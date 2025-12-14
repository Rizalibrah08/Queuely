<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\QRController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;

// Dashboard Routes
Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

// Video Routes
Route::prefix('videos')->group(function () {
    Route::get('/', [VideoController::class, 'index'])->name('videos.index');
});

// QR Routes
Route::prefix('qr')->group(function () {
    Route::get('/scan', [QRController::class, 'scan'])->name('qr.scan');
});

// Order Routes
Route::prefix('orders')->group(function () {
    Route::get('/', [OrderController::class, 'index'])->name('orders.index');
});

// Profile Routes
Route::prefix('profile')->group(function () {
    Route::get('/', [ProfileController::class, 'index'])->name('profile.index');
});