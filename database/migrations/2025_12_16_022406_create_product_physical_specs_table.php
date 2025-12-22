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
        Schema::create('product_physical_specs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');

            // Kích thước tổng thể (Overall Dimensions)
            $table->unsignedInteger('length_mm')->nullable()->comment('Chiều dài (mm)');
            $table->unsignedInteger('width_mm')->nullable()->comment('Chiều rộng (mm)');
            $table->unsignedInteger('height_mm')->nullable()->comment('Chiều cao (mm)');
            $table->unsignedInteger('wheelbase_mm')->nullable()->comment('Chiều dài cơ sở (mm)');
            $table->unsignedSmallInteger('ground_clearance_mm')->nullable()->comment('Khoảng sáng gầm (mm)');
            $table->decimal('turning_radius_m', 4, 1)->nullable()->comment('Bán kính vòng quay (m)');

            // Trọng lượng (Weight)
            $table->unsignedInteger('curb_weight_kg')->nullable()->comment('Trọng lượng không tải (kg)');
            $table->unsignedInteger('payload_capacity_kg')->nullable()->comment('Tải trọng cho phép (kg)');
            $table->unsignedInteger('gvwr_kg')->nullable()->comment('Tổng trọng lượng toàn tải - GVWR (kg)');

            // Thùng xe (Cargo Box Dimensions)
            $table->unsignedInteger('cargo_length_mm')->nullable()->comment('Chiều dài thùng (mm)');
            $table->unsignedInteger('cargo_width_mm')->nullable()->comment('Chiều rộng thùng (mm)');
            $table->unsignedInteger('cargo_height_mm')->nullable()->comment('Chiều cao thùng (mm)');
            $table->decimal('cargo_volume_m3', 6, 2)->nullable()->comment('Thể tích thùng (m³)');

            // Thông số vận hành (Performance)
            $table->unsignedSmallInteger('max_speed_kmh')->nullable()->comment('Tốc độ tối đa (km/h)');
            $table->decimal('max_grade_percent', 5, 2)->nullable()->comment('Độ dốc leo được (%)');

            // Lốp xe (Tires)
            $table->string('front_tire_size')->nullable()->comment('Kích thước lốp trước');
            $table->string('rear_tire_size')->nullable()->comment('Kích thước lốp sau');

            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->cascadeOnDelete();
            $table->unique('product_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_physical_specs');
    }
};
