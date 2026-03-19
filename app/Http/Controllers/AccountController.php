<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\PasswordUpdateRequest;
use App\Http\Requests\Auth\ProfileUpdateRequest;
use App\Http\Requests\Auth\UserAddressRequest;
use App\Models\Product;
use App\Models\UserAddress;
use App\Models\WishlistItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AccountController extends Controller
{
    public function dashboard(Request $request): View
    {
        $user = $request->user();
        $hasWishlistTable = Schema::hasTable('wishlist_items');
        $hasAddressTable = Schema::hasTable('user_addresses');

        return view('user.my-account', [
            'ordersCount' => $user?->orders()->count() ?? 0,
            'wishlistCount' => $hasWishlistTable ? ($user?->wishlistItems()->count() ?? 0) : 0,
            'addresses' => $hasAddressTable ? ($user?->addresses()->latest()->get() ?? collect()) : collect(),
            'recentOrders' => $user?->orders()->latest()->limit(3)->get() ?? collect(),
            'hasWishlistTable' => $hasWishlistTable,
            'hasAddressTable' => $hasAddressTable,
        ]);
    }

    public function orders(Request $request): View
    {
        $orders = $request->user()
            ->orders()
            ->with('items.product')
            ->latest()
            ->paginate(10);

        return view('user.order-tracking', compact('orders'));
    }

    public function showOrder(Request $request, \App\Models\Order $order): View
    {
        abort_unless($order->user_id === $request->user()->id, 403);
        $order->load('items.product', 'statusLogs.user');

        return view('user.order-detail', compact('order'));
    }

    public function requestCancellation(Request $request, \App\Models\Order $order): RedirectResponse
    {
        abort_unless($order->user_id === $request->user()->id, 403);
        abort_unless(in_array($order->status, ['pending', 'processing'], true), 422);

        $order->update([
            'cancel_requested_at' => now(),
        ]);

        $order->statusLogs()->create([
            'user_id' => $request->user()->id,
            'from_status' => $order->status,
            'to_status' => $order->status,
            'from_payment_status' => $order->payment_status,
            'to_payment_status' => $order->payment_status,
            'note' => 'Customer requested cancellation.',
        ]);

        return back()->with('status', 'Cancellation request submitted.');
    }

    public function wishlist(Request $request): View
    {
        abort_unless(Schema::hasTable('wishlist_items'), 404);

        $wishlistItems = $request->user()
            ->wishlistItems()
            ->with('product.category')
            ->latest()
            ->get();

        return view('user.wishlist', compact('wishlistItems'));
    }

    public function storeWishlistItem(Request $request, Product $product): RedirectResponse
    {
        abort_unless(Schema::hasTable('wishlist_items'), 404);

        $request->user()->wishlistItems()->firstOrCreate([
            'product_id' => $product->id,
        ]);

        return back()->with('status', 'Product added to wishlist.');
    }

    public function updateProfile(ProfileUpdateRequest $request): RedirectResponse
    {
        $data = $request->safe()->except('profile_photo');
        $user = $request->user();

        if ($request->hasFile('profile_photo')) {
            if ($user->profile_photo_path && str_starts_with($user->profile_photo_path, 'storage/')) {
                Storage::disk('public')->delete(str_replace('storage/', '', $user->profile_photo_path));
            }

            $data['profile_photo_path'] = 'storage/' . $request->file('profile_photo')->store('profiles', 'public');
        }

        $user->update($data);

        return redirect()->route('account')->with('status', 'Profile updated.');
    }

    public function updatePassword(PasswordUpdateRequest $request): RedirectResponse
    {
        $request->user()->update([
            'password' => $request->validated()['password'],
        ]);

        return redirect()->to(route('account') . '#password-settings')->with('status', 'Password updated.');
    }

    public function storeAddress(UserAddressRequest $request): RedirectResponse
    {
        abort_unless(Schema::hasTable('user_addresses'), 404);

        $user = $request->user();
        $data = $request->validated();
        $data['is_default'] = $request->boolean('is_default');

        if ($data['is_default']) {
            $user->addresses()->update(['is_default' => false]);
        }

        $user->addresses()->create($data);

        return redirect()->to(route('account') . '#address-book')->with('status', 'Address added.');
    }

    public function updateAddress(UserAddressRequest $request, UserAddress $address): RedirectResponse
    {
        abort_unless(Schema::hasTable('user_addresses'), 404);
        abort_unless($address->user_id === $request->user()->id, 403);

        $data = $request->validated();
        $data['is_default'] = $request->boolean('is_default');

        if ($data['is_default']) {
            $request->user()->addresses()->update(['is_default' => false]);
        }

        $address->update($data);

        return redirect()->to(route('account') . '#address-book')->with('status', 'Address updated.');
    }

    public function destroyAddress(Request $request, UserAddress $address): RedirectResponse
    {
        abort_unless(Schema::hasTable('user_addresses'), 404);
        abort_unless($address->user_id === $request->user()->id, 403);

        $address->delete();

        return redirect()->to(route('account') . '#address-book')->with('status', 'Address removed.');
    }

    public function destroyWishlistItem(Request $request, WishlistItem $wishlistItem): RedirectResponse
    {
        abort_unless(Schema::hasTable('wishlist_items'), 404);
        abort_unless($wishlistItem->user_id === $request->user()->id, 403);

        $wishlistItem->delete();

        return redirect()->route('account.wishlist')->with('status', 'Wishlist item removed.');
    }

    public function destroyWishlistProduct(Request $request, Product $product): RedirectResponse
    {
        abort_unless(Schema::hasTable('wishlist_items'), 404);

        $request->user()
            ->wishlistItems()
            ->where('product_id', $product->id)
            ->delete();

        return back()->with('status', 'Product removed from wishlist.');
    }
}
