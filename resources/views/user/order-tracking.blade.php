@extends('layouts.storefront')

@section('body_attributes') class="bg-body" data-bs-spy="scroll" data-bs-target="#navbar" data-bs-root-margin="0px 0px -40%"
  data-bs-smooth-scroll="true" tabindex="0"@endsection

@section('page_title', 'My Orders')

@section('storefront_content')
<section id="order-tracking" class="py-5 my-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-10">
          @if(session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
          @endif

          <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
              <h2 class="section-title text-uppercase mb-2">Order History</h2>
              <p class="mb-0 text-muted">Review all orders placed from your account.</p>
            </div>
            <a href="{{ route('account') }}" class="btn btn-outline-dark text-uppercase">Back to Account</a>
          </div>

          @forelse($orders as $order)
            <div class="border rounded-3 p-4 mb-4 bg-white">
              <div class="row g-3 align-items-center mb-3">
                <div class="col-md-4">
                  <small class="text-uppercase d-block">Order Number</small>
                  <strong>{{ $order->order_number }}</strong>
                </div>
                <div class="col-md-2">
                  <small class="text-uppercase d-block">Status</small>
                  <strong class="text-capitalize">{{ $order->status }}</strong>
                </div>
                <div class="col-md-2">
                  <small class="text-uppercase d-block">Payment</small>
                  <strong class="text-capitalize">{{ $order->payment_status }}</strong>
                </div>
                <div class="col-md-2">
                  <small class="text-uppercase d-block">Placed</small>
                  <strong>{{ $order->created_at->format('M d, Y') }}</strong>
                </div>
                <div class="col-md-2">
                  <small class="text-uppercase d-block">Total</small>
                  <strong>${{ number_format((float) $order->total, 2) }}</strong>
                </div>
                <div class="col-md-2 text-md-end">
                  <a href="{{ route('account.orders.show', $order) }}" class="btn btn-sm btn-outline-dark text-uppercase">Details</a>
                </div>
              </div>

              <div class="table-responsive">
                <table class="table align-middle mb-0">
                  <thead>
                    <tr>
                      <th>Item</th>
                      <th>Qty</th>
                      <th>Price</th>
                      <th>Total</th>
                    </tr>
                  </thead>
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
          @empty
            <div class="border rounded-3 p-5 text-center bg-white">
              <h3 class="h4 mb-3">No orders yet</h3>
              <p class="text-muted mb-4">Your placed orders will appear here once you complete checkout.</p>
              <a href="/shop" class="btn btn-dark text-uppercase">Start Shopping</a>
            </div>
          @endforelse

          @if($orders->hasPages())
            <div class="mt-4">
              {{ $orders->links('pagination::bootstrap-5') }}
            </div>
          @endif
        </div>
      </div>
    </div>
  </section>
@endsection
