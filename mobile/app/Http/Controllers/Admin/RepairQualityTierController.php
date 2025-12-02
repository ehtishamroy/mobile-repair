<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RepairQualityTier;
use App\Models\RepairIssue;
use App\Models\RepairDeviceType;

class RepairQualityTierController extends Controller
{
    public function index()
    {
        $qualityTiers = RepairQualityTier::with(['issue', 'deviceType'])
            ->orderBy('order')
            ->get();
        return view('admin.repair-quality-tiers.index', compact('qualityTiers'));
    }

    public function create()
    {
        $issues = RepairIssue::where('is_active', true)->orderBy('name')->get();
        $deviceTypes = RepairDeviceType::where('is_active', true)->orderBy('name')->get();
        return view('admin.repair-quality-tiers.form', compact('issues', 'deviceTypes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'repair_issue_id' => 'nullable|exists:repair_issues,id',
            'repair_device_type_id' => 'nullable|exists:repair_device_types,id',
            'name' => 'required|string|max:255',
            'price_modifier' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'is_default' => 'boolean',
            'order' => 'integer',
            'is_active' => 'boolean',
        ]);

        $validated['is_default'] = $request->has('is_default');
        $validated['is_active'] = $request->has('is_active');

        RepairQualityTier::create($validated);

        return redirect()->route('admin.repair-quality-tiers.index')
            ->with('success', 'Quality tier created successfully.');
    }

    public function edit(RepairQualityTier $repairQualityTier)
    {
        $issues = RepairIssue::where('is_active', true)->orderBy('name')->get();
        $deviceTypes = RepairDeviceType::where('is_active', true)->orderBy('name')->get();
        return view('admin.repair-quality-tiers.form', compact('repairQualityTier', 'issues', 'deviceTypes'));
    }

    public function update(Request $request, RepairQualityTier $repairQualityTier)
    {
        $validated = $request->validate([
            'repair_issue_id' => 'nullable|exists:repair_issues,id',
            'repair_device_type_id' => 'nullable|exists:repair_device_types,id',
            'name' => 'required|string|max:255',
            'price_modifier' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'is_default' => 'boolean',
            'order' => 'integer',
            'is_active' => 'boolean',
        ]);

        $validated['is_default'] = $request->has('is_default');
        $validated['is_active'] = $request->has('is_active');

        $repairQualityTier->update($validated);

        return redirect()->route('admin.repair-quality-tiers.index')
            ->with('success', 'Quality tier updated successfully.');
    }

    public function destroy(RepairQualityTier $repairQualityTier)
    {
        $repairQualityTier->delete();

        return redirect()->route('admin.repair-quality-tiers.index')
            ->with('success', 'Quality tier deleted successfully.');
    }
}
