@extends('Admin.layouts.master')
@section('title', 'Offers & Coupons')

@section('content')

<div class="page-header">
    <div>
        <h1>Offers & Promotions</h1>
        <p>Create and manage discount offers for your store.</p>
    </div>
    <a href="" class="btn btn-primary"><i class="fa-solid fa-plus"></i> New Offer</a>
</div>

<!-- Stats Row -->
<div class="grid grid-3" style="margin-bottom:24px;">
    <div class="stat-card" style="display:flex;align-items:center;gap:16px;padding:16px 20px;">
        <div class="stat-icon" style="background:rgba(63,185,80,.12);color:var(--accent);margin-bottom:0;">
            <i class="fa-solid fa-circle-check"></i>
        </div>
        <div>
            <div class="stat-value" style="font-size:22px;">3</div>
            <div class="stat-label">Active Offers</div>
        </div>
    </div>
    <div class="stat-card" style="display:flex;align-items:center;gap:16px;padding:16px 20px;">
        <div class="stat-icon" style="background:rgba(240,136,62,.12);color:var(--warn);margin-bottom:0;">
            <i class="fa-solid fa-clock"></i>
        </div>
        <div>
            <div class="stat-value" style="font-size:22px;">1</div>
            <div class="stat-label">Expiring Soon</div>
        </div>
    </div>
    <div class="stat-card" style="display:flex;align-items:center;gap:16px;padding:16px 20px;">
        <div class="stat-icon" style="background:rgba(88,166,255,.12);color:var(--info);margin-bottom:0;">
            <i class="fa-solid fa-chart-line"></i>
        </div>
        <div>
            <div class="stat-value" style="font-size:22px;">₹ 4,280</div>
            <div class="stat-label">Discount Given This Month</div>
        </div>
    </div>
</div>

<!-- Offer Cards -->
<div class="grid grid-3" style="margin-bottom:28px;">
    @foreach([
        ['Summer Fresh','🌿','20% off all Fruits & Vegetables','Jul 1 – Jul 31, 2025','342 uses','Active','var(--accent)','badge-green'],
        ['Weekend Special','🧀','Buy 2 Get 1 Free on Dairy','Jul 19 – Jul 21, 2025','87 uses','Active','var(--info)','badge-blue'],
        ['New User Offer','🎁','Flat ₹50 off on first order','Ongoing','204 uses','Active','var(--warn)','badge-orange'],
        ['Monsoon Sale','🌧️','15% off Beverages','Jun 1 – Jun 30, 2025','521 uses','Expired','var(--muted)','badge-gray'],
        ['Flash Friday','⚡','10% off entire cart','Jun 7, 2025','93 uses','Expired','var(--muted)','badge-gray'],
        ['Diwali Bonanza','🪔','25% off premium groceries','Oct 20 – Oct 25, 2025','0 uses','Scheduled','#a371f7','badge-blue'],
    ] as $offer)
    <div class="card" style="position:relative;overflow:hidden;">
        <div style="position:absolute;top:0;left:0;right:0;height:3px;background:{{ $offer[6] }};"></div>
        <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:12px;">
            <span style="font-size:28px;">{{ $offer[1] }}</span>
            <span class="badge {{ $offer[7] }}">{{ $offer[5] }}</span>
        </div>
        <div style="font-family:'Syne',sans-serif;font-weight:700;font-size:15px;margin-bottom:5px;">{{ $offer[0] }}</div>
        <div style="font-size:13px;color:var(--muted);margin-bottom:12px;">{{ $offer[2] }}</div>
        <div style="font-size:12px;display:flex;flex-direction:column;gap:5px;margin-bottom:14px;">
            <div style="display:flex;justify-content:space-between;">
                <span style="color:var(--muted);">Validity</span>
                <span>{{ $offer[3] }}</span>
            </div>
            <div style="display:flex;justify-content:space-between;">
                <span style="color:var(--muted);">Usage</span>
                <span style="color:{{ $offer[6] }};">{{ $offer[4] }}</span>
            </div>
        </div>
        <div style="display:flex;gap:8px;">
            <button class="btn btn-outline btn-sm" style="flex:1;justify-content:center;"><i class="fa-solid fa-pen"></i> Edit</button>
            @if($offer[5]==='Active')
            <button class="btn btn-warn btn-sm"><i class="fa-solid fa-pause"></i></button>
            @endif
            <button class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
        </div>
    </div>
    @endforeach
</div>

<!-- Coupon Codes Table -->
<div class="card">
    <div class="card-header">
        <span class="card-title">Coupon Codes</span>
        <button class="btn btn-outline btn-sm"><i class="fa-solid fa-plus"></i> Add Coupon</button>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Discount</th>
                    <th>Min Order</th>
                    <th>Uses / Limit</th>
                    <th>Expiry</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach([
                    ['FRESH20','20%','₹ 200','48 / 100','Jul 31, 2025','Active','badge-green'],
                    ['SAVE50','₹ 50 flat','₹ 300','204 / ∞','Ongoing','Active','badge-green'],
                    ['DAIRY10','10%','₹ 150','12 / 50','Jul 21, 2025','Active','badge-green'],
                    ['MONSOON15','15%','₹ 250','521 / 500','Jun 30, 2025','Expired','badge-gray'],
                ] as $c)
                <tr>
                    <td>
                        <span style="font-family:'Syne',sans-serif;font-weight:700;background:var(--surface2);padding:4px 10px;border-radius:6px;border:1px solid var(--border);letter-spacing:1px;">{{ $c[0] }}</span>
                    </td>
                    <td style="font-weight:600;color:var(--accent);">{{ $c[1] }}</td>
                    <td>{{ $c[2] }}</td>
                    <td>{{ $c[3] }}</td>
                    <td style="color:var(--muted);">{{ $c[4] }}</td>
                    <td><span class="badge {{ $c[6] }}">{{ $c[5] }}</span></td>
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
</div>

@endsection
