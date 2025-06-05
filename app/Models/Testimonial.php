<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_name',
        'client_designation',
        'company_name',
        'testimonial',
        'client_image',
        'rating',
        'is_featured',
        'is_active',
        'sort_order'
    ];

    protected $casts = [
        'rating' => 'integer',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'sort_order' => 'integer'
    ];

    protected $dates = ['deleted_at'];

    /**
     * Scope a query to only include active testimonials.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to only include featured testimonials.
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
        return $query->orderBy('sort_order')->orderBy('created_at', 'desc');
    }

    /**
     * Get the client image URL attribute.
     */
    public function getClientImageUrlAttribute()
    {
        return $this->client_image ? asset('storage/' . $this->client_image) : asset('images/default-avatar.png');
    }

    /**
     * Get star rating HTML.
     */
    public function getStarRatingAttribute()
    {
        $stars = '';
        for ($i = 1; $i <= 5; $i++) {
            if ($i <= $this->rating) {
                $stars .= '<i class="fas fa-star text-yellow-400"></i>';
            } else {
                $stars .= '<i class="far fa-star text-gray-300"></i>';
            }
        }
        return $stars;
    }

    /**
     * Get truncated testimonial.
     */
    public function getTruncatedTestimonialAttribute($length = 150)
    {
        return \Str::limit($this->testimonial, $length);
    }
}