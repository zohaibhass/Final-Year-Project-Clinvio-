@extends('layouts.layout_landingpage')
@section('title', 'all doctors')
@section('content')
    <div class="py-5">
        <div class="container animate__animated animate__fadeInDown">
            <div class="row hidden-md-up">

                {{-- card one --}}
                @foreach ($doctors as $doctor)
                    <div class="col-md-3 mt-3 ms-5">
                        <div class="card shadow" style="width: 18rem; height: 100%;">
                            <img class="card-img-top doc_img"
                                src="{{ asset('/storage/public/uploads' . $doctor->Profile_picture) }}" alt="Card image cap">
                            <h5 class="card-title text-center card-header">{{ $doctor->Name }}</h5>

                            <div class="card-body">
                                <h6 class="card-subtitle">Specialized in: <span
                                        style="color: #FC6600">{{ optional($doctor->department)->Name }}</span></h6>
                                <p class="card-text" style="max-height: 50px; overflow: hidden; text-overflow: ellipsis;">
                                    Description: <span style="color: #FC6600">{{ $doctor->Description }}</span></p>
                            </div>

                            <div class="card-footer p-0 py-2 text-center">
                                <a href="{{ Route('landing_doctor_details', ['id' => $doctor->Doctor_id]) }}"
                                    class="btn orange-outline-button">View Details</a>
                            </div>
                        </div>

                    </div>
                @endforeach

                <div class="text-center mt-5">
                    {{$doctors->links(); }}
                    </div>

            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
        <script src="https://pingendo.com/assets/bootstrap/bootstrap-4.0.0-alpha.6.min.js"></script>
    @endsection
