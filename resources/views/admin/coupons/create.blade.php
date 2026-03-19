@extends('layouts.admin')

@section('content')
    <div class="panel-card">
        <h5 class="mb-3">Create Coupon</h5>
        <form method="POST" action="{{ route('admin.coupons.store') }}">
            @include('admin.coupons._form', ['submitLabel' => 'Create Coupon'])
        </form>
    </div>
@endsection
