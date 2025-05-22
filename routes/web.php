<?php

use App\Http\Controllers\SepatuController;

Route::get('/', function () {
    return view('/auth/login');
});

Route::middleware(['auth'])->group(function () {
    // Route::get('/dashboard', [AuthenticatedSessionController::class, 'store'])
    Route::get('/sepatu', [SepatuController::class, 'index'])->name('sepatu.index');
    Route::get('/sepatu/create', [SepatuController::class, 'create'])->name('sepatu.create');
    Route::post('/sepatu', [SepatuController::class, 'store'])->name('sepatu.store');
    Route::delete('/sepatu/{id}', [SepatuController::class, 'destroy'])->name('sepatu.destroy');
});

require __DIR__.'/auth.php';

