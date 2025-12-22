<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductPhysicalSpec extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'length_mm',
        'width_mm',
        'height_mm',
        'wheelbase_mm',
        'ground_clearance_mm',
        'turning_radius_m',
        'curb_weight_kg',
        'payload_capacity_kg',
        'gvwr_kg',
        'cargo_length_mm',
        'cargo_width_mm',
        'cargo_height_mm',
        'cargo_volume_m3',
        'max_speed_kmh',
        'max_grade_percent',
        'front_tire_size',
        'rear_tire_size',
    ];

    protected $casts = [
        'turning_radius_m' => 'decimal:1',
        'cargo_volume_m3' => 'decimal:2',
        'max_grade_percent' => 'decimal:2',
    ];

    /**
     * Get the product that owns the spec
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
