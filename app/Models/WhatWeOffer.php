<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhatWeOffer extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'icon',
        'description',
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
     * Return public image URL (used in the Home section).
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

        return asset('storage/'.$this->image);
    }

    /**
     * Return public icon URL (used in the Convention Centre section).
     */
    public function getIconUrlAttribute(): ?string
    {
        if (! $this->icon) {
            return null;
        }

        if (str_starts_with($this->icon, 'http')) {
            return $this->icon;
        }

        if (str_starts_with($this->icon, 'assets/')) {
            return asset($this->icon);
        }

        return asset('storage/'.$this->icon);
    }

    /**
     * Formatted two-digit display order (01, 02, etc.).
     */
    public function getFormattedOrderAttribute(): string
    {
        return str_pad((string) ($this->order ?? 1), 2, '0', STR_PAD_LEFT);
    }
}
