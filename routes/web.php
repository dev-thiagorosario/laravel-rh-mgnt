<?php

use App\Http\Controllers\LoginViewController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/login', LoginViewController::class)->name('login');
