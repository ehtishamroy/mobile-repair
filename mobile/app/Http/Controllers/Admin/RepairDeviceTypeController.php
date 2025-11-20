<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RepairDeviceType;
use App\Models\RepairService;
use Illuminate\Http\Request;

class RepairDeviceTypeController extends Controller
{
    public function index()
    {
        $deviceTypes = RepairDeviceType::with('service')->orderBy('order')->latest()->paginate(15);
        return view('admin.repair-device-types.index', compact('deviceTypes'));
    }

    public function create()
    {
        $services = RepairService::where('is_active', true)->orderBy('order')->get();
        return view('admin.repair-device-types.create', compact('services'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'repair_service_id' => 'required|exists:repair_services,id',
            'name' => 'required|string|max:255',
            'brand' => 'nullable|string|max:255',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        RepairDeviceType::create($validated);

        return redirect()->route('admin.repair-device-types.index')->with('success', 'Device type created successfully.');
    }

    public function edit(string $id)
    {
        $deviceType = RepairDeviceType::findOrFail($id);
        $services = RepairService::where('is_active', true)->orderBy('order')->get();
        return view('admin.repair-device-types.edit', compact('deviceType', 'services'));
    }

    public function update(Request $request, string $id)
    {
        $deviceType = RepairDeviceType::findOrFail($id);

        $validated = $request->validate([
            'repair_service_id' => 'required|exists:repair_services,id',
            'name' => 'required|string|max:255',
            'brand' => 'nullable|string|max:255',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $deviceType->update($validated);

        return redirect()->route('admin.repair-device-types.index')->with('success', 'Device type updated successfully.');
    }

    public function destroy(string $id)
    {
        $deviceType = RepairDeviceType::findOrFail($id);
        $deviceType->delete();

        return redirect()->route('admin.repair-device-types.index')->with('success', 'Device type deleted successfully.');
    }
}
