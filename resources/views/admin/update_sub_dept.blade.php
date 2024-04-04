@extends('admin.index')
@section('title', 'update sub deptartment')
@section('content')
    <div class=" container col-md-8 order-md-1">
        <h4 class="mb-3 text-center mt-5 animate__animated animate__zoomIn"> Add Department</h4>
        <div>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <form action="{{ Route('add_dept',['id'=>$update_sub_dept_page->Sub_dept_id]) }}" method="POST">
                @csrf

                <div class="row">
                    {{-- <div class="team_form"> --}}
                    <div class="col-md-6 mb-3">
                        <label for="dept_name">Department</label>
                        <input type="text" class="form-control" name="dept_name" id="dept_name"
                            placeholder="Department Name" value="{{$update_sub_dept_page->Name}}" required="">
                        <div>
                            <div class="mb-3">
                                <label for="sub_dept_description">Description</label>
                                <textarea rows="7" class="form-control" name="dept_description" value="{{$update_sub_dept_page->Description}}" placeholder="About Doctor"
                                    required=""></textarea>
                                <div class="invalid-feedback">
                                    Invalid description.
                                </div>
                            </div>

            </form>
            <div class="text-center">
                <i class="fa-solid fa-plus"></i> <input class="orange-outline-button" type="submit" value="Update">
            </div>
        </div>
    </div>
@endsection
