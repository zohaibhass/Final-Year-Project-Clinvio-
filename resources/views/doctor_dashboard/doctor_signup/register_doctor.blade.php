@extends('doctor_dashboard.doctor_signup.signup_layout')
@section('title', 'sign_up')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card shadow-lg border-0 rounded-lg mt-3 mb-5">
                    <div class="card-header">
                        <h3 class="text-center font-weight-light my-4">Doctor,s Registration to <a
                                href="{{ route('home') }}"><img class="shadow-lg"
                                    src="{{ asset('images\android-chrome-192x192.png') }}" style="max-width:5%;"
                                    alt=""></a></h3>
                        <div
                            class="sufee-alert alert with-close alert-warning mx-5 mt-5 alert-dismissible shadow">
                            <span class="badge badge-pill badge-danger">note</span>
                            The Registration is only for well qualified doctors. After registration please submit your
                            professional and experience certificates after verifying them you wil be listed on clinvio
                            otherwise your request will be decline within 24 hours
                            <button type="button" class="close badge-danger" style="color:white;" data-dismiss="alert" aria-label="Close">
                                <b aria-hidden="true">×</b>
                            </button>
                        </div>


                    </div>
                    <div class="card-body alret alert-danger">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('registration') }}" method="POST" enctype="multipart/form-data">

                            @csrf
                            <div class="row mb-3">
                                <div class="col-md-6 d-none">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" id="d0ctor_id" value="{{ old('doctor_id') }}"
                                            name="doctor_id" type="hidden" />
                                        <label>doctor id</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" id="Name" required="name"
                                            value="{{ old('name') }}" name="name" type="text"
                                            placeholder="Enter your name" />
                                        <label>Name</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input class="form-control" required="phone" value="{{ old('phone') }}"
                                            name="phone" id="inputPhone" type="text"
                                            placeholder="Enter your nobile no" />
                                        <label>Phone</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" required="email" value="{{ old('email') }}"
                                            name="email" id="inputemail" type="email" />
                                        <label>Email</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" id="inputPassword" required="password"
                                            value="{{ old('password') }}" name="password" type="password"
                                            placeholder="enter your password password" />
                                        <label>Password</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <select class="form-select" required id="Gender" name="gender">
                                            <option value="" disabled selected>Select Gender</option>
                                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male
                                            </option>
                                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female
                                            </option>
                                            <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other
                                            </option>
                                        </select>
                                        <label for="Gender">Gender</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" id="inputage" required="age"
                                            value="{{ old('age') }}" name="age" type="number"
                                            placeholder="male/female/others" />
                                        <label>Age</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" id="city" required=""
                                            value="{{ old('city') }}" type="text" name="city"
                                            placeholder="enter city" />
                                        <label>City</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" id="state" required=""
                                            value="{{ old('state') }}" type="text" name="state"
                                            placeholder="State eg sindh,GB etc" />
                                        <label>State</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" id="country" required=""
                                            value="{{ old('country') }}" type="text" name="country"
                                            placeholder="country" />
                                        <label>Country</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" id="inputAdress" required=""
                                            value="{{ old('adress') }}" type="text" name="adress"
                                            placeholder="Enter your permenant adress" />
                                        <label>Adress</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" id="profile" required=""
                                            value="{{ old('profile') }}" name="profile" type="file" />
                                        <label>Profile Picture</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">

                                        <select class="form-select" id="dept_id" name="dept_id">
                                            <option value="" selected> select a specialization</option>
                                            @foreach ($departments as $department)
                                                <option value="{{ $department->dept_id }}">
                                                    {{ $department->Name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label>select a specialization</label>
                                    </div>
                                </div>

                                <div class="row mb-3">

                                    <div class="col-md-6 mt-2 ">
                                        <div class="form-floating mb-3 mb-md-0">
                                            <textarea rows="7" class="form-control h-25" rows="5" value="{{ old('doc_description') }}"
                                                name="doc_description" value="" placeholder="explain your self" required=""></textarea>
                                            <label>Description</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center"><input class="orange-outline-button" type="submit"
                                        value="Register">
                                </div>

                                <div class="card-footer text-center py-3">
                                    <div class="small"><a href="{{ route('login_page') }}">Have an account? Go to
                                            login</a></div>
                                </div>
                        </form>


                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
