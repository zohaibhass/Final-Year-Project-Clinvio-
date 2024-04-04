@extends('admin.index')
@section('title', 'sub departments')
@section('content')
    <div class="container mt-5">
        <div class="text-rignt mt-2 mb-2">
            <div class="text-center">
                <h3>Sub Departments</h3>
            </div>
            <div class="container mt-4">
                <table class="table table-light ">
                    <thead>
                        <tr>
                            <th scope="col">Sub_Dept_ID</th>
                            <th scope="col">Sub_Department Name</th>
                            <th scope="col">Description</th>
                            <th scope="col">update</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($show_sub_dept as $sub_dept)
                            <tr>
                                <th scope="row">{{ $sub_dept->Sub_dept_id }}</th>
                                <td>{{ $sub_dept->Name }}</td>
                                <td>{{ $sub_dept->Description }}</td>
                                <td><a class="btn btn-outline-info"
                                        href="{{ Route('update_sub_dept_page', ['id' => $sub_dept->Sub_dept_id]) }}"><i
                                            class="fa-solid fa-pen-to-square"></i></a></td>
                                <td><a class="btn btn-outline-danger"
                                        href="{{ Route('dlt_sub_dept', ['id' => $sub_dept->Sub_dept_id]) }}"><i
                                            class="fa-solid fa-trash-can"></i></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    @endsection
