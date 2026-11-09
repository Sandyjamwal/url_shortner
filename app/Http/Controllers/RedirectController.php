<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShortUrl;


class RedirectController extends Controller
{
    public function __invoke($shortUrl)
    {
        $short = ShortUrl::where('short_url', $shortUrl)->firstOrFail();

        return redirect()->away($short->original_url);
    }
}
