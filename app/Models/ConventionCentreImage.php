<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConventionCentreImage extends Model
{
     protected $fillable = [
        'convention_centre_id',
        'image',
        'alt_text',
        'sort_order',
    ];

    public function conventionCenter()
    {
        return $this->belongsTo(ConventionCentre::class);
    }
     
}
