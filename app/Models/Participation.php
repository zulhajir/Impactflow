<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Participation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'activity_id',
        'type',
        'registration_date',
        'status',
        'assigned_task',
        'hours_volunteered',
        'notes',
    ];

    protected $casts = [
        'registration_date' => 'datetime'
    ];

    public function user(): BelongsTo { return $this->belongsTo(User::class); }
    public function activity(): BelongsTo { return $this->belongsTo(Activity::class); }
}