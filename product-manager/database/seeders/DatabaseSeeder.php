<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        User::updateOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
            ]
        );

        // Create sample products
        $products = [
            [
                'name' => 'Wireless Bluetooth Headphones',
                'description' => 'Premium noise-cancelling wireless headphones with 30-hour battery life. Features advanced active noise cancellation, transparency mode, and premium sound quality with deep bass.',
                'price' => 149.99,
                'quantity' => 50,
                'is_active' => true,
            ],
            [
                'name' => 'Smart Fitness Watch',
                'description' => 'Track your health and fitness with GPS, heart rate monitor, sleep tracking, and 7-day battery life. Water resistant to 50 meters with a stunning AMOLED display.',
                'price' => 249.99,
                'quantity' => 35,
                'is_active' => true,
            ],
            [
                'name' => 'Portable Power Bank 20000mAh',
                'description' => 'Ultra-slim portable charger with fast charging support. Features dual USB-C ports and can charge multiple devices simultaneously. Perfect for travel.',
                'price' => 39.99,
                'quantity' => 100,
                'is_active' => true,
            ],
            [
                'name' => 'Mechanical Gaming Keyboard',
                'description' => 'RGB backlit mechanical keyboard with hot-swappable switches, N-key rollover, and programmable macro keys. Built with an aluminum frame for durability.',
                'price' => 89.99,
                'quantity' => 45,
                'is_active' => true,
            ],
            [
                'name' => 'Ultra HD 4K Webcam',
                'description' => 'Professional-grade webcam with auto-focus, built-in ring light, and AI-powered background blur. Perfect for video conferencing and content creation.',
                'price' => 79.99,
                'quantity' => 60,
                'is_active' => true,
            ],
            [
                'name' => 'Ergonomic Office Chair',
                'description' => 'Adjustable lumbar support, breathable mesh back, and 4D armrests. Designed for all-day comfort with a weight capacity of 300 lbs.',
                'price' => 329.99,
                'quantity' => 20,
                'is_active' => true,
            ],
            [
                'name' => 'Smart LED Desk Lamp',
                'description' => 'Touch-controlled LED desk lamp with adjustable color temperature and brightness. Features wireless charging pad and USB port. Eye-care technology reduces strain.',
                'price' => 54.99,
                'quantity' => 75,
                'is_active' => true,
            ],
            [
                'name' => 'Noise Cancelling Earbuds',
                'description' => 'Compact true wireless earbuds with adaptive noise cancellation, spatial audio, and 8-hour battery life per charge. IPX5 water resistant.',
                'price' => 119.99,
                'quantity' => 80,
                'is_active' => false,
            ],
        ];

        foreach ($products as $product) {
            Product::updateOrCreate(
                ['name' => $product['name']],
                $product
            );
        }
    }
}
