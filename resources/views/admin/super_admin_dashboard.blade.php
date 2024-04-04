@extends('admin.index')
@section('title', 'dashboard')
@section('content')

    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4 text-center card animate__animated animate__fadeInDown">
                        <div class="card-body">
                            <h5 class="badge text-bg-success animate__animated animate__zoomIn">New doctors :
                                {{ $new_doc_count }}</h5>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            {{-- <a class="small text-white stretched-link" href="#">View Details</a> --}}

                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-warning text-white mb-4 animate__animated animate__fadeInDown">
                        <div class="card-body text-center animate__animated animate__zoomIn ">
                            <h4 class="badge text-bg-danger">todays Appointments {{ $todaysappointments }}</h4>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            {{-- <a class="small text-white stretched-link" href="#">View Details</a> --}}

                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-success text-white mb-4 animate__animated animate__fadeInDown">
                        <div class="card-body text-center animate__animated animate__zoomIn ">
                            <h5 class="badge text-bg-warning">total Appointments {{ $totalappointments }}</h5>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            {{-- <a class="small text-white stretched-link" href="#">View Details</a> --}}

                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-danger text-white mb-4 animate__animated animate__fadeInDown">
                        <div class="card-body text-center animate__animated animate__zoomIn">
                            <h5 class="badge text-bg-primary">Total doctors : {{ $all_doc_count }}</h5>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            {{-- <a class="small text-white stretched-link" href="#">View Details</a> --}}

                        </div>
                    </div>
                </div>
            </div>

            <div class="container mt-2 mx-3  ">
                <div>
                    <h3 class="text-center">Recent Doctors</h3>
                </div>
                @if (count($recentDoctors) > 0)


                    <table class="table table-bordered table-striped animate__animated animate__zoomIn">
                        <thead>
                            <tr>
                                <th scope="col">S#no</th>
                                <th scope="col">Doctor name</th>
                                <th scope="col">Phone NO</th>
                                <th scope="col">Gender</th>
                                <th scope="col">Age</th>
                                {{-- <th scope="col">Specility</th> --}}
                                <th scope="col">Description</th>

                            </tr>
                        </thead>
                        <tbody>



                            @foreach ($recentDoctors as $key => $doc)
                                <tr>

                                    <th scope="row">{{ $loop->index + 1 }}</th>

                                    <td>{{ $doc->Name }}</td>
                                    <td>{{ $doc->Phone }}</td>
                                    <td>{{ $doc->Gender }}</td>
                                    <td>{{ $doc->Age }}</td>
                                    {{-- <td>{{$doc->Doctor_id}}</td> --}}
                                    <td class="table-cell">{{ $doc->Description }}</td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">
                        {{ $recentDoctors->links() }}
                    </div>
                @else
                    <div
                        class="sufee-alert alert with-close alert-secondary mx-5 mt-5 alert-dismissible animate__animated animate__fadeInDown">
                        <span class="badge badge-pill badge-secondary">Empty</span>
                        No recent doctor to show yet Yet.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>

                @endif
            </div>

        </div>
    </main>
@endsection
