<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['items', 'latestTracking'])
            ->latest()
            ->paginate(15);
        
        return view('admin.orders.index', compact('orders'));
    }

    public function show(string $id)
    {
        $order = Order::with(['items.product', 'tracking.updatedBy', 'coupon', 'user'])
            ->findOrFail($id);
        
        return view('admin.orders.show', compact('order'));
    }

    public function update(Request $request, string $id)
    {
        $order = Order::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,processing,shipped,delivered,cancelled,refunded',
            'payment_status' => 'required|in:pending,paid,failed,refunded',
            'admin_notes' => 'nullable|string',
        ]);

        $order->update($validated);

        return redirect()->route('admin.orders.show', $order->id)
            ->with('success', 'Order updated successfully.');
    }
}
