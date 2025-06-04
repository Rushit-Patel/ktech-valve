<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inquiry extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'product_id',
        'inquiry_type',
        'name',
        'email',
        'phone',
        'company',
        'subject',
        'message',
        'additional_data',
        'status',
        'admin_notes',
        'contacted_at'
    ];

    protected $casts = [
        'additional_data' => 'array',
        'contacted_at' => 'datetime'
    ];

    protected $dates = ['deleted_at'];

    /**
     * Get the product that the inquiry is about.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Scope a query to filter by status.
     */
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope a query to get new inquiries.
     */
    public function scopeNew($query)
    {
        return $query->where('status', 'new');
    }

    /**
     * Scope a query to get recent inquiries.
     */
    public function scopeRecent($query, $days = 7)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }

    /**
     * Mark inquiry as contacted.
     */
    public function markAsContacted($notes = null)
    {
        $this->update([
            'status' => 'contacted',
            'contacted_at' => now(),
            'admin_notes' => $notes
        ]);
    }

    /**
     * Get the status badge color.
     */
    public function getStatusColorAttribute()
    {
        return match($this->status) {
            'new' => 'bg-blue-100 text-blue-800',
            'contacted' => 'bg-yellow-100 text-yellow-800',
            'quoted' => 'bg-green-100 text-green-800',
            'closed' => 'bg-gray-100 text-gray-800',
            default => 'bg-gray-100 text-gray-800'
        };
    }

    /**
     * Get formatted inquiry type.
     */
    public function getFormattedInquiryTypeAttribute()
    {
        return ucfirst(str_replace('_', ' ', $this->inquiry_type));
    }
}