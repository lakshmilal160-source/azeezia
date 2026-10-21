<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'amenities' => 'array',
            'is_active' => 'boolean',
        ];
    }
}
