<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $categories = [
            ['name' => 'Electronics', 'description' => 'Gadgets, smartphones, and laptops.', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Books & Literature', 'description' => 'Fiction, non-fiction, and textbooks.', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Home & Kitchen', 'description' => 'Cookware, furniture, and home decor.', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Fashion & Apparel', 'description' => 'Clothing, footwear, and accessories.', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Health & Personal Care', 'description' => 'Skincare, vitamins, supplements, grooming essentials, and daily hygiene products.', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Sports & Outdoors', 'description' => 'Fitness gear and camping equipment.', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Toys & Games', 'description' => 'Board games, puzzles, and educational toys.', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Automotive', 'description' => 'Car parts, tools, and accessories.', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Pet Supplies', 'description' => 'Pet food, treats, toys, grooming tools, and accessories for dogs, cats, and small animals.', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Groceries & Gourmet Food', 'description' => 'Pantry staples, snacks, and beverages.', 'created_at' => $now, 'updated_at' => $now],
        ];

        DB::table('categories')->insert($categories);
    }
}
