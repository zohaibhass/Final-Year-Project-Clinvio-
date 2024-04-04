@extends('doctor_dashboard.doctors_layout')
@section('title','confirmed appointments')
@section('content')
    <div class="container mt-5">
        <h2 class="text-center animate__animated animate__zoomIn">Confirmed Patients</h2>
        @if (count($confirmedAppointments)>0)

        <table class="table table-striped animate__animated animate__zoomIn">
            <thead class="thead-dark">
                <tr>
                    <th class="text-center">Appointment id</th>
                    <th class="text-center">Patient Name</th>
                    <th class="text-center">Appointment Date</th>
                    <th class="text-center">Start Time</th>
                    <th class="text-center">End Time</th>
                    <th scope="col text-center">Action</th>
                    <th scope="col text-center">Details</th>
                </tr>
            </thead>
            <tbody>
                @foreach ( $confirmedAppointments as $confirm )


                <tr>
                    <td class="text-center">{{$confirm->Apt_id}}</td>
                    <td class="text-center">{{$confirm->patient->Name}}</td>
                    <td class="text-center">{{$confirm->Date}}</td>
                    <td class="text-center">{{$confirm->Time_start}}</td>
                    <td class="text-center">{{$confirm->Time_end}}</td>
                    <td><a class="btn btn-outline-danger" href="{{ Route('remove_appointment', $confirm->Apt_id) }}"><i
                        class="fa-solid fa-trash-can"></i></a></td>

                        <td><a class="btn btn-outline-primary btn-md" href="{{ Route('single_patient', $confirm->Apt_id) }}"><i class="fa-solid fa-eye"></i></a>

                </tr>

                @endforeach
                <!-- Add more rows for confirmed patients as needed -->
            </tbody>
        </table>
        @else

       <div class="sufee-alert alert with-close alert-secondary mx-5 mt-5 alert-dismissible animate__animated animate__fadeInDown">
        <span class="badge badge-pill badge-secondary">Empty</span>
        No appointment confirmed yet
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>

       @endif
    </div>
@endsection
