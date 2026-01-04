<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class LegacyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 0. Create Admin User
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@evara.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);
        
        // 0.1 Create Regular User (optional, for convenience)
        User::create([
            'name' => 'Test Customer',
            'email' => 'user@evara.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        // 1. Create Categories
        $categories = [
            'Pen and Pencils' => 'pen-and-pencils',
            'Paints and Colors' => 'paints-and-colors',
            'Markers and Highlighters' => 'markers-and-highlighters',
            'Notebooks and Diaries' => 'notebooks-and-diaries',
            'Cutters and Staplers' => 'cutters-and-staplers',
            'Pouches and Storage' => 'pouches-and-storage',
            'Tote Bags' => 'tote-bags',
            'Shoulder Bags' => 'shoulder-bags',
            'Water Bottles' => 'water-bottles',
            'Tumblers' => 'tumblers',
            'Fans' => 'fans',
            'Sale' => 'sale',
            'New Arrivals' => 'new-arrivals'
        ];

        $catIds = [];
        foreach ($categories as $name => $slug) {
            $cat = Category::create([
                'name' => $name,
                'slug' => $slug,
                'image' => null // Optional
            ]);
            $catIds[$slug] = $cat->id;
        }

        // 2. Create Products
        $products = [
            // Deals
            [
                'name' => 'Premium Paint Marker - set of 12',
                'price' => 2400.00,
                'image' => 'assets/images/MARKER d .webp',
                'category_slug' => 'markers-and-highlighters',
                'is_featured' => true // treat as deal
            ],
            [
                'name' => 'Transparent Pencil Case with Pens Bundle',
                'price' => 2500.00,
                'image' => 'assets/images/kawai d.webp',
                'category_slug' => 'pouches-and-storage',
                'is_featured' => true
            ],
            [
                'name' => 'Panda Pencil Case with Stationery Bundle',
                'price' => 2400.00,
                'image' => 'assets/images/panda d.jpg',
                'category_slug' => 'pouches-and-storage',
                'is_featured' => true
            ],
            [
                'name' => 'Unicorn Diary Deal',
                'price' => 1300.00,
                'image' => 'assets/images/diaryyyy d.webp',
                'category_slug' => 'notebooks-and-diaries',
                'is_featured' => true
            ],

            // Bags
            [
                'name' => 'Three-Color Stripes Contrast Handmade Shoulder Bag',
                'price' => 1800.00,
                'image' => 'assets/images/3 colors B.webp',
                'category_slug' => 'shoulder-bags',
            ],
            [
                'name' => 'Van Gogh Almond Blossoms European Tote Bag',
                'price' => 2500.00,
                'image' => 'assets/images/Blossom b.webp',
                'category_slug' => 'tote-bags',
            ],
            [
                'name' => 'Cities of the World Jute Boxed Tote Bag',
                'price' => 2200.00,
                'image' => 'assets/images/Cities b.webp',
                'category_slug' => 'tote-bags',
            ],
            [
                'name' => 'High Quality Canvas Boxed Tote and Shoulder Bag',
                'price' => 3200.00,
                'image' => 'assets/images/Tote b.webp',
                'category_slug' => 'tote-bags',
            ],

            // Fans
            [
                'name' => 'Doraemon & Lotso Handheld - Portable Fan',
                'price' => 1200.00,
                'image' => 'assets/images/Dora F.webp',
                'category_slug' => 'fans',
            ],
             [
                'name' => 'Rechargeable Handheld Mini Fan',
                'price' => 1600.00,
                'image' => 'assets/images/Sanrio.webp', // Assuming this image exists from legacy copy
                'category_slug' => 'fans',
            ],
             [
                'name' => 'Avengers Super Heroes Handheld - Portable Fan',
                'price' => 950.00,
                'image' => 'assets/images/Avenger F.webp',
                'category_slug' => 'fans',
            ],
             [
                'name' => 'Rechargeable Clip-on Fan',
                'price' => 1500.00,
                'image' => 'assets/images/Pur F.webp',
                'category_slug' => 'fans',
            ],

            // Stationery
            [
                'name' => 'Color Art Glitter Dual - Highlighter',
                'price' => 450.00,
                'image' => 'assets/images/High .webp',
                'category_slug' => 'markers-and-highlighters',
            ],
             [
                'name' => 'Metallic Colors - Gel Pen Set Of 6 / 12',
                'price' => 300.00,
                'image' => 'assets/images/Glitter S.webp',
                'category_slug' => 'pen-and-pencils',
            ],
             [
                'name' => 'DL Kawai Girl - Scissor',
                'price' => 650.00,
                'image' => 'assets/images/Scissors S.webp',
                'category_slug' => 'cutters-and-staplers',
            ],
             [
                'name' => 'Sanrio Characters Popsicle - Magic Eraser and Sharpener Set',
                'price' => 350.00,
                'image' => 'assets/images/erasers S.webp',
                'category_slug' => 'pen-and-pencils',
            ],
        ];

        foreach ($products as $p) {
            Product::create([
                'name' => $p['name'],
                'slug' => Str::slug($p['name']),
                'price' => $p['price'],
                'image' => $p['image'],
                'description' => 'High quality ' . $p['name'] . ' for your daily needs.',
                'stock' => 10,
                'category_id' => $catIds[$p['category_slug']] ?? null,
                'is_active' => true,
                'is_featured' => $p['is_featured'] ?? false
            ]);
        }
    }
}
