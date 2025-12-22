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
        Schema::create('product_features', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');

            // Hệ thống phanh & an toàn (Brakes & Safety)
            $table->string('front_brake_type')->nullable()->comment('Loại phanh trước');
            $table->string('rear_brake_type')->nullable()->comment('Loại phanh sau');
            $table->boolean('abs')->default(false)->comment('Hệ thống ABS');
            $table->boolean('ebd')->default(false)->comment('Hệ thống EBD');
            $table->boolean('esc')->default(false)->comment('Kiểm soát ổn định điện tử');
            $table->unsignedTinyInteger('airbags_count')->default(0)->comment('Số lượng túi khí');
            $table->boolean('reverse_camera')->default(false)->comment('Camera lùi');
            $table->boolean('parking_sensors')->default(false)->comment('Cảm biến đỗ xe');
            $table->boolean('camera_360')->default(false)->comment('Camera 360');
            $table->boolean('blind_spot_monitor')->default(false)->comment('Cảnh báo điểm mù');

            // Tiện nghi & giải trí (Comfort & Entertainment)
            $table->boolean('air_conditioning')->default(false)->comment('Điều hòa');
            $table->string('air_conditioning_type')->nullable()->comment('Loại điều hòa (Manual/Auto)');
            $table->decimal('touchscreen_size_inch', 3, 1)->nullable()->comment('Màn hình cảm ứng (inch)');
            $table->boolean('bluetooth')->default(false)->comment('Kết nối Bluetooth');
            $table->boolean('usb_ports')->default(false)->comment('Cổng USB');
            $table->unsignedTinyInteger('usb_ports_count')->default(0)->comment('Số cổng USB');
            $table->boolean('apple_carplay')->default(false)->comment('Apple CarPlay');
            $table->boolean('android_auto')->default(false)->comment('Android Auto');
            $table->unsignedTinyInteger('speaker_count')->default(0)->comment('Số lối');

            // Ghế ngồi (Seats)
            $table->unsignedTinyInteger('seating_capacity')->default(2)->comment('Số ghế ngồi');
            $table->string('seat_material')->nullable()->comment('Chất liệu ghế (Fabric/Leather)');
            $table->boolean('driver_seat_electric')->default(false)->comment('Ghế lái điện');
            $table->boolean('passenger_seat_electric')->default(false)->comment('Ghế phụ điện');
            $table->boolean('seat_heating')->default(false)->comment('Sưởi ghế');

            // Chiếu sáng (Lighting)
            $table->string('headlight_type')->nullable()->comment('Loại đèn pha (LED/Halogen)');
            $table->boolean('daytime_running_lights')->default(false)->comment('Đèn chạy ban ngày');
            $table->boolean('fog_lights')->default(false)->comment('Đèn sương mù');
            $table->boolean('automatic_headlights')->default(false)->comment('Đèn tự động');

            // Cửa sổ & gương (Windows & Mirrors)
            $table->boolean('power_windows')->default(false)->comment('Cửa sổ điện');
            $table->boolean('power_mirrors')->default(false)->comment('Gương chiếu hậu điện');
            $table->boolean('heated_mirrors')->default(false)->comment('Gương sưởi');

            // Khác (Others)
            $table->boolean('cruise_control')->default(false)->comment('Kiểm soát hành trình');
            $table->boolean('keyless_entry')->default(false)->comment('Mở cửa không chìa khóa');
            $table->boolean('push_start_button')->default(false)->comment('Nút khởi động');
            $table->string('steering_wheel_material')->nullable()->comment('Chất liệu vô lăng');
            $table->boolean('tilt_steering')->default(false)->comment('Vô lăng chỉnh độ cao');
            $table->boolean('telescopic_steering')->default(false)->comment('Vô lăng chỉnh sâu');

            // Ghi chú thêm
            $table->text('other_features')->nullable()->comment('Tính năng khác');

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
        Schema::dropIfExists('product_features');
    }
};
