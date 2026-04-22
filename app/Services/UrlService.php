<?php

namespace App\Services;

use App\Models\Url;
use Sqids\Sqids;
use Illuminate\Support\Facades\DB;

class UrlService
{
    protected $sqids;

    public function __construct()
    {
        $this->sqids = new Sqids(minLength: 5);
    }

    public function shorten($originalUrl)
    {
        return DB::transaction(function () use ($originalUrl) {

            $urlRecord = Url::create([
                'original_url' => $originalUrl,
                'short_code'   => '', 
            ]);


            $code = $this->sqids->encode([$urlRecord->id]); 


            $urlRecord->update(['short_code' => $code]);

            return $code;
        });
    }
}