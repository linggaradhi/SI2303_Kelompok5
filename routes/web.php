<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\CustomerOrderController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\CustomerDashboardController;

Route::get('/', function () {
    return view("auth.login");
});

Route::get('/dashboard', function () {
    if (Auth::user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } else {
        return redirect()->route('customer.dashboard');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

// Route khusus admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::put('/admin/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');
});

// Route khusus customer
Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/customer/dashboard', [CustomerDashboardController::class, 'index'])->name('customer.dashboard');
    Route::post('/customer/orders', [CustomerOrderController::class, 'store'])->name('customer.orders.store');
    Route::put('/customer/orders/{order}', [CustomerOrderController::class, 'update'])->name('customer.orders.update');
    Route::get('/customer/orders/{order}', [CustomerOrderController::class, 'show'])->name('customer.orders.show');
    Route::post('/customer/orders/{order}/cancel', [CustomerOrderController::class, 'cancel'])
        ->name('customer.orders.cancel');
});

// Route profile (semua user yang sudah login)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
