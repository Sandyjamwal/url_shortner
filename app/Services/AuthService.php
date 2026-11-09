<?php
namespace App\Services;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function registerCompany(array $credentials, Company $company)
    {
        if (!Auth::attempt($credentials)) {
            return false;
        }

        $user = Auth::user();

        if ($user->hasRole('super_admin') || $user->company_id !== $company->id) {
            Auth::logout();
            return false;
        }

        return true;
    }
}