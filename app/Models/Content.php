<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Content extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'activity_id',
        'title',
        'slug',
        'type',
        'excerpt',
        'body',
        'file_url',
        'is_published',
        'published_at',
        'report_date',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
        'report_date' => 'datetime',
    ];

    public function user(): BelongsTo { return $this->belongsTo(User::class); }
    public function activity(): BelongsTo { return $this->belongsTo(Activity::class); }
}