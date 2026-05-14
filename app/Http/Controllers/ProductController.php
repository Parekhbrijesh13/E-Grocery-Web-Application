<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::orderBy('category_name')->get();
        $search = $request->input('search');

        $products = Product::with('category')
            ->when($search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('product_name', 'like', "%{$search}%")
                        ->orWhere('sku', 'like', "%{$search}%")
                        ->orWhere('slug', 'like', "%{$search}%")
                        ->orWhere('tags', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('category_id'), function ($query) use ($request) {
                $query->where('category_id', $request->category_id);
            })
            ->when($request->filled('status'), function ($query) use ($request) {
                if ($request->status === 'out_of_stock') {
                    $query->where('stock', '<=', 0);
                    return;
                }

                if ($request->status === 'low_stock') {
                    $query->where('stock', '>', 0)->whereColumn('stock', '<=', 'low_stock_threshold');
                    return;
                }

                $query->where('status', $request->status);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('Admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::orderBy('category_name')->get();
        $product = new Product([
            'status' => 'active',
            'tax' => 0,
            'stock' => 0,
            'low_stock_threshold' => 10,
            'unit_value' => 1,
            'unit' => 'pcs',
            'featured' => false,
            'cod' => true,
        ]);

        return view('Admin.products.create', [
            'categories' => $categories,
            'product' => $product,
            'isEdit' => false,
        ]);
    }

    public function store(ProductRequest $request)
    {
        $data = $this->validatedProductData($request);
        $images = $this->storeProductImages($request);

        if (!empty($images)) {
            $data['images'] = $images;
            $data['product_img'] = $images[0];
        }

        Product::create($data);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product created successfully!');
    }

    public function edit(Product $product)
    {
        $categories = Category::orderBy('category_name')->get();

        return view('Admin.products.create', [
            'categories' => $categories,
            'product' => $product,
            'isEdit' => true,
        ]);
    }

    public function update(ProductRequest $request, Product $product)
    {
        $data = $this->validatedProductData($request);
        $images = $this->storeProductImages($request);

        if (!empty($images)) {
            $this->deleteProductImages($product);
            $data['images'] = $images;
            $data['product_img'] = $images[0];
        }

        $product->update($data);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product updated successfully!');
    }

    public function delete(Request $request, Product $product)
    {
        $this->deleteProductImages($product);
        $product->delete();

        if ($request->expectsJson()) {
            return response()->json(['status' => 'success', 'message' => 'Product deleted successfully!']);
        }

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product deleted successfully!');
    }

    private function validatedProductData(ProductRequest $request): array
    {
        $data = $request->validated();
        unset($data['images']);

        $data['low_stock_threshold'] = $data['low_stock_threshold'] ?? 10;
        $data['featured'] = $request->boolean('featured');
        $data['cod'] = $request->boolean('cod');

        return $data;
    }

    private function storeProductImages(Request $request): array
    {
        $images = [];

        foreach ($request->file('images', []) as $image) {
            $images[] = $image->store('Product_imgs', 'public');
        }

        return $images;
    }

    private function deleteProductImages(Product $product): void
    {
        $paths = array_filter(array_unique(array_merge($product->images ?? [], [$product->product_img])));

        foreach ($paths as $path) {
            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
        }
    }
}
