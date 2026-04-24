<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsClick extends Model
{
    protected $fillable = [
        'news_id',
        'device_id',
        'category_id',
        'clicked_at',
    ];

    protected $casts = [
        'clicked_at' => 'datetime',
    ];
}

