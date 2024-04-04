@extends('admin.index')
@section('title', ' add department')
@section('content')
    <div class=" container col-md-8 order-md-1">
        <h4 class="mb-3 text-center mt-5"> Add Department</h4>
        <div>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <form action="{{ Route('add_dept') }}" method="POST" class="animate__animated animate__zoomIn">
                @csrf

                <div class="row">
                    {{-- <div class="team_form"> --}}
                    <div class="col-md-6 mb-3">
                        <label for="dept_name">Department</label>
                        <input type="text" class="form-control" name="dept_name" id="dept_name"
                            placeholder="Department Name" value="" required="">
                        <div>
                            <div class="mb-3">
                                <label for="sub_dept_description">Description</label>
                                <textarea rows="7" class="form-control" name="dept_description" value="" placeholder="About Doctor"
                                    required=""></textarea>
                                <div class="invalid-feedback">
                                    Invalid description.
                                </div>
                            </div>

            </form>
            <div class="text-center">
                <i class="fa-solid fa-plus"></i> <input class="orange-outline-button" type="submit" value="Add">
            </div>
        </div>
    </div>
@endsection
