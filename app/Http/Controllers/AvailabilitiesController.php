<?php

namespace App\Http\Controllers;

use App\Models\Availability;

use Illuminate\Http\Request;

class AvailabilitiesController extends Controller
{

    public function viewAv(){

        $user= session()->get("AuthUser");
        $allAv= Availability::where("Doctor_id", $user->Doctor_id)->get();

        $allAvailabilities=[];
        foreach($allAv as $av){
            $allAvailabilities[$av->day]= [
                "start_time"=> $av->start_time,
                "end_time"=> $av->end_time
            ];
        }

        return view('doctor_dashboard.availability', compact("allAvailabilities"));
    }

    public function save_availability(Request $request)
    {
        // Ensure the user is authenticated

        // Validate the form data
        $request->validate([
            'day' => 'required|array',
            'start_time' => 'required|array',
            'end_time' => 'required|array',
        ]);

        // Get data from the form
        $authUser= session()->get("AuthUser");
        $doctorId = $authUser->Doctor_id;
        $days = $request->input('day');
        $startTimes = $request->input('start_time');
        $endTimes = $request->input('end_time');


        // Iterate through the form data and save it to the database
        // dd($doctorId);
 
        foreach ($days as $key => $day) {

            $dayx= Availability::where("day",$day)->where("Doctor_id", $doctorId)->first();

            if($dayx != null){

                $dayx->update([
                    "start_time"=>  $startTimes[$key] ,
                    "end_time"=>  $endTimes[$key] 
                ]);
            }
            else{
                
                Availability::insert([
                    'Doctor_id' =>  $doctorId,
                    'day' => $day,
                    'start_time' => $startTimes[$key],
                    'end_time' => $endTimes[$key],
                ]);
            }
            
        }

        // Redirect back with a success message
        return back()->with('success', 'Availability saved successfully.');
    }

}
