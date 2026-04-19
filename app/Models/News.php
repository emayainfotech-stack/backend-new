<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class News extends Model
{
    use HasFactory;

    protected $table = 'news';

    protected $fillable = [
        'category_id',
        'created_by',
        'title',
        'short_description',
        'source_link',
        'city',
        'state_id',
        'city_id',
        'media_type',
        'media_path',
        'tags',
        'status',
        'publish_at',
        'is_important',
        'send_push_notification',
    ];

    protected function casts(): array
    {
        return [
            'tags' => 'array',
            'publish_at' => 'datetime',
            'is_important' => 'boolean',
            'send_push_notification' => 'boolean',
        ];
    }

    public function getFormattedPublishAtAttribute(): string
    {
        return $this->publish_at ? $this->publish_at->format('d M Y, h:i A') : '—';
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}

