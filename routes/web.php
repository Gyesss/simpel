<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Student\DashboardController;
use App\Http\Controllers\Student\CompanyController;
use App\Http\Controllers\Student\InternshipApplicationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


// :3

Route::get('/', function () {
    return view('home');
})->name('home');


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
| Profile
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // Profile
    Route::get('/profile', [ProfileController::class, 'show'])
        ->name('profile.show');

    // Edit Profile
    Route::get('/profile/edit', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    // Update Profile Information
    Route::put('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    // Update Password
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])
        ->name('profile.password.update');
});


/*
|--------------------------------------------------------------------------
| Dashboard Redirect
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->get('/dashboard', function () {
    return match (Auth::user()->role) {
        'student' => redirect()->route('student.dashboard'),
        'hubin' => redirect()->route('hubin.dashboard'),
        'company' => redirect()->route('company.dashboard'),
        default => abort(403),
    };
})->name('dashboard');


/*
|--------------------------------------------------------------------------
| Student
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:student'])->group(function () {

    // Dashboard
    Route::get(
        '/student/dashboard',
        [DashboardController::class, 'index']
    )->name('student.dashboard');


    // Company Catalog
    Route::get('/student/companies', [CompanyController::class, 'index'])
        ->name('student.companies.index');


    // PKL Application
    Route::get('/student/applications', function () {
        return view('student.applications.index');
    })->name('student.applications.index');


    // Individual PKL Application
    Route::get(
        '/student/applications/individual',
        [InternshipApplicationController::class, 'createIndividual']
    )->name('student.applications.individual');

    Route::post(
        '/student/applications/individual',
        [InternshipApplicationController::class, 'storeIndividual']
    )->name('student.applications.individual.store');


    // Edit Individual PKL Application
    Route::get(
        '/student/applications/individual/{application}/edit',
        [InternshipApplicationController::class, 'editIndividual']
    )->name('student.applications.individual.edit');

    Route::put(
        '/student/applications/individual/{application}',
        [InternshipApplicationController::class, 'updateIndividual']
    )->name('student.applications.individual.update');


    // Group PKL Application
    Route::get(
        '/student/applications/group',
        [InternshipApplicationController::class, 'createGroup']
    )->name('student.applications.group');

    Route::post(
        '/student/applications/group',
        [InternshipApplicationController::class, 'storeGroup']
    )->name('student.applications.group.store');


    // Edit Group PKL Application
    Route::get(
        '/student/applications/group/{application}/edit',
        [InternshipApplicationController::class, 'editGroup']
    )->name('student.applications.group.edit');

    Route::put(
        '/student/applications/group/{application}',
        [InternshipApplicationController::class, 'updateGroup']
    )->name('student.applications.group.update');


    // Cancel PKL Application
    Route::delete(
        '/student/applications/{application}',
        [InternshipApplicationController::class, 'cancel']
    )->name('student.applications.cancel');


    // Withdraw from Group PKL Application
    Route::delete(
        '/student/applications/group/{application}/withdraw',
        [InternshipApplicationController::class, 'withdrawFromGroup']
    )->name('student.applications.group.withdraw');


    // Transfer Group Leader
    Route::patch(
        '/student/applications/group/{application}/transfer-leader',
        [InternshipApplicationController::class, 'transferLeader']
    )->name('student.applications.group.transfer-leader');


    // Search student for group application
    Route::get(
        '/student/students/search',
        [InternshipApplicationController::class, 'searchStudent']
    )->name('student.students.search');


    // Application Status
    Route::get(
        '/student/application-status',
        [InternshipApplicationController::class, 'status']
    )->name('student.application-status');


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
