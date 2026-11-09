<?php
namespace App\Services\Admin;

use App\Mail\InvitationMail;
use App\Models\Invitation;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class InvitationService
{
    public function invite($data, User $admin){

        $invitation = Invitation::create([
            'name'       => $data['name'],
            'email'      => $data['email'],
            'role'       => $data['role'],
            'company_id' => $admin->company_id, 
            'token'      => Str::random(20),
            'invited_by' => $admin->id,
            'expires_at' => now()->addDays(1),
        ]);

        Mail::to($invitation->email)->send(new InvitationMail($invitation));

        return $invitation;
    }
}