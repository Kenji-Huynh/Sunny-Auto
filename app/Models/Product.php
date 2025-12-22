<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'brand_id',
        'category_id',
        'sku',
        'name',
        'slug',
        'short_description',
        'description',
        'msrp_price',
        'currency',
        'status',
        'is_featured',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'release_date',
        'warranty_years',
        'warranty_km',
    ];

    protected $casts = [
        'msrp_price' => 'decimal:2',
        'release_date' => 'date',
        'is_featured' => 'boolean',
    ];

    /**
     * Get the brand that owns the product
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * Get the category that owns the product
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the EVC specs for the product
     */
    public function evcSpec()
    {
        return $this->hasOne(ProductEvcSpec::class);
    }

    /**
     * Get the physical specs for the product
     */
    public function physicalSpec()
    {
        return $this->hasOne(ProductPhysicalSpec::class);
    }

    /**
     * Get the features for the product
     */
    public function features()
    {
        return $this->hasOne(ProductFeature::class);
    }

    /**
     * Get all media for the product
     */
    public function media()
    {
        return $this->hasMany(Media::class)->orderBy('position');
    }

    /**
     * Get all images for the product
     */
    public function images()
    {
        return $this->hasMany(Media::class)->where('type', 'image')->orderBy('position');
    }

    /**
     * Get the primary image for the product
     */
    public function primaryImage()
    {
        return $this->hasOne(Media::class)->where('type', 'image')->where('is_primary', true);
    }

    /**
     * Scope a query to only include active products
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Get formatted price
     */
    public function getFormattedPriceAttribute()
    {
        return number_format($this->msrp_price, 0, ',', '.') . ' ' . $this->currency;
    }
}
