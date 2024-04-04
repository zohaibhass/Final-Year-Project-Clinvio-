<?php

use App\Models\Doctor;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\optioncontoller;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Middleware\AuthCheckMiddleware;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\CertificationController;
use App\Http\Middleware\AuthCheckAdminMiddleware;
use App\Http\Controllers\AvailabilitiesController;
use App\Http\Controllers\Sub_DepartmentController;




Route::get('/loggin', function () {
    return view('login');
});
Route::post('/logout', [DoctorController::class, 'logoutx'])->name('logout');


// routes for Doctors

Route::middleware(AuthCheckMiddleware::class)->group(function () {

    // Routes that require authentication
    Route::get('/doctor_layout', function () {
        return view('doctor_dashboard.doctors_layout');
    });

    // Route::get('/doctors_dashboard',function(){
    //     return view('doctor_dashboard/doctor_dashboard_home');
    // })->name('doctor_dashboard_home');

    Route::get('/allpatients', function () {
        return view('doctor_dashboard.all_patients');
    });

    Route::get('/allpatients', [PatientController::class, 'viewAppointments'])->name('all_patients');



    Route::get('/reject_pat/{id}', [PatientController::class, 'reject_patients'])->name('reject_patients');

    // profile route
    Route::get('/profile', function () {
        return view('doctor_dashboard.profile');
    });

    Route::get('/singlepatient', function () {
        return view('doctor_dashboard.single_patient');
    });

    Route::get('/single_pat/{id}', [PatientController::class, 'single_patient'])->name('single_patient');

    Route::get('/availability', [AvailabilitiesController::class, 'viewAv']);

    Route::get('/appointment', function () {
        return view('doctor_dashboard.confirm_appointments');
    })->name('appointments');

    Route::post('/save_ava', [AvailabilitiesController::class, 'save_availability'])->name('save_availability');


    Route::get('/search', [DoctorController::class, 'search'])->name('search');


    Route::get('/certificate', function () {
        return view('doctor_dashboard.add_certficate');
    })->name('add_certificate');

    Route::post('/add_Certi', [CertificationController::class, 'add_certificate'])->name('add_Certificate');


    Route::get('/doctor/profile/', [DoctorController::class, 'showProfileForm'])->name('doctorprofile');
    Route::post('/doctor/profile/update', [DoctorController::class, 'updateProfile'])->name('doctor.profile.update');


    Route::get('/appointments/{id}', [PatientController::class, 'acceptAppointment'])->name('appointments.accept');

    Route::get('/doctor_home', [AppointmentController::class, 'doctor_dashboard_home'])->name('doctor_dashboard_home');
    Route::get('/remove_appointment/{id}', [AppointmentController::class, 'remove_appointment'])->name('remove_appointment');


    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});


Route::get('/signup', function () {
    return view('doctor_dashboard.doctor_signup.register_doctor');
})->name('signup');

Route::post('/register', [DoctorController::class, 'reg_doctor'])->name('registration');

Route::get('/login', function () {
    return view('doctor_dashboard/doctor_signup/login');
})->name('login_page');

Route::post('/log_in', [DoctorController::class, 'login'])->name('login');

// route to get department in registration form

Route::get('/get_dept', [DoctorController::class, 'get_dept'])->name('reg_dept');



// Routes for super admin by middleware


Route::middleware(AuthCheckAdminMiddleware::class)->group(function () {

    // addd admin routes
    Route::get('/Adminlayout', function () {
        return view('admin/index');
    });



    Route::post('/approve_doctor/{id}', [DoctorController::class, 'approveDoctor'])->name('approve.doctor');
    Route::post('/reject_doctor/{id}', [DoctorController::class, 'rejectDoctor'])->name('reject.doctor');

    // registration and login route for doctors dashboar

    // Route for super admin dashboard

    Route::get('/superadmindashboared', function () {
        return view('admin/super_admin_dashboard');
    })->name('super_admin_home');

    Route::get('/dashboard', [DoctorController::class, 'RecentDoctors'])->name('recent_doctors');

    // Route for add doctors

    Route::get('/doctoradd', function () {
        return view('admin/add_doctor');
    });

    Route::get('/alldoctors', function () {
        return view('admin.all_doctors');
    });

    Route::post('/doctoradd', [DoctorController::class, 'insertdoctor'])->name('insert_doctor');

    // Route for all doctors

    Route::get('/alldoctors', [DoctorController::class, 'ShowDoctors'])->name('alldoctors');
    // Route::get('/alldoctors/{id}',[DoctorController::class,'delete_doctor'])->name('delete_doctor');
    Route::get('/dltdoctor/{id}', [DoctorController::class, 'delete_doctor'])->name('delete_doctor');
    Route::get('/updatepage/{id}', [DoctorController::class, 'update_page'])->name('update_page');
    Route::post('/update/{id}', [DoctorController::class, 'update_doctor'])->name('update_doctor');




    // Route for departments
    Route::get('/departments', function () {
        return view('admin.departments');
    });


    Route::get('/update_dept_page', function () {
        return view('admin.update_dept');
    });

    // Route::get('/show_dept',[DepartmentController::class,'ShowDepartments'])->name('show_dept');
    Route::get('/show_dept', [DepartmentController::class, 'ShowDepartments'])->name('show_dept');
    Route::get('/update_dept/{id}', [DepartmentController::class, 'updatedept_page'])->name('updatedept_page');
    Route::post('/updatedept/{id}', [DepartmentController::class, 'update_dept'])->name('update_dept');
    Route::get('/dlt_dept/{id}', [DepartmentController::class, 'delete_dept'])->name('dlt_dept');

    // Route for sub_departments

    Route::get('/sub_departments', function () {
        return view('admin/sub_departments');
    });

    Route::get('/sub_dept_update', function () {
        return view('admin.update_sub_dept');
    });
    Route::get('/subdept', [Sub_DepartmentController::class, 'show_sub_dept'])->name('show_Sub_dept');
    Route::post('/addsub_dept', [Sub_DepartmentController::class, 'AddSubDept'])->name('add_sub_dept');
    Route::get('/dlt_dsub_ept/{id}', [Sub_DepartmentController::class, 'delete_sub_dept'])->name('dlt_sub_dept');
    Route::get('update_sub_dept_page/{id}', [Sub_DepartmentController::class, 'update_sub_dept_page'])->name('update_sub_dept_page');
    Route::get('/getdept', [DepartmentController::class, 'get_dept'])->name('get_dept');

    //auth routes

    // Auth::routes();

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



    // Route for adding  departments


    Route::get('/add_department', function () {
        return view('admin/add_department');
    })->name("show_add_dept");


    Route::post('/add_dept', [DepartmentController::class, 'add_dept'])->name('add_dept');

    // Route::get('/getdpt',[DepartmentController::class,'get_dept']);

    // Route for adding sub departments

    Route::get('/add_sub_department', function () {
        return view('admin/add_sub_department');
    });

    // route for super admin dashboard setting

    Route::get('/setting', function () {
        return view('admin.setting');
    });

    Route::get('/settings', [optioncontoller::class, 'setting'])->name('settings');

    Route::get('/doc_detail', function () {
        return view('admin.show_doctor_detail');
    })->name('doc_detail');

    Route::get('/get_detail/{id}', [DoctorController::class, 'showDoctorDetails'])->name('doctor_detail');

    Route::get('/settings/edit', [optioncontoller::class, 'editSettings'])->name('edit_settings_page');
    Route::post('/settings/update', [optioncontoller::class, 'updateSettings'])->name('settings_update');
});


//  landing page routes

Route::get('/custom-register', 'Auth\RegisterController@showRegistrationForm');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// route for landing page layout

Route::get('/landingpagelayout', function () {
    return view('layouts/layout_landingpage');
});

// Route for New Landingpagelayout

Route::get('/newlandingpage', function () {
    return view('layouts.new_layout');
});

Route::get('/patient/appointments', [PatientController::class, 'showAppointments'])->name('patient.appointments');


// Route for Newhmepage


Route::get('/', [DoctorController::class, 'welcome'])->name('home');


// route for my appointment page

Route::get('/myappointments', function () {
    return view('myappointments');
});

Route::get('/allappointments', function () {
    return view('allappointments');
});

// Route for doctor details  in landing ppage

Route::get('/details', function () {
    return view('details');
});

Route::get('/doc_detail/{id}', [DoctorController::class, 'show_details_doc'])->name('landing_doctor_details');
Route::get('/search-doctors', [DoctorController::class, 'searchDoctors'])->name('search.doctors');

Route::post('/book_appointment', [PatientController::class, 'book_appointment'])->name('book_appointment');

// Define a route for the showAppointments method

Route::get('/find_doctors', [DoctorController::class, 'showAllDoctors'])->name('all_doctors_page');

Route::get('/cnic_phone', [AppointmentController::class,"showDetails"])->name('cnic_phone');
Route::post('/patient/appointments', [AppointmentController::class,"verifyDetails"])->name('patient.verifyDetails');












Route::get("/db", function () {

    $userType = session()->get("AuthUserType");

    if ($userType == "doctor") {
        return redirect()->route("doctor_dashboard_home");
    } else {
        return redirect()->route("super_admin_home");
    }
})->name("dashboard");


Route::get("hash", function(){

    echo Hash::make("12345678");
});


