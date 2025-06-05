<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Certification extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'certificate_image',
        'issued_by',
        'issued_date',
        'expiry_date',
        'certificate_number',
        'is_active',
        'sort_order'
    ];

    protected $casts = [
        'issued_date' => 'date',
        'expiry_date' => 'date',
        'is_active' => 'boolean',
        'sort_order' => 'integer'
    ];

    protected $dates = ['deleted_at'];

    /**
     * Scope a query to only include active certifications.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to only include valid (non-expired) certifications.
     */
    public function scopeValid($query)
    {
        return $query->where(function ($query) {
            $query->whereNull('expiry_date')
                  ->orWhere('expiry_date', '>', now());
        });
    }

    /**
     * Scope a query to order by sort order.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('issued_date', 'desc');
    }

    /**
     * Get the certificate image URL attribute.
     */
    public function getCertificateImageUrlAttribute()
    {
        return $this->certificate_image ? asset('storage/' . $this->certificate_image) : asset('images/default-certificate.jpg');
    }

    /**
     * Check if certification is expired.
     */
    public function getIsExpiredAttribute()
    {
        return $this->expiry_date && $this->expiry_date->isPast();
    }

    /**
     * Get days until expiry.
     */
    public function getDaysUntilExpiryAttribute()
    {
        if (!$this->expiry_date) {
            return null;
        }

        return now()->diffInDays($this->expiry_date, false);
    }

    /**
     * Get certification status.
     */
    public function getStatusAttribute()
    {
        if (!$this->expiry_date) {
            return 'valid';
        }

        $daysUntilExpiry = $this->days_until_expiry;

        if ($daysUntilExpiry < 0) {
            return 'expired';
        } elseif ($daysUntilExpiry <= 30) {
            return 'expiring_soon';
        } else {
            return 'valid';
        }
    }
}