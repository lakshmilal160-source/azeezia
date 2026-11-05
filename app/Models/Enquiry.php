<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Enquiry extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'enquiry_type',
        'convention_centre_id',
        'resort_id',
        'organic_farm_id',
        'status',
        'admin_notes',
    ];

    public function conventionCentre(): BelongsTo
    {
        return $this->belongsTo(ConventionCentre::class);
    }

    public function resort(): BelongsTo
    {
        return $this->belongsTo(Resort::class);
    }

    public function organicFarm(): BelongsTo
    {
        return $this->belongsTo(OrganicFarm::class);
    }
}
