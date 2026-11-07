<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuperAdmin\InvitationController;
use App\Http\Controllers\SuperAdmin\DashboardController;
use App\Http\Controllers\Admin\AcceptInvitationController;
use App\Http\Controllers\Admin\LoginController as AdminOrMemberLogin;



Route::get('/superadmin/login', function () {
    return view('auth.login');
})->name('superadmin');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/logout', [AdminOrMemberLogin::class, 'logout'])->middleware('role:admin|member')->name('logout');
});

Route::middleware(['auth', 'verified','role:super_admin'])->prefix('superadmin')->group(function (){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/invitations', [InvitationController::class, 'store'])->name('invitations.store');
});

Route::get('/invitation/{token}', [AcceptInvitationController::class, 'show'])->name('invitation.accept');
Route::post('/invitation/{token}', [AcceptInvitationController::class, 'store'])->name('invitation.store');

Route::middleware('guest')->group(function () {
    Route::get('/{company:slug}/login', [AdminOrMemberLogin::class, 'showLogin'])->name('company.login');
    Route::post('/{company:slug}/login', [AdminOrMemberLogin::class, 'login'])->name('company.login.store');
});

require __DIR__.'/auth.php';
