@extends('Admin.layouts.master')
@section('title', 'Inventory')

@section('content')

    <div class="page-header">
        <div>
            <h1>Inventory</h1>
            <p>Track grocery stock, restocks, damaged items, expiry waste, and low-stock alerts.</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
            <i class="fa-solid fa-plus"></i> Add Product
        </a>
    </div>

    <div class="grid grid-4" style="margin-bottom:18px;">
        <div class="card">
            <div style="font-size:12px;color:var(--muted);margin-bottom:8px;">Total Products</div>
            <div style="font-size:26px;font-weight:800;">{{ $stats['total_products'] }}</div>
        </div>
        <div class="card">
            <div style="font-size:12px;color:var(--muted);margin-bottom:8px;">In Stock</div>
            <div style="font-size:26px;font-weight:800;color:var(--accent);">{{ $stats['in_stock'] }}</div>
        </div>
        <div class="card">
            <div style="font-size:12px;color:var(--muted);margin-bottom:8px;">Low Stock</div>
            <div style="font-size:26px;font-weight:800;color:var(--warn);">{{ $stats['low_stock'] }}</div>
        </div>
        <div class="card">
            <div style="font-size:12px;color:var(--muted);margin-bottom:8px;">Stock Value</div>
            <div style="font-size:26px;font-weight:800;">Rs. {{ number_format((float) $stats['stock_value'], 2) }}</div>
        </div>
    </div>

    <form method="GET" action="{{ route('admin.inventory.index') }}"
        style="display:flex;gap:10px;margin-bottom:18px;flex-wrap:wrap;">
        <input type="text" name="search" value="{{ request('search') }}" class="form-control" style="width:240px;"
            placeholder="Search product or SKU...">

        <select name="category_id" class="form-control" style="width:190px;">
            <option value="">All Categories</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected((string) request('category_id') === (string) $category->id)>
                    {{ $category->category_name }}
                </option>
            @endforeach
        </select>

        <select name="stock_status" class="form-control" style="width:170px;">
            <option value="">All Stock</option>
            <option value="in_stock" @selected(request('stock_status') === 'in_stock')>In Stock</option>
            <option value="low_stock" @selected(request('stock_status') === 'low_stock')>Low Stock</option>
            <option value="out_of_stock" @selected(request('stock_status') === 'out_of_stock')>Out of Stock</option>
        </select>

        <button type="submit" class="btn btn-primary btn-sm"><i class="fa-solid fa-filter"></i> Filter</button>
        <a href="{{ route('admin.inventory.index') }}" class="btn btn-outline btn-sm">Clear</a>
    </form>

    <div class="grid" style="grid-template-columns:1fr 360px;gap:20px;align-items:start;">
        <div class="card">
            <div class="card-header">
                <span class="card-title">Stock Control</span>
                <span style="font-size:13px;color:var(--muted);">{{ $products->total() }} items</span>
            </div>

            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Category</th>
                            <th>Current Stock</th>
                            <th>Alert</th>
                            <th>Status</th>
                            <th>Action</th>
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
                                            <img src="{{ asset('storage/' . $product->product_img) }}"
                                                alt="{{ $product->product_name }}"
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
                                                {{ $product->sku ?: $unitValue . ' ' . $product->unit }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-gray">
                                        {{ optional($product->category)->category_name ?? 'No Category' }}
                                    </span>
                                </td>
                                <td style="{{ $product->stock <= 0 ? 'color:var(--danger);font-weight:700;' : 'font-weight:700;' }}">
                                    {{ $product->stock }} {{ $product->unit }}
                                </td>
                                <td>{{ $product->low_stock_threshold }} {{ $product->unit }}</td>
                                <td><span class="badge {{ $stockBadge['class'] }}">{{ $stockBadge['label'] }}</span></td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#adjustInventory{{ $product->id }}">
                                        <i class="fa-solid fa-warehouse"></i> Adjust
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" style="text-align:center;color:var(--muted);padding:28px;">
                                    No inventory items found.
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
                        Showing {{ $products->firstItem() }}-{{ $products->lastItem() }} of {{ $products->total() }} items
                    @else
                        Showing 0 items
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

        <div class="card">
            <div class="card-header"><span class="card-title">Recent Movements</span></div>

            <div style="display:flex;flex-direction:column;gap:12px;">
                @forelse ($movements as $movement)
                    <div style="padding-bottom:12px;border-bottom:1px solid var(--border);">
                        <div style="display:flex;align-items:center;justify-content:space-between;gap:10px;">
                            <div style="font-weight:600;font-size:13px;">
                                {{ optional($movement->product)->product_name ?? 'Deleted product' }}
                            </div>
                            <span class="badge {{ $movement->badge_class }}">
                                {{ $movement->quantity_delta > 0 ? '+' : '' }}{{ $movement->quantity_delta }}
                            </span>
                        </div>
                        <div style="font-size:12px;color:var(--muted);margin-top:4px;">
                            {{ $movement->type_label }}: {{ $movement->quantity_before }} to {{ $movement->quantity_after }}
                        </div>
                        @if ($movement->reason || $movement->reference_no)
                            <div style="font-size:12px;color:var(--muted);margin-top:4px;">
                                {{ $movement->reason }}
                                @if ($movement->reference_no)
                                    #{{ $movement->reference_no }}
                                @endif
                            </div>
                        @endif
                        <div style="font-size:11px;color:var(--muted);margin-top:4px;">
                            {{ $movement->created_at->format('d M Y, h:i A') }}
                        </div>
                    </div>
                @empty
                    <div style="font-size:13px;color:var(--muted);">No stock movements yet.</div>
                @endforelse
            </div>
        </div>
    </div>

    @foreach ($products as $product)
        <div class="modal fade" id="adjustInventory{{ $product->id }}" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" style="background: var(--surface); border: 1px solid var(--border);">
                    <form action="{{ route('admin.inventory.adjust', $product) }}" method="POST">
                        @csrf

                        <div class="modal-header" style="border-bottom: 1px solid rgba(48, 54, 61, .5);">
                            <h5 class="modal-title"
                                style="font-family: 'Syne', sans-serif; font-size: 16px; font-weight: 700;">
                                Adjust Inventory
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body" style="padding:20px;">
                            <div style="margin-bottom:14px;">
                                <div style="font-weight:700;">{{ $product->product_name }}</div>
                                <div style="font-size:12px;color:var(--muted);">
                                    Current stock: {{ $product->stock }} {{ $product->unit }}
                                </div>
                            </div>

                            <div class="grid grid-2">
                                <div class="form-group">
                                    <label class="form-label">Adjustment Type *</label>
                                    <select name="type" class="form-control" required>
                                        <option value="restock">Restock / Purchase</option>
                                        <option value="return">Customer Return</option>
                                        <option value="reduce">Stock Out</option>
                                        <option value="damage">Damaged Item</option>
                                        <option value="expired">Expired Item</option>
                                        <option value="set">Set Exact Stock</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Quantity *</label>
                                    <input type="number" min="0" name="quantity" class="form-control" required>
                                </div>
                            </div>

                            <div class="grid grid-2">
                                <div class="form-group">
                                    <label class="form-label">Low Stock Alert</label>
                                    <input type="number" min="0" name="low_stock_threshold"
                                        value="{{ $product->low_stock_threshold }}" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Reference No.</label>
                                    <input type="text" name="reference_no" class="form-control"
                                        placeholder="Bill, PO, return ID">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Reason</label>
                                <input type="text" name="reason" class="form-control"
                                    placeholder="Fresh purchase, wastage, audit correction">
                            </div>

                            <div class="form-group">
                                <label class="form-label">Notes</label>
                                <textarea name="notes" class="form-control" rows="2" placeholder="Optional notes"></textarea>
                            </div>
                        </div>

                        <div class="modal-footer" style="border-top: 1px solid rgba(48, 54, 61, .5); padding: 12px 20px;">
                            <button type="button" class="btn btn-outline" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save Adjustment</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

@endsection
