<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrganicFarm extends Model
{
     protected $fillable = [
        'name',
        'slug',
        'short_description',
        'description',
        'area_acres',
        'address',
        'activities',
        'facilities',
        'contact_phone',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'area_acres' => 'decimal:2',
            'activities' => 'array',
            'facilities' => 'array',
            'is_active' => 'boolean',
        ];
    }
}
