<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $products = [
            [
                'category_id' => 1, // Electronics
                'name' => 'Wireless Noise-Canceling Headphones',
                'sku' => 100001,
                'stock_quantity' => 45,
                'price' => 199.99,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'category_id' => 2, // Books & Literature
                'name' => 'Clean Code: A Handbook of Agile Software Craftsmanship',
                'sku' => 100002,
                'stock_quantity' => 120,
                'price' => 38.50,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'category_id' => 3, // Home & Kitchen
                'name' => 'Stainless Steel French Press Coffee Maker',
                'sku' => 100003,
                'stock_quantity' => 60,
                'price' => 34.95,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'category_id' => 4, // Fashion & Apparel
                'name' => 'Classic Fit Cotton Crewneck T-Shirt',
                'sku' => 100004,
                'stock_quantity' => 200,
                'price' => 19.99,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'category_id' => 5, // Health & Personal Care
                'name' => 'Daily Hydrating Facial Cleanser 250ml',
                'sku' => 100005,
                'stock_quantity' => 85,
                'price' => 14.50,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'category_id' => 6, // Sports & Outdoors
                'name' => 'Non-Slip Eco Friendly Yoga Mat',
                'sku' => 100006,
                'stock_quantity' => 75,
                'price' => 29.00,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'category_id' => 7, // Toys & Games
                'name' => '1000-Piece Landscape Jigsaw Puzzle',
                'sku' => 100007,
                'stock_quantity' => 50,
                'price' => 22.00,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'category_id' => 8, // Automotive
                'name' => 'Portable Digital Tire Inflator Air Compressor',
                'sku' => 100008,
                'stock_quantity' => 30,
                'price' => 45.99,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'category_id' => 9, // Pet Supplies
                'name' => 'Interactive Feather Wand Cat Toy',
                'sku' => 100009,
                'stock_quantity' => 150,
                'price' => 9.99,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'category_id' => 10, // Groceries & Gourmet Food
                'name' => 'Organic Arabica Whole Bean Coffee 1kg',
                'sku' => 100010,
                'stock_quantity' => 90,
                'price' => 24.75,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        DB::table('products')->insert($products);
    }
}
