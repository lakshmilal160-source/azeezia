<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResortRoomType extends Model
{
    protected $fillable = [
        'resort_id',
        'name',
        'description',
        'bedrooms',
        'bathrooms',
        'max_guests',
        'price',
        'price_unit',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'bedrooms' => 'integer',
            'bathrooms' => 'integer',
            'max_guests' => 'integer',
            'price' => 'decimal:2',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ];
    }
}
