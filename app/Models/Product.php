<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'content',
        'model_number',
        'technical_specifications',
        'features',
        'applications',
        'main_image',
        'gallery_images',
        'brochure_pdf',
        'price',
        'is_featured',
        'is_active',
        'sort_order',
        'meta_data'
    ];

    protected $casts = [
        'technical_specifications' => 'array',
        'features' => 'array',
        'applications' => 'array',
        'gallery_images' => 'array',
        'price' => 'decimal:2',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'meta_data' => 'array'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function inquiries()
    {
        return $this->hasMany(Inquiry::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    public function getSimilarProducts($limit = 4)
    {
        return self::where('category_id', $this->category_id)
                  ->where('id', '!=', $this->id)
                  ->active()
                  ->ordered()
                  ->limit($limit)
                  ->get();
    }
}
