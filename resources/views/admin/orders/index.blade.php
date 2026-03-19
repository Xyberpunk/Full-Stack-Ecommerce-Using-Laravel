@extends('layouts.admin')

@section('content')
    <div class="panel-card">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0">Orders</h5>
            <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-dark">Reset Filters</a>
        </div>
        <form method="GET" action="{{ route('admin.orders.index') }}" class="row g-2 mb-4">
            <div class="col-md-5">
                <input type="text" name="q" class="form-control" value="{{ request('q') }}" placeholder="Search order number, customer, or email">
            </div>
            <div class="col-md-3">
                <select name="status" class="form-control">
                    <option value="">All order statuses</option>
                    @foreach(['pending','processing','shipped','delivered','cancelled'] as $status)
                        <option value="{{ $status }}" @selected(request('status') === $status)>{{ ucfirst($status) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select name="payment_status" class="form-control">
                    <option value="">All payment statuses</option>
                    @foreach(['pending','paid','failed','refunded'] as $status)
                        <option value="{{ $status }}" @selected(request('payment_status') === $status)>{{ ucfirst($status) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-1">
                <button class="btn btn-primary w-100">Go</button>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                <tr><th>Order #</th><th>Customer</th><th>Status</th><th>Payment</th><th>Total</th><th>Date</th><th></th></tr>
                </thead>
                <tbody>
                @forelse($orders as $order)
                    <tr>
                        <td>{{ $order->order_number }}</td>
                        <td>{{ $order->customer_name }}<br><small class="text-muted">{{ $order->customer_email }}</small></td>
                        <td><span class="badge text-bg-{{ $order->status === 'delivered' ? 'success' : ($order->status === 'cancelled' ? 'danger' : ($order->status === 'shipped' ? 'info' : ($order->status === 'processing' ? 'warning' : 'secondary'))) }}">{{ ucfirst($order->status) }}</span></td>
                        <td><span class="badge text-bg-{{ $order->payment_status === 'paid' ? 'success' : ($order->payment_status === 'refunded' ? 'warning' : ($order->payment_status === 'failed' ? 'danger' : 'secondary')) }}">{{ ucfirst($order->payment_status) }}</span></td>
                        <td>${{ number_format((float)$order->total, 2) }}</td>
                        <td>{{ $order->created_at->format('d M Y') }}</td>
                        <td><a href="/admin/orders/{{ $order->id }}" class="btn btn-sm btn-outline-dark">View</a></td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="text-muted">No orders found.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        {{ $orders->links() }}
    </div>
@endsection
