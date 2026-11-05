<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Infrastructure extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'description',
        'points',
        'order',
        'status',
    ];

    protected $casts = [
        'order' => 'integer',
        'status' => 'boolean',
    ];

    /**
     * Scope to active items.
     */
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    /**
     * Scope ordered.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('id');
    }

    /**
     * Return public image URL.
     */
    public function getImageUrlAttribute(): ?string
    {
        if (! $this->image) {
            return null;
        }

        if (str_starts_with($this->image, 'http')) {
            return $this->image;
        }

        if (str_starts_with($this->image, 'assets/')) {
            return asset($this->image);
        }

        if (str_starts_with($this->image, 'storage/')) {
            return asset($this->image);
        }

        return asset('storage/'.$this->image);
    }

    /**
     * Get points as an array of trimmed lines.
     */
    public function getPointsArrayAttribute(): array
    {
        if (empty($this->points)) {
            return [];
        }

        $lines = preg_split('/\r\n|\r|\n/', (string) $this->points);

        return array_values(array_filter(array_map('trim', $lines)));
    }

    /**
     * Formatted two-digit display order (01, 02, etc.).
     */
    public function getFormattedOrderAttribute(): string
    {
        return str_pad((string) ($this->order ?? 1), 2, '0', STR_PAD_LEFT);
    }
}
