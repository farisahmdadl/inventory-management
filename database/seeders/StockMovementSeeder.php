<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StockMovementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $stockMovements = [
            [
                'product_id' => 1, // Wireless Noise-Canceling Headphones
                'type' => 'in',
                'quantity' => 50,
                'notes' => 'Initial warehouse stock received from main audio supplier.',
                'user_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'product_id' => 2, // Clean Code Book
                'type' => 'in',
                'quantity' => 100,
                'notes' => 'Bulk restock order for Q4 book promotion.',
                'user_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'product_id' => 3, // Stainless Steel French Press
                'type' => 'out',
                'quantity' => 15,
                'notes' => 'Dispatched for online retail customer orders.',
                'user_id' => 2,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'product_id' => 4, // Classic Fit Cotton Crewneck T-Shirt
                'type' => 'in',
                'quantity' => 200,
                'notes' => 'New seasonal apparel batch arrived at warehouse B.',
                'user_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'product_id' => 5, // Daily Hydrating Facial Cleanser
                'type' => 'out',
                'quantity' => 10,
                'notes' => 'Transferred to retail store branch for display.',
                'user_id' => 3,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'product_id' => 6, // Non-Slip Eco Friendly Yoga Mat
                'type' => 'in',
                'quantity' => 75,
                'notes' => 'Restocked from eco-sports vendor shipment #402.',
                'user_id' => 2,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'product_id' => 7, // 1000-Piece Landscape Jigsaw Puzzle
                'type' => 'out',
                'quantity' => 5,
                'notes' => 'Removed from inventory due to damaged outer packaging.',
                'user_id' => 3,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'product_id' => 8, // Portable Digital Tire Inflator
                'type' => 'in',
                'quantity' => 40,
                'notes' => 'Monthly automotive accessories restock completed.',
                'user_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'product_id' => 9, // Interactive Feather Wand Cat Toy
                'type' => 'out',
                'quantity' => 25,
                'notes' => 'Fulfilled wholesale order for local pet shop.',
                'user_id' => 2,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'product_id' => 10, // Organic Arabica Whole Bean Coffee
                'type' => 'in',
                'quantity' => 90,
                'notes' => 'Freshly roasted batch received and verified by QA.',
                'user_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        DB::table('stock_movements')->insert($stockMovements);
    }
}
