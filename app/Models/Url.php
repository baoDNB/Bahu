<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Url extends Model
{
    protected $fillable = ['original_url', 'short_code', 'user_id', 'visits'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function histories(): HasMany
    {
        return $this->hasMany(LinkHistory::class, 'url_id');
    }
}