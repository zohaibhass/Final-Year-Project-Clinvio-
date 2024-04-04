@extends('doctor_dashboard.doctors_layout')
@section('title','set up your availability')

@section('content')
@push('styles')
<style>
/* Custom CSS for your form */
.container {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    background-color: #ffffff;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
    margin-bottom: 30px;
}

.row {
    margin-bottom: 20px;
}

label {
    font-weight: bold;
    margin-bottom: 5px;
    color: #333;
}

input[type="checkbox"] {
    margin-right: 10px;
}

input[type="time"] {
    width: calc(100% - 20px);
    margin-bottom: 10px;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.orange-outline-button {
    background-color:#CD5C08;;
    color: #fff;
    border: 2px solid #ff9900;
    border-radius: 5px;
    padding: 10px 20px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.orange-outline-button:hover {
    background-color: #fff;
    color:#CD5C08;;
}




</style>
@endpush
    <div class="container animate__animated animate__zoomIn">

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @elseif (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <h2 class="mb-4">Set Availability</h2>
    <form action="{{ route('save_availability') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <label for="monday">Monday:</label>
                <input type="checkbox" name="day[]" value="Monday">
            </div>
            <div class="col-md-6">
                <label for="start-time-monday">Start Time:</label>
                <input type="time" value="{{ isset($allAvailabilities['Monday']) ? $allAvailabilities['Monday']['start_time'] : ''}}" name="start_time[]" class="form-control" id="start-time-monday">
                <label for="end-time-monday">End Time:</label>
                <input type="time"  value="{{ isset($allAvailabilities['Monday']) ? $allAvailabilities['Monday']['end_time'] : ''}}" name="end_time[]" class="form-control" id="end-time-monday">
            </div>
        </div>

        <div class="row">
            <input type="hidden" name="Doctor_id" value="">
            <div class="col-md-6">
                <label for="tuesday">Tuesday:</label>
                <input type="checkbox" name="day[]" value="Tuesday">
            </div>
            <div class="col-md-6">
                <label for="start-time-tuesday">Start Time:</label>
                <input type="time" value="{{ isset($allAvailabilities['tuesday']) ? $allAvailabilities['tuesday']['end_time'] : ''}}" name="start_time[]" class="form-control" id="start-time-tuesday">
                <label for="end-time-tuesday">End Time:</label>
                <input type="time" name="end_time[]"  value="{{ isset($allAvailabilities['tuesday']) ? $allAvailabilities['tuesday']['end_time'] : ''}}" name="start_time[]" class="form-control" id="end-time-tuesday">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label for="wednesday">Wednesday:</label>
                <input type="checkbox" name="day[]" value="Wednesday">
            </div>
            <div class="col-md-6">
                <label for="start-time-wednesday">Start Time:</label>
                <input type="time" name="start_time[]" class="form-control"  value="{{ isset($allAvailabilities['wednesday']) ? $allAvailabilities['wednesday']['end_time'] : ''}}" name="start_time[]" id="start-time-wednesday">
                <label for="end-time-wednesday">End Time:</label>
                <input type="time" name="end_time[]"  value="{{ isset($allAvailabilities['wednesday']) ? $allAvailabilities['wednesday']['end_time'] : ''}}" name="start_time[]" class="form-control" id="end-time-wednesday">
            </div>
        </div>

        <div class="row">
            <input type="hidden" name="Doctor_id" value="">
            <div class="col-md-6">
                <label for="thursday">Thursday:</label>
                <input type="checkbox" name="day[]" value="Thursday">
            </div>
            <div class="col-md-6">
                <label for="start-time-thursday">Start Time:</label>
                <input type="time" name="start_time[]"  value="{{ isset($allAvailabilities['thursday']) ? $allAvailabilities['thursday']['end_time'] : ''}}" name="start_time[]" class="form-control" id="start-time-thursday">
                <label for="end-time-thursday">End Time:</label>
                <input type="time" name="end_time[]"  value="{{ isset($allAvailabilities['thursday']) ? $allAvailabilities['thursday']['end_time'] : ''}}" name="start_time[]" class="form-control" id="end-time-thursday">
            </div>
        </div>

        <div class="row">
            <input type="hidden" name="Doctor_id" value="">
            <div class="col-md-6">
                <label for="friday">Friday:</label>
                <input type="checkbox" name="day[]" value="Friday">
            </div>
            <div class="col-md-6">
                <label for="start-time-friday">Start Time:</label>
                <input type="time" name="start_time[]" class="form-control"  value="{{ isset($allAvailabilities['friday']) ? $allAvailabilities['friday']['end_time'] : ''}}" name="start_time[]" id="start-time-friday">
                <label for="end-time-friday">End Time:</label>
                <input type="time" name="end_time[]"  value="{{ isset($allAvailabilities['friday']) ? $allAvailabilities['friday']['end_time'] : ''}}" name="start_time[]" class="form-control" id="end-time-friday">
            </div>
        </div>

        <div class="row">
            <input type="hidden" name="Doctor_id" value="">
            <div class="col-md-6">
                <label for="saturday">Saturday:</label>
                <input type="checkbox" name="day[]" value="Saturday">
            </div>
            <div class="col-md-6">
                <label for="start-time-saturday">Start Time:</label>
                <input type="time" name="start_time[]"  value="{{ isset($allAvailabilities['Saturday']) ? $allAvailabilities['Saturday']['end_time'] : ''}}" name="start_time[]" class="form-control" id="start-time-saturday">
                <label for="end-time-saturday">End Time:</label>
                <input type="time" name="end_time[]" class="form-control" id="end-time-saturday">
            </div>
        </div>

        <div class="row">
            <input type="hidden" name="Doctor_id" value="">
            <div class="col-md-6">
                <label for="sunday">Sunday:</label>
                <input type="checkbox" name="day[]" value="Sunday">
            </div>
            <div class="col-md-6">
                <label for="start-time-sunday">Start Time:</label>
                <input type="time" name="start_time[]"  value="{{ isset($allAvailabilities['Sunday']) ? $allAvailabilities['Sunday']['end_time'] : ''}}"  class="form-control" id="start-time-sunday">
                <label for="end-time-sunday">End Time:</label>
                <input type="time" name="end_time[]"  value="{{ isset($allAvailabilities['sunday']) ? $allAvailabilities['Sunday']['end_time'] : ''}}" class="form-control" id="end-time-sunday">
            </div>
        </div>

        <div class="text-center mt-3">
            <button type="submit" class="orange-outline-button">Save Availability</button>
        </div>
    </form>

    </div>
@endsection
