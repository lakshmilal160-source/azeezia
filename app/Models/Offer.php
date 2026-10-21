<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
     protected $fillable = [
        'title',
        'slug',
        'description',
        'banner_image',
        'button_text',
        'button_url',
        'start_date',
        'end_date',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'datetime',
            'end_date' => 'datetime',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ];
    }
}
