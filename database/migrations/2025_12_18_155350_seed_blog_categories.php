<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $categories = [
            ['name' => 'About', 'slug' => 'about', 'description' => 'About our company and team'],
            ['name' => 'Products', 'slug' => 'products', 'description' => 'Product news and updates'],
            ['name' => 'Technology', 'slug' => 'technology', 'description' => 'Technology trends and innovations'],
            ['name' => 'Solutions', 'slug' => 'solutions', 'description' => 'Business solutions and case studies'],
            ['name' => 'Insights', 'slug' => 'insights', 'description' => 'Industry insights and analysis'],
            ['name' => 'Media', 'slug' => 'media', 'description' => 'Media coverage and press releases'],
        ];

        foreach ($categories as $category) {
            DB::table('blog_categories')->insertOrIgnore([
                'name' => $category['name'],
                'slug' => $category['slug'],
                'description' => $category['description'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('blog_categories')->whereIn('slug', [
            'about', 'products', 'technology', 'solutions', 'insights', 'media'
        ])->delete();
    }
};
