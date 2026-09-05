<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return redirect()->route('login');
});

// Auth
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');
    Route::get('/petugas/dashboard', [DashboardController::class, 'petugas'])->name('petugas.dashboard');
    Route::get('/user/dashboard', [DashboardController::class, 'user'])->name('user.dashboard');

    //pelanggan
    Route::get('/admin/user', [UserController::class, 'index'])->name('admin.user.index');
    Route::post('/admin/user', [UserController::class, 'store'])->name('admin.user.store');
    Route::put('/admin/user/{id}', [UserController::class, 'update'])->name('admin.user.update');
Route::delete('/admin/user/{id}', [UserController::class, 'destroy'])->name('admin.user.destroy');

    // Laporan
    Route::get('/user/laporan', [ReportController::class, 'myReports'])->name('user.laporan.index');
    Route::post('/user/laporan', [ReportController::class, 'store'])->name('user.laporan.store');
    Route::get('/admin/laporan', [ReportController::class, 'adminIndex'])->name('admin.laporan.index');
});