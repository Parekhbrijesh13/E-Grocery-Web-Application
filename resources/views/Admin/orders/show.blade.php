@extends('Admin.layouts.master')
@section('title', 'Order #ORD-1042')

@section('content')

<div class="page-header">
    <div style="display:flex;align-items:center;gap:12px;">
        <a href="" class="btn btn-outline btn-sm"><i class="fa-solid fa-arrow-left"></i></a>
        <div>
            <h1>Order #ORD-1042</h1>
            <p>Placed on Jul 18, 2025 · 10:42 AM</p>
        </div>
        <span class="badge badge-green" style="font-size:13px;padding:5px 12px;">Delivered</span>
    </div>
    <div style="display:flex;gap:8px;">
        <button class="btn btn-outline"><i class="fa-solid fa-print"></i> Print Invoice</button>
        <button class="btn btn-primary"><i class="fa-solid fa-pen"></i> Update Status</button>
    </div>
</div>

<div class="grid" style="grid-template-columns:1fr 320px;gap:20px;">
    <!-- Left col -->
    <div style="display:flex;flex-direction:column;gap:18px;">
        <!-- Items -->
        <div class="card">
            <div class="card-header"><span class="card-title">Order Items</span></div>
            <div class="table-wrap">
                <table>
                    <thead><tr><th>Product</th><th>Unit Price</th><th>Qty</th><th>Subtotal</th></tr></thead>
                    <tbody>
                        @foreach([
                            ['🥭','Alphonso Mangoes 1kg','Fruits',120,2,240],
                            ['🥛','Amul Full Cream Milk 1L','Dairy',65,3,195],
                            ['🧄','Garlic 250g','Vegetables',40,1,40],
                            ['🍅','Tomatoes 1kg','Vegetables',55,3,165],
                        ] as $item)
                        <tr>
                            <td>
                                <div style="display:flex;align-items:center;gap:10px;">
                                    <span style="font-size:22px;">{{ $item[0] }}</span>
                                    <div>
                                        <div style="font-weight:500;">{{ $item[1] }}</div>
                                        <div style="font-size:11px;color:var(--muted);">{{ $item[2] }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>₹ {{ $item[3] }}</td>
                            <td>{{ $item[4] }}</td>
                            <td style="font-weight:700;">₹ {{ $item[5] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div style="border-top:1px solid var(--border);padding-top:16px;margin-top:8px;">
                @foreach([['Subtotal','₹ 640'],['Delivery Charge','₹ 0'],['Discount','-₹ 50'],['Total','₹ 590']] as $r)
                <div style="display:flex;justify-content:space-between;padding:5px 16px;font-size:13.5px;{{ $loop->last ? 'font-weight:700;font-size:15px;color:var(--accent);border-top:1px solid var(--border);padding-top:12px;margin-top:6px;' : '' }}">
                    <span>{{ $r[0] }}</span><span>{{ $r[1] }}</span>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Timeline -->
        <div class="card">
            <div class="card-header"><span class="card-title">Order Timeline</span></div>
            @foreach([
                ['Order Placed','Jul 18, 2025 · 10:42 AM','var(--accent)','fa-circle-check'],
                ['Payment Confirmed','Jul 18, 2025 · 10:43 AM','var(--accent)','fa-circle-check'],
                ['Packed & Ready','Jul 18, 2025 · 11:20 AM','var(--accent)','fa-circle-check'],
                ['Out for Delivery','Jul 18, 2025 · 12:05 PM','var(--accent)','fa-circle-check'],
                ['Delivered','Jul 18, 2025 · 1:34 PM','var(--accent)','fa-circle-check'],
            ] as $step)
            <div style="display:flex;gap:14px;padding:0 4px {{ $loop->last ? '0' : '18px' }};">
                <div style="display:flex;flex-direction:column;align-items:center;gap:0;">
                    <div style="width:28px;height:28px;border-radius:50%;background:{{ $step[2] }}22;color:{{ $step[2] }};display:flex;align-items:center;justify-content:center;font-size:12px;flex-shrink:0;">
                        <i class="fa-solid {{ $step[3] }}"></i>
                    </div>
                    @if(!$loop->last)
                    <div style="width:2px;flex:1;background:var(--border);margin:4px 0;min-height:20px;"></div>
                    @endif
                </div>
                <div style="padding-top:4px;">
                    <div style="font-weight:600;font-size:13.5px;">{{ $step[0] }}</div>
                    <div style="font-size:12px;color:var(--muted);">{{ $step[1] }}</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Right col -->
    <div style="display:flex;flex-direction:column;gap:18px;">
        <!-- Customer -->
        <div class="card">
            <div class="card-header"><span class="card-title">Customer</span></div>
            <div style="display:flex;align-items:center;gap:12px;margin-bottom:14px;">
                <div style="width:44px;height:44px;border-radius:50%;background:linear-gradient(135deg,var(--accent),#1a7a2e);display:flex;align-items:center;justify-content:center;font-weight:700;font-size:16px;">P</div>
                <div>
                    <div style="font-weight:700;">Priya Shah</div>
                    <div style="font-size:12px;color:var(--muted);">priya@mail.com</div>
                </div>
            </div>
            <div style="display:flex;flex-direction:column;gap:8px;">
                @foreach([
                    ['fa-phone','📞 +91 98765 43210'],
                    ['fa-location-dot','📍 12 Rose Apt, Race Course Rd, Rajkot 360001'],
                    ['fa-cart-shopping','14 total orders'],
                ] as $info)
                <div style="font-size:12.5px;color:var(--muted);">{{ $info[1] }}</div>
                @endforeach
            </div>
            <a href="" class="btn btn-outline" style="width:100%;justify-content:center;margin-top:14px;">View Profile</a>
        </div>

        <!-- Delivery -->
        <div class="card">
            <div class="card-header"><span class="card-title">Delivery Info</span></div>
            <div style="font-size:13px;line-height:1.7;color:var(--muted);">
                <strong style="color:var(--text);">Priya Shah</strong><br>
                12 Rose Apartment, Race Course Road<br>
                Rajkot, Gujarat – 360001<br>
                <span style="color:var(--accent);">📞 +91 98765 43210</span>
            </div>
        </div>

        <!-- Payment -->
        <div class="card">
            <div class="card-header"><span class="card-title">Payment</span></div>
            <div style="display:flex;flex-direction:column;gap:10px;font-size:13px;">
                <div style="display:flex;justify-content:space-between;">
                    <span style="color:var(--muted);">Method</span>
                    <span class="badge badge-blue">Online (UPI)</span>
                </div>
                <div style="display:flex;justify-content:space-between;">
                    <span style="color:var(--muted);">Status</span>
                    <span class="badge badge-green">Paid</span>
                </div>
                <div style="display:flex;justify-content:space-between;">
                    <span style="color:var(--muted);">Transaction ID</span>
                    <span style="font-family:'Syne',sans-serif;font-size:12px;">TXN#84920312</span>
                </div>
            </div>
        </div>

        <!-- Update Status -->
        <div class="card">
            <div class="card-header"><span class="card-title">Update Status</span></div>
            <div class="form-group">
                <select class="form-control">
                    <option>Pending</option>
                    <option>Processing</option>
                    <option>Packed</option>
                    <option>Out for Delivery</option>
                    <option selected>Delivered</option>
                    <option>Cancelled</option>
                </select>
            </div>
            <button class="btn btn-primary" style="width:100%;justify-content:center;">Save Status</button>
        </div>
    </div>
</div>

@endsection
