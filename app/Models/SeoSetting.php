<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_type',
        'page_identifier',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'og_title',
        'og_description',
        'og_image',
        'schema_markup',
        'canonical_url',
        'robots_meta'
    ];

    protected $casts = [
        'schema_markup' => 'array'
    ];

    /**
     * Get SEO settings for a specific page.
     */
    public static function getForPage($pageType, $identifier = null)
    {
        return static::where('page_type', $pageType)
            ->where('page_identifier', $identifier)
            ->first();
    }

    /**
     * Get or create SEO settings for a page.
     */
    public static function getOrCreateForPage($pageType, $identifier = null, $defaultData = [])
    {
        $seoSetting = static::getForPage($pageType, $identifier);

        if (!$seoSetting) {
            $seoSetting = static::create(array_merge([
                'page_type' => $pageType,
                'page_identifier' => $identifier,
            ], $defaultData));
        }

        return $seoSetting;
    }

    /**
     * Get the Open Graph image URL attribute.
     */
    public function getOgImageUrlAttribute()
    {
        return $this->og_image ? asset('storage/' . $this->og_image) : asset('images/default-og.jpg');
    }

    /**
     * Scope to get settings by page type.
     */
    public function scopeByPageType($query, $pageType)
    {
        return $query->where('page_type', $pageType);
    }
}