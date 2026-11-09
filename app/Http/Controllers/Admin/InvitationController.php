<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\InsertInvitationRequest;
use App\Services\Admin\InvitationService;

class InvitationController extends Controller
{
    public function __construct(private InvitationService $service) {}

    public function store(InsertInvitationRequest $request)
    {
        $this->service->invite($request->validated(), $request->user());

        return back()->with('success', 'Invitation send succesfully');
    }
}
