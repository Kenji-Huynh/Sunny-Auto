<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BlogCategory;

class BlogCategorySeeder extends Seeder
{
    /**
     * Run the database seeder.
     * 
     * NOTE: Categories are now created via migration (2025_12_18_155350_seed_blog_categories)
     * This seeder is kept for backward compatibility but should not be used.
     */
    public function run(): void
    {
        $this->command->warn('⚠️  BlogCategorySeeder is deprecated!');
        $this->command->info('   Categories are now seeded via migration: 2025_12_18_155350_seed_blog_categories');
        $this->command->info('   Run: php artisan migrate');
        
        // Check if categories exist
        $count = BlogCategory::count();
        if ($count > 0) {
            $this->command->info("✅ Found $count existing blog categories");
        } else {
            $this->command->error('❌ No blog categories found. Please run migrations!');
        }
    }
}
