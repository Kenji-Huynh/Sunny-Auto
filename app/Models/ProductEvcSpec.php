<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductEvcSpec extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'range_km',
        'range_test_standard',
        'zero_to_100_kmh',
        'zero_to_100_note',
        'drivetrain',
        'drivetrain_description',
        'power_kw',
        'torque_nm',
        'battery_capacity_kwh',
        'battery_type',
        'battery_supplier',
        'dc_fast_charging_supported',
        'charging_connector_type',
        'charge_10_80_min',
        'onboard_charger_kw',
        'charge_description',
        'fast_charge_min_percent',
        'fast_charge_max_percent',
    ];

    protected $casts = [
        'dc_fast_charging_supported' => 'boolean',
        // All other spec fields are now strings (no decimal cast needed)
    ];

    /**
     * Get the product that owns the spec
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
