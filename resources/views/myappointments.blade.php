@extends('layouts.layout_landingpage')
@section('title',"myappontments")
@section('content')
    <div  class=" container white_box mb_30 mb-2 animate__animated animate__zoomIn">
        <div class="box_header ">
            <div class="main-title text-center">
                <h3 class="mb- my-5">Appointments</h3>
            </div>
        </div>

        {{-- @if (count($appointments) > 0) --}}
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Doctor Name</th>
                    <th scope="col">Day</th>
                    <th scope="col">Time</th>
                    <th scope="col">Date</th>
                    <th scope="col">status</th>
                </tr>
            </thead>
            <tbody>

                {{-- @if($appointments->isEmpty())

        @else --}}


        @foreach($appointments as $appointment)
                <tr>
                    <th scope="row">{{$appointment->Apt_id}}</th>
                    <td>{{$appointment->doctor->Name}}</td>
                    <td>{{$appointment->Date}}</td>
                    <td>{{$appointment->Time_start}}</td>
                    <td>{{$appointment->Time_end}}</td>
                    <td><span class="badge badge-pill badge-success ">Approve</span></td>
                </tr>
                @endforeach
            </tbody>

        </table>
        {{-- @else

        <div class="sufee-alert alert with-close alert-secondary mx-5 mt-5 alert-dismissible animate__animated animate__fadeInDown">
            <span class="badge badge-pill badge-secondary">Empty</span>
            No appointments found for the provided CNIC and Phone Number.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>

        @endif --}}
    </div>
@endsection
