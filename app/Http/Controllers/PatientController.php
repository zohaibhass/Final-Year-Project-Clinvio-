<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Patient;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{

    public function book_appointment(Request $request)
    {

        // Validate the request data
        $validation = $request->validate([

            'name' => 'required',
            'phone' => 'required',
            'cnic' => 'required|min:12|max:15',
            'Age' => 'required|numeric',
            'Gender' => 'required',
            'date' => 'required',
            'pat_description' => 'required'

        ]);

        // Create a new appointment record
        $patient = Patient::create([
            'Name' => $request->input('name'),
            'Phone' => $request->input('phone'),
            'cnic' => $request->input('cnic'),
            'Age' => $request->input('Age'),
            'Gender' => $request->input('Gender'),
        ]);


        $datetime = new DateTime($request->date);
        $start_time = $datetime->format("H:i:s");
        $date = $datetime->format("Y-m-d");
        $end_time = $datetime->modify("+ 15 minutes")->format("H:i:s");

        $appointment = Appointment::insert([
            'Pat_id' => $patient->id,
            'Doctor_id' => $request->input('doctor_id'),
            'description' => $request->input('pat_description'),
            'Time_start' => $start_time,
            "Time_end" => $end_time,
            "date" => $date,
            "status" => "pending"

        ]);


        // Redirect back with a success message
        return back()->with('success', 'Appointment requested successfully!');
    }

    // method to accecpt_reject_patient

    public function updateAppointmentStatus(Request $request, $appointmentId)
    {
        $appointment = Appointment::findOrFail($appointmentId);

        // Check if the current user is the doctor associated with the appointment
        if ($appointment->doctor_id == Auth::user()->id) {
            // Doctor can approve or reject the appointment
            $appointment->status = $request->status; // 'confirmed' or 'rejected'
            $appointment->save();

            return back()->with('success', 'patient accecpted');
        }
    }


    // Displaying Appointments for Patients

    public function viewAppointments(Request $request)

    {
        $doctor_id = session()->get('AuthUser')->Doctor_id;

        $request->status = $_GET['status'] ?? "pending";

        // Retrieve pending and confirmed appointments for the patient
        if ($request->status == 'pending') {
            $pendingAppointments = Appointment::where('Doctor_id', $doctor_id)->where('status', 'pending')
                ->get();

            // dd($pendingAppointments);


            return view('doctor_dashboard/all_patients', compact('pendingAppointments'));
        } elseif ($request->status == 'confirm') {

            $confirmedAppointments = Appointment::where('Doctor_id', $doctor_id)
                ->where('status', 'confirm')
                ->get();



            return view('doctor_dashboard/confirm_appointments', compact('confirmedAppointments'));
        }
    }







    public function showpatients()
    {
        $show_pat = Patient::select('Pat_id', 'Name', 'Phone', 'Gender', 'Age')->get();

        return view('doctor_dashboard.all_patients', ['show_pat' => $show_pat]);
    }

    public function reject_patients($id)
    {
        $delete_pat = Patient::where('Pat_id', $id)->delete();
        return back()->with('sucess', 'patient deleted');
    }


    public function single_patient($id)
    {
        $single_apt = Appointment::where('Apt_id', $id)->first();

        return view('doctor_dashboard.single_patient', [
            'singleapt' => $single_apt
        ]);
    }


    public function acceptAppointment(Request $req)
    {

        $appx = Appointment::where("Apt_id", $req->id)->update([
            "status" => $req->status
        ]);


        return redirect()->back();
    }


    public function showAppointments(Request $request)
    {

        $patient = session()->get("AuthPatient");


        if ($patient == null) {
            return redirect()->route("cnic_phone")->with(['message' => "Please Verify First..."]);
        }

        $appointments = Appointment::whereHas('patient', function ($query) use ($patient) {
            $query->where('cnic', $patient->cnic)
                  ->where('Phone', $patient->Phone);
        })->where('status', 'confirm')->get();


        // Pass the appointments data to the view
        return view('myappointments', compact('appointments'));
    }
}
