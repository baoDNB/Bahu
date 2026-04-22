<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UrlService;
use App\Models\Url;
use Illuminate\View\View;

class UrlController extends Controller
{
    protected $urlService;

    public function __construct(UrlService $urlService)
    {
        $this->urlService = $urlService;
    }

    public function index(): View
    {
        $urls = Url::latest()->take(10)->get();

        return view('welcome', compact('urls'));
    }

    public function store(Request $request) 
    {
        $request->validate([
            'url' => 'required|url'
        ], [
            'url.required' => 'Vui lòng nhập URL!',
            'url.url' => 'Định dạng link không đúng (phải có http:// hoặc https://)'
        ]);

        $shortCode = $this->urlService->shorten($request->url);

        return redirect()->route('home')->with('short_url', url('/') . '/' . $shortCode);
    }

    public function redirect($code)
    {
        $url = Url::where('short_code', $code)->first();

        if (!$url) {
            abort(404);
        }

        $url->increment('visits');

        return redirect()->away($url->original_url);
    }
}