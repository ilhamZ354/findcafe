<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;
use App\Models\Menu;

class CafeDetail extends Model
{
    protected $fillable = [
        'cafe_id', 'address', 'image_profile', 'description', 'galleries', 'location'
    ];

    protected $casts = [
        'galleries' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'cafe_id');
    }

    public function menus(): HasMany
    {
        return $this->hasMany(Menu::class, 'cafe_id');
    }
}
