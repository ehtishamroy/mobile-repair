<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderTracking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class OrderTrackingController extends Controller
{
    /**
     * Store a new tracking update
     */
    public function store(Request $request, string $orderId)
    {
        $order = Order::findOrFail($orderId);

        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,processing,shipped,delivered,cancelled,refunded',
            'title' => 'required|string|max:255',
            'message' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'tracking_date' => 'nullable|date',
            'is_customer_notified' => 'boolean',
        ]);

        $validated['order_id'] = $order->id;
        $validated['updated_by'] = Auth::id();
        
        if (empty($validated['tracking_date'])) {
            $validated['tracking_date'] = Carbon::now();
        }

        $tracking = OrderTracking::create($validated);

        // Update order status
        $order->update(['status' => $validated['status']]);

        return redirect()->route('admin.orders.show', $order->id)
            ->with('success', 'Tracking update added successfully.');
    }

    /**
     * Update an existing tracking entry
     */
    public function update(Request $request, string $orderId, string $trackingId)
    {
        $order = Order::findOrFail($orderId);
        $tracking = OrderTracking::where('order_id', $orderId)->findOrFail($trackingId);

        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,processing,shipped,delivered,cancelled,refunded',
            'title' => 'required|string|max:255',
            'message' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'tracking_date' => 'nullable|date',
            'is_customer_notified' => 'boolean',
        ]);

        $validated['updated_by'] = Auth::id();

        $tracking->update($validated);

        // Update order status if this is the latest tracking
        $latestTracking = $order->latestTracking;
        if ($latestTracking && $latestTracking->id == $tracking->id) {
            $order->update(['status' => $validated['status']]);
        }

        return redirect()->route('admin.orders.show', $order->id)
            ->with('success', 'Tracking update modified successfully.');
    }

    /**
     * Delete a tracking entry
     */
    public function destroy(string $orderId, string $trackingId)
    {
        $order = Order::findOrFail($orderId);
        $tracking = OrderTracking::where('order_id', $orderId)->findOrFail($trackingId);

        $tracking->delete();

        return redirect()->route('admin.orders.show', $order->id)
            ->with('success', 'Tracking update deleted successfully.');
    }
}
