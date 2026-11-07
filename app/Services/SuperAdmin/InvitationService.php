<?php
namespace App\Services\SuperAdmin;
use App\Mail\InvitationMail;
use App\Models\Invitation;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class InvitationService
{
    public function inviteAdmin(array $data, User $superAdmin)
    {
        Invitation::where('email', $data['email'])
            ->whereNull('accepted_at')
            ->delete();

        $invitation = Invitation::create([
            'name'       => $data['name'],
            'email'      => $data['email'],
            'role'       => 'admin',
            'company_id' => null,     
            'token'      => Str::random(40),
            'invited_by' => $superAdmin->id,
            'expires_at' => now()->addDays(3),
        ]);

        Mail::to($invitation->email)->send(new InvitationMail($invitation));

        return $invitation;
    }
}