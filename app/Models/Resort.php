<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Resort extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'short_description',
        'description',
        'address',
        'amenities',
        'contact_phone',
        'email',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'amenities' => 'array',
            'is_active' => 'boolean',
        ];
    }

    public function roomTypes(): HasMany
    {
        return $this->hasMany(ResortRoomType::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ResortImage::class);
    }
}
