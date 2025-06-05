<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Industry extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'icon',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'is_active',
        'sort_order'
    ];

    protected $casts = [
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

        static::creating(function ($industry) {
            if (empty($industry->slug)) {
                $industry->slug = Str::slug($industry->name);
            }
        });

        static::updating(function ($industry) {
            if ($industry->isDirty('name') && empty($industry->slug)) {
                $industry->slug = Str::slug($industry->name);
            }
        });
    }

    /**
     * Get the products that serve this industry.
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_industry');
    }

    /**
     * Get active products that serve this industry.
     */
    public function activeProducts(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_industry')
                    ->where('products.is_active', true);
    }

    /**
     * Scope a query to only include active industries.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to order by sort order.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    /**
     * Get the meta title attribute with fallback.
     */
    public function getMetaTitleAttribute($value)
    {
        return $value ?: $this->name . ' Industry Solutions | K Tech Valves';
    }

    /**
     * Get the image URL attribute.
     */
    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : asset('images/default-industry.jpg');
    }

    /**
     * Get the icon URL attribute.
     */
    public function getIconUrlAttribute()
    {
        return $this->icon ? asset('storage/' . $this->icon) : asset('images/default-icon.svg');
    }

    /**
     * Get products count for this industry.
     */
    public function getProductsCountAttribute()
    {
        return $this->activeProducts()->count();
    }
}