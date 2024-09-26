<?php

namespace App\Http\Controllers;

use App\Models\ShortUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class UserurlController extends Controller
{
    public function index()
    {
        $urls = ShortUrl::where('user_id', Auth::id())->get();
        return view('user.urls', compact('urls'));
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

        return redirect()->route('user.urls')->with('success', 'Short URL generated!');
    }
    public function show($shortUrl)
    {
        $url = ShortUrl::where('short_url', $shortUrl)->firstOrFail();
        $url->increment('click_count');

        return redirect($url->original_url);
    }
    
}
