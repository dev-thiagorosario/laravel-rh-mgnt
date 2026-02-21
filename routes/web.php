<?php

use App\Http\Controllers\LoginViewController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CreateUserController;
use App\Http\Controllers\CreateUserViewController;
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
});

Route::get('/login', LoginViewController::class)->name('login');
Route::post('/login', LoginController::class)->name('login.authenticate');
