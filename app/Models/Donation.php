<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'activity_id',
        'amount',
        'currency',
        'donation_date',
        'payment_method',
        'is_anonymous',
        'status',
    ];

    protected $casts = [
        'donation_date' => 'datetime',
        'amount' => 'decimal:2',
        'is_anonymous' => 'boolean',
    ];

    public function user(): BelongsTo { return $this->belongsTo(User::class); }
    public function activity(): BelongsTo { return $this->belongsTo(Activity::class); }
}