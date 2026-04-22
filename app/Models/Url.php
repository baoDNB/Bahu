<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    protected $fillable = ['original_url', 'short_code', 'user_id', 'visits'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
