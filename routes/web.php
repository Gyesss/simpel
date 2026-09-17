<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Student\CompanyController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

// Login page
Route::get('/login', [AuthController::class, 'showLogin'])
    ->middleware('guest')
    ->name('login');

// Process login
Route::post('/login', [AuthController::class, 'login'])
    ->middleware('guest')
    ->name('login.process');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


/*
|--------------------------------------------------------------------------
| Student
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:student'])->group(function () {

    // Dashboard
    Route::get('/student/dashboard', function () {
        return view('student.dashboard');
    })->name('student.dashboard');


    // Company Catalog
    Route::get('/student/companies', [CompanyController::class, 'index'])
        ->name('student.companies.index');


    // PKL Application
    Route::get('/student/applications', function () {
        return 'Halaman Pengajuan PKL';
    })->name('student.applications.index');


    // Application Status
    Route::get('/student/application-status', function () {
        return 'Halaman Status Pengajuan';
    })->name('student.application-status');


    // Response Letter
    Route::get('/student/response-letter', function () {
        return 'Halaman Surat Balasan';
    })->name('student.response-letter');
});


/*
|--------------------------------------------------------------------------
| Hubin
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:hubin'])->group(function () {

    // Dashboard
    Route::get('/hubin/dashboard', function () {
        return view('hubin.dashboard');
    })->name('hubin.dashboard');


    // Company Management
    Route::get('/hubin/companies', function () {
        return 'Halaman Data Perusahaan';
    })->name('hubin.companies.index');


    // PKL Applications
    Route::get('/hubin/applications', function () {
        return 'Halaman Pengajuan PKL';
    })->name('hubin.applications.index');


    // Introduction Letters
    Route::get('/hubin/introduction-letters', function () {
        return 'Halaman Surat Pengantar';
    })->name('hubin.introduction-letters.index');


    // Supervisors
    Route::get('/hubin/supervisors', function () {
        return 'Halaman Pembimbing';
    })->name('hubin.supervisors.index');
});


/*
|--------------------------------------------------------------------------
| Company
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:company'])->group(function () {

    // Dashboard
    Route::get('/company/dashboard', function () {
        return view('company.dashboard');
    })->name('company.dashboard');


    // Student Applications
    Route::get('/company/applications', function () {
        return 'Halaman Lamaran Siswa';
    })->name('company.applications.index');


    // Accepted Students
    Route::get('/company/accepted-students', function () {
        return 'Halaman Siswa Diterima';
    })->name('company.accepted-students.index');
});
