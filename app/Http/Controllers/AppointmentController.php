<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AppointmentController extends Controller
{
    public function doctor_dashboard_home() {

        // $doctor = Auth::guard('doctor')->user();

        // $doctor_id = $doctor->Doctor_id;
        // Retrieve the most recent appointments, ordered by appointment date in descending order

        $recentAppointments = Appointment::orderBy('Date', 'desc')
                                         ->limit(10) // You can adjust the number of recent appointments to display
                                         ->get();
        $totalAppointmentsCount = Appointment::count();

        $today = Carbon::now()->toDateString();

        // Retrieve the count of appointments scheduled for today
        $todaysAppointmentsCount = Appointment::whereDate('Date', $today)->count();

        $pendingAppointmentsCount = Appointment::where('status', 'pending')->count();

        // Retrieve the count of approved appointments
        $approvedAppointmentsCount = Appointment::where('status', 'confirm')->count();


        return view('doctor_dashboard/doctor_dashboard_home', ['recentAppointments'=>$recentAppointments,
                                                                'totalappointments'=>$totalAppointmentsCount,
                                                                 'todaysappointments'=>$todaysAppointmentsCount,
                                                                'pendingappointments'=>$pendingAppointmentsCount,
                                                                  'confirmedappointments'=>$approvedAppointmentsCount]);
    }
    public function remove_appointment(string $id)
    {

        $rem_apt = Appointment::where('Apt_id', $id)->delete();
        return back();

        //    return view('delete_doctor',['dlt_doc'=>$dlt_doc]);

    }


    function showDetails(Request $request){
        return view('view_appointments');
    }

    function verifyDetails(Request $request){

        $validated= $request->validate([
            "cnic"=>"required",
            "phoneNumber"=> "required|min:10"
        ]);

        $patient= Patient::where("Phone", $validated['phoneNumber'])->where("cnic", $validated['cnic'])->whereHas('appointments', function ($query) {
            $query->where('status', 'confirm');
        })
        ->with('appointments')->first();
        $all_appointments=null;

        if($patient!=null){
            session()->put("AuthPatient", $patient);
            return redirect()->route("patient.appointments");
        }
        else{
            return redirect()->back()->with(['message'=>"No appointment exists with provided Credentials"]);
        }



    }
}
