<?php

namespace App\Http\Controllers;

use App\Models\ShortUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class apiController extends Controller
{
    public function index()
    {
        $urls = ShortUrl::where('user_id', Auth::id())->get();

        // Return URLs in JSON format
        return response()->json([
            'urls' => $urls,
        ], 200);
    }

    public function create(Request $request)
    {
        $request->validate([
            'original_url' => 'required|url',
        ]);

        $shortUrl = Str::random(6);

        $url = ShortUrl::create([
            'original_url' => $request->original_url,
            'short_url' => $shortUrl,
            'user_id' => Auth::id(),
        ]);

        return response()->json([
            'message' => 'Short URL generated!',
            'original_url' => $url->original_url,
            'short_url' => url($shortUrl),
        ], 201);
    }
    public function show($shortUrl)
    {
        $url = ShortUrl::where('short_url', $shortUrl)->firstOrFail();
        $url->increment('click_count');
        return response()->json([
            'original_url' => $url->original_url,
        ], 200);
    }
}
