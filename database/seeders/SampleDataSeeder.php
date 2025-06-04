<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\Industry;
use App\Models\Page;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SampleDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Product Categories
        $categories = [
            [
                'name' => 'Butterfly Valves',
                'slug' => 'butterfly-valves',
                'description' => 'High-quality butterfly valves for various industrial applications',
                'meta_title' => 'Butterfly Valves - Industrial Grade | K Tech Valves',
                'meta_description' => 'Explore our range of butterfly valves including electrical, pneumatic, wafer type, and lug type butterfly valves.',
            ],
            [
                'name' => 'Ball Valves',
                'slug' => 'ball-valves',
                'description' => 'Durable ball valves designed for industrial applications',
                'meta_title' => 'Ball Valves - Industrial Grade | K Tech Valves',
                'meta_description' => 'High-quality ball valves including 1-piece, 2-piece, 3-piece and pneumatic operated ball valves.',
            ],
            [
                'name' => 'Check Valves',
                'slug' => 'check-valves',
                'description' => 'Reliable check valves to prevent backflow',
                'meta_title' => 'Check Valves - Prevent Backflow | K Tech Valves',
                'meta_description' => 'Premium check valves including dual plate and wafer type check valves for industrial use.',
            ],
        ];

        foreach ($categories as $index => $categoryData) {
            ProductCategory::create(array_merge($categoryData, ['sort_order' => $index + 1]));
        }

        // Create Industries
        $industries = [
            [
                'name' => 'Oil & Gas',
                'slug' => 'oil-gas',
                'description' => 'Valve solutions for oil and gas industry operations',
            ],
            [
                'name' => 'Chemical Processing',
                'slug' => 'chemical-processing',
                'description' => 'Chemical resistant valves for processing plants',
            ],
            [
                'name' => 'Water Treatment',
                'slug' => 'water-treatment',
                'description' => 'Valves for water and wastewater treatment facilities',
            ],
            [
                'name' => 'Power Generation',
                'slug' => 'power-generation',
                'description' => 'Heavy-duty valves for power plants and utilities',
            ],
            [
                'name' => 'HVAC',
                'slug' => 'hvac',
                'description' => 'Valves for heating, ventilation, and air conditioning systems',
            ],
            [
                'name' => 'Food & Beverage',
                'slug' => 'food-beverage',
                'description' => 'Sanitary valves for food and beverage processing',
            ],
        ];

        foreach ($industries as $industryData) {
            Industry::create($industryData);
        }

        // Create Sample Products
        $butterflyCategory = ProductCategory::where('slug', 'butterfly-valves')->first();
        $ballCategory = ProductCategory::where('slug', 'ball-valves')->first();

        $products = [
            [
                'category_id' => $butterflyCategory->id,
                'name' => 'Electrical Butterfly Valve',
                'slug' => 'electrical-butterfly-valve',
                'short_description' => 'Electric actuated butterfly valve for automated control',
                'description' => 'High-performance electrical butterfly valve with precision control and reliable operation.',
                'is_featured' => true,
                'technical_details' => [
                    'Size Range' => '2" to 48"',
                    'Pressure Rating' => 'PN 10/16',
                    'Temperature Range' => '-20°C to 200°C',
                    'Body Material' => 'Cast Iron, Ductile Iron, Stainless Steel',
                    'Disc Material' => 'Stainless Steel',
                    'Seat Material' => 'EPDM, NBR, Viton',
                ]
            ],
            [
                'category_id' => $butterflyCategory->id,
                'name' => 'Pneumatic Butterfly Valve',
                'slug' => 'pneumatic-butterfly-valve',
                'short_description' => 'Pneumatic actuated butterfly valve for quick operation',
                'description' => 'Reliable pneumatic butterfly valve with fast response time and excellent sealing.',
                'is_featured' => true,
                'technical_details' => [
                    'Size Range' => '2" to 36"',
                    'Pressure Rating' => 'PN 10/16/25',
                    'Operating Pressure' => '4-7 bar',
                    'Body Material' => 'Cast Iron, Ductile Iron',
                    'Actuator Type' => 'Double Acting, Spring Return',
                ]
            ],
            [
                'category_id' => $ballCategory->id,
                'name' => '3 Piece Flange End Ball Valve',
                'slug' => '3-piece-flange-end-ball-valve',
                'short_description' => 'Heavy-duty 3-piece ball valve with flange connections',
                'description' => 'Robust 3-piece ball valve designed for high-pressure applications with easy maintenance.',
                'is_featured' => true,
                'technical_details' => [
                    'Size Range' => '1/2" to 12"',
                    'Pressure Rating' => 'Class 150/300/600',
                    'Temperature Range' => '-29°C to 200°C',
                    'Body Material' => 'Carbon Steel, Stainless Steel',
                    'Ball Material' => 'Stainless Steel',
                    'Seat Material' => 'PTFE, RPTFE',
                ]
            ],
        ];

        foreach ($products as $productData) {
            Product::create($productData);
        }

        // Create Static Pages
        $pages = [
            [
                'title' => 'About Us',
                'slug' => 'about-us',
                'meta_title' => 'About K Tech Valves - Leading Valve Manufacturer',
                'meta_description' => 'Learn about K Tech Valves, a leading manufacturer of industrial valves with years of expertise and commitment to quality.',
                'content' => '<h2>About K Tech Valves</h2><p>K Tech Valves is a leading manufacturer of high-quality industrial valves...</p>',
            ],
            [
                'title' => 'Quality Policy',
                'slug' => 'quality-policy',
                'meta_title' => 'Quality Policy - K Tech Valves',
                'meta_description' => 'Our commitment to quality and excellence in valve manufacturing and customer service.',
                'content' => '<h2>Quality Policy</h2><p>At K Tech Valves, quality is our top priority...</p>',
            ],
        ];

        foreach ($pages as $pageData) {
            Page::create($pageData);
        }
    }
}