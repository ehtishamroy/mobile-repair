<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RepairOrder;
use Illuminate\Http\Request;

class RepairOrderController extends Controller
{
    public function index()
    {
        $repairOrders = RepairOrder::with(['service', 'deviceType'])
            ->latest()
            ->paginate(15);
        
        return view('admin.repair-orders.index', compact('repairOrders'));
    }

    public function show(string $id)
    {
        $repairOrder = RepairOrder::with(['service', 'deviceType'])
            ->findOrFail($id);
        
        // Load issues if selected_issues exist
        $issues = [];
        if ($repairOrder->selected_issues && is_array($repairOrder->selected_issues)) {
            $issues = \App\Models\RepairIssue::whereIn('id', $repairOrder->selected_issues)->get();
        }
        
        return view('admin.repair-orders.show', compact('repairOrder', 'issues'));
    }

    public function update(Request $request, string $id)
    {
        $repairOrder = RepairOrder::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:pending,paid,processing,completed,cancelled',
        ]);

        $repairOrder->update($validated);

        return redirect()->route('admin.repair-orders.show', $repairOrder->id)
            ->with('success', 'Repair order updated successfully.');
    }
}
