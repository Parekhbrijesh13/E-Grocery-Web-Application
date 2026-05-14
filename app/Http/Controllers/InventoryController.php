<?php

namespace App\Http\Controllers;

use App\Http\Requests\InventoryAdjustmentRequest;
use App\Models\Category;
use App\Models\InventoryMovement;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::orderBy('category_name')->get();

        $products = Product::with('category')
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->search;

                $query->where(function ($query) use ($search) {
                    $query->where('product_name', 'like', "%{$search}%")
                        ->orWhere('sku', 'like', "%{$search}%")
                        ->orWhere('slug', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('category_id'), function ($query) use ($request) {
                $query->where('category_id', $request->category_id);
            })
            ->when($request->filled('stock_status'), function ($query) use ($request) {
                match ($request->stock_status) {
                    'in_stock' => $query->whereColumn('stock', '>', 'low_stock_threshold'),
                    'low_stock' => $query->where('stock', '>', 0)->whereColumn('stock', '<=', 'low_stock_threshold'),
                    'out_of_stock' => $query->where('stock', '<=', 0),
                    default => null,
                };
            })
            ->orderBy('stock')
            ->paginate(12)
            ->withQueryString();

        $stats = [
            'total_products' => Product::count(),
            'in_stock' => Product::whereColumn('stock', '>', 'low_stock_threshold')->count(),
            'low_stock' => Product::where('stock', '>', 0)->whereColumn('stock', '<=', 'low_stock_threshold')->count(),
            'out_of_stock' => Product::where('stock', '<=', 0)->count(),
            'stock_value' => Product::selectRaw('SUM(stock * COALESCE(cost_price, price, 0)) as total')->value('total') ?? 0,
        ];

        $movements = InventoryMovement::with('product')
            ->latest()
            ->limit(12)
            ->get();

        return view('Admin.inventory.index', compact('products', 'categories', 'stats', 'movements'));
    }

    public function adjust(InventoryAdjustmentRequest $request, Product $product)
    {
        $validated = $request->validated();

        $result = DB::transaction(function () use ($validated, $product) {
            $product = Product::lockForUpdate()->findOrFail($product->id);
            $before = (int) $product->stock;
            $quantity = (int) $validated['quantity'];

            $after = match ($validated['type']) {
                'restock', 'return' => $before + $quantity,
                'reduce', 'damage', 'expired' => $before - $quantity,
                'set' => $quantity,
            };

            if ($after < 0) {
                return ['error' => 'Stock cannot go below zero.'];
            }

            $product->stock = $after;

            if (array_key_exists('low_stock_threshold', $validated) && $validated['low_stock_threshold'] !== null) {
                $product->low_stock_threshold = (int) $validated['low_stock_threshold'];
            }

            $product->save();

            InventoryMovement::create([
                'product_id' => $product->id,
                'type' => $validated['type'],
                'quantity_delta' => $after - $before,
                'quantity_before' => $before,
                'quantity_after' => $after,
                'reason' => $validated['reason'] ?? null,
                'reference_no' => $validated['reference_no'] ?? null,
                'notes' => $validated['notes'] ?? null,
            ]);

            return ['success' => 'Inventory updated successfully!'];
        });

        if (isset($result['error'])) {
            return back()
                ->withInput()
                ->with('error', $result['error']);
        }

        return redirect()
            ->route('admin.inventory.index')
            ->with('success', $result['success']);
    }
}
