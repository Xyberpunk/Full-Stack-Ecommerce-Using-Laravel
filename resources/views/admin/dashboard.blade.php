@extends('layouts.admin')

@section('content')
    <div class="panel-card mb-4">
        <form method="GET" class="row g-3 align-items-end">
            <div class="col-md-3">
                <label class="form-label">Date From</label>
                <input type="date" name="date_from" value="{{ request('date_from') }}" class="form-control">
            </div>
            <div class="col-md-3">
                <label class="form-label">Date To</label>
                <input type="date" name="date_to" value="{{ request('date_to') }}" class="form-control">
            </div>
            <div class="col-md-3">
                <button class="btn btn-primary">Apply Filter</button>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-dark">Reset</a>
            </div>
        </form>
    </div>
    <div class="row g-3 mb-4">
        <div class="col-md-3"><div class="metric-card"><small>Products</small><h3>{{ $stats['total_products'] }}</h3><p class="mb-0 text-muted">Active: {{ $stats['active_products'] }}</p></div></div>
        <div class="col-md-3"><div class="metric-card"><small>Orders</small><h3>{{ $stats['total_orders'] }}</h3><p class="mb-0 text-muted">Pending: {{ $stats['pending_orders'] }}</p><p class="mb-0 text-muted">Processing: {{ $stats['processing_orders'] }}</p><p class="mb-0 text-muted">Delivered: {{ $stats['delivered_orders'] }}</p></div></div>
        <div class="col-md-3"><div class="metric-card"><small>Users</small><h3>{{ $stats['total_users'] }}</h3><p class="mb-0 text-muted">Admins: {{ $stats['admin_users'] }}</p></div></div>
        <div class="col-md-3"><div class="metric-card"><small>Blog Posts</small><h3>{{ $stats['published_posts'] }}</h3><p class="mb-0 text-muted">Published posts</p></div></div>
    </div>
    <div class="row g-3 mb-4">
        <div class="col-md-6"><div class="metric-card"><small>Total Revenue</small><h3>${{ number_format($stats['total_revenue'], 2) }}</h3><p class="mb-0 text-muted">Gross order revenue</p></div></div>
        <div class="col-md-6"><div class="metric-card"><small>Low Stock Alerts</small><h3>{{ $stats['low_stock_products'] }}</h3><p class="mb-0 text-muted">Products at or below threshold</p></div></div>
    </div>
    <div class="row g-3 mb-4">
        <div class="col-md-6"><div class="metric-card"><small>Repeat Customers</small><h3>{{ $repeatCustomerCount }}</h3><p class="mb-0 text-muted">Customers with more than one order</p></div></div>
        <div class="col-md-6"><div class="metric-card"><small>Customer Order Rate</small><h3>{{ number_format($customerOrderRate, 1) }}%</h3><p class="mb-0 text-muted">Users who have placed at least one order</p></div></div>
    </div>

    <div class="row g-3">
        <div class="col-lg-8">
            <div class="panel-card mb-3">
                <h5 class="mb-3">Monthly Revenue</h5>
                @php($maxRevenue = max(1, (float) $monthlyRevenue->max('revenue')))
                @foreach($monthlyRevenue as $point)
                    <div class="mb-3">
                        <div class="d-flex justify-content-between small mb-1">
                            <span>{{ $point['label'] }}</span>
                            <span>${{ number_format($point['revenue'], 2) }}</span>
                        </div>
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar bg-dark" style="width: {{ ($point['revenue'] / $maxRevenue) * 100 }}%"></div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="panel-card">
                <h5 class="mb-3">Recent Orders</h5>
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead><tr><th>Order</th><th>Customer</th><th>Status</th><th>Total</th><th></th></tr></thead>
                        <tbody>
                        @forelse($recentOrders as $order)
                            <tr>
                                <td>{{ $order->order_number }}</td>
                                <td>{{ $order->customer_name }}</td>
                                <td>{{ ucfirst($order->status) }}</td>
                                <td>${{ number_format((float)$order->total, 2) }}</td>
                                <td><a href="/admin/orders/{{ $order->id }}" class="btn btn-sm btn-outline-dark">View</a></td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-muted">No orders yet.</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="panel-card mb-3">
                <h5 class="mb-3">Low Stock Products</h5>
                @forelse($lowStockProducts as $product)
                    <div class="border rounded p-2 mb-2">
                        <strong>{{ $product->name }}</strong>
                        <div class="text-muted small">SKU: {{ $product->sku ?: '-' }}</div>
                        <div class="text-danger small">Stock {{ $product->stock }} / Alert {{ $product->low_stock_threshold }}</div>
                    </div>
                @empty
                    <p class="text-muted mb-0">No low stock alerts.</p>
                @endforelse
            </div>
            <div class="panel-card">
                <h5 class="mb-3">Recent Blog Posts</h5>
                @forelse($recentPosts as $post)
                    <div class="border rounded p-2 mb-2">
                        <strong>{{ $post->title }}</strong>
                        <div class="text-muted small">{{ $post->is_published ? 'Published' : 'Draft' }}</div>
                    </div>
                @empty
                    <p class="text-muted mb-0">No blog posts yet.</p>
                @endforelse
            </div>
        </div>
    </div>
    <div class="row g-3 mt-1">
        <div class="col-lg-4">
            <div class="panel-card">
                <h5 class="mb-3">Top Products</h5>
                @forelse($topProducts as $product)
                    <div class="border rounded p-2 mb-2">
                        <strong>{{ $product->product_name }}</strong>
                        <div class="text-muted small">{{ (int) $product->units_sold }} units sold</div>
                        <div class="small">${{ number_format((float) $product->revenue, 2) }} revenue</div>
                    </div>
                @empty
                    <p class="text-muted mb-0">No product sales yet.</p>
                @endforelse
            </div>
        </div>
        <div class="col-lg-4">
            <div class="panel-card">
                <h5 class="mb-3">Coupon Usage</h5>
                @forelse($couponUsage as $coupon)
                    <div class="border rounded p-2 mb-2">
                        <strong>{{ $coupon->code }}</strong>
                        <div class="text-muted small">{{ $coupon->used_count }} uses</div>
                    </div>
                @empty
                    <p class="text-muted mb-0">No coupon redemptions yet.</p>
                @endforelse
            </div>
        </div>
        <div class="col-lg-4">
            <div class="panel-card">
                <h5 class="mb-3">Recent Customers</h5>
                @forelse($recentCustomers as $customer)
                    <div class="border rounded p-2 mb-2">
                        <strong>{{ $customer->name }}</strong>
                        <div class="text-muted small">{{ $customer->email }}</div>
                    </div>
                @empty
                    <p class="text-muted mb-0">No customers yet.</p>
                @endforelse
            </div>
        </div>
        <div class="col-lg-4">
            <div class="panel-card">
                <h5 class="mb-3">Category Sales</h5>
                @forelse($categorySales as $category)
                    <div class="border rounded p-2 mb-2">
                        <strong>{{ $category->category_name }}</strong>
                        <div class="small">${{ number_format((float) $category->revenue, 2) }} revenue</div>
                    </div>
                @empty
                    <p class="text-muted mb-0">No category sales for this range.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
