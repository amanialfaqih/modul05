<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Amani Bookstore</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        /* ======================
           🔥 MODE ADMIN & USER
        ====================== */

        body.admin-mode {
            background: linear-gradient(135deg, #eef2ff, #f8fafc);
        }

        body.user-mode {
            background: linear-gradient(135deg, #fdf6f0, #f5ebe0);
        }

        /* SIDEBAR */
        .sidebar {
            width: 260px;
            min-height: 100vh;
            padding: 25px;
            border-radius: 0 20px 20px 0;
            box-shadow: 8px 0 30px rgba(0,0,0,0.2);
        }

        /* ADMIN SIDEBAR */
        body.admin-mode .sidebar {
            background: linear-gradient(180deg, #1e1b4b, #0f172a);
            color: white;
        }

        /* USER SIDEBAR (ELEGAN) */
        body.user-mode .sidebar {
            background: linear-gradient(180deg, #5c4033, #3e2c23);
            color: #f3e5d8;
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 15px;
            border-radius: 12px;
            text-decoration: none;
            transition: 0.3s;
            font-weight: 500;
        }

        /* ADMIN MENU */
        body.admin-mode .menu-item {
            color: #cbd5f5;
        }

        /* USER MENU */
        body.user-mode .menu-item {
            color: #f3e5d8;
        }

        .menu-item:hover {
            background: rgba(255,255,255,0.08);
            transform: translateX(6px);
        }

        /* ACTIVE ADMIN */
        body.admin-mode .active-menu {
            background: linear-gradient(90deg, #6366f1, #818cf8);
            color: white !important;
        }

        /* ACTIVE USER */
        body.user-mode .active-menu {
            background: linear-gradient(90deg, #d6a77a, #e6c7a1);
            color: #3e2c23 !important;
        }

        .menu-item .badge {
            font-size: 11px;
            padding: 4px 8px;
            border-radius: 999px;
        }

        /* TOPBAR */
        .topbar {
            backdrop-filter: blur(12px);
            border-radius: 15px;
            padding: 15px 20px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        }

        body.admin-mode .topbar {
            background: rgba(255,255,255,0.6);
        }

        body.user-mode .topbar {
            background: rgba(255,248,240,0.8);
        }

        /* CONTENT */
        .content-box {
            border-radius: 18px;
            padding: 25px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        }

        body.admin-mode .content-box {
            background: rgba(255,255,255,0.9);
        }

        body.user-mode .content-box {
            background: #fffaf5;
        }

        /* BUTTON */
        .btn {
            border-radius: 999px !important;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        }

        body.admin-mode .btn-success {
            background: linear-gradient(90deg, #10b981, #34d399);
        }

        body.user-mode .btn-success {
            background: linear-gradient(90deg, #c08a5d, #e0b084);
        }

        .btn-primary {
            background: linear-gradient(90deg, #6366f1, #818cf8);
            border: none;
        }

        .btn-danger {
            background: linear-gradient(90deg, #ef4444, #f87171);
            border: none;
        }

        .btn-warning {
            background: linear-gradient(90deg, #f59e0b, #fbbf24);
            border: none;
        }

        /* CARD */
        .card {
            border-radius: 18px;
            border: none;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }

        body.user-mode .card {
            background: #fffaf5;
        }

        .card img {
            transition: transform 0.4s ease;
        }

        .card:hover img {
            transform: scale(1.08);
        }

        /* TABLE */
        .table tbody tr:hover {
            background: #eef2ff;
        }

        /* PAGINATION */
        .pagination .page-link {
            border-radius: 10px;
            margin: 0 3px;
            color: #6366f1;
        }

        .pagination .active .page-link {
            background: #6366f1;
            color: white;
            border: none;
        }

        /* INPUT */
        .form-control, .form-select {
            border: 1px solid #e5e7eb;
            border-radius: 12px;
        }

        .form-control:focus, .form-select:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99,102,241,0.15);
        }

        .alert {
            border-radius: 12px;
        }
    </style>
</head>

<body class="{{ auth()->user()->role === 'admin' ? 'admin-mode' : 'user-mode' }}">

<div class="d-flex">

    {{-- SIDEBAR --}}
    <div class="sidebar d-flex flex-column">

        <h4 class="text-center fw-bold mb-4">📚 Amani</h4>

        {{-- 🔥 PROFILE SIDEBAR --}}
<div class="text-center mb-3">

    {{-- FOTO --}}
    @if(auth()->user()->photo)
        <img src="{{ asset('images/profile/'.auth()->user()->photo) }}"
             class="rounded-circle shadow mb-2"
             width="65" height="65"
             style="object-fit:cover;">
    @else
        <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}"
             class="rounded-circle shadow mb-2"
             width="65" height="65">
    @endif

    {{-- TEXT --}}
    <div class="fw-semibold">
        Halo, {{ auth()->user()->role === 'admin' ? 'Admin' : auth()->user()->name }} 👋
    </div>

</div>

        {{-- DASHBOARD --}}
        <a href="{{ route('home') }}" 
           class="menu-item {{ request()->routeIs('home') ? 'active-menu' : '' }}">
           🏠 Dashboard
        </a>

        {{-- ADMIN --}}
        @if(auth()->user()->role === 'admin')
        <a href="{{ route('settings') }}" 
   class="menu-item {{ request()->routeIs('settings') ? 'active-menu' : '' }}">
   ⚙️ Pengaturan
</a>

            <a href="{{ route('books.index') }}" 
               class="menu-item {{ request()->routeIs('books.*') ? 'active-menu' : '' }}">
               📘 Data Buku
            </a>

            <a href="{{ route('categories.index') }}" 
               class="menu-item {{ request()->routeIs('categories.*') ? 'active-menu' : '' }}">
               📂 Kategori
            </a>

        @endif

        {{-- USER --}}
        @if(auth()->user()->role === 'user')

            <a href="{{ route('shop') }}" 
               class="menu-item {{ request()->routeIs('shop') ? 'active-menu' : '' }}">
               🛍️ Shop
            </a>

            <a href="{{ route('cart') }}" 
               class="menu-item d-flex justify-content-between {{ request()->routeIs('cart') ? 'active-menu' : '' }}">
               
                <span>🛒 Keranjang</span>

                @if(session('cart') && count(session('cart')) > 0)
                    <span class="badge bg-danger">
                        {{ count(session('cart')) }}
                    </span>
                @endif
            </a>

        @endif

        {{-- USER INFO --}}
        <div class="mt-auto text-center">
            <hr>
            <small>{{ auth()->user()->name ?? 'User' }}</small>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn btn-danger w-100 mt-2">Logout</button>
            </form>
        </div>

    </div>

    {{-- CONTENT --}}
    <div class="flex-grow-1 p-4">

        <div class="topbar mb-4 d-flex justify-content-between">
            <h5 class="fw-semibold m-0">Amani Bookstore</h5>
            <div>👤 {{ auth()->user()->name ?? 'User' }}</div>
        </div>

        <div class="content-box">
            @yield('content')
        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>