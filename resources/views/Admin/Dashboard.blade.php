@extends('Admin.layouts.master')
@section('title', 'Dashboard')

@section('content')

    <div class="page-header">
        <div>
            <h1>Dashboard</h1>
            <p>Welcome back! Here's what's happening today.</p>
        </div>
        <div style="display:flex;gap:10px;">
            <button class="btn btn-outline"><i class="fa-solid fa-arrow-down-to-line"></i> Export</button>
            <a href="" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Add
                Product</a>
        </div>
    </div>

    <!-- Stats -->
    <div class="grid grid-4" style="margin-bottom:24px;">
        <div class="stat-card">
            <div class="stat-icon" style="background:rgba(63,185,80,.12);color:var(--accent);">
                <i class="fa-solid fa-bag-shopping"></i>
            </div>
            <div class="stat-value">₹ 84,320</div>
            <div class="stat-label">Total Revenue</div>
            <div class="stat-change up"><i class="fa-solid fa-arrow-trend-up"></i> +12.4% from last month</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background:rgba(88,166,255,.12);color:var(--info);">
                <i class="fa-solid fa-cart-shopping"></i>
            </div>
            <div class="stat-value">248</div>
            <div class="stat-label">Orders Today</div>
            <div class="stat-change up"><i class="fa-solid fa-arrow-trend-up"></i> +8 since yesterday</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background:rgba(240,136,62,.12);color:var(--warn);">
                <i class="fa-solid fa-users"></i>
            </div>
            <div class="stat-value">1,842</div>
            <div class="stat-label">Total Customers</div>
            <div class="stat-change up"><i class="fa-solid fa-arrow-trend-up"></i> +34 this week</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background:rgba(248,81,73,.12);color:var(--danger);">
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>
            <div class="stat-value">7</div>
            <div class="stat-label">Low Stock Items</div>
            <div class="stat-change down"><i class="fa-solid fa-arrow-trend-down"></i> Needs attention</div>
        </div>
    </div>

    <!-- Recent Orders + Active Offers -->
    <div class="grid" style="grid-template-columns:1fr 360px;gap:20px;margin-bottom:24px;">
        <div class="card">
            <div class="card-header">
                <span class="card-title">Recent Orders</span>
                <a href="" class="btn btn-outline btn-sm">View All</a>
            </div>
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Items</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ([['#ORD-1042', 'Priya Shah', 4, '₹ 640', 'delivered', 'badge-green'], ['#ORD-1041', 'Rahul Mehta', 2, '₹ 210', 'processing', 'badge-blue'], ['#ORD-1040', 'Anita Patel', 6, '₹ 1,120', 'pending', 'badge-orange'], ['#ORD-1039', 'Kiran Joshi', 1, '₹ 85', 'cancelled', 'badge-red'], ['#ORD-1038', 'Deepak Nair', 3, '₹ 430', 'delivered', 'badge-green']] as $order)
                            <tr>
                                <td style="font-weight:600;font-family:'Syne',sans-serif;">{{ $order[0] }}</td>
                                <td>{{ $order[1] }}</td>
                                <td>{{ $order[2] }} items</td>
                                <td style="font-weight:600;">{{ $order[3] }}</td>
                                <td><span class="badge {{ $order[5] }}">{{ ucfirst($order[4]) }}</span></td>
                                <td>
                                    <a href="#" class="btn btn-outline btn-sm"><i class="fa-solid fa-eye"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Active Offers -->
        <div class="card">
            <div class="card-header">
                <span class="card-title">Active Offers</span>
                <a href="" class="btn btn-outline btn-sm">Manage</a>
            </div>
            <div style="display:flex;flex-direction:column;gap:10px;">
                @foreach ([['Summer Fresh', '20% off Fruits & Veggies', '#3fb950', 'fa-leaf', 'Jul 31'], ['Weekend Deal', 'Buy 2 Get 1 on Dairy', '#58a6ff', 'fa-droplet', 'Jul 21'], ['New User', 'Flat ₹50 off first order', '#f0883e', 'fa-user-plus', 'Ongoing']] as $offer)
                    <div
                        style="display:flex;align-items:center;gap:14px;padding:13px;background:var(--surface2);border-radius:10px;border:1px solid var(--border);">
                        <div
                            style="width:38px;height:38px;border-radius:9px;background:{{ $offer[2] }}22;display:flex;align-items:center;justify-content:center;color:{{ $offer[2] }};font-size:15px;flex-shrink:0;">
                            <i class="fa-solid {{ $offer[3] }}"></i>
                        </div>
                        <div style="flex:1;min-width:0;">
                            <div style="font-weight:700;font-size:13px;font-family:'Syne',sans-serif;">{{ $offer[0] }}
                            </div>
                            <div style="font-size:12px;color:var(--muted);margin-top:2px;">{{ $offer[1] }}</div>
                        </div>
                        <div style="font-size:11px;color:var(--muted);white-space:nowrap;">Ends {{ $offer[4] }}</div>
                    </div>
                @endforeach
                <a href="" class="btn btn-outline"
                    style="justify-content:center;margin-top:4px;">
                    <i class="fa-solid fa-plus"></i> New Offer
                </a>
            </div>
        </div>
    </div>

    <!-- Low Stock + Top Categories -->
    <div class="grid grid-2">
        <div class="card">
            <div class="card-header">
                <span class="card-title">⚠️ Low Stock Alert</span>
                <a href="{{ route('admin.inventory.index') }}" class="btn btn-outline btn-sm">Inventory</a>
            </div>
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Category</th>
                            <th>Stock</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ([['Alphonso Mangoes', 'Fruits', 3], ['Amul Butter 500g', 'Dairy', 5], ['Toor Dal 1kg', 'Grains', 2]] as $item)
                            <tr>
                                <td style="font-weight:500;">{{ $item[0] }}</td>
                                <td><span class="badge badge-gray">{{ $item[1] }}</span></td>
                                <td><span class="badge badge-red">{{ $item[2] }} left</span></td>
                                <td><a href="{{ route('admin.inventory.index', ['stock_status' => 'low_stock']) }}" class="btn btn-warn btn-sm">Restock</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <span class="card-title">Top Categories</span>
            </div>
            @foreach ([['Fruits & Vegetables', 68, 'var(--accent)'], ['Dairy & Eggs', 52, 'var(--info)'], ['Grains & Pulses', 41, 'var(--warn)'], ['Snacks & Beverages', 35, '#a371f7'], ['Personal Care', 18, 'var(--danger)']] as $cat)
                <div style="margin-bottom:14px;">
                    <div style="display:flex;justify-content:space-between;font-size:12.5px;margin-bottom:5px;">
                        <span style="font-weight:500;">{{ $cat[0] }}</span>
                        <span style="color:var(--muted);">{{ $cat[1] }} orders</span>
                    </div>
                    <div style="height:6px;background:var(--surface2);border-radius:3px;overflow:hidden;">
                        <div
                            style="height:100%;width:{{ round(($cat[1] / 68) * 100) }}%;background:{{ $cat[2] }};border-radius:3px;">
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
