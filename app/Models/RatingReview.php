<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RatingReview extends Model
{
    protected $fillable = [
        'cafe_id', 'user_id', 'rating', 'review'
    ];

    // relasi ke user
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // relasi ke user role cafe
    public function cafe(): BelongsTo
    {
        return $this->belongsTo(User::class, 'cafe_id');
    }
}
