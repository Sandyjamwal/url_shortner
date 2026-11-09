<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ShortUrlService;

class MemberDashboardController extends Controller
{
    public function __construct(private ShortUrlService $service){
    
   }

    public function index(){
        $userId = auth()->user()->id;

        $shortUrl = $this->service->forMember($userId); 
        return view('member.dashboard',compact('shortUrl'));
    }
}
