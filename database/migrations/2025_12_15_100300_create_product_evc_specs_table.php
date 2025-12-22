<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('product_evc_specs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');

            // Range (Range)
            $table->unsignedSmallInteger('range_km')->nullable(); // 180
            $table->string('range_test_standard')->nullable(); // CHTC Driving Range
            
            // Acceleration (0-100 km/h)
            $table->decimal('zero_to_100_kmh', 5, 2)->nullable();
            $table->string('zero_to_100_note')->nullable(); // N/A (light-duty truck; not specified)

            // Drivetrain (Drivetrain)
            $table->string('drivetrain')->nullable(); // RWD
            $table->string('drivetrain_description')->nullable(); // Rear-wheel drive (single motor)

            // Power (Power)
            $table->decimal('power_kw', 8, 2)->nullable(); // 105
            $table->unsignedInteger('torque_nm')->nullable(); // 300

            // Battery (Battery)
            $table->decimal('battery_capacity_kwh', 6, 2)->nullable(); // 66.84
            $table->string('battery_type')->nullable(); // lithium-ion
            $table->string('battery_supplier')->nullable(); // Ningde

            // Charging (Charge)
            $table->boolean('dc_fast_charging_supported')->default(false);
            $table->string('charging_connector_type')->nullable(); // DC
            $table->unsignedSmallInteger('charge_10_80_min')->nullable(); // ~60 minutes
            $table->decimal('onboard_charger_kw', 5, 2)->nullable(); // 7 kW OBC
            $table->text('charge_description')->nullable();
            $table->decimal('fast_charge_min_percent', 5, 2)->nullable(); // 10
            $table->decimal('fast_charge_max_percent', 5, 2)->nullable(); // 80

            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->cascadeOnDelete();
            $table->unique('product_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_evc_specs');
    }
};
