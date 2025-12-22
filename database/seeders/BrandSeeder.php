<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * NOTE: This seeder is DEPRECATED!
     * Brands are now auto-created when adding products via brand_name field.
     * See ProductController::store() for automatic brand creation logic.
     */
    public function run(): void
    {
        $this->command->warn('⚠️  BrandSeeder is deprecated!');
        $this->command->info('   Brands are now auto-created when you add products.');
        $this->command->info('   Enter brand name in product form → Brand created automatically.');
        $this->command->info('   See: ProductController::store() for details.');
    }
}
