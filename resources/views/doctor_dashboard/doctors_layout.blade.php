<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>@yield('title')</title>
 <link rel="stylesheet" href="{{asset('css/doctor_dashboard.css')}}">


 {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet"> --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link href="{{asset('css/styles_dashboard.css')}}" rel="stylesheet" />
    <link rel="icon" type="image/png" href="{{ asset('images\favicon-16x16.png') }}">

    @stack('styles')
</head>
<style>
    @media (max-width: 767px) {

        /* Apply styles only on screens with a maximum width of 767px (mobile) */
        .fixed-on-mobile {
            position:fixed;
            top: 0;
            right: 0;
            background-color: #fff;
            padding: 10px;
            /* Add more styles as needed */
        }
    }

    .sb-sidenav-toggled #layoutSidenav {
        display: none !important
    }
</style>

<body class="sb-nav-fixed">
    <nav class=" fixed-on-mobile sb-topnav navbar navbar-expand navbar-dark"
        style="position: relative; background:#CD5C08; color:white">
        @php
            use App\Models\Option;

            $setting=Option::where('Opt_key','title')->first();

        @endphp
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="{{ route('home') }}">{{ $setting->Opt_value }}</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..."
                    aria-describedby="btnNavbarSearch" />
                <button class="orange-outline-button" id="btnNavbarSearch" type="button"><i
                        class="fas fa-search"></i></button>
            </div>
        </form>
        <!-- Navbar-->
        {{-- <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="{{route('doctorprofile')}}">Profile</a></li>

                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" style="color:black" class="btn btn-link">Logout</button>
                    </form></li>
                </ul>
            </li>
        </ul> --}}

        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    @if (auth()->check() && auth()->user()->doctor && auth()->user()->doctor->Profile_picture)
                        <img src="{{ asset('storage/public/uploads' . auth()->user()->doctor->Profile_picture) }}" alt="Profile Image" class="rounded-circle" style="width: 32px; height: 32px;">
                    @else
                        <i class="fas fa-user fa-fw"></i>
                    @endif
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="{{ route('doctorprofile') }}">Profile</a></li>

                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" style="color:black" class="btn btn-link">Logout</button>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>

    </nav>

    {{-- side bar content --}}

    <div style="display: flex; min-height: 100vh;" class="flex-md-nowrap flex-wrap">
        <div id="layoutSidenav"
            style="display: flex; flex-direction: column; z-index: 999;
        background: transparent;"
            class="d-sm-none d-md-flex fixed-on-mobile">
            <div id="layoutSidenav_nav" style="position: relative; flex: 1;z-index:99" class="fixed-on-mobile p-0">
                <nav class="sb-sidenav accordion sb-sidenav-dark nav_text" id="sidenavAccordion"
                    style="background:#CD5C08;  color:white">
                    <div class="sb-sidenav-menu">
                        <div class="nav nav_text">

                            <a class="nav-link  @if(str_contains(route('doctor_dashboard_home'),$_SERVER['REQUEST_URI'])) active @endif" href="{{route('doctor_dashboard_home')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dctors Dashboard
                            </a>

                            {{-- ALL DOCTORS --}}

                            <div class="sb-sidenav-menu-heading nav_text">Management</div>
                            <a class="nav-link {{ request()->has('status') && request()->status == 'pending' ? 'active' : '' }}" href="/allpatients?status=pending">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-code-pull-request"></i></div>
                               Requested Appointments
                            </a>

                            {{-- ADD DOCTORS --}}

                            <a class="nav-link collapsed {{request()->has('status')&& request()->status == 'confirm'?'active':' ' }}" href="{{route('all_patients',['status'=>"confirm"])}}">
                                <div class="sb-nav-link-icon"><i class="fa-regular fa-calendar-check"></i></div>

                                Confirmed Appointments


                            </a>

                            {{-- MANAGE DEPARTMENTS --}}

                            {{-- <div class="sb-sidenav-menu-heading nav_text">Departments Section</div> --}}

                            <a class="nav-link collapsed {{ request()->is('availability') ? 'active':'' }}" href="/availability">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-calendar"></i></i></div>

                               Set Availability


                            </a>

                            <a class="nav-link collapsed @if(str_contains(route('add_certificate'),$_SERVER['REQUEST_URI'])) active @endif" href='{{route('add_certificate')}}'>
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-certificate"></i></div>

                                Add certificate


                            </a>
                        </div>
                    </div>

                </nav>
            </div>
        </div>

        {{-- BOODY CONTENT --}}
        <div id="layoutSidenav_content" style="width: 100%">
            <main>
                @yield('content')
            </main>

            {{-- Footer start --}}

            {{-- <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Clinvio 2023</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer> --}}


        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    {{-- <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/datatables-simple-demo.js') }}"></script>
</body>

</html>
