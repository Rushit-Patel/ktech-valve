<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gallery extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'image',
        'alt_text',
        'category',
        'description',
        'is_active',
        'sort_order'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer'
    ];

    protected $dates = ['deleted_at'];

    /**
     * Scope a query to only include active gallery items.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to filter by category.
     */
    public function scopeCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Scope a query to order by sort order.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('created_at', 'desc');
    }

    /**
     * Get the image URL attribute.
     */
    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : asset('images/default-gallery.jpg');
    }

    /**
     * Get the thumbnail URL attribute.
     */
    public function getThumbnailUrlAttribute()
    {
        if (!$this->image) {
            return asset('images/default-gallery-thumb.jpg');
        }
        
        $pathInfo = pathinfo($this->image);
        $thumbnail = $pathInfo['dirname'] . '/thumbs/' . $pathInfo['filename'] . '_thumb.' . $pathInfo['extension'];
        
        return asset('storage/' . $thumbnail);
    }

    /**
     * Get unique categories.
     */
    public static function getCategories()
    {
        return static::active()
            ->whereNotNull('category')
            ->distinct()
            ->pluck('category')
            ->filter()
            ->sort()
            ->values();
    }
}