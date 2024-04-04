@extends('doctor_dashboard.doctors_layout')
@section('title','add certification')
@section('content')
    <div class="container card mt-5">
        <h2 class="text-center card-title animate__animated animate__zoomIn">Add Certificate</h2>

        <div class="card-body alret alert-danger animate__animated animate__zoomIn">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @elseif (session('success'))

            <div class="alert alert-success">

                {{ session('success') }}
            </div>
            @endif

        <form action="{{route('add_Certificate')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">

                <div class="form-group d-none">
                    <label for="doctorId">Doctor ID:</label>
                    <input type="hidden" class="form-control" id="doctorId" name="doc_id" required>
                </div>
                <div class="form-group col-sm-5">
                    <label for="Certificate_Title">Certificate Title:</label>
                    <input type="text" class="form-control" value="{{old('Certificate_Title')}}" name="Certificate_Title" id="Certificate_Title"
                        placeholder="Enter Certificate Title" required>
                </div>
                <div class="form-group col-sm-5">
                    <label for="organization">Organization:</label>
                    <input type="text" class="form-control" value="{{old('organization')}}" name="organization" id="organization" placeholder="Enter Organization" required>
                </div>
                <div class="form-group col-sm-5">
                    <label for="completionDate">Completion Date:</label>
                    <input type="date" class="form-control" value="{{old('completionDate')}}" name="completionDate"  id="completionDate" required>
                </div>

                <div class="form-group col-sm-5">
                    <label for="file">Upload your certificates:</label>
                    <input type="file" class="form-control" id="file" value="{{old('upload_certificate')}}"  name="upload_certificate" required>
                </div>

                <div class="form-group col-sm-6">
                    <label for="description">Description:</label>
                    <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter Description About your certificates">{{old('description')}}</textarea>
                </div>

            </div>
            <div class="text-center">

                <input type="submit" class="orange-outline-button text-center mt-3">

            </div>
        </form>
    </div>
@endsection
