@csrf
<div class="row g-3">
    <div class="col-md-4">
        <label class="form-label">Code</label>
        <input type="text" name="code" class="form-control" value="{{ old('code', $coupon->code ?? '') }}" required>
    </div>
    <div class="col-md-4">
        <label class="form-label">Type</label>
        <select name="type" class="form-control">
            @foreach(['fixed' => 'Fixed Amount', 'percent' => 'Percent'] as $value => $label)
                <option value="{{ $value }}" @selected(old('type', $coupon->type ?? 'fixed') === $value)>{{ $label }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4">
        <label class="form-label">Value</label>
        <input type="number" step="0.01" name="value" class="form-control" value="{{ old('value', $coupon->value ?? '') }}" required>
    </div>
    <div class="col-md-4">
        <label class="form-label">Minimum Order Amount</label>
        <input type="number" step="0.01" name="min_order_amount" class="form-control" value="{{ old('min_order_amount', $coupon->min_order_amount ?? '0.00') }}">
    </div>
    <div class="col-md-4">
        <label class="form-label">Usage Limit</label>
        <input type="number" name="usage_limit" class="form-control" value="{{ old('usage_limit', $coupon->usage_limit ?? '') }}">
    </div>
    <div class="col-md-4">
        <label class="form-label">Used Count</label>
        <input type="number" class="form-control" value="{{ $coupon->used_count ?? 0 }}" disabled>
    </div>
    <div class="col-md-6">
        <label class="form-label">Starts At</label>
        <input type="datetime-local" name="starts_at" class="form-control" value="{{ old('starts_at', isset($coupon?->starts_at) ? $coupon->starts_at->format('Y-m-d\\TH:i') : '') }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">Ends At</label>
        <input type="datetime-local" name="ends_at" class="form-control" value="{{ old('ends_at', isset($coupon?->ends_at) ? $coupon->ends_at->format('Y-m-d\\TH:i') : '') }}">
    </div>
    <div class="col-12">
        <div class="form-check">
            <input type="checkbox" class="form-check-input" name="is_active" value="1" id="coupon-active" @checked(old('is_active', $coupon->is_active ?? true))>
            <label class="form-check-label" for="coupon-active">Active</label>
        </div>
    </div>
    <div class="col-12">
        <button class="btn btn-primary">{{ $submitLabel }}</button>
        <a href="{{ route('admin.coupons.index') }}" class="btn btn-outline-dark">Cancel</a>
    </div>
</div>
