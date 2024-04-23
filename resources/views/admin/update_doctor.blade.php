@extends('admin.index')
@section('title', 'update doctors')
@section('content')
    <div class="container col-md-8 order-md-1">

        <h4 class="mb-3 text-center mt-5">Update Doctor</h4>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <form action="{{ route('update_doctor', ['id' => $up_page->Doctor_id]) }}" method="POST" enctype="multipart/form-data"
            class="animate__animated animate__zoomIn">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="team_name">Doctor Name</label>
                    <input type="text" class="form-control" name="doc_name" value="{{ $up_page->Name }}"
                        placeholder="Doctor Name" required="">
                    @error('doc_name')
                        <p class="alert alert-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="EMAIL">Email</label>
                    <input type="text" class="form-control" name="email" value="{{ $up_page->Email }}"
                        placeholder="Enter your Email" required="">
                    @error('email')
                        <p class="alert alert-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="row">
                    @php
                        use App\Models\Department;
                        $departments = Department::all();

                    @endphp
                    <div class="form-group col-md-6 mb-3">
                        <label for="dept_id" class="form-label">Specialty</label>
                        <select class="form-select" id="dept_id" name="dept_id">
                            @foreach ($departments as $department)
                                <option value="{{ $department->dept_id }}"
                                    {{ $up_page->department->dept_id == $department->dept_id ? 'selected' : '' }}>
                                    {{ $department->Name }}
                                </option>
                            @endforeach
                        </select>
                        @error('dept_id')
                            <p class="alert alert-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="profile_picture">Profile Picture</label>
                        <input type="file" class="form-control" name="profile_picture" id="picture">
                        @if ($up_page->Profile_picture)
                            <img style="height: 50px; width: 50px;"
                                src="{{ asset('storage/public/uploads' . $up_page->Profile_picture) }}"
                                alt="Profile Picture">
                        @endif
                        @error('profile_picture')
                            <p class="alert alert-danger">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="phoneph">Phone No</label>
                    <input type="text" class="form-control" name="phone_no" id="phone" placeholder="Enter Phone No"
                        value="{{ $up_page->Phone }}" required="">
                    @error('phone_no')
                        <p class="alert alert-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group col-md-6 mb-3">
                    <label for="gender">Gender:</label>
                    <input type="text" class="form-control" name="gender" id="gender" placeholder="male/female"
                        value="{{ $up_page->Gender }}" required="">
                    @error('gender')
                        <p class="alert alert-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="row">


                <div class=" form-group col-md-6 mb-3">
                    <label for="age">Age</label>
                    <input type="number" class="form-control" name="age" id="age" value="{{ $up_page->Age }}"
                        required="">
                    @error('age')
                        <p class="alert alert-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class=" form-group col-md-6 mb-3">
                    <label for="inputCity">city</label>
                    <input type="text" class="form-control" value="{{ $up_page->city }}" name="city" id="city"
                        required="">
                    @error('city')
                        <p class="alert alert-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="inputstate">State</label>
                    <input type="text" class="form-control" value="{{ $up_page->state }}" name="state" id="state"
                        placeholder="state or porvience" required="">
                    @error('state')
                        <p class="alert alert-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group col-md-6 mb-3">
                    <label for="country">Country</label>
                    <input type="text" class="form-control" value="{{ $up_page->country }}" name="country"
                        id="country" placeholder="enter your country" required="">
                    @error('country')
                        <p class="alert alert-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="inputAdress">Adress</label>
                    <input type="text" class="form-control" value="{{ $up_page->adress }}" name="adress"
                        id="adress" placeholder="enter your adress" required="">
                    @error('adress')
                        <p class="alert alert-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="team_description">Description</label>
                <textarea rows="7" class="form-control" name="doc_description" placeholder="text" required="">{{ $up_page->Description }}</textarea>
                @error('doc_description')
                    <p class="alert alert-danger">{{ $message }}</p>
                @enderror
            </div>

    </div>
    <div class="text-center">
        <i class="fa-solid fa-plus"></i> <input class="orange-outline-button" type="submit" value="Update">
    </div>
    </form>
    </div>
@endsection
