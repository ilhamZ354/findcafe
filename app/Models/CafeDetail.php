<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CafeDetail extends Model
{
    protected $fillable = [
        'cafe_id', 'address', 'image_profile', 'description', 'galleries', 'location'
    ];

    protected $casts = [
        'galleries' => 'array',
    ];

    // relasi ke cafe
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'cafe_id');
    }

    //relasi ke menu
    public function menus(): HasMany
    {
        return $this->hasMany(Menu::class, 'cafe_id');
    }
}
