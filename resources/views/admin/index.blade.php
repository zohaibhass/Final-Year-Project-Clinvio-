<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="{{ asset('css/styles_dashboard.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="icon" type="image/png" href="{{ asset('images\favicon-16x16.png') }}">

</head>
<style>
    @media (max-width: 767px) {

        /* Apply styles only on screens with a maximum width of 767px (mobile) */
        .fixed-on-mobile {
            position: fixed;
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
        <!-- Navbar Brand-->
        @php
            use App\Models\Option;

            $setting = Option::where('Opt_key', 'title')->first();

        @endphp
        <a class="navbar-brand ps-3" href="/superadmindashboard">{{ $setting->Opt_value }}</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <form action="{{ route('search') }}" method="GET"
            class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                {{-- <input class="form-control" name="search" type="text" placeholder="Search for..." aria-label="Search for..."
                    aria-describedby="btnNavbarSearch" /> --}}
                <select class="d-none" name="search_type">
                    <option value="departments">Departments</option>
                    <option value="doctors">Doctors</option>
                </select>
                {{-- <input type="submit" class="orange-outline-button" value="search" />               --}}
                {{-- <button class="orange-outline-button" id="btnNavbarSearch" type="button"><i
                        class="fas fa-search"></i></button> --}}
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-2 me-lg-4 mt-2">
            <li class="nav-item dropdown">
                <a class="nav-link @if (str_contains(route('alldoctors'), $_SERVER['REQUEST_URI'])) active @endif dropdown-toggle" id="navbarDropdown"
                    href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i
                        class="fa-solid fa-gear"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="{{ route('edit_settings_page') }}">Settings</a></li>

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
                    style="background:#c75a07; color:white">
                    <div class="sb-sidenav-menu">
                        <div class="nav nav_text">

                            <a class="nav-link @if (str_contains(route('recent_doctors'), $_SERVER['REQUEST_URI'])) active @endif"
                                href="{{ Route('recent_doctors') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Super Admin Dashboard
                            </a>
                            {{-- @php

    dd(r
@endphp --}}
                            {{-- ALL DOCTORS --}}

                            <div class="sb-sidenav-menu-heading nav_text">Manage Doctor</div>
                            <a class="nav-link @if (str_contains(route('alldoctors'), $_SERVER['REQUEST_URI'])) active @endif"
                                href="{{ route('alldoctors') }}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-user-doctor"></i></div>
                                All doctors
                            </a>

                            {{-- ADD DOCTORS --}}

                            <a class="nav-link @if (str_contains(route('insert_doctor'), $_SERVER['REQUEST_URI'])) active @endif collapsed"
                                href="{{ route('insert_doctor') }}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-user-plus"></i></div>
                                Add doctor

                            </a>

                            {{-- MANAGE DEPARTMENTS --}}

                            <div class="sb-sidenav-menu-heading nav_text">Departments Section</div>

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                All Departments
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="show" id="collapseLayouts" aria-labelledby="headingOne"
                                data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav ">
                                    <a class="nav-link @if (str_contains(route('show_dept'), $_SERVER['REQUEST_URI'])) active @endif"
                                        href="{{ Route('show_dept') }}">
                                        <div class="sb-nav-link-icon"><i class="fa-solid fa-building"></i></i> </div>
                                        Departments
                                    </a>
                                    <a href="{{ route('show_add_dept') }}"
                                        class="nav-link @if (str_contains(route('show_add_dept'), $_SERVER['REQUEST_URI'])) active @endif">
                                        <div class="sb-nav-link-icon"><i class="fa-solid fa-circle-plus"></i></div>Add
                                        Depatment
                                    </a>
                                    <a class="nav-link @if (str_contains(route('show_Sub_dept'), $_SERVER['REQUEST_URI'])) active @endif"
                                        href="{{ Route('show_Sub_dept') }}">
                                        <div class="sb-nav-link-icon"><i class="fa-regular fa-building"></i></div>
                                        Sub_Departments
                                    </a>
                                    <a href="{{ Route('get_dept') }}"
                                        class="nav-link @if (str_contains(route('get_dept'), $_SERVER['REQUEST_URI'])) active @endif">
                                        <div class="sb-nav-link-icon"><i class="fa-solid fa-circle-plus"></i></div>
                                        Add_Sub_Department
                                    </a>
                                </nav>
                            </div>
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
                        <div class="text-muted">{{ $settings['footer'] ?? 'footer' }}</div>

                    </div>
                </div>
            </footer> --}}

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js\scripts.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    {{-- <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js\datatables-simple-demo.js') }}"></script>
</body>

</html>
