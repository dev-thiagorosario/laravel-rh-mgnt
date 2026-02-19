<?php

use App\Http\Controllers\LoginViewController;
use App\Http\Controllers\CreateUserController;
use App\Http\Controllers\CreateUserViewController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/login', LoginViewController::class)->name('login');
Route::get('/users/create', CreateUserViewController::class)->name('users.create');
Route::post('/api/users', CreateUserController::class)->name('users.store');
