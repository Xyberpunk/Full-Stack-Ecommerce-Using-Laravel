<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'order_number',
        'status',
        'payment_status',
        'payment_method',
        'payment_reference',
        'stripe_session_id',
        'payment_failure_reason',
        'shipping_method',
        'tracking_number',
        'coupon_code',
        'invoice_number',
        'subtotal',
        'tax',
        'tax_rate',
        'shipping',
        'discount',
        'total',
        'customer_name',
        'customer_email',
        'customer_phone',
        'shipping_address',
        'notes',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'tax' => 'decimal:2',
        'tax_rate' => 'decimal:2',
        'shipping' => 'decimal:2',
        'discount' => 'decimal:2',
        'total' => 'decimal:2',
        'invoice_generated_at' => 'datetime',
        'cancel_requested_at' => 'datetime',
        'returned_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function statusLogs()
    {
        return $this->hasMany(OrderStatusLog::class)->latest();
    }

    public function stockMovements()
    {
        return $this->hasMany(StockMovement::class);
    }
}
