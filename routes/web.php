<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;




// Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
// Route::post('/login', [AuthController::class, 'login']);
// Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('forgot.password');
// Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.reset');
// Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route::get('/dashboard', [AuthController::class, 'showDashboard'])->name('dashboard');
// Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
// Route::post('/login', [AuthController::class, 'login']);
// Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('forgot.password');
// Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.reset');
// Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// Route::get('/profile/update', [AuthController::class, 'showUpdateProfileForm'])->name('profile.update.form');

// Route::get('/user/create', [AuthController::class, 'showCreateUserForm'])->name('user.create');


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('forgot.password');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('reset-password');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/profile/edit', [AuthController::class, 'editProfile'])->name('profile.edit');
Route::put('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update.post');
Route::get('/user/create', [AuthController::class, 'createUser'])->name('user.create');
Route::post('/user/store', [AuthController::class, 'storeUser'])->name('user.store');
Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');


Route::middleware(['auth', 'role:Super Admin'])->group(function () {
    Route::get('/admin', function () {
        return view('dashboard');
    })->name('admin.dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
