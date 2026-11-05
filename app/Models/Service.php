<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'description',
        'image',
        'sort_order',
        'is_active',
        'points',
    ];

    protected function casts(): array
    {
        return [
            'points' => 'array',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ];
    }
}
