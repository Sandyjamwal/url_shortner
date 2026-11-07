<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invitation;

class DashboardController extends Controller
{
    public function index()
    {
        $invitations = Invitation::whereNull('company_id')
            ->latest()
            ->get();

        return view('superadmin.dashboard', compact('invitations'));
    }
}
