<?php
namespace App\Services;
use App\Models\ShortUrl;
use App\Models\User;
use Illuminate\Support\Str;

class ShortUrlService
{
    public function create($url, User $user)
    {
        $shortUrl = Str::random(6);
        return ShortUrl::create([
            'company_id'   => $user->company_id, 
            'user_id'      => $user->id,
            'original_url' => $url,
            'short_url'         => $shortUrl,
        ]);
    }

    public function forAdmin($companyId)
    {
        return ShortUrl::with('user')->where('company_id', $companyId)->latest()->get();
    }

    public function forMember($userId)
    {
        return ShortUrl::where('user_id', $userId)->latest()->get();
    }

    public function forSuperAdmin()
    {
        return ShortUrl::with(['user', 'company'])->latest()->get();
    }
}