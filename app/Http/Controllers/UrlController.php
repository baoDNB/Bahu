<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UrlService;
use App\Models\Url;
use App\Models\LinkHistory; // Thêm dòng này để sử dụng Model lịch sử

class UrlController extends Controller
{
    protected $urlService;

    public function __construct(UrlService $urlService)
    {
        $this->urlService = $urlService;
    }

    /**
     * Lưu link rút gọn mới
     */
    public function store(Request $request) 
    {
        $request->validate([
            'url' => 'required|url'
        ], [
            'url.required' => 'Vui lòng nhập URL!',
            'url.url' => 'Định dạng link không đúng (phải có http:// hoặc https://)'
        ]);

        $shortCode = $this->urlService->shorten($request->url);

        return back()->with('short_url', url('/') . '/' . $shortCode);
    }

    /**
     * Xử lý chuyển hướng và ghi lại lịch sử click
     */
    public function redirect(Request $request, $code)
    {
        $url = Url::where('short_code', $code)->first();

        if (!$url) {
            abort(404);
        }

        $url->increment('visits');

        $source = $request->query('source', 'direct'); 

        LinkHistory::create([
            'url_id'     => $url->id, 
            'platform'   => $source,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

   
        return redirect()->away($url->original_url);
    }


    public function index()
    {
        $urls = auth()->user()->urls()->latest()->get();

        return view('components.links', compact('urls'));
    }
    public function history($id)
    {

        $url = Url::with(['histories' => function($query) {
            $query->latest(); 
        }])
        ->where('user_id', auth()->id())
        ->findOrFail($id);

        return view('components.history', compact('url'));
    }
}