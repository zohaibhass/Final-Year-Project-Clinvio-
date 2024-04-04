@extends('admin.index')
@section('title', 'departments')
@section('content')
    <div class="card borders mt-3 mb-3 ms-3 me-3 p-3">
        <div class="text-center">
            <h3>Main Departments</h3>
        </div>

        <table class="table table-light table-striped  borders mt-2 animate__animated animate__zoomIn">
            <thead>
                <tr>
                    <th scope="col">Dept_id</th>
                    <th scope="col">Department Name</th>
                    <th class="table-cell" scope="col">Description</th>
                    <th scope="col">update</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($show_depts as $data)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $data->Name }}</td>
                        <td>{{ $data->Description }}</td>

                        <td><a class="btn btn-outline-info btn-sm" href="{{ Route('updatedept_page', ['id' => $data->Dept_id]) }}"><i
                                    class="fa-solid fa-pen-to-square"></i></a></td>
                        <td><a class="btn btn-outline-danger btn-sm" href="{{ Route('dlt_dept', ['id' => $data->Dept_id]) }}"><i
                                    class="fa-solid fa-trash-can"></i></a></td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        <div class="text-center">
        {{ $show_depts->links() }}
    </div>
    </div>

@endsection
