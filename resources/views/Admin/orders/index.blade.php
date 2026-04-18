@extends('Admin.layouts.master')
@section('title', 'Orders')

@section('content')

    <div class="page-header">
        <div>
            <h1>Orders</h1>
            <p>Manage and track all customer orders.</p>
        </div>
        <button class="btn btn-outline"><i class="fa-solid fa-arrow-down-to-line"></i> Export CSV</button>
    </div>

    <!-- Filter Tabs -->
    <div style="display:flex;gap:8px;margin-bottom:20px;flex-wrap:wrap;">
        @foreach (['All (248)', 'Pending (42)', 'Processing (38)', 'Delivered (142)', 'Cancelled (26)'] as $tab)
            <button class="btn {{ $loop->first ? 'btn-primary' : 'btn-outline' }}"
                style="{{ $loop->first ? '' : 'padding:7px 14px;' }}">{{ $tab }}</button>
        @endforeach
        <div style="margin-left:auto;display:flex;gap:8px;">
            <input type="date" class="form-control" style="width:auto;">
            <select class="form-control" style="width:auto;">
                <option>All Payment</option>
                <option>Online</option>
                <option>COD</option>
            </select>
        </div>
    </div>

    <div class="card">
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th><input type="checkbox"></th>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Date</th>
                        <th>Items</th>
                        <th>Total</th>
                        <th>Payment</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ([['#ORD-1042', 'Priya Shah', 'priya@mail.com', 'Jul 18, 2025', 4, '₹ 640', 'Online', 'delivered', 'badge-green'], ['#ORD-1041', 'Rahul Mehta', 'rahul@mail.com', 'Jul 18, 2025', 2, '₹ 210', 'COD', 'processing', 'badge-blue'], ['#ORD-1040', 'Anita Patel', 'anita@mail.com', 'Jul 17, 2025', 6, '₹ 1,120', 'Online', 'pending', 'badge-orange'], ['#ORD-1039', 'Kiran Joshi', 'kiran@mail.com', 'Jul 17, 2025', 1, '₹ 85', 'COD', 'cancelled', 'badge-red'], ['#ORD-1038', 'Deepak Nair', 'deepak@mail.com', 'Jul 16, 2025', 3, '₹ 430', 'Online', 'delivered', 'badge-green'], ['#ORD-1037', 'Meena Rao', 'meena@mail.com', 'Jul 16, 2025', 5, '₹ 890', 'Online', 'delivered', 'badge-green'], ['#ORD-1036', 'Suresh Kumar', 'suresh@mail.com', 'Jul 15, 2025', 2, '₹ 175', 'COD', 'pending', 'badge-orange']] as $o)
                        <tr>
                            <td><input type="checkbox"></td>
                            <td style="font-weight:700;font-family:'Syne',sans-serif;">{{ $o[0] }}</td>
                            <td>
                                <div style="font-weight:500;">{{ $o[1] }}</div>
                                <div style="font-size:11px;color:var(--muted);">{{ $o[2] }}</div>
                            </td>
                            <td style="color:var(--muted);font-size:13px;">{{ $o[3] }}</td>
                            <td>{{ $o[4] }} items</td>
                            <td style="font-weight:700;">{{ $o[5] }}</td>
                            <td>
                                <span
                                    class="badge {{ $o[6] === 'Online' ? 'badge-blue' : 'badge-gray' }}">{{ $o[6] }}</span>
                            </td>
                            <td><span class="badge {{ $o[8] }}">{{ ucfirst($o[7]) }}</span></td>
                            <td>
                                <div style="display:flex;gap:6px;">
                                    <a href="" class="btn btn-outline btn-sm"><i
                                            class="fa-solid fa-eye"></i></a>
                                    <button class="btn btn-outline btn-sm"><i class="fa-solid fa-pen"></i></button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- Pagination -->
        <div
            style="display:flex;align-items:center;justify-content:space-between;padding:16px 0 0;border-top:1px solid var(--border);margin-top:8px;">
            <span style="font-size:13px;color:var(--muted);">Showing 1–7 of 248 orders</span>
            <div style="display:flex;gap:4px;">
                @foreach (['‹', '1', '2', '3', '...', '34', '›'] as $p)
                    <button class="btn btn-outline btn-sm"
                        style="{{ $p === '1' ? 'background:var(--accent);color:#0d1117;border-color:var(--accent);' : '' }}">{{ $p }}</button>
                @endforeach
            </div>
        </div>
    </div>

@endsection
