@extends('admin.index')
@section('title', 'all doctors')

@section('content')
    <style>
        @media (max-width: 767px) {
            .table-responsive {
                max-width: 100%;
                overflow-x: auto;
            }
        }
    </style>
    <main>

        <div class="container">

            <h3 class="text-center">All doctors</h3>
            @if (count($doc_data) > 0)



                <table class="table-responsive table table-bordered table-striped animate__animated animate__zoomIn">
                    <thead>
                        <tr>
                            <th scope="col">S#no</th>
                            <th scope="col">Doctor name</th>
                            <th scope="col">Phone NO</th>
                            <th scope="col">Email</th>
                            {{-- <th scope="col">Gender</th> --}}
                            <th scope="col">Status</th>
                            <th scope="col">Specility</th>
                            {{-- <th scope="col">Description</th> --}}
                            <th scope="col">Details</th>
                            <th scope="col">Update</th>
                            <th scope="col">Delete</th>

                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp

                        @foreach ($doc_data as $doc)
                            <tr>
                                <th scope="row">{{ $i }}</th>
                                <td>{{ $doc->Name }}</td>
                                <td>{{ $doc->Phone }}</td>
                                <td>{{ $doc->Email }}</td>
                                {{-- <td>{{ $doc->Gender }}</td> --}}
                                <td>{{ $doc->status }}</td>
                                <td>{{ $doc->Department->Name }}</td>
                                {{-- <td class="table-cell">{{ $doc->Description }}</td> --}}
                                <td><a class="btn btn-outline-primary btn-sm"
                                        href="{{ Route('doctor_detail', ['id' => $doc->Doctor_id]) }}"><i
                                            class="fa-solid fa-eye"></i> </a> </td>
                                <td><a class="btn btn-outline-info btn-sm"
                                        href="{{ Route('update_page', ['id' => $doc->Doctor_id]) }}"><i
                                            class="fa-solid fa-pen-to-square"></i> </a> </td>
                                <td><a class="btn btn-outline-danger btn-sm"
                                        href="{{ Route('delete_doctor', $doc->Doctor_id) }}"><i
                                            class="fa-solid fa-trash-can"></i></a></td>

                            </tr>
                            @php
                                $i++;
                            @endphp
                        @endforeach

                    </tbody>
                </table>

                <div class="text-center">
                    {{ $doc_data->links() }}
                </div>
            @else
                <div
                    class="sufee-alert alert with-close alert-secondary mx-5 mt-5 alert-dismissible animate__animated animate__fadeInDown">
                    <span class="badge badge-pill badge-secondary">Empty</span>
                    No doctor to show yet Yet.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

            @endif
        </div>

    </main>
@endsection
