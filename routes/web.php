<?php

use App\Http\Controllers\CreateUserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\UpdateUserController;
use App\Http\Middleware\WithoutCSRF;
use App\View\Http\Controller\CreateUserViewController;
use App\View\Http\Controller\DashboardViewController;
use App\View\Http\Controller\LoginViewController;
use App\View\Http\Controller\ProfileViewController;
use App\View\Http\Controller\WebLoginController;
use App\View\Http\Controller\WebDepartamentController;
use App\Http\Controllers\ListDepartamentController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', LoginViewController::class)->name('login');
});

Route::post('/login', WebLoginController::class)->name('login.authenticate');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', DashboardViewController::class)->name('dashboard');
    Route::get('/users/create', CreateUserViewController::class)->name('users.create');
    Route::post('/api/users', CreateUserController::class)->name('users.store');
    Route::post('reset-password', ResetPasswordController::class)->name('password.reset');
    Route::get('/user-profile', ProfileViewController::class)->name('user.profile');
    Route::post('/logout', LogoutController::class)->name('logout');
    Route::put('/api/users/{userId?}', UpdateUserController::class)->name('users.update');
    Route::get('/departament', '/departaments')->name('departament.dashboard');
    Route::get('/departaments', WebDepartamentController::class)->name('departments.index');
    Route::get('/api/departaments', ListDepartamentController::class)->name('departaments.list');
});

Route::prefix(WithoutCSRF::PREFIX)->name('bruno.')->group(function () {
    Route::post('/login', LoginController::class)->name('login.authenticate');

    Route::middleware('auth')->group(function () {
        Route::post('/api/users', CreateUserController::class)->name('users.store');
        Route::post('reset-password', ResetPasswordController::class)->name('password.reset');
        Route::post('/logout', LogoutController::class)->name('logout');
        Route::put('/api/users/{userId?}', UpdateUserController::class)->name('users.update');
        Route::get('/api/departaments', ListDepartamentController::class)->name('departaments.list');
    });
});
