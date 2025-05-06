<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RatingReview extends Model
{
    protected $fillable = [
        'cafe_id', 'user_id', 'rating', 'review'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function cafe(): BelongsTo
    {
        return $this->belongsTo(User::class, 'cafe_id');
    }
}
