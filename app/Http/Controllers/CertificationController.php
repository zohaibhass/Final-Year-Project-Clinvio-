<?php

namespace App\Http\Controllers;
use App\Models\Certification;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class CertificationController extends Controller
{


    public function add_certificate(Request $request)
{
    // Validate the form data
    $request->validate([
        'Certificate_Title' => 'required|string',
        'organization' => 'required|string',
        'completionDate' => 'required|date',
        'upload_certificate' => 'required|file|mimes:pdf,doc',
        'description' => 'nullable|string',
    ]);

    // Handle file upload
    $path=false;
    if($request->hasFile("upload_certificate")){

        $path= $request->file("upload_certificate")->storePublicly("/public/public/certificates/files");
    }

    // Get the authenticated user's ID
    $authUser = session()->get("AuthUser");
    $doctorId = $authUser->Doctor_id;

    $file=null;
    if($path){
      // Create a new Image instance and associate it with the certification using the 'model' column
        $file= Image::create([
            'Model' => "certificate",
            'Image_path' => $path,
        ]);
    }
  
    // Insert data into the 'certifications' table using Eloquent
    $certification = new Certification();
    $certification->doctor_id = $doctorId;
    $certification->name = $request->input('Certificate_Title');
    $certification->organization = $request->input('organization');
    $certification->completion_date = $request->input('completionDate');
    $certification->certi_description = $request->input('description');
    $certification->certi_id= $file==null ? "" : $file->id;
    $certification->created_at = now();
    $certification->updated_at = now();
    $certification->save();



    // Redirect to a success page or return a response as needed
    return back()->with('success', 'Certification added successfully. Hope you will be listed on clinvio soon.');
}

}

    

