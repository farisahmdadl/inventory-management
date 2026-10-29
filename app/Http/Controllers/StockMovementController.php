<?php

namespace App\Http\Controllers;

use App\Models\StockMovement;
use Illuminate\View\View;

class StockMovementController extends Controller
{
    public function index(): View
    {
        // Mengurutkan berdasarkan ID dari yang paling besar (DESC)
        $movements = StockMovement::with('product')
            ->orderByDesc('id')
            ->get();

        return view('stock-movements.index', compact('movements'));
    }
}
