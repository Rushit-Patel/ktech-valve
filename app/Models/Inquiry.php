<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;    protected $fillable = [
        'name',
        'email',
        'phone',
        'company',
        'subject',
        'message',
        'product_id',
        'status',
        'priority',
        'source',
        'metadata',
        'admin_notes',
        'responded_at'
    ];

    protected $casts = [
        'responded_at' => 'datetime',
        'metadata' => 'array'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeNew($query)
    {
        return $query->where('status', 'new');
    }

    public function markAsResponded()
    {
        $this->update([
            'status' => 'in_progress',
            'responded_at' => now()
        ]);
    }
}
