@extends('Admin.layouts.master')
@section('title', 'Products')

@section('content')

    <div class="page-header">
        <div>
            <h1>Products</h1>
            <p>Manage your product catalogue.</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Add Product</a>
    </div>

    <form method="GET" action="{{ route('admin.products.index') }}"
        style="display:flex;gap:10px;margin-bottom:18px;flex-wrap:wrap;">
        <input type="text" name="search" value="{{ request('search') }}" class="form-control" style="width:240px;"
            placeholder="Search products...">

        <select name="category_id" class="form-control" style="width:190px;">
            <option value="">All Categories</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected((string) request('category_id') === (string) $category->id)>
                    {{ $category->category_name }}
                </option>
            @endforeach
        </select>

        <select name="status" class="form-control" style="width:160px;">
            <option value="">All Status</option>
            <option value="active" @selected(request('status') === 'active')>Active</option>
            <option value="draft" @selected(request('status') === 'draft')>Draft</option>
            <option value="inactive" @selected(request('status') === 'inactive')>Inactive</option>
            <option value="low_stock" @selected(request('status') === 'low_stock')>Low Stock</option>
            <option value="out_of_stock" @selected(request('status') === 'out_of_stock')>Out of Stock</option>
        </select>

        <button type="submit" class="btn btn-primary btn-sm"><i class="fa-solid fa-filter"></i> Filter</button>
        <a href="{{ route('admin.products.index') }}" class="btn btn-outline btn-sm">Clear</a>
    </form>

    <div class="card">
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Unit</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        @php
                            $stockBadge = $product->stock_badge;
                            $unitValue = rtrim(rtrim(number_format((float) $product->unit_value, 2, '.', ''), '0'), '.');
                        @endphp
                        <tr>
                            <td>
                                <div style="display:flex;align-items:center;gap:10px;">
                                    @if ($product->product_img)
                                        <img src="{{ asset('storage/' . $product->product_img) }}" alt="{{ $product->product_name }}"
                                            style="width:42px;height:42px;border-radius:8px;object-fit:cover;border:1px solid var(--border);">
                                    @else
                                        <span
                                            style="width:42px;height:42px;border-radius:8px;background:var(--surface2);display:inline-flex;align-items:center;justify-content:center;color:var(--muted);border:1px solid var(--border);">
                                            <i class="fa-solid fa-box-open"></i>
                                        </span>
                                    @endif
                                    <div>
                                        <div style="font-weight:600;">{{ $product->product_name }}</div>
                                        <div style="font-size:12px;color:var(--muted);">
                                            {{ $product->sku ?: $product->slug }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge badge-gray">
                                    {{ optional($product->category)->category_name ?? 'No Category' }}
                                </span>
                            </td>
                            <td>
                                <div style="font-weight:700;">Rs. {{ number_format((float) $product->price, 2) }}</div>
                                @if ((float) $product->mrp > (float) $product->price)
                                    <div style="font-size:12px;color:var(--muted);">
                                        <s>Rs. {{ number_format((float) $product->mrp, 2) }}</s>
                                    </div>
                                @endif
                            </td>
                            <td style="{{ $product->stock <= 0 ? 'color:var(--danger);font-weight:600;' : '' }}">
                                {{ $product->stock }}
                            </td>
                            <td>{{ $unitValue }} {{ $product->unit }}</td>
                            <td><span class="badge {{ $stockBadge['class'] }}">{{ $stockBadge['label'] }}</span></td>
                            <td>
                                <div style="display:flex;gap:6px;">
                                    <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-outline btn-sm">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>
                                    <form action="{{ route('admin.products.delete', $product) }}" method="POST"
                                        onsubmit="return confirm('Delete this product?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align:center;color:var(--muted);padding:28px;">
                                No products found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div
            style="display:flex;align-items:center;justify-content:space-between;padding:16px 0 0;border-top:1px solid var(--border);margin-top:8px;gap:12px;flex-wrap:wrap;">
            <span style="font-size:13px;color:var(--muted);">
                @if ($products->count())
                    Showing {{ $products->firstItem() }}-{{ $products->lastItem() }} of {{ $products->total() }} products
                @else
                    Showing 0 products
                @endif
            </span>

            @if ($products->hasPages())
                <div style="display:flex;gap:4px;align-items:center;">
                    @if ($products->onFirstPage())
                        <button class="btn btn-outline btn-sm" disabled>Prev</button>
                    @else
                        <a href="{{ $products->previousPageUrl() }}" class="btn btn-outline btn-sm">Prev</a>
                    @endif

                    <span style="font-size:13px;color:var(--muted);padding:0 8px;">
                        Page {{ $products->currentPage() }} of {{ $products->lastPage() }}
                    </span>

                    @if ($products->hasMorePages())
                        <a href="{{ $products->nextPageUrl() }}" class="btn btn-outline btn-sm">Next</a>
                    @else
                        <button class="btn btn-outline btn-sm" disabled>Next</button>
                    @endif
                </div>
            @endif
        </div>
    </div>

@endsection
