<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $dateFrom = $request->date('date_from');
        $dateTo = $request->date('date_to');
        $orderBase = Order::query()
            ->when($dateFrom, fn ($query) => $query->whereDate('created_at', '>=', $dateFrom))
            ->when($dateTo, fn ($query) => $query->whereDate('created_at', '<=', $dateTo));

        $stats = [
            'total_products' => Product::count(),
            'active_products' => Product::where('is_active', true)->count(),
            'total_orders' => (clone $orderBase)->count(),
            'pending_orders' => (clone $orderBase)->where('status', 'pending')->count(),
            'processing_orders' => (clone $orderBase)->where('status', 'processing')->count(),
            'delivered_orders' => (clone $orderBase)->where('status', 'delivered')->count(),
            'total_users' => User::count(),
            'admin_users' => User::where('role', 'admin')->count(),
            'published_posts' => BlogPost::where('is_published', true)->count(),
            'total_revenue' => (float) (clone $orderBase)->whereIn('payment_status', ['paid', 'pending'])->sum('total'),
            'low_stock_products' => Product::query()->whereColumn('stock', '<=', 'low_stock_threshold')->count(),
        ];

        $recentOrders = (clone $orderBase)->latest()->limit(8)->get();
        $recentPosts = BlogPost::latest()->limit(5)->get();
        $recentCustomers = User::where('role', 'user')->latest()->limit(5)->get();
        $lowStockProducts = Product::query()
            ->whereColumn('stock', '<=', 'low_stock_threshold')
            ->orderBy('stock')
            ->limit(6)
            ->get();
        $topProducts = OrderItem::query()
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->select('product_name', DB::raw('SUM(quantity) as units_sold'), DB::raw('SUM(line_total) as revenue'))
            ->when($dateFrom, fn ($query) => $query->whereDate('orders.created_at', '>=', $dateFrom))
            ->when($dateTo, fn ($query) => $query->whereDate('orders.created_at', '<=', $dateTo))
            ->groupBy('product_name')
            ->orderByDesc('units_sold')
            ->limit(5)
            ->get();
        $couponUsage = Coupon::query()
            ->where('used_count', '>', 0)
            ->orderByDesc('used_count')
            ->limit(5)
            ->get();

        $categorySales = OrderItem::query()
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->leftJoin('products', 'products.id', '=', 'order_items.product_id')
            ->leftJoin('categories', 'categories.id', '=', 'products.category_id')
            ->selectRaw('COALESCE(categories.name, "Uncategorized") as category_name, SUM(order_items.line_total) as revenue')
            ->when($dateFrom, fn ($query) => $query->whereDate('orders.created_at', '>=', $dateFrom))
            ->when($dateTo, fn ($query) => $query->whereDate('orders.created_at', '<=', $dateTo))
            ->groupBy('category_name')
            ->orderByDesc('revenue')
            ->limit(6)
            ->get();

        $repeatCustomerCount = Order::query()
            ->select('user_id')
            ->whereNotNull('user_id')
            ->when($dateFrom, fn ($query) => $query->whereDate('created_at', '>=', $dateFrom))
            ->when($dateTo, fn ($query) => $query->whereDate('created_at', '<=', $dateTo))
            ->groupBy('user_id')
            ->havingRaw('COUNT(*) > 1')
            ->get()
            ->count();

        $customerOrderRate = User::where('role', 'user')->count() > 0
            ? round(((clone $orderBase)->whereNotNull('user_id')->distinct('user_id')->count('user_id') / max(1, User::where('role', 'user')->count())) * 100, 1)
            : 0;

        $monthlyRevenue = collect(range(5, 0))
            ->map(function (int $monthsAgo) {
                $date = Carbon::now()->subMonths($monthsAgo);
                return [
                    'label' => $date->format('M'),
                    'revenue' => (float) Order::query()
                        ->whereYear('created_at', $date->year)
                        ->whereMonth('created_at', $date->month)
                        ->sum('total'),
                ];
            })
            ->push([
                'label' => Carbon::now()->format('M'),
                'revenue' => (float) Order::query()
                    ->whereYear('created_at', now()->year)
                    ->whereMonth('created_at', now()->month)
                    ->sum('total'),
            ]);

        return view('admin.dashboard', compact(
            'stats',
            'recentOrders',
            'recentPosts',
            'recentCustomers',
            'lowStockProducts',
            'topProducts',
            'couponUsage',
            'categorySales',
            'repeatCustomerCount',
            'customerOrderRate',
            'monthlyRevenue',
        ));
    }
}
