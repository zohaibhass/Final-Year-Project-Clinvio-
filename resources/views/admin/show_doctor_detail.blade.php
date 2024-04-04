@extends('admin.index')
@section('title', 'doctors details')

@section('content')


    <div class="card p-3 ms-4 me-4 mt-5 mb-5">
        @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>

                @elseif (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
        <div class="row">
            <div class="col-md-4 d-flex justify-content-center">
                <div style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                    <img src="{{ asset('/storage/public/uploads' . $doctor->Profile_picture) }}" alt="Doctor Profile"
                        class="doctor-profile-img img-fluid" style="object-fit: cover; object-position: top">
                </div>
            </div>
            <div class="col-md-8 p-0" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                <h2 class="text-center mt-2">Doctor {{ $doctor->Name }},s Details</h2>
                <table class="table table-striped">

                    <thead>
                        <th scope="row">Doctor Name</th>
                        <th scope="row">Phone No</th>
                        <th scope="row">Email</th>
                        <th scope="row">Gender</th>
                        {{-- <th scope="row">Age</th> --}}
                        <th scope="row">Specialty</th>

                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $doctor->Name }}</td>
                            <td>{{ $doctor->Phone }}</td>
                            <td>{{ $doctor->Email}}</td>
                            <td>{{ $doctor->Gender }}</td>
                            {{-- <td>{{ $doctor->Age }}</td> --}}
                            <td> {{ $doctor->department->Name}}</td>
                        </tr>
                    </tbody>


                </table>
                <button class="btn btn-outline-info mb-2 ms-2 btn-sm " onclick="toggleDescription()"> <i class="bi bi-arrows-collapse"></i> About {{ $doctor->Name  }}</button>
                <div class="description mb-1" id="description" style="display: none;    ">{{ $doctor->Description }}</div>
            </div>
                <h2 class="text-center mt-4">Certification Details</h2>
                <table class="table table-striped">
                    <thead>
                        <th>Certification Title</th>
                        <th>Organization Name</th>
                        <th>Completion Date</th>
                        <th>Certification Description   </th>
                        <th>Certificates to Download</th>
                    </thead>


                    <tbody>
                        {{-- {{dd($certification)}} --}}
                        @if ($certification)
                            @foreach ($certification as $certi)
                                <tr>
                                    <td>{{ $certi->name }}</td>
                                    <td>{{ $certi->organization }}</td>
                                    <td>{{ $certi->completion_date }}</td>
                                    <td>{{ $certi->certi_description }}</td>
                                    <td class="text-center">
                                        @php
                                            $image= App\Models\Image::where("Img_id", $certi->certi_id)->first();
                                        @endphp

                                        @if($image!=null)
                                        <a href="{{ Storage::url($image->Image_path) }}"
                                            download="Certification Document.pdf"
                                            class="btn btn-outline-primary btn-sm px-4 py-1 mb-2" style="white-space: nowrap">
                                             &nbsp;<i class="fa-solid fa-download"></i>
                                        </a>

                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5">No certification data available.</td>
                            </tr>
                        @endif

                    </tbody>
                </table>


            </div>
            <div class="mt-5 text-center mt-0">
                <form action="{{ route('approve.doctor', ['id' => $doctor->Doctor_id]) }}" method="POST"
                    style="display:inline;">
                    @csrf
                    <input type="submit" class="btn btn-outline-success btn-sm" value="Accept">
                </form>

                <!-- Reject Button -->
                <form action="{{ route('reject.doctor', ['id' => $doctor->Doctor_id]) }}" method="POST"
                    style="display:inline;">
                    @csrf
                    <input type="submit" class="btn btn-outline-danger btn-sm" value="Reject">
            </div>
        </div>


    </div>

    </div>
<script>
    function toggleDescription() {
    var description = document.getElementById("description");
    if (description.style.display === "none") {
        description.style.display = "block";
    } else {
        description.style.display = "none";
    }
}
</script>



@endsection
