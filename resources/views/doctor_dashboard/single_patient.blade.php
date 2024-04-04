@extends('doctor_dashboard.doctors_layout')
@section('title','patient details')
@section('content')

<div class="container mt-5">
    <div class="card animate__animated animate__zoomIn">
        <div class="card-body">
            <h2 class="card-title">Patient Details</h2>
            <dl class="row">
                <dt class="col-sm-3">Name:</dt>
                <dd class="col-sm-9">{{$singleapt->patient->Name}}</dd>

                <dt class="col-sm-3">Phone:</dt>
                <dd class="col-sm-9">{{$singleapt->patient->Phone}}</dd>

                <dt class="col-sm-3">Age:</dt>
                <dd class="col-sm-9">{{$singleapt->patient->Age}}</dd>

                <dt class="col-sm-3">Gender:</dt>
                <dd class="col-sm-9">{{$singleapt->patient->Gender}}</dd>

                <dt class="col-sm-3">Date:</dt>
                <dd class="col-sm-9">{{$singleapt->Date}}</dd>

                <dt class="col-sm-3">Time Start:</dt>
                <dd class="col-sm-9">{{$singleapt->Time_start}}</dd>

                <dt class="col-sm-3">Time End:</dt>
                <dd class="col-sm-9">{{$singleapt->Time_end}}</dd>

                <dt class="col-sm-3">Description:</dt>
                <dd class="col-sm-9">{{$singleapt->description}}</dd>
            </dl>

            {{-- <div>
                <a class="btn btn-danger btn-sm" href="{{ Route('reject_patients', $singleapt->patient->Pat_id) }}">Cancel</a>
                <a class="btn btn-success btn-sm" href="{{route('appointments.accept',['id'=>$singleapt->patient->Pat_id,'status'=>'confirm'])}}" >Confirm</a>
            </div> --}}
        </div>
    </div>
</div>

@endsection
