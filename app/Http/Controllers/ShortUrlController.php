<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreShortUrlRequest;
use App\Services\ShortUrlService;

class ShortUrlController extends Controller
{
    public function __construct(private ShortUrlService $service)
    {

    }

    public function store(StoreShortUrlRequest $request)
    {
        $short = $this->service->create($request->original_url, $request->user());

        return back()->with('success', 'Short URL Genrated Succesfully');
    }
}
