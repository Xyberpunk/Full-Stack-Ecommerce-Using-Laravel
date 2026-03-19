<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Panel' }}</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/fonts.css') }}">
    <style>
        body { background: #f2f3f5; }
        .admin-shell { min-height: 100vh; }
        .admin-sidebar {
            background: #171717;
            color: #fff;
            width: 260px;
            min-height: 100vh;
            position: sticky;
            top: 0;
        }
        .admin-sidebar a { color: #ddd; display: block; padding: 12px 16px; border-radius: 10px; text-decoration: none; }
        .admin-sidebar a:hover, .admin-sidebar a.active { background: #b71d1d; color: #fff; }
        .admin-main { flex: 1; padding: 24px; }
        .admin-topbar {
            background: #fff;
            border-radius: 14px;
            padding: 14px 18px;
            margin-bottom: 18px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.05);
        }
        .metric-card {
            background: #fff;
            border-radius: 14px;
            padding: 20px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.05);
            height: 100%;
        }
        .panel-card {
            background: #fff;
            border-radius: 14px;
            padding: 20px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.05);
        }
    </style>
</head>
<body>
<div class="d-flex admin-shell">
    <aside class="admin-sidebar p-3">
        <div class="mb-4">
            <a href="/admin" class="text-white fw-bold fs-4 p-2">Rural Admin</a>
        </div>
        <nav class="d-grid gap-1">
            <a href="/admin" class="{{ request()->is('admin') ? 'active' : '' }}">Dashboard</a>
            <a href="/admin/products" class="{{ request()->is('admin/products*') ? 'active' : '' }}">Products</a>
            <a href="/admin/categories" class="{{ request()->is('admin/categories*') ? 'active' : '' }}">Categories</a>
            <a href="/admin/coupons" class="{{ request()->is('admin/coupons*') ? 'active' : '' }}">Coupons</a>
            <a href="/admin/orders" class="{{ request()->is('admin/orders*') ? 'active' : '' }}">Orders</a>
            <a href="/admin/users" class="{{ request()->is('admin/users*') ? 'active' : '' }}">Users</a>
            <a href="/admin/blog" class="{{ request()->is('admin/blog*') ? 'active' : '' }}">Blog</a>
            <a href="/" target="_blank">View Store</a>
        </nav>
    </aside>
    <main class="admin-main">
        <div class="admin-topbar d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-0">{{ $title ?? 'Admin Panel' }}</h5>
                <small class="text-muted">Logged in as {{ auth()->user()->name }} ({{ auth()->user()->role }})</small>
            </div>
            <form action="/logout" method="POST" class="m-0">
                @csrf
                <button type="submit" class="btn btn-dark">Logout</button>
            </form>
        </div>

        @if(session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>
</div>
</body>
</html>
