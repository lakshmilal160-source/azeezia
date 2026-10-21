<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConventionHall extends Model
{
     protected $fillable = [
        'convention_centre_id',
        'name',
        'seating_capacity',
        'floating_capacity',
        'dining_capacity',
        'description',
        'sort_order',
        'is_active',
    ];

    public function conventionCenter()
    {
        return $this->belongsTo(ConventionCentre::class);
    }
}
