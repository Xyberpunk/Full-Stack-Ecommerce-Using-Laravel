@extends('layouts.admin')

@section('content')
    <div class="panel-card">
        <h5 class="mb-3">Edit Coupon</h5>
        <form method="POST" action="{{ route('admin.coupons.update', $coupon) }}">
            @method('PUT')
            @include('admin.coupons._form', ['submitLabel' => 'Update Coupon'])
        </form>
    </div>
@endsection
