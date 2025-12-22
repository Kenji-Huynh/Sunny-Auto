<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        // Categories are now created via migration (2025_12_18_155350_seed_blog_categories)
        // Get existing categories
        $aboutCategory = BlogCategory::where('slug', 'about')->first();
        $productsCategory = BlogCategory::where('slug', 'products')->first();
        $technologyCategory = BlogCategory::where('slug', 'technology')->first();
        $solutionsCategory = BlogCategory::where('slug', 'solutions')->first();
        $insightsCategory = BlogCategory::where('slug', 'insights')->first();
        $mediaCategory = BlogCategory::where('slug', 'media')->first();

        // Lấy admin user
        $admin = User::where('email', 'admin@gmail.com')->first();
        
        if (!$admin) {
            echo "Warning: Admin user not found. Please create admin user first.\n";
            return;
        }

        // Tạo sample blog posts (without featured images - will be uploaded manually)
        $posts = [
            [
                'title' => 'The Future of Electric Trucks in Vietnam',
                'slug' => 'future-of-electric-trucks-vietnam',
                'excerpt' => 'Discover how electric trucks are revolutionizing the transportation industry in Vietnam and Southeast Asia.',
                'content' => '<h2>Introduction</h2><p>Electric trucks are transforming logistics and transportation across Vietnam. With zero emissions and significantly lower operating costs, they represent the future of commercial vehicles.</p><h3>Key Benefits</h3><ul><li>Zero emissions - Contributing to cleaner air in cities</li><li>Lower operating costs - Up to 60% savings on fuel</li><li>Government incentives - Tax breaks and subsidies</li><li>Quiet operation - Reducing noise pollution</li></ul><h3>Market Growth</h3><p>At Sunny Auto, we are committed to providing cutting-edge electric truck solutions for businesses of all sizes. The Vietnamese market for electric commercial vehicles is expected to grow by 300% in the next 5 years.</p><p>Our partnerships with leading manufacturers like Weichai and BYD ensure that Vietnamese businesses have access to world-class electric truck technology.</p>',
                'category_id' => $productsCategory?->id ?? 1,
                'status' => 'published',
                'published_at' => now(),
                'views_count' => rand(500, 2000),
                'featured_image' => null
            ],
            [
                'title' => 'Expanding Our Charging Network Nationwide',
                'slug' => 'expanding-charging-network-nationwide',
                'excerpt' => 'Learn about our ambitious plans to install 1000+ charging stations across Vietnam by 2026.',
                'content' => '<h2>Charging Infrastructure Revolution</h2><p>We are proud to announce our ambitious plan to expand our charging infrastructure across the country.</p><h3>Our Goals</h3><p>By 2026, Sunny Auto aims to have over 1000 charging stations operational in major cities and along key transportation routes.</p><h3>Strategic Locations</h3><ul><li>Highway rest stops and service areas</li><li>Urban commercial districts</li><li>Industrial zones and logistics hubs</li><li>Shopping malls and public parking areas</li></ul><h3>Technology</h3><p>Our charging stations feature the latest DC fast charging technology, capable of charging most EVs to 80% in under 30 minutes. We use smart grid integration to optimize energy usage and reduce costs.</p><p>This infrastructure investment is crucial for the widespread adoption of electric vehicles in Vietnam.</p>',
                'category_id' => $solutionsCategory?->id ?? 2,
                'status' => 'published',
                'published_at' => now()->subDays(5),
                'views_count' => rand(800, 1500),
                'featured_image' => null
            ],
            [
                'title' => 'BYD Partnership: Bringing World-Class EVs to Vietnam',
                'slug' => 'byd-partnership-world-class-evs',
                'excerpt' => 'Sunny Auto partners with BYD to bring cutting-edge electric vehicle technology to the Vietnamese market.',
                'content' => '<h2>Strategic Partnership Announcement</h2><p>We are thrilled to announce our strategic partnership with BYD, one of the world\'s leading electric vehicle manufacturers.</p><h3>Why BYD?</h3><p>BYD has been at the forefront of EV technology for over a decade, with innovations in battery technology, electric motors, and vehicle design. Their commitment to quality and innovation aligns perfectly with our mission.</p><h3>Product Range</h3><ul><li>Electric trucks for commercial use</li><li>E-charging stations and infrastructure</li><li>Battery technology and energy storage solutions</li></ul><h3>Local Support</h3><p>Through this partnership, we will provide comprehensive after-sales support, including maintenance, spare parts, and technical training for our customers.</p>',
                'category_id' => $mediaCategory?->id ?? 3,
                'status' => 'published',
                'published_at' => now()->subDays(10),
                'views_count' => rand(600, 1200),
                'featured_image' => null
            ],
            [
                'title' => 'Understanding EV Battery Technology',
                'slug' => 'understanding-ev-battery-technology',
                'excerpt' => 'A comprehensive guide to electric vehicle battery technology, types, and maintenance.',
                'content' => '<h2>EV Battery Basics</h2><p>Electric vehicle batteries are the heart of any EV. Understanding how they work can help you make better decisions about vehicle maintenance and usage.</p><h3>Battery Types</h3><p>Most modern EVs use lithium-ion batteries due to their high energy density and long lifespan. These batteries can typically last 8-10 years or more with proper care.</p><h3>Maintenance Tips</h3><ul><li>Avoid extreme temperatures when possible</li><li>Don\'t let battery charge drop below 20%</li><li>Use regular charging instead of fast charging when not needed</li><li>Park in shade during hot weather</li></ul><h3>Future Developments</h3><p>Battery technology is rapidly evolving, with solid-state batteries promising even greater range and faster charging times in the near future.</p>',
                'category_id' => $technologyCategory?->id ?? 4,
                'status' => 'published',
                'published_at' => now()->subDays(15),
                'views_count' => rand(400, 900),
                'featured_image' => null
            ],
            [
                'title' => 'How EVs Reduce Carbon Footprint',
                'slug' => 'how-evs-reduce-carbon-footprint',
                'excerpt' => 'Exploring the environmental benefits of electric vehicles and their role in combating climate change.',
                'content' => '<h2>Environmental Impact</h2><p>Electric vehicles play a crucial role in reducing greenhouse gas emissions and combating climate change.</p><h3>Zero Direct Emissions</h3><p>Unlike traditional vehicles, EVs produce zero tailpipe emissions. This is particularly important in urban areas where air quality is a major concern.</p><h3>Renewable Energy Integration</h3><p>When charged using renewable energy sources like solar or wind power, EVs become even more environmentally friendly.</p><h3>Lifecycle Analysis</h3><p>Studies show that even when accounting for battery production and electricity generation, EVs have a significantly lower carbon footprint than conventional vehicles over their lifetime.</p>',
                'category_id' => $insightsCategory?->id ?? 5,
                'status' => 'published',
                'published_at' => now()->subDays(20),
                'views_count' => rand(300, 700),
                'featured_image' => null
            ],
            [
                'title' => 'About Sunny Auto: Leading the EV Revolution',
                'slug' => 'about-sunny-auto-ev-revolution',
                'excerpt' => 'Learn about Sunny Auto\'s mission to transform Vietnam\'s transportation landscape.',
                'content' => '<h2>Our Mission</h2><p>Sunny Auto is committed to bringing sustainable transportation solutions to Vietnam.</p>',
                'category_id' => $aboutCategory?->id ?? 6,
                'status' => 'published',
                'published_at' => now()->subDays(25),
                'views_count' => rand(200, 500),
                'featured_image' => null
            ]
        ];

        foreach ($posts as $post) {
            BlogPost::create([
                ...$post,
                'author_id' => $admin->id
            ]);
        }

        $this->command->info("✅ Blog seeder completed successfully!");
        $this->command->info("   - Created " . count($posts) . " blog posts");
        $this->command->info("   📝 Note: Upload blog featured images via admin panel");
    }
}
