<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LinkHistory extends Model
{
    protected $fillable = ['url_id', 'platform', 'ip_address', 'user_agent'];

    public function url()
    {
        return $this->belongsTo(Url::class);
    }
}