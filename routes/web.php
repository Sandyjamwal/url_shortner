<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuperAdmin\InvitationController;
use App\Http\Controllers\SuperAdmin\DashboardController;
use App\Http\Controllers\Admin\AcceptInvitationController;
use App\Http\Controllers\Admin\LoginController as AdminOrMemberLogin;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\InvitationController as AdminInvitation;
use App\Http\Controllers\Member\MemberDashboardController;
use App\Http\Controllers\ShortUrlController;
use App\Http\Controllers\RedirectController;


Route::get('/', function () {
    return redirect()->route('superadmin');
});


Route::get('/superadmin/login', function () {
    return view('auth.login');
})->name('superadmin');

Route::middleware(['auth'])->group(function(){

    Route::middleware(['role:super_admin'])->prefix('superadmin')->group(function (){
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('/invitations', [InvitationController::class, 'store'])->name('invitations.store');
    });

    Route::middleware(['role:admin'])->prefix('admin')->group(function (){
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin_dashboard');
        Route::post('/invitations', [AdminInvitation::class, 'store'])->name('admininvitations.store');
    });

    Route::middleware(['role:member'])->prefix('member')->group(function (){
        Route::get('/dashboard', [MemberDashboardController::class, 'index'])->name('member_dashboard');
    });

    Route::middleware(['role:admin|member'])->prefix('member')->group(function (){
        Route::post('/short-urls', [ShortUrlController::class, 'store'])->name('short-urls.store');
        Route::post('/logout', [AdminOrMemberLogin::class,'logout'])->name('adminlogout');
    });
    Route::get('/{shortUrl}', RedirectController::class)->name('short.redirect');

});

Route::get('/invitation/{token}', [AcceptInvitationController::class, 'show'])->name('invitation.accept');
Route::post('/invitation/{token}', [AcceptInvitationController::class, 'store'])->name('invitation.store');

Route::middleware('guest')->group(function () {
    Route::get('/{company:slug}/login', [AdminOrMemberLogin::class, 'showLogin'])->name('company.login');
    Route::post('/{company:slug}/login', [AdminOrMemberLogin::class, 'login'])->name('company.login.store');
});

require __DIR__.'/auth.php';
