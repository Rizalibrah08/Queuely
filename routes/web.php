<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\QRController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UMKMController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\UmkmOrderController;

// Dashboard Routes
Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

// Shop Routes
Route::get('/shop/{id}', [App\Http\Controllers\ShopController::class, 'show'])->name('shop.show');

// Video Routes
Route::prefix('videos')->group(function () {
    Route::get('/', [VideoController::class, 'index'])->name('videos.index');
});

// QR Routes
Route::prefix('qr')->group(function () {
    Route::get('/scan', [QRController::class, 'scan'])->name('qr.scan');
    Route::post('/verify', [QRController::class, 'verify'])->name('qr.verify');
});

// Order Routes
Route::prefix('orders')->group(function () {
    Route::get('/', [OrderController::class, 'index'])->name('orders.index');
    Route::post('/checkout', [OrderController::class, 'checkout'])->name('orders.checkout');
    Route::post('/store', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/success/{id}', [OrderController::class, 'success'])->name('orders.success');
});

// Profile Routes
Route::prefix('profile')->group(function () {
    Route::get('/', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/login', [ProfileController::class, 'login'])->name('profile.login');
    Route::post('/register', [ProfileController::class, 'register'])->name('profile.register');
    Route::post('/logout', [ProfileController::class, 'logout'])->name('profile.logout');
    Route::post('/update-profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::post('/update-profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
});

// Global Login Route Alias (Fixes Route [login] not defined)
Route::get('/login', [ProfileController::class, 'index'])->name('login');

// UMKM Routes (Untuk User Biasa)
Route::prefix('umkm')->middleware('auth')->group(function () {
    Route::get('/daftar', [UMKMController::class, 'create'])->name('umkm.create');
    Route::post('/daftar', [UMKMController::class, 'store'])->name('umkm.store');
    Route::get('/status', [UMKMController::class, 'status'])->name('umkm.status');
    Route::get('/dashboard', [UMKMController::class, 'dashboard'])->name('umkm.dashboard');
    Route::get('/edit', [UMKMController::class, 'edit'])->name('umkm.edit');
    Route::post('/update', [UMKMController::class, 'update'])->name('umkm.update');
    Route::get('/qrcode', [UMKMController::class, 'qrcode'])->name('umkm.qrcode');

    // Menu Management Routes
    Route::prefix('menu')->name('umkm.menu.')->group(function () {
        Route::get('/', [MenuController::class, 'index'])->name('index');
        Route::get('/create', [MenuController::class, 'create'])->name('create');
        Route::post('/', [MenuController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [MenuController::class, 'edit'])->name('edit');
        Route::put('/{id}', [MenuController::class, 'update'])->name('update');
        Route::delete('/{id}', [MenuController::class, 'destroy'])->name('destroy');
    });

    // Order Management Routes (UMKM Side)
    Route::prefix('orders')->name('umkm.orders.')->group(function () {
        Route::get('/', [UmkmOrderController::class, 'index'])->name('index');
        Route::get('/history', [UmkmOrderController::class, 'history'])->name('history');
        Route::put('/{id}/status', [UmkmOrderController::class, 'updateStatus'])->name('update-status');
    });

    // Video Management Routes (UMKM Side)
    Route::prefix('videos')->name('umkm.videos.')->group(function () {
        Route::get('/', [App\Http\Controllers\UmkmVideoController::class, 'index'])->name('index');
        Route::get('/create', [App\Http\Controllers\UmkmVideoController::class, 'create'])->name('create');
        Route::post('/', [App\Http\Controllers\UmkmVideoController::class, 'store'])->name('store');
        Route::delete('/{id}', [App\Http\Controllers\UmkmVideoController::class, 'destroy'])->name('destroy');
    });
});

// ==================== ADMIN ROUTES ====================

// Admin Login (Public)
Route::prefix('admin')->group(function () {
    // Login
    Route::get('/login', [AdminController::class, 'login'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'authenticate'])->name('admin.authenticate');
});

// Admin Protected Routes
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');

    // ========== UMKM MANAGEMENT ==========
    Route::prefix('umkm')->name('admin.umkm.')->group(function () {
        // List semua UMKM
        Route::get('/', [AdminController::class, 'umkm'])->name('index');

        // Detail UMKM
        Route::get('/{id}', [AdminController::class, 'umkmDetail'])->name('detail');
        Route::get('/{id}/show', [AdminController::class, 'show'])->name('show');

        // Approve/Reject (POST)
        Route::post('/{id}/approve', [AdminController::class, 'approveUmkm'])->name('approve');
        Route::post('/{id}/reject', [AdminController::class, 'rejectUmkm'])->name('reject');

        // Update status (PUT)
        Route::put('/{id}/status', [AdminController::class, 'updateStatus'])->name('updateStatus');

        // Bulk actions
        Route::put('/bulk-status', [AdminController::class, 'bulkStatusUpdate'])->name('bulk-status');

        // Delete
        Route::delete('/{id}', [AdminController::class, 'destroy'])->name('destroy');

        // Create/Edit UMKM (jika perlu)
        Route::get('/create', [AdminController::class, 'create'])->name('create');
        Route::post('/store', [AdminController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [AdminController::class, 'edit'])->name('edit');
        Route::put('/{id}/update', [AdminController::class, 'update'])->name('update');
    });

    // ========== USER MANAGEMENT ==========
    Route::prefix('users')->name('admin.users.')->group(function () {
        Route::get('/', [AdminController::class, 'users'])->name('index');
        Route::get('/create', [AdminController::class, 'createAdmin'])->name('create');
        Route::post('/store', [AdminController::class, 'storeAdmin'])->name('store');
    });

    // ========== SETTINGS ==========
    Route::prefix('settings')->name('admin.settings.')->group(function () {
        Route::get('/', [AdminController::class, 'settings'])->name('index');
        Route::post('/profile', [AdminController::class, 'updateProfile'])->name('profile');
    });
});