<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="icon" type="image/png" href="{{ asset('images\favicon-16x16.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    <title>@yield('title')</title>
</head>

<body>


    <div style="min-height: 100vh; display: flex; flex-direction: column; justify-content: space-between">
        <div>
            @php
                use App\Models\Option;
                $settings = Option::whereIn('Opt_key', ['title', 'footer', 'logo'])->pluck('Opt_value', 'Opt_key');
            @endphp
            <nav id='header' class="navbar navbar-expand-lg shadow ">

                @foreach ($settings as $key => $value)
                    @if ($key === 'logo')
                        <a class="navbar-brand float-start" href="{{ route('home') }}"><img class="shadow"
                                style="height: 50px; width:50px;" src="{{ asset('storage/' . $value ?? ' ') }}"
                                alt=""></a>
                        {{-- @elseif ($key === 'title')
                        <a class="navbar-brand col-lg-4 col-md-12 text-light"
                            href="{{ route('home') }}">{{ $value }}</a> --}}
                    @endif
                @endforeach
                <button class="navbar-toggler" style="background-color: white" type="button" data-toggle="collapse"
                    data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"><i class="fa-solid fa-bars" style="color:black;"></i></span>
                </button>
                <div class="collapse navbar-collapse justify-content-center " id="navbarNav">
                    <ul class="navbar-nav ml-auto  ">
                        <li class="nav-item  {{ request()->is('home') ? 'active' : '' }}">
                            <a class="nav-link text-light" href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="nav-item {{ request()->is('cnic_phone') ? 'active' : '' }}">
                            <a class="nav-link text-light" href="{{ route('cnic_phone') }}">My Appointments</a>
                        </li>
                    </ul>
                </div>
                <div class="mx-2 shadow">
                    @auth
                        @if (session()->get("AuthUser"))
                            <img src="{{ asset('storage/' . session()->get("AuthUser")->doctor->Profile_picture) }}" alt="Profile Image"
                                class="rounded-circle profile-image" style="width: 32px; height: 32px;">
                        @else
                            <!-- Show default profile image or user's name -->
                            <img src="{{ asset('default_profile_image.png') }}" alt="Profile Image"
                                class="rounded-circle profile-image" style="width: 32px; height: 32px;">
                        @endif
                    @else
                        <a href="{{ route('login_page') }}" class="signup-button">Sign in</a>
                        <a href="{{ route('reg_dept') }}" class="signup-button">Sign Up</a>
                    @endauth
                </div>

                {{-- <div class="mx-2">
                    <a href="{{ route('login_page') }}" class="signup-button">Sign in</a>
                    <a href="{{route('reg_dept')}}" class="signup-button">Sign Up</a>

                </div> --}}
                <!-- Add the search field -->
                <form class="form-inline my-2 my-lg-0 ml-auto" action="{{ route('search.doctors') }}" method="GET">
                    <div class="input-group shadow">
                        <input style="height: 50px" class="form-control" name="search" type="search"
                            placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-white  signup-button"><svg xmlns="http://www.w3.org/2000/svg"
                                width="16" height="16" fill="currentColor" class="bi bi-search"
                                viewBox="0 0 16 16">
                                <path
                                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                            </svg> </button>
                    </div>
                </form>
            </nav>


            <!-- body  content -->


            <main>
                @yield('content')
            </main>

        </div>



        <div style="background-color: #FC6600">
            <div class="container">
                <footer class="py-5">
                    <div class="row">
                        <div class="col-2">

                        </div>

                        <div class="d-flex justify-content-between py-4 my-4 border-top">
                            @foreach ($settings as $key => $value)
                                @if ($key === 'footer')
                                    <p>{{ $value }}</p>
                                @endif
                            @endforeach

                            <ul class="list-unstyled d-flex">
                                <li class="ms-3"><a class="link-dark" href="#"><svg class="bi"
                                            width="24" height="24">
                                            <use xlink:href="#twitter"></use>
                                        </svg></a></li>
                                <li class="ms-3"><a class="link-dark" href="#"><svg class="bi"
                                            width="24" height="24">
                                            <use xlink:href="#instagram"></use>
                                        </svg></a></li>
                                <li class="ms-3"><a class="link-dark" href="#"><svg class="bi"
                                            width="24" height="24">
                                            <use xlink:href="#facebook"></use>
                                        </svg></a></li>
                            </ul>
                        </div>
                </footer>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js\frontend.js') }}"></script>
</body>

</html>
