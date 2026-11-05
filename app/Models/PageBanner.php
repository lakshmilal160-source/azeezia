<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageBanner extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'page_banners';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'page_name',
        'page_slug',
        'title_part1',
        'title_part2',
        'description',
        'banner_image',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Retrieve the public URL for the banner image.
     */
    public function getImageUrlAttribute(): ?string
    {
        return $this->banner_image ? asset('storage/'.$this->banner_image) : null;
    }

    /**
     * Get combined title.
     */
    public function getFullTitleAttribute(): string
    {
        return trim(($this->title_part1 ? $this->title_part1.' ' : '').($this->title_part2 ?? ''));
    }

    /**
     * Find active banner by page slug.
     */
    public static function getForPage(string $pageSlug): ?self
    {
        return static::where('page_slug', $pageSlug)->where('is_active', true)->first();
    }
}
