<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PushNotification extends Model
{
    use HasFactory;

    protected $fillable = [
        'news_id',
        'title',
        'body',
        'status',
        'error',
    ];

    public function news(): BelongsTo
    {
        return $this->belongsTo(News::class);
    }
}

