<?php

namespace App\Services;

use App\Models\Url;
use Sqids\Sqids;
use Illuminate\Support\Facades\DB;

class UrlService
{
    //private $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

    /*public function __construct($chars)
    {
        $this->chars = str_split($chars);
    }

    private function encode($id)
    {
        $code = '';
        while ($id > 0) {
            $code = $this->chars[$id % 62] . $code;
            $id = intdiv($id, 62);
        }
        return $code;
    }*/
    protected $sqids;

    public function __construct()
    {
        // Khởi tạo Sqids với độ dài tối thiểu là 5 ký tự (tùy chọn)
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