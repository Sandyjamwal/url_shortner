<?php
namespace App\Services\Admin;

use App\Models\Company;
use App\Models\Invitation;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AcceptInvitationService
{
    public function findValid(string $token)
    {
        return Invitation::where('token', $token)
            ->whereNull('accepted_at')
            ->where('expires_at', '>', now())
            ->firstOrFail();
    }

    public function accept(Invitation $invitation, array $data)
    {
        return DB::transaction(function () use ($invitation, $data) {

            $companyId = $invitation->company_id;

            if (!$companyId) {
                $companyId = Company::create([
                    'name' => $data['company_name'],
                    'slug' => $this->makeSlug($data['company_name']),
                    ])->id;
            }

            $user = User::create([
                'name'       => $invitation->name,
                'email'      => $invitation->email,
                'password'   => Hash::make($data['password']),
                'company_id' => $companyId,
            ]);

            $user->assignRole($invitation->role);

            $invitation->update(['accepted_at' => now()]);

            return $user;
        });
    }

    private function makeSlug(string $name): string
    {
        $slug = Str::slug($name);
  
        if (Company::where('slug', $slug)->exists()) {
            $slug .= '-' . Str::random(5);
        }

        return $slug;
    }
}