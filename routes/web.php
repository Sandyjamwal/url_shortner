<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;



Route::get('/superadmin/login', function () {
    return view('auth.login');
})->name('superadmin');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified','role:super_admin'])->prefix('superadmin')->group(function (){
    Route::get('/dashboard', function () {
        return view('superadmin.dashboard');
    })->name('dashboard');
});

require __DIR__.'/auth.php';
