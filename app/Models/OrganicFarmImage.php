<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrganicFarmImage extends Model
{
     protected $fillable = [
        'organic_farm_id',
        'image',
        'alt_text',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'sort_order' => 'integer',
        ];
    }
}
