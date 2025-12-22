<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'name',
        'company',
        'email',
        'phone',
        'subject',        // Thêm lại subject
        'message',        // Thêm lại message
        'location',
        'inquiry_types',
        'ev_products',
        'ev_products_other',
        'charging_products',
        'charging_products_other',
        'intended_use',
        'intended_use_other',
        'estimated_budget',
        'purchase_timeline',
        'notes',
        'consent_agreed',
        'status',
        'admin_notes',
        'read_at',
    ];

    protected $casts = [
        'inquiry_types' => 'array',
        'ev_products' => 'array',
        'charging_products' => 'array',
        'consent_agreed' => 'boolean',
        'read_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Mark contact as read
     */
    public function markAsRead()
    {
        if (!$this->read_at) {
            $this->update(['read_at' => now()]);
        }
    }

    /**
     * Scope for unread contacts
     */
    public function scopeUnread($query)
    {
        return $query->whereNull('read_at');
    }

    /**
     * Scope for new contacts
     */
    public function scopeNew($query)
    {
        return $query->where('status', 'new');
    }

    /**
     * Get status badge color
     */
    public function getStatusColorAttribute()
    {
        return match($this->status) {
            'new' => 'bg-blue-500',
            'in_progress' => 'bg-yellow-500',
            'resolved' => 'bg-green-500',
            default => 'bg-gray-500',
        };
    }

    /**
     * Get status label
     */
    public function getStatusLabelAttribute()
    {
        return match($this->status) {
            'new' => 'Mới',
            'in_progress' => 'Đang xử lý',
            'resolved' => 'Đã giải quyết',
            default => 'Không xác định',
        };
    }
}
