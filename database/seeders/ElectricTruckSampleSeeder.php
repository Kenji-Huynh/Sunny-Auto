<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ElectricTruckSampleSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        // Brand
        $brandId = DB::table('brands')->insertGetId([
            'name' => 'WEICHAI',
            'slug' => Str::slug('WEICHAI'),
            'country' => null,
            'description' => null,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        // Category
        $categoryId = DB::table('categories')->insertGetId([
            'name' => 'Electric Truck',
            'slug' => Str::slug('Electric Truck'),
            'is_active' => true,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        // Product
        $productId = DB::table('products')->insertGetId([
            'brand_id' => $brandId,
            'category_id' => $categoryId,
            'sku' => null,
            'name' => 'Sample Electric Truck',
            'slug' => Str::slug('Sample Electric Truck'),
            'short_description' => 'Electric light-duty truck by WEICHAI',
            'description' => null,
            'msrp_price' => 1111111111,
            'currency' => 'VND',
            'status' => 'active',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        // EV Specs
        DB::table('product_evc_specs')->insert([
            'product_id' => $productId,
            'range_km' => 180,
            'dc_fast_charging_supported' => true,
            'charge_10_80_min' => 60,
            'onboard_charger_kw' => 7.00,
            'charge_description' => 'DC fast charging supported (approx. 10–80% in ~60 minutes, 7 kW OBC)',
            'power_kw' => 105.00,
            'torque_nm' => 300,
            'zero_to_100_kmh' => null,
            'zero_to_100_note' => 'N/A (light-duty truck; not specified)',
            'drivetrain' => 'RWD',
            'drivetrain_description' => 'Rear-wheel drive (single motor)',
            'battery_capacity_kwh' => 66.84,
            'battery_type' => 'lithium-ion',
            'battery_supplier' => 'Ningde',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }
}
