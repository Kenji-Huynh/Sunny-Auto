<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'type',
        'url',
        'alt_text',
        'position',
        'is_primary',
    ];

    protected $casts = [
        'is_primary' => 'boolean',
    ];

    /**
     * Get the product that owns the media
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Scope a query to only include images
     */
    public function scopeImages($query)
    {
        return $query->where('type', 'image');
    }

    /**
     * Scope a query to only include videos
     */
    public function scopeVideos($query)
    {
        return $query->where('type', 'video');
    }

    /**
     * Scope a query to only include primary media
     */
    public function scopePrimary($query)
    {
        return $query->where('is_primary', true);
    }
}
