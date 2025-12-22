<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Xe tải điện',
                'description' => 'Các loại xe tải điện từ nhỏ đến trung bình, phù hợp cho vận chuyển hàng hóa đô thị và logistics.',
            ],
            [
                'name' => 'Hệ thống trạm sạc',
                'description' => 'Các giải pháp và thiết bị trạm sạc điện cho xe điện, bao gồm trạm sạc nhanh DC, trạm sạc AC và hệ thống quản lý trạm sạc thông minh.',
            ],
        ];

        foreach ($categories as $categoryData) {
            $existing = Category::where('slug', Str::slug($categoryData['name']))->first();
            
            if (!$existing) {
                Category::create([
                    'name' => $categoryData['name'],
                    'slug' => Str::slug($categoryData['name']),
                    'description' => $categoryData['description'],
                    'is_active' => true,
                ]);
                $this->command->info("✅ Đã thêm danh mục: {$categoryData['name']}");
            } else {
                $this->command->info("ℹ️ Danh mục {$categoryData['name']} đã tồn tại.");
            }
        }
    }
}
