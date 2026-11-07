<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Resort extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'short_description',
        'description',
        'address',
        'amenities',
        'contact_phone',
        'email',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'amenities' => 'array',
            'is_active' => 'boolean',
        ];
    }

    public function roomTypes(): HasMany
    {
        return $this->hasMany(ResortRoomType::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ResortImage::class);
    }

    public static function getContact(): array
    {
        $resort = self::query()->first();

        // The resort and organic farm have the same address, so choose the resort address
        $address = $resort?->address ?: 'Near Heritage Valley, Thrissur, Kerala 680005';
        $phone = $resort?->contact_phone ?: '+91 75 94 95 0777';
        $email = $resort?->email ?: 'farm@azeezia.com';
        $name = $resort?->name ?: 'Azeezia Resort';
        $url = 'https://maps.google.com/?q='.urlencode('Azeezia Resort, '.$address);

        return [
            'name' => 'Azeezia Resort & 65+ Acre Farm',
            'resort_name' => $name,
            'combined_name' => 'Azeezia Resort & Organic Farm',
            'address' => $address,
            'phone' => $phone,
            'email' => $email,
            'url' => $url,
        ];
    }
}
