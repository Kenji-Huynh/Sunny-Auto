<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->command->info('🚀 Bắt đầu seed database...');
        $this->command->info('');
        
        // Seed in order: Users -> Categories -> Products -> Blogs
        // NOTE: Brands are auto-created when creating products (via brand_name field)
        // NOTE: Blog categories are now created via migration (2025_12_18_155350_seed_blog_categories)
        $this->call([
            AdminUserSeeder::class,
            // BrandSeeder::class, // REMOVED: Brands now auto-created from product brand_name
            CategorySeeder::class,
            ProductSeeder::class,
            // BlogCategorySeeder::class, // REMOVED: Categories now seeded via migration
            BlogSeeder::class,
        ]);
        
        $this->command->info('');
        $this->command->info('✅ Hoàn thành seed database!');
        $this->command->info('');
        $this->command->info('📝 Thông tin đăng nhập:');
        $this->command->info('   Email: admin@gmail.com');
        $this->command->info('   Password: 12345678');
    }
}
