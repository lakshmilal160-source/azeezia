<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ConventionCentre extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'short_description',
        'description',
        'address',
        'location_url',
        'car_parking_capacity',
        'is_active',
    ];

    public function halls(): HasMany
    {
        return $this->hasMany(ConventionHall::class);
    }
    public function images():HasMany
    {
        return $this->hasMany(ConventionCentreImage::class);
    }
    public function enquiries():HasMany
    {
        return $this->hasMany(Enquiry::class);
    }
}
