<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invitation;
use App\Services\ShortUrlService;

class DashboardController extends Controller
{
     public function __construct(private ShortUrlService $service){
    
   }
    public function index()
    {
        $invitations = Invitation::whereNull('company_id')
            ->latest()
            ->get();

        $shortUrl = $this->service->forSuperAdmin(); 

        return view('superadmin.dashboard', compact('invitations','shortUrl'));
    }
}
