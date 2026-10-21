<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResortImage extends Model
{
     protected $fillable = [
        'resort_id',
        'resort_room_type_id',
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
