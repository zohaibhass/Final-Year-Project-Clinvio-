@extends('admin.index')
@section('title', 'update department')
@section('content')
    <div class=" container col-md-8 order-md-1">
        <h4 class="mb-3 text-center mt-5"> Update Department</h4>
        <div>
            <div>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <form action="{{ Route('update_dept', ['id' => $update->Dept_id]) }}" method="POST" class="animate__animated animate__zoomIn">
                    @csrf
                    <div class="row">
                        <div class="team_form">
                        <div class="col-md-6 mb-3">
                            <label for="dept_name">Department</label>
                            <input type="text" class="form-control" name="dept_name" id="dept_name"
                                placeholder="Department Name" value="{{ $update->Name }}" required="">
                          </div>
                                <div class="mb-3">
                                    <label for="team_description">Description</label>
                                    <textarea rows="7" class="form-control" name="dept_description" value=""
                                        placeholder="About department" required="">{{$update->Description }}</textarea>

                    </div>            </div>

                </form>
                <div class="text-center">
                    <i class="fa-solid fa-plus"></i> <input class="orange-outline-button" type="submit" value="Update">
                </div>
            </div>
        </div>
    </div>
@endsection
