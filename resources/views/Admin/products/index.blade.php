@extends('Admin.layouts.master')
@section('title', 'Products')

@section('content')

<div class="page-header">
    <div>
        <h1>Products</h1>
        <p>Manage your product catalogue.</p>
    </div>
    <a href="" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Add Product</a>
</div>

<!-- Filters -->
<div style="display:flex;gap:10px;margin-bottom:18px;flex-wrap:wrap;">
    <input type="text" class="form-control" style="width:240px;" placeholder="Search products…">
    <select class="form-control" style="width:180px;">
        <option>All Categories</option>
        <option>Fruits & Vegetables</option>
        <option>Dairy & Eggs</option>
        <option>Grains & Pulses</option>
        <option>Snacks</option>
    </select>
    <select class="form-control" style="width:150px;">
        <option>All Status</option>
        <option>Active</option>
        <option>Out of Stock</option>
        <option>Draft</option>
    </select>
    <div style="margin-left:auto;display:flex;gap:8px;">
        <button class="btn btn-outline btn-sm" title="Grid View"><i class="fa-solid fa-grip"></i></button>
        <button class="btn btn-primary btn-sm" title="List View"><i class="fa-solid fa-list"></i></button>
    </div>
</div>

<div class="card">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th><input type="checkbox"></th>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Sales</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach([
                    ['🥭','Alphonso Mangoes 1kg','Fruits & Vegetables','₹ 120','48 kg','234','Active','badge-green'],
                    ['🥛','Amul Full Cream Milk 1L','Dairy & Eggs','₹ 65','200 L','891','Active','badge-green'],
                    ['🍅','Tomatoes 1kg','Fruits & Vegetables','₹ 55','92 kg','412','Active','badge-green'],
                    ['🌾','Toor Dal 1kg','Grains & Pulses','₹ 130','2 kg','128','Low Stock','badge-orange'],
                    ['🧄','Garlic 250g','Fruits & Vegetables','₹ 40','0','56','Out of Stock','badge-red'],
                    ['🥚','Farm Eggs (6 pcs)','Dairy & Eggs','₹ 72','140 pcs','302','Active','badge-green'],
                    ['🧴','Dove Shampoo 200ml','Personal Care','₹ 185','38 pcs','74','Active','badge-green'],
                    ['🍪','Parle-G Biscuits 800g','Snacks','₹ 45','250 pcs','612','Active','badge-green'],
                ] as $p)
                <tr>
                    <td><input type="checkbox"></td>
                    <td>
                        <div style="display:flex;align-items:center;gap:10px;">
                            <span style="font-size:24px;">{{ $p[0] }}</span>
                            <div style="font-weight:500;">{{ $p[1] }}</div>
                        </div>
                    </td>
                    <td><span class="badge badge-gray">{{ $p[2] }}</span></td>
                    <td style="font-weight:700;">{{ $p[3] }}</td>
                    <td style="{{ $p[4]==='0'?'color:var(--danger);font-weight:600;':'' }}">{{ $p[4] }}</td>
                    <td style="color:var(--muted);">{{ $p[5] }}</td>
                    <td><span class="badge {{ $p[7] }}">{{ $p[6] }}</span></td>
                    <td>
                        <div style="display:flex;gap:6px;">
                            <button class="btn btn-outline btn-sm"><i class="fa-solid fa-pen"></i></button>
                            <button class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div style="display:flex;align-items:center;justify-content:space-between;padding:16px 0 0;border-top:1px solid var(--border);margin-top:8px;">
        <span style="font-size:13px;color:var(--muted);">Showing 1–8 of 460 products</span>
        <div style="display:flex;gap:4px;">
            @foreach(['‹','1','2','3','...','58','›'] as $p)
            <button class="btn btn-outline btn-sm" style="{{ $p==='1'?'background:var(--accent);color:#0d1117;border-color:var(--accent);':'' }}">{{ $p }}</button>
            @endforeach
        </div>
    </div>
</div>

@endsection
