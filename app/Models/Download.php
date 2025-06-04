<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Download extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'file_name',
        'file_path',
        'file_type',
        'file_size',
        'description',
        'category',
        'product_id',
        'download_count',
        'is_public',
        'is_active'
    ];

    protected $casts = [
        'file_size' => 'integer',
        'download_count' => 'integer',
        'is_public' => 'boolean',
        'is_active' => 'boolean'
    ];

    protected $dates = ['deleted_at'];

    /**
     * Get the product that owns the download.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Scope a query to only include active downloads.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to only include public downloads.
     */
    public function scopePublic($query)
    {
        return $query->where('is_public', true);
    }

    /**
     * Scope a query to filter by category.
     */
    public function scopeCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Get the file URL attribute.
     */
    public function getFileUrlAttribute()
    {
        return asset('storage/' . $this->file_path);
    }

    /**
     * Get formatted file size.
     */
    public function getFormattedFileSizeAttribute()
    {
        if (!$this->file_size) {
            return 'Unknown';
        }

        $units = ['B', 'KB', 'MB', 'GB'];
        $size = $this->file_size;
        $unit = 0;

        while ($size >= 1024 && $unit < count($units) - 1) {
            $size /= 1024;
            $unit++;
        }

        return round($size, 2) . ' ' . $units[$unit];
    }

    /**
     * Increment download count.
     */
    public function incrementDownloadCount()
    {
        $this->increment('download_count');
    }

    /**
     * Get file icon based on type.
     */
    public function getFileIconAttribute()
    {
        return match($this->file_type) {
            'pdf' => 'fa-file-pdf',
            'doc', 'docx' => 'fa-file-word',
            'xls', 'xlsx' => 'fa-file-excel',
            'zip', 'rar' => 'fa-file-archive',
            'jpg', 'jpeg', 'png', 'gif' => 'fa-file-image',
            default => 'fa-file'
        };
    }
}