<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'type',
        'media_url',
        'thumbnail_url',
        'is_published',
        'album_id',
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(Media::class, 'album_id');
    }

    public function album(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'album_id');
    }
}