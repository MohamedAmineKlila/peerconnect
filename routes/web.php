<?php

use App\Http\Controllers\ConnectionController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InterestController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::view('/about', 'pages.about')->name('about');
Route::get('/contact', [ContactMessageController::class, 'create'])->name('contact');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
Route::post('/dashboard/react/{profile}', [DashboardController::class, 'react'])->middleware('auth')->name('dashboard.react');
Route::post('/reports/{user}', [ReportController::class, 'store'])->middleware('auth')->name('reports.store');

Route::resource('profiles', ProfileController::class);
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/access-logs/export', [AdminController::class, 'exportAccessLogs'])->name('admin.access-logs.export');
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('reports', ReportController::class)->only(['index', 'show', 'update', 'destroy']);
    });
    Route::resource('interests', InterestController::class);
    Route::resource('connections', ConnectionController::class);
    Route::resource('messages', MessageController::class);
    Route::resource('contact-messages', ContactMessageController::class)->except(['create', 'store']);
});
Route::post('/contact-messages', [ContactMessageController::class, 'store'])->name('contact-messages.store');
