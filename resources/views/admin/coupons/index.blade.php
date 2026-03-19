@extends('layouts.admin')

@section('content')
    <div class="panel-card">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0">Coupons</h5>
            <a href="{{ route('admin.coupons.create') }}" class="btn btn-primary">Add Coupon</a>
        </div>
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                <tr><th>Code</th><th>Type</th><th>Value</th><th>Minimum</th><th>Usage</th><th>Status</th><th class="text-end">Actions</th></tr>
                </thead>
                <tbody>
                @forelse($coupons as $coupon)
                    <tr>
                        <td>{{ $coupon->code }}</td>
                        <td>{{ ucfirst($coupon->type) }}</td>
                        <td>{{ $coupon->type === 'percent' ? number_format((float) $coupon->value, 2) . '%' : '$' . number_format((float) $coupon->value, 2) }}</td>
                        <td>${{ number_format((float) $coupon->min_order_amount, 2) }}</td>
                        <td>{{ $coupon->used_count }}{{ $coupon->usage_limit ? ' / ' . $coupon->usage_limit : '' }}</td>
                        <td>{{ $coupon->is_active ? 'Active' : 'Inactive' }}</td>
                        <td class="text-end">
                            <a href="{{ route('admin.coupons.edit', $coupon) }}" class="btn btn-sm btn-outline-dark">Edit</a>
                            <form method="POST" action="{{ route('admin.coupons.destroy', $coupon) }}" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete coupon?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="text-muted">No coupons found.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        {{ $coupons->links() }}
    </div>
@endsection
