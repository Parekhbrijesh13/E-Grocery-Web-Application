<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') — FreshCart Admin</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=DM+Sans:wght@300;400;500&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --bg: #0d1117;
            --surface: #161b22;
            --surface2: #1c2330;
            --border: #30363d;
            --accent: #3fb950;
            --accent2: #58d68d;
            --warn: #f0883e;
            --danger: #f85149;
            --info: #58a6ff;
            --text: #e6edf3;
            --muted: #8b949e;
            --sidebar-w: 260px;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'DM Sans', sans-serif !important;
            background: var(--bg) !important;
            color: var(--text) !important;
            display: flex;
            min-height: 100vh;
            font-size: 14px;
        }

        /* ── SIDEBAR ── */
        .sidebar {
            width: var(--sidebar-w);
            background: var(--surface);
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            z-index: 100;
            overflow-y: auto;
        }

        .sidebar-logo {
            padding: 24px 20px 20px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo-icon {
            width: 38px;
            height: 38px;
            background: var(--accent);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .logo-text {
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: 18px;
            letter-spacing: -0.5px;
        }

        .logo-text span {
            color: var(--accent);
        }

        .sidebar-section {
            padding: 20px 12px 8px;
        }

        .sidebar-label {
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            color: var(--muted);
            padding: 0 8px 8px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 12px;
            border-radius: 8px;
            color: var(--muted);
            text-decoration: none;
            font-size: 13.5px;
            font-weight: 500;
            transition: all .15s;
            margin-bottom: 2px;
            position: relative;
        }

        .nav-item i {
            width: 18px;
            text-align: center;
            font-size: 14px;
        }

        .nav-item:hover {
            background: var(--surface2);
            color: var(--text);
        }

        .nav-item.active {
            background: rgba(63, 185, 80, .12);
            color: var(--accent);
        }

        .nav-item.active i {
            color: var(--accent);
        }

        .nav-badge {
            margin-left: auto;
            background: var(--warn);
            color: #fff;
            font-size: 10px;
            font-weight: 700;
            padding: 2px 7px;
            border-radius: 20px;
        }

        .nav-badge.green {
            background: var(--accent);
        }

        .sidebar-footer {
            margin-top: auto;
            padding: 16px 12px;
            border-top: 1px solid var(--border);
        }

        .admin-card {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px;
            border-radius: 8px;
            background: var(--surface2);
        }

        .admin-avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--accent), #1a7a2e);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 13px;
        }

        .admin-name {
            font-size: 13px;
            font-weight: 600;
        }

        .admin-role {
            font-size: 11px;
            color: var(--muted);
        }

        /* ── TOPBAR ── */
        .topbar {
            position: fixed;
            top: 0;
            left: var(--sidebar-w);
            right: 0;
            height: 60px;
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            padding: 0 28px;
            gap: 16px;
            z-index: 99;
        }

        .topbar-title {
            font-family: 'Syne', sans-serif;
            font-size: 17px;
            font-weight: 700;
            flex: 1;
        }

        .topbar-search {
            display: flex;
            align-items: center;
            gap: 8px;
            background: var(--surface2);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 7px 14px;
            width: 240px;
        }

        .topbar-search input {
            background: none;
            border: none;
            outline: none;
            color: var(--text);
            font-size: 13px;
            width: 100%;
            font-family: 'DM Sans', sans-serif;
        }

        .topbar-search input::placeholder {
            color: var(--muted);
        }

        .topbar-search i {
            color: var(--muted);
            font-size: 13px;
        }

        .topbar-btn {
            width: 36px;
            height: 36px;
            background: var(--surface2);
            border: 1px solid var(--border);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--muted);
            cursor: pointer;
            transition: all .15s;
            position: relative;
        }

        .topbar-btn:hover {
            border-color: var(--accent);
            color: var(--accent);
        }

        .notif-dot {
            position: absolute;
            top: 7px;
            right: 7px;
            width: 7px;
            height: 7px;
            background: var(--warn);
            border-radius: 50%;
            border: 2px solid var(--surface);
        }

        /* ── MAIN ── */
        .main {
            margin-left: var(--sidebar-w);
            padding-top: 60px;
            flex: 1;
            min-height: 100vh;
        }

        .content {
            padding: 28px;
        }

        /* ── CARDS ── */
        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 20px;
        }

        .card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 18px;
        }

        .card-title {
            font-family: 'Syne', sans-serif;
            font-size: 15px;
            font-weight: 700;
        }

        /* ── BUTTONS ── */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            font-family: 'DM Sans', sans-serif;
            cursor: pointer;
            border: none;
            transition: all .15s;
            text-decoration: none;
        }

        .btn-primary {
            background: var(--accent);
            color: #0d1117;
        }

        .btn-primary:hover {
            background: var(--accent2);
        }

        .btn-outline {
            background: transparent;
            color: var(--text);
            border: 1px solid var(--border);
        }

        .btn-outline:hover {
            border-color: var(--accent);
            color: var(--accent);
        }

        .btn-danger {
            background: rgba(248, 81, 73, .15);
            color: var(--danger);
            border: 1px solid rgba(248, 81, 73, .3);
        }

        .btn-warn {
            background: rgba(240, 136, 62, .15);
            color: var(--warn);
            border: 1px solid rgba(240, 136, 62, .3);
        }

        .btn-sm {
            padding: 5px 11px;
            font-size: 12px;
        }

        /* ── TABLE ── */
        .table-wrap {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: .8px;
            text-transform: uppercase;
            color: var(--muted);
            padding: 10px 16px;
            border-bottom: 1px solid var(--border);
        }

        td {
            padding: 13px 16px;
            border-bottom: 1px solid rgba(48, 54, 61, .5);
            font-size: 13.5px;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover td {
            background: rgba(255, 255, 255, .025);
        }

        /* ── BADGE ── */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 3px 9px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
        }

        .badge-green {
            background: rgba(63, 185, 80, .15);
            color: var(--accent);
        }

        .badge-orange {
            background: rgba(240, 136, 62, .15);
            color: var(--warn);
        }

        .badge-red {
            background: rgba(248, 81, 73, .15);
            color: var(--danger);
        }

        .badge-blue {
            background: rgba(88, 166, 255, .15);
            color: var(--info);
        }

        .badge-gray {
            background: rgba(139, 148, 158, .15);
            color: var(--muted);
        }

        /* ── FORM ── */
        .form-group {
            margin-bottom: 18px;
        }

        .form-label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            color: var(--muted);
            margin-bottom: 7px;
            letter-spacing: .5px;
        }

        .form-control {
            width: 100%;
            background: var(--surface2);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 9px 13px;
            color: var(--text);
            font-size: 13.5px;
            font-family: 'DM Sans', sans-serif;
            outline: none;
            transition: border .15s;
        }

        .form-control:focus {
            border-color: var(--accent);
        }

        .form-control::placeholder {
            color: var(--muted);
        }

        select.form-control {
            cursor: pointer;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 90px;
        }

        /* ── GRID ── */
        .grid {
            display: grid;
            gap: 18px;
        }

        .grid-4 {
            grid-template-columns: repeat(4, 1fr);
        }

        .grid-3 {
            grid-template-columns: repeat(3, 1fr);
        }

        .grid-2 {
            grid-template-columns: repeat(2, 1fr);
        }

        /* ── STAT CARD ── */
        .stat-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 20px;
        }

        .stat-icon {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 17px;
            margin-bottom: 14px;
        }

        .stat-value {
            font-family: 'Syne', sans-serif;
            font-size: 26px;
            font-weight: 800;
        }

        .stat-label {
            font-size: 12px;
            color: var(--muted);
            margin-top: 3px;
        }

        .stat-change {
            font-size: 12px;
            margin-top: 8px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .stat-change.up {
            color: var(--accent);
        }

        .stat-change.down {
            color: var(--danger);
        }

        /* ── PAGE HEADER ── */
        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
        }

        .page-header h1 {
            font-family: 'Syne', sans-serif;
            font-size: 22px;
            font-weight: 800;
        }

        .page-header p {
            font-size: 13px;
            color: var(--muted);
            margin-top: 3px;
        }

        /* ── FLASH ── */
        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 13px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-success {
            background: rgba(63, 185, 80, .12);
            border: 1px solid rgba(63, 185, 80, .3);
            color: var(--accent);
        }

        .alert-error {
            background: rgba(248, 81, 73, .12);
            border: 1px solid rgba(248, 81, 73, .3);
            color: var(--danger);
        }

        /* scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--border);
            border-radius: 3px;
        }
    </style>

    @stack('styles')
</head>

<body>

    <!-- ── SIDEBAR ── -->
    <aside class="sidebar">
        <div class="sidebar-logo">
            <div class="logo-icon">🛒</div>
            <div class="logo-text">Fresh<span>Cart</span></div>
        </div>

        <div class="sidebar-section">
            <div class="sidebar-label">Main</div>
            <a href="{{ route('admin.dashboard') }}"
                class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-chart-pie"></i> Dashboard
            </a>
            <a href="" class="nav-item {{ request()->routeIs('admin.orders*') ? 'active' : '' }}">
                <i class="fa-solid fa-bag-shopping"></i> Orders
                <span class="nav-badge">12</span>
            </a>
            <a href="" class="nav-item {{ request()->routeIs('admin.customers*') ? 'active' : '' }}">
                <i class="fa-solid fa-users"></i> Customers
            </a>
        </div>

        <div class="sidebar-section">
            <div class="sidebar-label">Catalogue</div>
            <a href="" class="nav-item {{ request()->routeIs('admin.products*') ? 'active' : '' }}">
                <i class="fa-solid fa-box"></i> Products
            </a>
            <a href="" class="nav-item {{ request()->routeIs('admin.categories*') ? 'active' : '' }}">
                <i class="fa-solid fa-tags"></i> Categories
            </a>
            <a href="" class="nav-item {{ request()->routeIs('admin.inventory*') ? 'active' : '' }}">
                <i class="fa-solid fa-warehouse"></i> Inventory
            </a>
        </div>

        <div class="sidebar-section">
            <div class="sidebar-label">Marketing</div>
            <a href="" class="nav-item {{ request()->routeIs('admin.offers*') ? 'active' : '' }}">
                <i class="fa-solid fa-percent"></i> Offers
                <span class="nav-badge green">3</span>
            </a>
            <a href="" class="nav-item {{ request()->routeIs('admin.coupons*') ? 'active' : '' }}">
                <i class="fa-solid fa-ticket"></i> Coupons
            </a>
            <a href="" class="nav-item {{ request()->routeIs('admin.banners*') ? 'active' : '' }}">
                <i class="fa-solid fa-image"></i> Banners
            </a>
        </div>

        <div class="sidebar-section">
            <div class="sidebar-label">Settings</div>
            <a href="}" class="nav-item {{ request()->routeIs('admin.settings*') ? 'active' : '' }}">
                <i class="fa-solid fa-gear"></i> Settings
            </a>
            <a href="" class="nav-item {{ request()->routeIs('admin.reports*') ? 'active' : '' }}">
                <i class="fa-solid fa-chart-bar"></i> Reports
            </a>
        </div>

        <div class="sidebar-footer">
            <div class="admin-card">
                <div class="admin-avatar">A</div>
                <div>
                    <div class="admin-name">Admin User</div>
                    <div class="admin-role">Super Admin</div>
                </div>
                <a href="" style="margin-left:auto;color:var(--muted);font-size:14px;" title="Logout">
                    <i class="fa-solid fa-right-from-bracket"></i>
                </a>
            </div>
        </div>
    </aside>

    <!-- ── TOPBAR ── -->
    <header class="topbar">
        <div class="topbar-title">@yield('title', 'Dashboard')</div>
        <div class="topbar-search">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" placeholder="Search anything…">
        </div>
        <div class="topbar-btn">
            <i class="fa-solid fa-bell"></i>
            <span class="notif-dot"></span>
        </div>
        <div class="topbar-btn">
            <i class="fa-solid fa-circle-half-stroke"></i>
        </div>
    </header>

    <!-- ── MAIN ── -->
    <main class="main">
        <div class="content">
            @if (session('success'))
                <div class="alert alert-success"><i class="fa-solid fa-circle-check"></i> {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-error"><i class="fa-solid fa-circle-xmark"></i> {{ session('error') }}</div>
            @endif

            @yield('content')
        </div>
    </main>

    <!-- Bootstrap JS (with Popper included) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>
