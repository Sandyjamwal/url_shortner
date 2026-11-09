<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Models\Company;
use App\Services\AuthService;

class LoginController extends Controller
{
    public function __construct(private AuthService $service) {}
    public function showLogin(Company $company)
    {
        return view('admin.login', compact('company'));
    }

    public function login(LoginRequest $request, Company $company)
    {
        if (!$this->service->registerCompany($request->validated(), $company)) {
            return back()
                ->withErrors(['email' => 'Email or password is invalid'])
                ->onlyInput('email');
        }

        $request->session()->regenerate();

        // return redirect()->route('admin_dashboard');

        return auth()->user()->hasRole('admin') ? redirect()->route('admin_dashboard') : redirect()->route('member_dashboard'); 
    }

    public function logout(Request $request)
    {
        $slug = auth()->user()->company?->slug;

        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('company.login', $slug);
    }
}
