<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'short_description',
        'description',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'technical_details',
        'images',
        'banner_image',
        'is_featured',
        'is_active',
        'sort_order'
    ];

    protected $casts = [
        'technical_details' => 'array',
        'images' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'sort_order' => 'integer'
    ];

    protected $dates = ['deleted_at'];

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }
        });

        static::updating(function ($product) {
            if ($product->isDirty('name') && empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }
        });
    }

    /**
     * Get the category that owns the product.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    /**
     * Get the inquiries for the product.
     */
    public function inquiries(): HasMany
    {
        return $this->hasMany(Inquiry::class);
    }

    /**
     * Get the downloads for the product.
     */
    public function downloads(): HasMany
    {
        return $this->hasMany(Download::class);
    }

    /**
     * Get the industries that this product serves.
     */
    public function industries(): BelongsToMany
    {
        return $this->belongsToMany(Industry::class, 'product_industry');
    }

    /**
     * Scope a query to only include active products.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to only include featured products.
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope a query to order by sort order.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    /**
     * Get related products (same category, excluding current).
     */
    public function getRelatedProductsAttribute()
    {
        return static::active()
            ->where('category_id', $this->category_id)
            ->where('id', '!=', $this->id)
            ->take(4)
            ->get();
    }

    /**
     * Get the main image attribute.
     */
    public function getMainImageAttribute()
    {
        if ($this->images && is_array($this->images) && count($this->images) > 0) {
            return $this->images[0];
        }
        return null;
    }

    /**
     * Get the main image URL attribute.
     */
    public function getMainImageUrlAttribute()
    {
        $mainImage = $this->main_image;
        return $mainImage ? asset('storage/' . $mainImage) : asset('images/default-product.jpg');
    }

    /**
     * Get all image URLs.
     */
    public function getImageUrlsAttribute()
    {
        if (!$this->images || !is_array($this->images)) {
            return [asset('images/default-product.jpg')];
        }

        return collect($this->images)->map(function ($image) {
            return asset('storage/' . $image);
        })->toArray();
    }

    /**
     * Get the meta title attribute with fallback.
     */
    public function getMetaTitleAttribute($value)
    {
        return $value ?: $this->name . ' | K Tech Valves';
    }

    /**
     * Get the banner image URL attribute.
     */
    public function getBannerImageUrlAttribute()
    {
        return $this->banner_image ? asset('storage/' . $this->banner_image) : asset('images/default-banner.jpg');
    }
}