<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Confirmation</title>
</head>
<body style="font-family: Arial, sans-serif; color: #111; line-height: 1.6;">
    <h2>Thank you for your order, {{ $order->customer_name }}.</h2>
    <p>Your order <strong>{{ $order->order_number }}</strong> has been received.</p>
    <p>Invoice: <strong>{{ $order->invoice_number }}</strong></p>
    <p>Payment method: <strong>{{ ucfirst(str_replace('_', ' ', $order->payment_method ?? 'pending')) }}</strong></p>
    <p>Shipping method: <strong>{{ ucfirst(str_replace('_', ' ', $order->shipping_method ?? 'standard')) }}</strong></p>

    <table width="100%" cellpadding="8" cellspacing="0" style="border-collapse: collapse; margin-top: 18px;">
        <thead>
            <tr>
                <th align="left" style="border-bottom: 1px solid #ddd;">Item</th>
                <th align="left" style="border-bottom: 1px solid #ddd;">Qty</th>
                <th align="left" style="border-bottom: 1px solid #ddd;">Total</th>
            </tr>
        </thead>
        <tbody>
        @foreach($order->items as $item)
            <tr>
                <td style="border-bottom: 1px solid #eee;">{{ $item->product_name }}</td>
                <td style="border-bottom: 1px solid #eee;">{{ $item->quantity }}</td>
                <td style="border-bottom: 1px solid #eee;">${{ number_format((float) $item->line_total, 2) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <p style="margin-top: 18px;">Subtotal: ${{ number_format((float) $order->subtotal, 2) }}</p>
    <p>Discount: ${{ number_format((float) $order->discount, 2) }}</p>
    <p>Shipping: ${{ number_format((float) $order->shipping, 2) }}</p>
    <p>Tax: ${{ number_format((float) $order->tax, 2) }}</p>
    <p><strong>Total: ${{ number_format((float) $order->total, 2) }}</strong></p>
</body>
</html>
