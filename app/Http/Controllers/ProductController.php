<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::with('category')->orderByDesc('id')->get();
        $categories = Category::orderBy('name')->get();

        return view('products.index', compact('products', 'categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:64',
            'sku' => 'required|integer|unique:products,sku',
            'category_id' => 'required|integer',
            'stock_quantity' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
        ]);

        DB::transaction(function () use ($validated) {
            $product = Product::create($validated);

            // Jika stok awal lebih dari 0, catat otomatis ke log stock_movements
            if ($product->stock_quantity > 0) {
                StockMovement::create([
                    'product_id' => $product->id,
                    'type' => 'in',
                    'quantity' => $product->stock_quantity,
                    'notes' => 'Initial stock for new product',
                    'user_id' => Auth::id() ?? 1,
                ]);
            }
        });

        return back()->with('success', "Product '{$validated['name']}' has been added successfully.");
    }

    public function adjustStock(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'type' => 'required|in:in,out',
            'quantity' => 'required|integer|min:1',
            'notes' => 'nullable|string|max:255',
        ]);

        if ($validated['type'] === 'out' && $product->stock_quantity < $validated['quantity']) {
            return back()->with('error', "Failed! Stock {$product->name} is insufficient (Remaining: {$product->stock_quantity}).");
        }

        DB::transaction(function () use ($validated, $product) {
            if ($validated['type'] === 'in') {
                $product->increment('stock_quantity', $validated['quantity']);
            } else {
                $product->decrement('stock_quantity', $validated['quantity']);
            }

            StockMovement::create([
                'product_id' => $product->id,
                'type' => $validated['type'],
                'quantity' => $validated['quantity'],
                'notes' => $validated['notes'] ?? null,
                'user_id' => Auth::id() ?? 1,
            ]);
        });

        $actionText = $validated['type'] === 'in' ? 'added to' : 'removed from';

        return back()->with('success', "Successfully! {$validated['quantity']} units have been {$actionText} product {$product->name}.");
    }

    public function destroy(Product $product): RedirectResponse
    {
        $productName = $product->name;

        DB::transaction(function () use ($product) {
            // Hapus riwayat pergerakan stok terkait produk ini (opsional/aman untuk foreign key)
            StockMovement::where('product_id', $product->id)->delete();
            $product->delete();
        });

        return back()->with('success', "'{$productName}' has been removed.");
    }
}
