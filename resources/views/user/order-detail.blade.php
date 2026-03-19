@extends('layouts.storefront')

@section('body_attributes') class="bg-body" data-bs-spy="scroll" data-bs-target="#navbar" data-bs-root-margin="0px 0px -40%"
  data-bs-smooth-scroll="true" tabindex="0"@endsection

@section('page_title', 'Order Details')

@section('storefront_content')
<section class="py-5">
  <div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <div>
        <h2 class="section-title text-uppercase mb-2">{{ $order->order_number }}</h2>
        <p class="mb-0 text-muted">Invoice {{ $order->invoice_number }} • {{ $order->created_at->format('M d, Y') }}</p>
      </div>
      <a href="{{ route('account.orders') }}" class="btn btn-outline-dark text-uppercase">Back to Orders</a>
    </div>

    <div class="row g-4">
      <div class="col-lg-8">
        <div class="border rounded-4 p-4 bg-white">
          <h4 class="mb-3">Items</h4>
          <div class="table-responsive">
            <table class="table align-middle mb-0">
              <thead><tr><th>Product</th><th>Qty</th><th>Price</th><th>Total</th></tr></thead>
              <tbody>
              @foreach($order->items as $item)
                <tr>
                  <td>{{ $item->product_name }}</td>
                  <td>{{ $item->quantity }}</td>
                  <td>${{ number_format((float) $item->unit_price, 2) }}</td>
                  <td>${{ number_format((float) $item->line_total, 2) }}</td>
                </tr>
              @endforeach
              </tbody>
            </table>
          </div>
        </div>

        <div class="border rounded-4 p-4 bg-white mt-4">
          <h4 class="mb-3">Status Timeline</h4>
          @forelse($order->statusLogs as $log)
            <div class="border rounded-3 p-3 mb-3">
              <div class="d-flex justify-content-between flex-wrap gap-2">
                <strong>{{ $log->user?->name ?? 'System' }}</strong>
                <span class="text-muted small">{{ $log->created_at->format('M d, Y h:i A') }}</span>
              </div>
              <div class="small mt-2">Order: {{ ucfirst($log->from_status ?? 'n/a') }} -> {{ ucfirst($log->to_status ?? 'n/a') }}</div>
              <div class="small">Payment: {{ ucfirst($log->from_payment_status ?? 'n/a') }} -> {{ ucfirst($log->to_payment_status ?? 'n/a') }}</div>
              @if($log->note)
                <div class="text-muted mt-2">{{ $log->note }}</div>
              @endif
            </div>
          @empty
            <p class="text-muted mb-0">No order history updates yet.</p>
          @endforelse
        </div>
      </div>

      <div class="col-lg-4">
        <div class="border rounded-4 p-4 bg-white">
          <h4 class="mb-3">Summary</h4>
          <p class="mb-1"><strong>Status:</strong> <span class="text-capitalize">{{ $order->status }}</span></p>
          <p class="mb-1"><strong>Payment:</strong> <span class="text-capitalize">{{ str_replace('_', ' ', $order->payment_status) }}</span></p>
          <p class="mb-1"><strong>Method:</strong> <span class="text-capitalize">{{ str_replace('_', ' ', $order->payment_method ?? 'n/a') }}</span></p>
          <p class="mb-1"><strong>Shipping:</strong> <span class="text-capitalize">{{ str_replace('_', ' ', $order->shipping_method ?? 'standard') }}</span></p>
          <p class="mb-1"><strong>Tracking:</strong> {{ $order->tracking_number ?: 'Not assigned yet' }}</p>
          @if($order->cancel_requested_at)
            <p class="mb-1 text-warning"><strong>Cancel Request:</strong> Submitted {{ $order->cancel_requested_at->format('M d, Y h:i A') }}</p>
          @endif
          <p class="mb-1"><strong>Address:</strong> {{ $order->shipping_address ?: '-' }}</p>
          <hr>
          <p class="mb-1"><strong>Subtotal:</strong> ${{ number_format((float) $order->subtotal, 2) }}</p>
          <p class="mb-1"><strong>Discount:</strong> ${{ number_format((float) $order->discount, 2) }}</p>
          <p class="mb-1"><strong>Shipping:</strong> ${{ number_format((float) $order->shipping, 2) }}</p>
          <p class="mb-1"><strong>Tax:</strong> ${{ number_format((float) $order->tax, 2) }}</p>
          <p class="mb-0"><strong>Total:</strong> ${{ number_format((float) $order->total, 2) }}</p>
          @if(in_array($order->status, ['pending', 'processing'], true) && !$order->cancel_requested_at)
            <form method="POST" action="{{ route('account.orders.cancel-request', $order) }}" class="mt-4">
              @csrf
              <button type="submit" class="btn btn-outline-dark text-uppercase">Request Cancellation</button>
            </form>
          @endif
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
