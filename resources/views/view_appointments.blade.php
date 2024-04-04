@extends('layouts.layout_landingpage')
@section('title','enter_cnic and phone')
@section('content')
<div class="row mt-5 mb-4 ml-5 mx-5  card animate__animated animate__zoomIn shadow">
   <div class="card-header"><h2 class="card-title">Enter CNIC and Phone Number</h2></div>

   @if (session('message'))

   <div class="alert alert-danger">

       {{ session('message') }}
   </div>
   @endif


    <form class="card-body" id="patientForm" action="{{ route('patient.verifyDetails') }}" method="POST">
        @csrf
        <div class=" form-floating mb-6 mb-md-0">
            <input type="text"  class="form-control" id="cnic" name="cnic" required>
            <label>CNIC</label>
        </div>
        <div class="form-floating mt-2 mb-6 mb-md-2">

            <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber" required>
            <label for="phoneNumber" class="form-label">Phone Number</label>
        </div>
        <div class=" card-footer">
        <input type="submit" class="btn orange-outline-button" value="submit">
    </div>
    </form>

</div>


@endsection
