@extends('layouts.layout_landingpage')
@section('title', 'appointment boking')
@section('content')
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css"
        integrity="sha512-f0tzWhCwVFS3WeYaofoLWkTP62ObhewQ1EZn65oSYDZUg1+CyywGKkWzm8BxaJj5HGKI72PnMH9jYyIFz+GH7g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />



    <div class="container p-5 animate__animated animate__zoomIn">
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <div class="doc__card mb-5">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('/storage/public/uploads' . $doctor_detail->Profile_picture) }}"
                            style="border-radius:50%; object-fit: cover; object-position: top" class="img-fluid shadow">
                    </div>
                    <hr>
                    <div class="doctor-name mt-3"><i class="bi bi-person-check-fill"></i> <b>Doctor Name</b>:
                        {{ $doctor_detail->Name }} <i class="bi bi-patch-check-fill" style="color: #57A0D2;"></i></div>
                        <div class="specialties">
                            <p><i class="bi bi-check-all me-1"></i><b>Specialist:</b> {{ $doctor_detail->department->Name }}</p>
                        </div>
                    <div class="contact-info">
                        <p> <i class="bi bi-envelope me-1"></i><b>Email</b> : {{ $doctor_detail->Email }}</p>
                        <p><i class="bi bi-telephone-fill me-1"></i>/<i class="bi bi-whatsapp me-1"></i><b>Phone No</b>:
                            {{ $doctor_detail->Phone }}</p>
                        <p><i class="bi bi-flag-fill me-1"></i><b>country</b>:{{ $doctor_detail->country }}</p>
                        <p><i class="bi bi-map me-1"></i><b>state</b>:{{ $doctor_detail->state }}</p>
                        <p><i class="bi bi-geo-alt me-1"></i><b>Adress</b>:{{ $doctor_detail->adress }}</p>
                        <p><i class="bi bi-body-text me-1"></i><b>About</b>:{{ $doctor_detail->Description }}</p>

                    </div>
                    <div class="card-footer ">
                        <h2>Current Availability</h2>
                        <table class="table table-bordered avatable">
                            <thead>
                                <tr>
                                    <th>Day</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($availabilityData as $availability)
                                    <tr>
                                        <td>{{ $availability->day }}</td>
                                        <td>{{ $availability->start_time }}</td>
                                        <td>{{ $availability->end_time }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <div class="col-sm-12 col-md-6">
                <h2>Book an Appointment</h2>
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
                <form action="{{ Route('book_appointment') }}" method="POST" id="appointmentForm">
                    @csrf
                    <div class="form-group">
                        <label for="name">Your Name:</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    {{-- <div class="form-group d-none">
                        <label for="apt_id">Apt_id:</label>
                        <input type="text" id="apt_id" name="apt_id">
                    </div> --}}
                    {{-- <div class="form-group d-none">
                        <label for="pat_id">patient_id:</label>
                        <input type="hidden" id="pat_id" name="pat_id">
                    </div> --}}

                    <div class="form-group d-none">
                        <label for="">Doctor_id:</label>

                        <input type="hidden" name="doctor_id" value="{{ $doctor_detail->Doctor_id }}">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone No:</label>
                        <input type="text" id="phone" name="phone" required>
                    </div>

                    <div class="form-group">
                        <label for="cnic">Cnic:</label>
                        <input type="text" id="cnic" name="cnic" required>
                    </div>

                    <div class="form-group">
                        <label for="cnic">Gender:</label>
                        <select class="form-group" required id="Gender" name="Gender">
                            <option value="" disabled selected>Select Gender</option>
                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male
                            </option>
                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female
                            </option>
                            <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="phone">Age:</label>
                        <input type="number" class="form-control" id="Age" name="Age" required>
                    </div>

                    <div class="form-group">
                        <label for="date">Select Date:</label>
                        <input autocomplete="off" type="text" id="date" name="date">

                        <div id="my_calendar"></div>

                    </div>
                    <div class="mb-3">
                        <label for="pat_description">Description</label>
                        <textarea rows="7" class="form-control" name="pat_description" value="" placeholder="explain your illness"
                            required=""></textarea>
                    </div>
                    <input class="orange-outline-button" type="submit" value="Book Appointment">
                </form>
            </div>
        </div>




    </div>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.9.0/dist/sweetalert2.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"
        integrity="sha512-AIOTidJAcHBH2G/oZv9viEGXRqDNmfdPVPYOYKGy3fti0xIplnlgMHUGfuNRzC6FkzIo0iIxgFnr9RikFxK+sw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.9.0/dist/sweetalert2.all.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js" integrity="sha512-AIOTidJAcHBH2G/oZv9viEGXRqDNmfdPVPYOYKGy3fti0xIplnlgMHUGfuNRzC6FkzIo0iIxgFnr9RikFxK+sw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        var days = [
            "Sunday",
            "Monday",
            "Tuesday",
            "Wednesday",
            "Thursday",
            "Friday",
            "Saturday"
        ];

        var disabledDays=[0,1,2,3,4,5,6];

        <?php
            foreach ($availabilityData as $availability):
        ?>
            delete disabledDays[days.indexOf("<?php echo $availability->day ?>")]
            console.log("dat" , days.indexOf("<?php echo $availability->day ?>"))
            // disabledDays .splice(days.indexOf("<?php echo $availability->day ?>"),1)
        <?php
            endforeach;
        ?>

        console.log("av days", disabledDays)

        var reserveDates = {
            <?php
            $i=1;
            foreach ($availabilityData as $availability):

            ?> "<?= $availability->day ?>": {
                    "start_time": "<?= $availability->start_time ?>",
                    "end_time": "<?= $availability->end_time ?>"
                }
            <?php
            if($i!= count($availabilityData)){
                echo ",";
            }
            endforeach;
            $i++;
            ?>

        };

        console.log("dates", reserveDates)

        jQuery('#date').datetimepicker({
            step:15,
            disabledWeekDays: disabledDays,
            onSelectDate: function(curr, input){
                console.log("fasdfsdf")
                $('#date').val("")
            },
            onSelectTime: function(curr_time, $input) {
                // let input= jQuery('#date').datetimepicker('getValue')
                let input= jQuery('#date').val()
                console.log("dateee", input)
                if(input==null){
                    return;
                }
                let date = new Date(input)

                let day = date.getDay();

                let selectedDay = days[day]

                let reserveSelectedDay = reserveDates[selectedDay]
                console.log("reserveSelectedDay", selectedDay)

                if(reserveSelectedDay!=undefined){
                    console.log(reserveSelectedDay)
                    let isAvailable= timeIsBetween(reserveSelectedDay.start_time, reserveSelectedDay.end_time, date)
                    console.log("ava", isAvailable)

                    if(!isAvailable){
                        Swal.fire({
                            position: "top-end",
                            icon: "warning",
                            title: "<h5>Doctor is not Available on Time. Select another time.</h5>",
                            showConfirmButton: false,
                            timer: 3500
                        })

                    }
                }
                else{
                    $("#date").val("")
                    // alert("Doctor Not Available at this Day...")
                    Swal.fire({
                        position: "top-end",
                        icon: "warning",
                        title: "<h5>Doctor is not Available on this Date and Time....</h5>",
                        showConfirmButton: false,
                        timer: 3500
                    })
                    return false
                }
            }
        });


        function timeIsBetween($date1, $date2, $checkDate){
            var startTime = $date1;
            var endTime = $date2;
            var checkTime= $checkDate;

            startDate = new Date(checkTime.getTime());
            startDate.setHours(startTime.split(":")[0]);
            startDate.setMinutes(startTime.split(":")[1]);
            startDate.setSeconds(startTime.split(":")[2]);

            endDate = new Date(checkTime.getTime());
            endDate.setHours(endTime.split(":")[0]);
            endDate.setMinutes(endTime.split(":")[1]);
            endDate.setSeconds(endTime.split(":")[2]);


            valid = startDate < checkTime && endDate > checkTime

            return valid;
        }

        //     webix.ui({
        //     view:"calendar",
        //     id:"my_calendar",
        //     date:new Date(2012,3,16),
        //     weekHeader:true,
        //     events:webix.Date.isHoliday,
        //     // width:300,
        //     // height:250
        // });
    </script>
@endsection
