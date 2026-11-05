<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ConventionCentre extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'contact_phone',
        'email',
        'address',
        'location_url',
        'short_description',
        'description',
        'car_parking_capacity',
        'is_active',
    ];

    protected $casts = [
        'car_parking_capacity' => 'integer',
        'is_active' => 'boolean',
    ];

    /**
     * Scope to active convention centres.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Phone alias for convenience.
     */
    public function getPhoneAttribute(): ?string
    {
        return $this->contact_phone;
    }

    /**
     * Mobile alias for convenience.
     */
    public function getMobileAttribute(): ?string
    {
        return $this->contact_phone;
    }

    /**
     * Halls / spaces relation.
     */
    public function halls(): HasMany
    {
        return $this->hasMany(ConventionHall::class)->orderBy('sort_order')->orderBy('id');
    }

    /**
     * Gallery images.
     */
    public function images(): HasMany
    {
        return $this->hasMany(ConventionCentreImage::class)->orderBy('sort_order')->orderBy('id');
    }

    /**
     * Enquiries relation.
     */
    public function enquiries(): HasMany
    {
        return $this->hasMany(Enquiry::class);
    }
}
