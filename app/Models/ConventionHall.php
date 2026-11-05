<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ConventionHall extends Model
{
    use HasFactory;

    protected $fillable = [
        'convention_centre_id',
        'name',
        'badge',
        'image',
        'seating_capacity',
        'floating_capacity',
        'dining_capacity',
        'description',
        'features',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'seating_capacity' => 'integer',
        'floating_capacity' => 'integer',
        'dining_capacity' => 'integer',
        'sort_order' => 'integer',
        'is_active' => 'boolean',
    ];

    /**
     * Parent convention centre.
     */
    public function conventionCentre(): BelongsTo
    {
        return $this->belongsTo(ConventionCentre::class, 'convention_centre_id');
    }

    /**
     * Alias for backward compatibility.
     */
    public function conventionCenter(): BelongsTo
    {
        return $this->conventionCentre();
    }

    /**
     * Scope to active halls.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope ordered.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }

    /**
     * Return public URL for hall image.
     */
    public function getImageUrlAttribute(): ?string
    {
        if (! $this->image) {
            return null;
        }

        return str_starts_with($this->image, 'http') ? $this->image : asset($this->image);
    }

    /**
     * Get features as an array of trimmed lines.
     */
    public function getFeaturesArrayAttribute(): array
    {
        if (empty($this->features)) {
            return [];
        }

        $lines = preg_split('/\r\n|\r|\n/', (string) $this->features);

        return array_values(array_filter(array_map('trim', $lines)));
    }
}
