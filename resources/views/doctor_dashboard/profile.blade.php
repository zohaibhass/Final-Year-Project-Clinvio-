@extends('doctor_dashboard.doctors_layout')
@section('title', 'profile setting')
@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2 animate__animated animate__zoomIn"
            style="box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;">

            @if (session('success'))
                <div class="alert alert-success mt-3">
                    {{ session('success') }}
                </div>
            @elseif (session('error'))
                <div class="alert alert-danger mt-3">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Profile Settings Form -->
            <h2 class="mb-4">Profile Settings</h2>

            <form method="POST" action="{{ route("doctor.profile.update") }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <!-- Profile Picture -->
                        <div class="card mb-3"
                            style="box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;">
                            <img class="card-body" src="{{ asset('storage/public/uploads' . $doctor->Profile_picture)}}"
                                alt="Doctor Profile Picture" class="img-fluid rounded mb-3 profile-picture">
                            <div class="upload-btn-wrapper text-center mb-2">
                                <button class=" btn-sm orange-outline-button ">Change Profile Photo</button>
                                <input type="file" name="profile_photo" id="profile_photo" accept="image/*">
                                @error('profile_photo')
                                  <p class="alert alert-danger"> {{$message  }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" name="name" class="form-control" id="name" value="{{ $doctor->Name }}"
                                placeholder="Enter your full name">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" name="email" class="form-control" id="email"
                                placeholder="Enter your email" value="{{ $doctor->Email }}">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="update_password" class="form-label">Update Password</label>
                            <div class="input-group">
                                <input name="update_password" type="password" class="form-control"
                                    id="update_password" placeholder="Enter your new password">
                                <input name="update_password_confirmation" type="password" class="form-control"
                                    id="update_password_confirmation" placeholder="Confirm your new password">
                                <button class="btn btn-outline-primary" type="button" id="show-new-password-btn">
                                    <i class="bi bi-eye" id="toggleNewPassword"></i>
                                </button>
                            </div>
                            @error('update_password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            @error('update_password_confirmation')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone No</label>
                            <input name="phone" type="number" class="form-control" id="phone"
                                value="{{ $doctor->Phone }}" placeholder="">
                            @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="dept_id" class="form-label">Specialty</label>
                            <select class="form-select" id="dept_id" name="dept_id">
                                @foreach ($departments as $department)
                                    <option value="{{ $department->dept_id }}"
                                        {{ $doctor->department->dept_id == $department->dept_id ? 'selected' : '' }}>
                                        {{ $department->Name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('dept_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" class="form-control" id="description"
                                cols="30" rows="10">{{ $doctor->Description }}</textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class=" orange-outline-button mb-2 ">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const togglePasswordVisibility = (inputId, buttonId) => {
            const passwordInput = document.getElementById(inputId);
            const toggleButton = document.getElementById(buttonId);
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            toggleButton.classList.toggle('bi-eye');
            toggleButton.classList.toggle('bi-eye-slash');
        };

        document.getElementById('show-new-password-btn').addEventListener('click', function() {
            togglePasswordVisibility('update_password', 'toggleNewPassword');
        });

        document.getElementById('show-password-confirmation-btn').addEventListener('click', function() {
            togglePasswordVisibility('password_confirmation', 'togglePasswordConfirmation');
        });
    });

</script>

@endsection
