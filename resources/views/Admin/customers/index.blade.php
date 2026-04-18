@extends('Admin.layouts.master')
@section('title', 'Customers')

@section('content')

<div class="page-header">
    <div>
        <h1>Customers</h1>
        <p>Browse and manage your registered customers.</p>
    </div>
    <div style="display:flex;gap:10px;">
        <button class="btn btn-outline"><i class="fa-solid fa-arrow-down-to-line"></i> Export</button>
        <button class="btn btn-primary"><i class="fa-solid fa-plus"></i> Add Customer</button>
    </div>
</div>

<!-- Stats -->
<div class="grid grid-4" style="margin-bottom:24px;">
    @foreach([
        ['1,842','Total Customers','var(--text)','fa-users'],
        ['184','New This Month','var(--accent)','fa-user-plus'],
        ['1,204','Active (ordered)','var(--info)','fa-circle-check'],
        ['312','Inactive','var(--muted)','fa-user-slash'],
    ] as $s)
    <div class="stat-card" style="display:flex;align-items:center;gap:14px;">
        <div class="stat-icon" style="background:{{ $s[2] }}22;color:{{ $s[2] }};margin-bottom:0;">
            <i class="fa-solid {{ $s[3] }}"></i>
        </div>
        <div>
            <div class="stat-value" style="font-size:22px;">{{ $s[0] }}</div>
            <div class="stat-label">{{ $s[1] }}</div>
        </div>
    </div>
    @endforeach
</div>

<!-- Filters + Table -->
<div class="card">
    <div style="display:flex;gap:10px;margin-bottom:18px;flex-wrap:wrap;">
        <input type="text" class="form-control" style="width:240px;" placeholder="Search by name, email, phone…">
        <select class="form-control" style="width:160px;">
            <option>All Customers</option>
            <option>Active</option>
            <option>Inactive</option>
            <option>New (this month)</option>
        </select>
        <select class="form-control" style="width:160px;">
            <option>Sort: Newest</option>
            <option>Sort: Oldest</option>
            <option>Most Orders</option>
            <option>Highest Spend</option>
        </select>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th><input type="checkbox"></th>
                    <th>Customer</th>
                    <th>Phone</th>
                    <th>City</th>
                    <th>Orders</th>
                    <th>Total Spent</th>
                    <th>Joined</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach([
                    ['P','Priya Shah','priya@mail.com','+91 98765 43210','Rajkot',14,'₹ 4,820','Jun 2024','Active','badge-green'],
                    ['R','Rahul Mehta','rahul@mail.com','+91 87654 32109','Ahmedabad',8,'₹ 2,110','Aug 2024','Active','badge-green'],
                    ['A','Anita Patel','anita@mail.com','+91 76543 21098','Surat',22,'₹ 7,640','Jan 2024','Active','badge-green'],
                    ['K','Kiran Joshi','kiran@mail.com','+91 65432 10987','Vadodara',3,'₹ 640','Jul 2025','New','badge-blue'],
                    ['D','Deepak Nair','deepak@mail.com','+91 54321 09876','Rajkot',17,'₹ 5,230','Mar 2024','Active','badge-green'],
                    ['M','Meena Rao','meena@mail.com','+91 43210 98765','Gandhinagar',0,'₹ 0','Jul 2025','Inactive','badge-gray'],
                    ['S','Suresh Kumar','suresh@mail.com','+91 32109 87654','Rajkot',6,'₹ 1,840','May 2024','Active','badge-green'],
                ] as $c)
                <tr>
                    <td><input type="checkbox"></td>
                    <td>
                        <div style="display:flex;align-items:center;gap:10px;">
                            <div style="width:34px;height:34px;border-radius:50%;background:linear-gradient(135deg,var(--accent),#1a7a2e);display:flex;align-items:center;justify-content:center;font-weight:700;font-size:13px;flex-shrink:0;">{{ $c[0] }}</div>
                            <div>
                                <div style="font-weight:600;">{{ $c[1] }}</div>
                                <div style="font-size:11px;color:var(--muted);">{{ $c[2] }}</div>
                            </div>
                        </div>
                    </td>
                    <td style="color:var(--muted);font-size:13px;">{{ $c[3] }}</td>
                    <td>{{ $c[4] }}</td>
                    <td style="font-weight:600;">{{ $c[5] }}</td>
                    <td style="font-weight:700;color:var(--accent);">{{ $c[6] }}</td>
                    <td style="color:var(--muted);font-size:12px;">{{ $c[7] }}</td>
                    <td><span class="badge {{ $c[9] }}">{{ $c[8] }}</span></td>
                    <td>
                        <div style="display:flex;gap:6px;">
                            <a href="" class="btn btn-outline btn-sm"><i class="fa-solid fa-eye"></i></a>
                            <button class="btn btn-outline btn-sm"><i class="fa-solid fa-pen"></i></button>
                            <button class="btn btn-danger btn-sm"><i class="fa-solid fa-ban"></i></button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div style="display:flex;align-items:center;justify-content:space-between;padding:16px 0 0;border-top:1px solid var(--border);margin-top:8px;">
        <span style="font-size:13px;color:var(--muted);">Showing 1–7 of 1,842 customers</span>
        <div style="display:flex;gap:4px;">
            @foreach(['‹','1','2','3','...','263','›'] as $p)
            <button class="btn btn-outline btn-sm" style="{{ $p==='1'?'background:var(--accent);color:#0d1117;border-color:var(--accent);':'' }}">{{ $p }}</button>
            @endforeach
        </div>
    </div>
</div>

@endsection
