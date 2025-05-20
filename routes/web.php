<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/', [\App\Http\Controllers\CameraController::class, 'index']);
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [\App\Http\Controllers\Admin\AdminController::class, 'index'])->name('users.index');
    Route::post('/admin/assign', [\App\Http\Controllers\Admin\AdminController::class, 'assign'])->name('users.cameras.update');

    Route::post('/admin/users', [\App\Http\Controllers\Admin\AdminController::class, 'storeUser'])->name('users.store');
    Route::delete('/admin/users/{id}', [\App\Http\Controllers\Admin\AdminController::class, 'destroyUser'])->name('users.destroy');

    Route::post('/admin/cameras', [\App\Http\Controllers\Admin\AdminController::class, 'storeCamera'])->name('cameras.store');
    Route::delete('/admin/cameras/{id}', [\App\Http\Controllers\Admin\AdminController::class, 'destroyCamera'])->name('cameras.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
