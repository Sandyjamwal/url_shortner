<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AcceptInvitationRequest;
use App\Services\Admin\AcceptInvitationService;

class AcceptInvitationController extends Controller
{
    public function __construct(private AcceptInvitationService $service) {

    }

    public function show(string $token)
    {
        $invitation = $this->service->findValid($token);

        return view('admin.accept-invitation', compact('invitation'));
    }

    public function store(AcceptInvitationRequest $request, string $token)
    {
        $invitation = $this->service->findValid($token);

        if (!$invitation->company_id && !$request->filled('company_name')) {
            return back()
                ->withErrors(['company_name' => 'Please enter Company Name'])
                ->withInput();
        }

        $user = $this->service->accept($invitation, $request->validated());

        return redirect()
            ->route('company.login', $user->company->slug)
            ->with('success', 'Account created succesfully');
    }
}
