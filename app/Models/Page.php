<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'template',
        'sections',
        'featured_image',
        'is_active',
        'meta_data'
    ];

    protected $casts = [
        'sections' => 'array',
        'is_active' => 'boolean',
        'meta_data' => 'array'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
