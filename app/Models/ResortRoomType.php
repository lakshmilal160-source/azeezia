<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ResortRoomType extends Model
{
    protected $fillable = [
        'resort_id',
        'name',
        'image',
        'image_2',
        'description',
        'bedrooms',
        'bathrooms',
        'max_guests',
        'price',
        'price_unit',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'bedrooms' => 'integer',
            'bathrooms' => 'integer',
            'max_guests' => 'integer',
            'price' => 'decimal:2',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Parent resort.
     */
    public function resort(): BelongsTo
    {
        return $this->belongsTo(Resort::class);
    }

    /**
     * Associated gallery images.
     */
    public function images(): HasMany
    {
        return $this->hasMany(ResortImage::class, 'resort_room_type_id');
    }

    /**
     * Scope to active room types.
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

        if (str_starts_with($this->image, 'assets/') || str_starts_with($this->image, 'storage/')) {
            return asset($this->image);
        }

        return asset('storage/'.$this->image);
    }

    /**
     * Return secondary public image URL.
     */
    public function getImage2UrlAttribute(): ?string
    {
        if (! $this->image_2) {
            return null;
        }

        if (str_starts_with($this->image_2, 'http')) {
            return $this->image_2;
        }

        if (str_starts_with($this->image_2, 'assets/') || str_starts_with($this->image_2, 'storage/')) {
            return asset($this->image_2);
        }

        return asset('storage/'.$this->image_2);
    }
}
