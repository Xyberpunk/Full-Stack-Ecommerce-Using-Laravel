@extends('layouts.admin')

@section('content')
    <div class="row g-3">
        <div class="col-lg-8">
            <div class="panel-card">
                <h5 class="mb-3">Order {{ $order->order_number }}</h5>
                <div class="table-responsive">
                    <table class="table">
                        <thead><tr><th>Product</th><th>Qty</th><th>Unit Price</th><th>Line Total</th></tr></thead>
                        <tbody>
                        @forelse($order->items as $item)
                            <tr>
                                <td>{{ $item->product_name }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>${{ number_format((float)$item->unit_price, 2) }}</td>
                                <td>${{ number_format((float)$item->line_total, 2) }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="text-muted">No items on this order.</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="panel-card mt-3">
                <h5 class="mb-3">Status History</h5>
                @forelse($order->statusLogs as $log)
                    <div class="border rounded-3 p-3 mb-3">
                        <div class="d-flex justify-content-between flex-wrap gap-2">
                            <div>
                                <strong>{{ $log->user?->name ?? 'System' }}</strong>
                                <div class="text-muted small">{{ $log->created_at->format('d M Y, h:i A') }}</div>
                            </div>
                            <div class="small text-end">
                                <div>Order: {{ ucfirst($log->from_status ?? 'n/a') }} -> {{ ucfirst($log->to_status ?? 'n/a') }}</div>
                                <div>Payment: {{ ucfirst($log->from_payment_status ?? 'n/a') }} -> {{ ucfirst($log->to_payment_status ?? 'n/a') }}</div>
                            </div>
                        </div>
                        @if($log->note)
                            <div class="mt-2 text-muted">{{ $log->note }}</div>
                        @endif
                    </div>
                @empty
                    <p class="text-muted mb-0">No status updates have been logged for this order yet.</p>
                @endforelse
            </div>
        </div>
        <div class="col-lg-4">
            <div class="panel-card">
                <h5 class="mb-3">Order Settings</h5>
                <p class="mb-1"><strong>Customer:</strong> {{ $order->customer_name }}</p>
                <p class="mb-1"><strong>Phone:</strong> {{ $order->customer_phone ?: '-' }}</p>
                <p class="mb-1"><strong>Email:</strong> {{ $order->customer_email }}</p>
                <p class="mb-1"><strong>Address:</strong> {{ $order->shipping_address ?: '-' }}</p>
                <p class="mb-1"><strong>Payment Method:</strong> {{ $order->payment_method ?: '-' }}</p>
                <p class="mb-1"><strong>Payment Ref:</strong> {{ $order->payment_reference ?: '-' }}</p>
                <p class="mb-1"><strong>Stripe Session:</strong> {{ $order->stripe_session_id ?: '-' }}</p>
                <p class="mb-1"><strong>Tracking Number:</strong> {{ $order->tracking_number ?: '-' }}</p>
                @if($order->cancel_requested_at)
                    <p class="mb-1 text-warning"><strong>Customer Cancel Request:</strong> {{ $order->cancel_requested_at->format('d M Y, h:i A') }}</p>
                @endif
                <p class="mb-1"><strong>Coupon:</strong> {{ $order->coupon_code ?: '-' }}</p>
                <p class="mb-1"><strong>Discount:</strong> ${{ number_format((float) $order->discount, 2) }}</p>
                @if($order->payment_failure_reason)
                    <p class="mb-1 text-danger"><strong>Payment Failure:</strong> {{ $order->payment_failure_reason }}</p>
                @endif
                <p class="mb-3"><strong>Total:</strong> ${{ number_format((float)$order->total, 2) }}</p>
                <form method="POST" action="/admin/orders/{{ $order->id }}" class="d-grid gap-2">
                    @csrf @method('PUT')
                    <label class="form-label mb-0">Order Status</label>
                    <select name="status" class="form-control">
                        @foreach(['pending','processing','shipped','delivered','cancelled','returned'] as $status)
                            <option value="{{ $status }}" @selected($order->status === $status)>{{ ucfirst($status) }}</option>
                        @endforeach
                    </select>
                    <label class="form-label mb-0">Payment Status</label>
                    <select name="payment_status" class="form-control">
                        @foreach(['pending','paid','failed','refunded'] as $status)
                            <option value="{{ $status }}" @selected($order->payment_status === $status)>{{ ucfirst($status) }}</option>
                        @endforeach
                    </select>
                    <label class="form-label mb-0">Tracking Number</label>
                    <input type="text" name="tracking_number" class="form-control" value="{{ old('tracking_number', $order->tracking_number) }}" placeholder="Optional shipment tracking number">
                    <label class="form-label mb-0">Admin Note</label>
                    <textarea name="admin_note" class="form-control" rows="4" placeholder="Optional note for this order update"></textarea>
                    <button class="btn btn-primary">Save changes</button>
                </form>
                @if($order->notes)
                    <hr>
                    <h6 class="mb-2">Customer Note</h6>
                    <p class="text-muted mb-0">{{ $order->notes }}</p>
                @endif
            </div>
        </div>
    </div>
@endsection
