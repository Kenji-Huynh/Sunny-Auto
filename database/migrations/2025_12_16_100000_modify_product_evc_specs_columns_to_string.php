<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('product_evc_specs', function (Blueprint $table) {
            // Thay đổi 6 trường sang string để có thể lưu text tự do
            $table->string('range_km')->nullable()->change();
            $table->string('zero_to_100_kmh')->nullable()->change();
            $table->string('power_kw')->nullable()->change();
            $table->string('battery_capacity_kwh')->nullable()->change();
            $table->text('charge_description')->nullable()->change();
            $table->string('drivetrain')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_evc_specs', function (Blueprint $table) {
            // Khôi phục về kiểu cũ
            $table->unsignedSmallInteger('range_km')->nullable()->change();
            $table->decimal('zero_to_100_kmh', 5, 2)->nullable()->change();
            $table->decimal('power_kw', 8, 2)->nullable()->change();
            $table->decimal('battery_capacity_kwh', 6, 2)->nullable()->change();
            $table->text('charge_description')->nullable()->change();
            $table->string('drivetrain')->nullable()->change();
        });
    }
};
