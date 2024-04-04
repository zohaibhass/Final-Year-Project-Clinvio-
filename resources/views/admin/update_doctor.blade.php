@extends('admin.index')
@section('title', 'update doctors')
@section('content')
    <div class=" container col-md-8 order-md-1">

        <h4 class="mb-3 text-center mt-5">Update Doctor</h4>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <form action="{{ Route('update_doctor',['id'=>$up_page->Doctor_id]) }} " method="POST" enctype="multipart/form-data" class="animate__animated animate__zoomIn">
            @csrf
            <div class="row">
                {{-- <div class="team_form"> --}}
                <div class="col-md-6 mb-3">
                    <label for="team_name">Doctor Name</label>
                    <input type="text" class="form-control" name="doc_name" value="{{$up_page->Name}}" placeholder="Doctor Name"
                        value="" required="">

                </div>


                <div class="col-md-6 mb-3">
                    <label for="EMAIL">Email</label>
                    <input type="text" class="form-control" name="email" value="{{$up_page->Email}}" placeholder="Enter your Email"
                        value="" required="">

                </div>
                {{-- </div> --}}

                <div class="row">

                    <div class="form-group col-md-6 mb-3">
                        <label for="specialty">Specialty:</label>
                        <select class="form-control" id="specialty" name="specialty">
                            @if ($up_page->department)
                                <option value="{{ $up_page->department->Dept_id }}" selected>{{ $up_page->department->Name }}</option>
                            @endif
                            @foreach (\App\Models\Department::select('Dept_id', 'Name')->get() as $Department)
                                <option value="{{ $Department->Dept_id }}">{{ $Department->Name }}</option>
                            @endforeach
                            <!-- Add more specialty options as needed -->
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="pofile_picture">Profile Picture</label>
                        <input type="file" class="form-control" name="profile_picture" id="picture" value="{{$up_page->Profile_picture}}"
                            required="">

                    </div>

                </div>


                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="phoneph">Phone No</label>
                        <input type="text" class="form-control" name="phone_no" id="phone"
                            placeholder="Enter Phone No" value="{{$up_page->Phone}}" required="">

                    </div>

                    <div class="form-group col-md-6 mb-3">
                        <label for="gender">Gender:</label>
                        <input type="text" class="form-control" name="gender" id="gender" placeholder="male/female"
                            value="{{$up_page->Gender}}" required="">
                    </div>
                </div>


                <div class="col-md-6 mb-3">
                    <label for="age">Age</label>
                    <input type="number" class="form-control" name="age" id="age" value="{{$up_page->Age}}" required="">

                </div>

                <div class="col-md-6 mb-3">
                    <label for="inputCity">city</label>
                    <input type="text" class="form-control"  value="{{$up_page->city}}" name="city" id="city" value=""
                        required="">

                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="inputstate">State</label>
                        <input type="text" class="form-control" value="{{$up_page->state}}" name="state" id="state"
                            placeholder="state or porvience" value="" required="">

                    </div>

                    <div class="form-group col-md-6 mb-3">
                        <label for="country">Country</label>
                        <input type="text" class="form-control" value="{{$up_page->country}}" name="country" id="country"
                            placeholder="enter your country" value="" required="">
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="inputAdress">Adress</label>
                        <input type="text" class="form-control" value="{{$up_page->adress}}" name="adress" id="adress"
                            placeholder="enter your adress" value="" required="">

                    </div>

                </div>

                <div class="mb-3">
                    <label for="team_description">Description</label>
                    <textarea rows="7" class="form-control" name="doc_description" placeholder="text" required="">{{$up_page->Description}}</textarea>
                </div>


            </div>
            <div class="text-center">
                <i class="fa-solid fa-plus"></i> <input class="orange-outline-button" type="submit" value="Update">
            </div>
        </form>
    </div>
@endsection
