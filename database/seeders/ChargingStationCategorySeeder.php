<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class ChargingStationCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if category already exists
        $existingCategory = Category::where('slug', 'he-thong-tram-sac')->first();

        if (!$existingCategory) {
            Category::create([
                'name' => 'Hệ thống trạm sạc',
                'slug' => 'he-thong-tram-sac',
                'description' => 'Các giải pháp và thiết bị trạm sạc điện cho xe điện, bao gồm trạm sạc nhanh DC, trạm sạc AC và hệ thống quản lý trạm sạc thông minh.',
            ]);

            $this->command->info('✅ Đã thêm category: Hệ thống trạm sạc');
        } else {
            $this->command->info('ℹ️ Category "Hệ thống trạm sạc" đã tồn tại.');
        }
    }
}
