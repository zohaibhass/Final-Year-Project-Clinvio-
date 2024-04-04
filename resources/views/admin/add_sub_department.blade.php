@extends('admin.index')
@section('title', 'add sub department')
@section('content')
    <div class=" container col-md-8 order-md-1">
        <h4 class="mb-3 text-center mt-5">Add Sub_Deptartment</h4>
        <div>
            <div>
                @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
            <form action="{{Route('add_sub_dept')}}" method="POST" class="animate__animated animate__zoomIn">
                @csrf
                @method('POST')
                <div class="row">
                    {{-- <div class="team_form"> --}}
                    <div class="form-group col-md-6 mb-3">
                        <label for="specialty">Main Department:</label>
                        <select class="form-control" id="specialty" name="specialty">
                            <option value="" selected>Select Main Specility In</option>
                          @foreach ($dropdown as $drop )
                                <option value="{{ $drop->Dept_id }}">{{ $drop->Name }}</option>
                                @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="sub_dept_name">Sub_Department</label>
                        <input type="text" class="form-control" name="sub_dept_name" id="sub_dept_name"
                            placeholder="sub_dept_name" value="" required="">
                    </div>
                    <div class="mb-3">
                        <label for="team_description">Description</label>
                        <textarea rows="7" rows="5" class="form-control" name="sub_dept_description" value="" placeholder="text" required=""></textarea>
                    </div>
            </form>
            <div class="text-center">
                <i class="fa-solid fa-plus"></i> <input class="orange-outline-button" type="submit" value="Add">
        </div>
        </div>
    </div>
@endsection
