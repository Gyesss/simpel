<?php

use App\Http\Controllers\AuthController;
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

    Route::get('/student/dashboard', function () {
        return view('student.dashboard');
    })->name('student.dashboard');
});


/*
|--------------------------------------------------------------------------
| Hubin
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:hubin'])->group(function () {

    Route::get('/hubin/dashboard', function () {
        return view('hubin.dashboard');
    })->name('hubin.dashboard');
});


/*
|--------------------------------------------------------------------------
| Company
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:company'])->group(function () {

    Route::get('/company/dashboard', function () {
        return view('company.dashboard');
    })->name('company.dashboard');
});
