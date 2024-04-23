@extends('/layouts/layout_landingpage')
@section('title', 'home')
@section('content')
    <div class="container mb-5 d-flex " style="min-height:540px;">
        <div class="row flex-1">
            <div class="col-lg-6 col-md-12 align-item-center d-flex flex-1  justify-content-center animate__animated animate__zoomIn"
                style="flex-direction: column">
                <!-- Left Side: Text -->
                <h1 class="text-center">You are <span style="color: #FC6600">one click away</span> from <span
                        style="color: #FC6600">getting</span> appointment <span style="color: #FC6600">with your doctor</span>
                </h1>
                @if (count($doctors) > 0)
                    <div class='mt-3 text-center'>
                        <a class="btn orange-outline-button" href="{{ route('all_doctors_page') }}">find doctor</a>
                    </div>
                @endif
            </div>
            <div class="col-lg-2"></div>
            <div class="col-lg-4 col-md-12 d-flex align-items-center animate__animated animate__fadeInDown">
                <!-- Right Side: Image -->
                <img src="{{ asset('images/Frame1.png') }}" alt="Image" class="img-fluid w-100 ">
            </div>
        </div>
    </div>


    {{-- cards --}}


    {{-- card 1 --}}
    <div class="container mb-5">
        <div class="row ">
            @foreach ($doctors as $doctor)
                <div class="col-md-3 mt-3 ml-5">
                    <div class="card shadow animate__animated animate__fadeInDown" style="width: 18rem; height: 100%;">
                        <img class="card-img-top doc_img"
                            src="{{ asset('/storage/public/uploads' . $doctor->Profile_picture) }}"
                            style="object-fit: cover; object-position: top" alt="Card image cap">
                        <h5 class="card-title text-center card-header">{{ $doctor->Name }}<i class="bi bi-patch-check-fill ms-1" style="color: #57A0D2;"></i></h5>
                        <div class="card-body">

                            <h6 class="card-subtitle">Specialized in: <span
                                    style="color: #FC6600">{{ $doctor->department->Name }}</span></h6>

                            <p class="card-text" style="max-height: 50px; overflow: hidden; text-overflow: ellipsis;">
                                Description: <span style="color: #FC6600">{{ $doctor->Description }}</span>
                            </p>
                        </div>
                        <div class="card-footer p-0 py-2 text-center">
                            <a class="btn orange-outline-button"
                                href="{{ Route('landing_doctor_details', ['id' => $doctor->Doctor_id]) }}">View Details</a>
                        </div>
                    </div>
                </div>
            @endforeach



        </div>
        @if (count($doctors) >= 3)
            <div class="text-center">
                <a class="btn text-center mt-5 orange-outline-button" href="{{ route('all_doctors_page') }}">
                    more
                </a>
            </div>
        @endif
    </div>

@endsection
