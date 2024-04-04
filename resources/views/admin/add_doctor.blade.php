@extends('admin.index')
@section('title', 'add doctors')
@section('content')
    <div class="ms-3 me-3 mt-3 card col p-5 mb-5 shadow">
        <h4 class="mb-3 text-center mt-2">Add Doctor</h4>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @elseif (session('success'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('insert_doctor') }}" method="POST" enctype="multipart/form-data" class="animate__animated animate__zoomIn">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="doc_name">Doctor Name</label>
                        <input type="text" class="form-control" name="doc_name" value="{{ old('doc_name') }}" placeholder="Doctor Name" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Enter your Email" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="specialty">Specialty</label>
                        <select class="form-control" id="specialty" name="specialty" required>
                            <option value="" selected>Select specialty</option>
                            @foreach (\App\Models\Department::select('Name')->get() as $Department)
                                <option value="{{ $Department->Dept_id }}">{{ $Department->Name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="profile_picture">Profile Picture</label>
                        <input type="file" class="form-control" name="profile_picture" id="profile_picture" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="phone_no">Phone No</label>
                        <input type="text" class="form-control" name="phone_no" id="phone" placeholder="Enter Phone No" value="{{ old('phone_no') }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="gender">Gender</label>
                        <input type="text" class="form-control" name="gender" id="gender" placeholder="Male/Female" value="{{ old('gender') }}" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="age">Age</label>
                        <input type="number" class="form-control" name="age" id="age" value="{{ old('age') }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="city">City</label>
                        <input type="text" class="form-control" name="city" id="city" value="{{ old('city') }}" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="state">State</label>
                        <input type="text" class="form-control" name="state" id="state" placeholder="State or Province" value="{{ old('state') }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="country">Country</label>
                        <input type="text" class="form-control" name="country" id="country" placeholder="Enter your country" value="{{ old('country') }}" required>
                    </div>
                </div>
            </div>
            <div class="form-group mb-3">
                <label for="address">Address</label>
                <input type="text" class="form-control" name="address" id="address" placeholder="Enter your address" value="{{ old('address') }}" required>
            </div>
            <div class="form-group mb-3">
                <label for="doc_description">Description</label>
                <textarea rows="7" class="form-control" name="doc_description" placeholder="Enter text" required>{{ old('doc_description') }}</textarea>
            </div>
            <div class="text-center">
                <button type="submit" class="orange-outline-button"><i class="fa-solid fa-plus"></i> Add</button>
            </div>
        </form>
    </div>
@endsection
