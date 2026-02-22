<?php

use App\Http\Controllers\LoginViewController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CreateUserController;
use App\Http\Controllers\CreateUserViewController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ResetPasswordController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/admin', function () {
        return view('home.dashboard');
    });

    Route::get('/users/create', CreateUserViewController::class)->name('users.create');
    Route::post('/api/users', CreateUserController::class)->name('users.store');
    Route::post('reset-password', ResetPasswordController::class)->name('password.reset');
});

Route::get('/login', LoginViewController::class)->name('login');
Route::post('/login', LoginController::class)->name('login.authenticate');
Route::post('/logout', LogoutController::class)->name('logout');
