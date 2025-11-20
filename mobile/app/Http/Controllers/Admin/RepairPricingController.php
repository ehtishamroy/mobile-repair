<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RepairPricing;
use App\Models\RepairService;
use App\Models\RepairDeviceType;
use App\Models\RepairIssue;
use Illuminate\Http\Request;

class RepairPricingController extends Controller
{
    public function index()
    {
        $pricings = RepairPricing::with(['service', 'deviceType', 'issue'])
            ->latest()
            ->paginate(15);
        return view('admin.repair-pricings.index', compact('pricings'));
    }

    public function create()
    {
        $services = RepairService::where('is_active', true)->orderBy('order')->get();
        $deviceTypes = RepairDeviceType::where('is_active', true)->orderBy('order')->get();
        $issues = RepairIssue::where('is_active', true)->orderBy('order')->get();
        return view('admin.repair-pricings.create', compact('services', 'deviceTypes', 'issues'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'repair_service_id' => 'required|exists:repair_services,id',
            'repair_device_type_id' => 'nullable|exists:repair_device_types,id',
            'repair_issue_id' => 'nullable|exists:repair_issues,id',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:500',
            'is_inspection_fee' => 'boolean',
            'is_active' => 'boolean',
        ]);

        $validated['is_inspection_fee'] = $request->has('is_inspection_fee');
        $validated['is_active'] = $request->has('is_active');

        RepairPricing::create($validated);

        return redirect()->route('admin.repair-pricings.index')->with('success', 'Pricing created successfully.');
    }

    public function edit(string $id)
    {
        $pricing = RepairPricing::findOrFail($id);
        $services = RepairService::where('is_active', true)->orderBy('order')->get();
        $deviceTypes = RepairDeviceType::where('is_active', true)
            ->where('repair_service_id', $pricing->repair_service_id)
            ->orderBy('order')
            ->get();
        $issues = RepairIssue::where('is_active', true)
            ->where('repair_service_id', $pricing->repair_service_id)
            ->orderBy('order')
            ->get();
        return view('admin.repair-pricings.edit', compact('pricing', 'services', 'deviceTypes', 'issues'));
    }

    public function update(Request $request, string $id)
    {
        $pricing = RepairPricing::findOrFail($id);

        $validated = $request->validate([
            'repair_service_id' => 'required|exists:repair_services,id',
            'repair_device_type_id' => 'nullable|exists:repair_device_types,id',
            'repair_issue_id' => 'nullable|exists:repair_issues,id',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:500',
            'is_inspection_fee' => 'boolean',
            'is_active' => 'boolean',
        ]);

        $validated['is_inspection_fee'] = $request->has('is_inspection_fee');
        $validated['is_active'] = $request->has('is_active');

        $pricing->update($validated);

        return redirect()->route('admin.repair-pricings.index')->with('success', 'Pricing updated successfully.');
    }

    public function destroy(string $id)
    {
        $pricing = RepairPricing::findOrFail($id);
        $pricing->delete();

        return redirect()->route('admin.repair-pricings.index')->with('success', 'Pricing deleted successfully.');
    }

    public function getDeviceTypes(Request $request)
    {
        $serviceId = $request->get('service_id');
        $deviceTypes = RepairDeviceType::where('repair_service_id', $serviceId)
            ->where('is_active', true)
            ->orderBy('order')
            ->get();
        
        return response()->json($deviceTypes);
    }

    public function getIssues(Request $request)
    {
        $serviceId = $request->get('service_id');
        $issues = RepairIssue::where('repair_service_id', $serviceId)
            ->where('is_active', true)
            ->orderBy('order')
            ->get();
        
        return response()->json($issues);
    }
}
