<?php

namespace App\Http\Controllers;

use App\Mail\DoctorAcceptedNotification;
use App\Mail\DoctorApprovalEmail;


use App\Mail\DoctorRejectedNotification;
use App\Models\Appointment;
use App\Models\Availability;
use App\Models\Certification;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\Image;
use App\Models\Option;
use App\Models\User;
use Carbon\Carbon;

use function Laravel\Prompts\select;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Routing\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;
use Nette\Utils\Random;
use PhpParser\Node\Stmt\Return_;

class DoctorController extends Controller
{


    // method to insert doctors by super admin

    public function insertdoctor(Request $request)
    {

        $request->validate([


            'doc_name' => 'required|string|max:255',
            'email' => 'required|Email|unique:doctors',
            'specialty' => 'required|string|max:255',
            'profile_picture' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'phone' => 'required|string|max:20',
            'gender' => 'required|string|in:Male,Female',
            'age' => 'required|integer|min:1',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'adress' => 'required',

            'doc_description' => 'nullable|string|max:1000'

        ]);

        $file = $request->file('profile_picture');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = 'public/uploads' . $fileName;

        Storage::disk('public')->put($filePath, file_get_contents($file));
        $departmentId = $request->input('dept_id');

        $pass = rand(8, 12);

        $doctor_data = Doctor::insert([
            'Name' => $request->input('doc_name'),
            'Email' => $request->input('email'),
            'Department' => $request->input('specialty'),
            'Profile_picture' => $fileName,
            'Phone' => $request->input('phone'),
            'Gender' => $request->input('gender'),
            'Age' => $request->input('age'),
            'city' => $request->input('city'),
            'state' => $request->input('state'),
            'country' => $request->input('country'),
            'Department' => $request->input('specialty'),
            'adress' => $request->input('adress'),
            'Password' => Hash::make($pass),
            'Description' => $request->input('doc_description'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if ($doctor_data) {
            return back()->with('success', 'Doctor added successfully!');
        } else {
            return back()->with('error', 'enter valid data');
        }
    }

    // method to show all the doctors

    public function ShowDoctors()
    {

        $get_doc = Doctor::simplepaginate(4);
        $department = Department::select('Name')->get();


        return view('admin/all_doctors', [
            'doc_data' => $get_doc,
            'dept' => $department
        ]);
    }

    // method to delete doctor from by super admin

    public function delete_doctor(string $id)
    {

        $dlt_doc = Doctor::where('Doctor_id', $id)->delete();
        return back();

        //    return view('delete_doctor',['dlt_doc'=>$dlt_doc]);

    }

    // method to update page of doctor

    public function update_page(string $id)
    {

        $update_page = Doctor::all()->where('Doctor_id', $id)->first();



        return view('admin.update_doctor', ['up_page' => $update_page]);
    }

    // method to update_doctor

    public function update_doctor(string $id, Request $req)
    {
        // Validate the form fields
        $validatedData = request()->validate([
            'doc_name' => 'required',
            'email' => 'required|email',
            'dept_id' => 'required',
            'profile_picture' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'phone_no' => 'required',
            'gender' => 'required',
            'age' => 'required|numeric',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'adress' => 'required',
            'doc_description' => 'required',
        ]);

        if ($req->hasFile('profile_picture')) {
            $file = $req->file('profile_picture');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = 'public/uploads' . $fileName;

            // Save the profile picture to the same path
            Storage::disk('public')->put($filePath, file_get_contents($file));

            // Update the profile picture path in the data array
            $data['Profile_picture'] = $fileName;
        }

        $updateData = [
            'Name' => $validatedData['doc_name'],
            'Email' => $validatedData['email'],
            'dept_id' => $validatedData['dept_id'],
            'Phone' => $validatedData['phone_no'],
            'Gender' => $validatedData['gender'],
            'Age' => $validatedData['age'],
            'Profile_picture' => $fileName,
            'city' => $validatedData['city'],
            'state' => $validatedData['state'],
            'country' => $validatedData['country'],
            'Description' => $validatedData['doc_description'],
            'adress' => $validatedData['adress'],
        ];

        // Update the doctor record
        Doctor::where('Doctor_id', $id)->update($updateData);

        return redirect()->route('alldoctors');
    }



    // method to target recent doctors on super admin dashboard

    public function RecentDoctors()
    {
        $today = Carbon::now()->toDateString();
        $recentDoctors = Doctor::orderBy('created_at', 'desc')->simplepaginate(4);


        $alldoctorscount = Doctor::count();

        $newdoctorscount = Doctor::where('created_at', '>=', now()->subDays(4))
            ->count();
        $todaysAppointmentsCount = Appointment::whereDate('Date', $today)->count();
        $totalAppointmentsCount = Appointment::count();


        return view('admin.super_admin_dashboard', [
            'recentDoctors' => $recentDoctors,
            'all_doc_count' => $alldoctorscount,
            'new_doc_count' => $newdoctorscount,
            'todaysappointments' => $todaysAppointmentsCount,
            'totalappointments' => $totalAppointmentsCount
        ]);
    }

    // method to register doctor

    public function reg_doctor(Request $req)
    {
        $req->validate([
            'name' => 'required',
            'phone' => 'required|unique:doctors',
            'email' => 'required|email|unique:doctors',
            'password' => ['required', Password::min(8)],
            'gender' => 'required',
            'age' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'profile' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'adress' => 'required',
            // 'tags' => 'required',
            'doc_description' => 'required'
        ]);

        $file = $req->file('profile');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = 'public/uploads' . $fileName;

        Storage::disk('public')->put($filePath, file_get_contents($file));
        $departmentId = $req->input('dept_id');

        try {

            Doctor::create([
                // $authUser= session()->get("AuthUser"),
                // $departmentId = $authUser->dept_id,
                'Name' => $req->input('name'),
                'Phone' => $req->input('phone'),
                'Email' => trim($req->input('email')),
                'password' => Hash::make($req->input('password')),
                'Gender' => $req->input('gender'),
                'Age' => $req->input('age'),
                'city' => $req->input('city'),
                'state' => $req->input('state'),
                'country' => $req->input('country'),
                'adress' => $req->input('adress'),
                'Profile_picture' => $fileName,
                'dept_id' => $departmentId,
                'tags' => $req->input('tags'),
                'Description' => $req->input('doc_description')


            ]);

            return redirect()->route('doctor_dashboard_home')->with('success', 'Registration successful!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Error while registering. Please try again.' . $e->getMessage()])->withInput();
        }
    }
    public function get_dept()
    {
        $getdept = Department::all();
        return view('doctor_dashboard.doctor_signup.register_doctor', ['departments' => $getdept]);
    }
    // method for login by doctor

    public function login(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Authentication
        $email = trim($request->input('email'));
        $password = $request->input('password');

        $user = Doctor::where('Email', "=", $email)->first();
        $super_admin = User::where('email', '=', $email)->first();

        if ($user && Hash::check($password, $user->Password)) {

            session(['AuthUser' => $user]);
            session(['AuthUserType' => "doctor"]);


            return redirect()->route('dashboard');
        } elseif ($super_admin && Hash::check($password,  $super_admin->password)) {

            session(['AuthUser' => $super_admin]);
            session(['AuthUserType' => "admin"]);


            return redirect()->route('recent_doctors');
        } else {
            // If authentication fails, redirect back with an error message
            return redirect()->back()->withErrors(['email' => 'Invalid email or password'])->withInput();
        }
    }


    // method for search on super admin dashboard

    public function search(Request $req)
    {
        $query = $req->input('search');
        $search_type = $req->input('search_type');

        if ($search_type == 'departments') {
            $result = Department::where('Name', 'like', '%' . $query . '%')->get();
            // return dd($result);
            return view('admin.search_result', [
                'results' => $result,
                'search_type' => $search_type
            ]);
        } elseif ($search_type == 'doctors') {
            $result = Doctor::where('Name', 'like', '%' . $query . '%')->get();
            // return dd($result);
            return view('admin.search_result', [
                'results' => $result,
                'search_type' => $search_type
            ]);
        } else {
            return back()->with('error', 'invalid search');
        }
    }

    //    method to show the details of doctor

    public function showDoctorDetails($id)
    {

        $doctor = Doctor::select('Doctor_id', 'Name', 'dept_id', 'Email', 'Phone', 'Age', 'Gender', 'Description', 'Profile_picture')
            ->where('Doctor_id', $id)
            ->first();

        $certification = Certification::where('Doctor_id', $id)
            ->get();

        $dept = Department::select('Name')->where('Dept_id', $id)->first();


        return view('admin/show_doctor_detail', [
            'doctor' => $doctor,
            'department' => $dept,
            'certification' => $certification
        ]);
    }

    // method to approve doctor

    public function approveDoctor($id)
    {
        try {
            Doctor::where("Doctor_id", $id)->update(['status' => 'accepted']);
            $doctor = Doctor::where("Doctor_id", $id)->first();
            Mail::to($doctor->Email)->send(new DoctorAcceptedNotification($doctor));
            return redirect()->back()->with('success', 'Doctor approved successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to send email. Please check your internet connection and try again.');
        }
    }

    // method to reject doctor

    public function rejectDoctor($id)
    {
        try {
            Doctor::where("Doctor_id", $id)->update(['status' => 'rejected']);
            $doctor = Doctor::where("Doctor_id", $id)->first();
            Mail::to($doctor->Email)->send(new DoctorRejectedNotification($doctor));
            return redirect()->back()->with('success', 'Doctor rejected successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to send email. Please check your internet connection and try again.');
        }
    }


    public function welcome()
    {
        $doctors = Doctor::where("status", "accepted")->limit(3)->get();
        return view('welcome', compact('doctors'));
    }

    public function loadMore(Request $request)
    {
        $offset = $request->get('offset', 0);
        $limit = 3; // Number of doctors to load at a time

        // Fetch more doctors using query builder
        $doctors = Doctor::with('department')->skip($offset)->take($limit)->get();

        return view('load-more-doctors', compact('doctors'));
    }

    public function show_details_doc(string $id)
    {

        $show_details = Doctor::where('Doctor_id', $id)->first();
        $show_dept = Department::select('Dept_id', 'Name')->where('Dept_id', $id)->first();
        // Fetch availability data for the specific doctor
        $availabilityData = Availability::where('Doctor_id', $id)->get();




        return view('details', [
            'doctor_detail' => $show_details,
            'show_dept' => $show_dept,
            'availabilityData' => $availabilityData
        ]);
    }


    public function showAllDoctors()
    {
        // Fetch doctors and their corresponding departments from the database
        $doctors = Doctor::where("status", "accepted")->simplepaginate(3);

        return view('allappointments', ['doctors' => $doctors]);
    }

    public function searchDoctors(Request $request)
    {
        $searchQuery = $request->input('search');

        $doctors = Doctor::where('Name', 'like', "%{$searchQuery}%")
            ->orWhere('Description', 'like', "%{$searchQuery}%")
            ->orWhereHas('department', function ($query) use ($searchQuery) {
                $query->where('dept_id', 'like', "%{$searchQuery}%");
            })
            ->get();

        return view('search_landing', compact('doctors'));
    }

    public function logoutx()
    {
        unset($_SESSION["AuthUser"]);
        unset($_SESSION["AuthUserType"]);

        session()->remove("AuthUser");
        session()->remove("AuthUserType");
        return redirect()->route('login_page'); // Redirect to the login page after logout
    }


    public function showProfileForm()
    {
        $user = session()->get("AuthUser");
        $doctor = Doctor::with('department')->where("Doctor_id", $user->Doctor_id)->first();
        $departments = Department::all();

        return view('doctor_dashboard/profile', [
            'doctor' => $doctor,
            'departments' => $departments
        ]);
    }
    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        // Check if the user is authenticated and has associated doctor data
        if (!$user || !$user->doctor) {
            return redirect()->back()->with('error', 'User or doctor data not found.');
        }

        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'update_password' => 'nullable|string|min:6|confirmed',
            'phone' => 'nullable|string|max:20',
            'dept_id' => 'nullable|exists:departments,dept_id',
            'description' => 'nullable|string',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust max file size if needed
        ]);

        // Update doctor's profile data
        $doctor = $user->doctor; // Get the doctor instance directly from the user
        $doctor->Name = $validatedData['name'];
        $doctor->Email = $validatedData['email'];
        $doctor->Phone = $validatedData['phone'];
        $doctor->dept_id = $validatedData['dept_id'];
        $doctor->Description = $validatedData['description'];

        // Update password if provided
        if ($validatedData['update_password']) {
            $doctor->Password = bcrypt($validatedData['update_password']);
        }

        // Handle profile photo if provided
        if ($request->hasFile('profile_photo')) {
            $photoPath = $request->file('profile_photo')->store('public/uploads');
            $doctor->Profile_picture = str_replace('public/', '', $photoPath);
        }

        $doctor->save();

        return redirect()->route('doctorprofile')->with('success', 'Profile updated successfully!');
    }



    // code to all doctors langing page

    public function all_doc_page()
    {
        $doc = Doctor::select('Name', 'Description')->with('department')->join('doctors', 'Doctor_id_id', '=', '.Doctor_id')->get();

        return view('allappointments', ['doctors' => $doc]);
    }
}
