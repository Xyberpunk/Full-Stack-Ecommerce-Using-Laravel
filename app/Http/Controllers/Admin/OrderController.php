<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OrderStatusUpdateRequest;
use App\Models\Order;
use App\Services\InventoryService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(
        private readonly InventoryService $inventory,
    ) {
    }

    public function index(Request $request)
    {
        $orders = Order::with('user')
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->string('status')))
            ->when($request->filled('payment_status'), fn ($query) => $query->where('payment_status', $request->string('payment_status')))
            ->when($request->filled('q'), function ($query) use ($request) {
                $term = $request->string('q')->toString();
                $query->where(function ($searchQuery) use ($term) {
                    $searchQuery
                        ->where('order_number', 'like', "%{$term}%")
                        ->orWhere('customer_name', 'like', "%{$term}%")
                        ->orWhere('customer_email', 'like', "%{$term}%");
                });
            })
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load('items.product', 'user', 'statusLogs.user');
        return view('admin.orders.show', compact('order'));
    }

    public function update(OrderStatusUpdateRequest $request, Order $order)
    {
        $data = $request->validated();
        $note = $data['admin_note'] ?? null;
        $oldStatus = $order->status;
        $oldPaymentStatus = $order->payment_status;

        if (($data['payment_status'] ?? null) === 'paid' && ($data['status'] ?? null) === 'pending') {
            $data['status'] = 'processing';
            $note = trim(($note ? $note . ' ' : '') . 'Order auto-moved to processing after payment approval.');
        }

        if (($data['status'] ?? null) === 'delivered' && ($data['payment_status'] ?? null) === 'pending') {
            $data['payment_status'] = 'paid';
            $note = trim(($note ? $note . ' ' : '') . 'Payment auto-marked as paid when order was delivered.');
        }

        $statusChanged = $oldStatus !== $data['status'];
        $paymentChanged = $oldPaymentStatus !== $data['payment_status'];

        $order->update([
            'status' => $data['status'],
            'payment_status' => $data['payment_status'],
            'tracking_number' => $data['tracking_number'] ?? $order->tracking_number,
            'returned_at' => $data['status'] === 'returned' ? now() : $order->returned_at,
        ]);

        if ($oldStatus !== 'cancelled' && $order->status === 'cancelled') {
            $this->inventory->restoreForOrder($order, $request->user()?->id);
        }

        if ($oldStatus === 'cancelled' && $order->status !== 'cancelled') {
            $this->inventory->decreaseForOrder($order, $request->user()?->id);
        }

        if ($statusChanged || $paymentChanged || filled($note)) {
            $order->statusLogs()->create([
                'user_id' => $request->user()?->id,
                'from_status' => $oldStatus,
                'to_status' => $order->status,
                'from_payment_status' => $oldPaymentStatus,
                'to_payment_status' => $order->payment_status,
                'note' => $note,
            ]);
        }

        return redirect()->route('admin.orders.show', $order)->with('status', 'Order updated.');
    }
}
