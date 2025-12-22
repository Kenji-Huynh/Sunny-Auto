<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductFeature extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'front_brake_type',
        'rear_brake_type',
        'abs',
        'ebd',
        'esc',
        'airbags_count',
        'reverse_camera',
        'parking_sensors',
        'camera_360',
        'blind_spot_monitor',
        'air_conditioning',
        'air_conditioning_type',
        'touchscreen_size_inch',
        'bluetooth',
        'usb_ports',
        'usb_ports_count',
        'apple_carplay',
        'android_auto',
        'speaker_count',
        'seating_capacity',
        'seat_material',
        'driver_seat_electric',
        'passenger_seat_electric',
        'seat_heating',
        'headlight_type',
        'daytime_running_lights',
        'fog_lights',
        'automatic_headlights',
        'power_windows',
        'power_mirrors',
        'heated_mirrors',
        'cruise_control',
        'keyless_entry',
        'push_start_button',
        'steering_wheel_material',
        'tilt_steering',
        'telescopic_steering',
        'other_features',
    ];

    protected $casts = [
        'abs' => 'boolean',
        'ebd' => 'boolean',
        'esc' => 'boolean',
        'reverse_camera' => 'boolean',
        'parking_sensors' => 'boolean',
        'camera_360' => 'boolean',
        'blind_spot_monitor' => 'boolean',
        'air_conditioning' => 'boolean',
        'touchscreen_size_inch' => 'decimal:1',
        'bluetooth' => 'boolean',
        'usb_ports' => 'boolean',
        'apple_carplay' => 'boolean',
        'android_auto' => 'boolean',
        'driver_seat_electric' => 'boolean',
        'passenger_seat_electric' => 'boolean',
        'seat_heating' => 'boolean',
        'daytime_running_lights' => 'boolean',
        'fog_lights' => 'boolean',
        'automatic_headlights' => 'boolean',
        'power_windows' => 'boolean',
        'power_mirrors' => 'boolean',
        'heated_mirrors' => 'boolean',
        'cruise_control' => 'boolean',
        'keyless_entry' => 'boolean',
        'push_start_button' => 'boolean',
        'tilt_steering' => 'boolean',
        'telescopic_steering' => 'boolean',
    ];

    /**
     * Get the product that owns the features
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
