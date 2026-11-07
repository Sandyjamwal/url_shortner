<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SuperAdmin\StoreInvitationRequest;
use App\Services\SuperAdmin\InvitationService;

class InvitationController extends Controller
{
    public function __construct(private InvitationService $invitationservice) {}

    public function store(StoreInvitationRequest $request)
    {
        $this->invitationservice->inviteAdmin($request->validated(), $request->user());

        return back()->with('success', 'Invitation send succesfully');
    }
}
