<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invitation;
use App\Models\User;
use App\Services\ShortUrlService;

class DashboardController extends Controller
{
   public function __construct(private ShortUrlService $service){
    
   }

    public function index(){

        $companyId = auth()->user()->company_id;

        $users = User::where('company_id', $companyId)->with('roles')->get();
        $invitations = Invitation::where('company_id', $companyId)
            ->whereNull('accepted_at')->latest()->get();
        $shortUrl = $this->service->forAdmin($companyId); 

        return view('admin.dashboard', compact('users', 'invitations' , 'shortUrl'));
    }
}
