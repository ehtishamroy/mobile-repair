<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RepairDeviceType;
use App\Models\RepairService;
use App\Models\RepairBrand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RepairDeviceTypeController extends Controller
{
    public function index()
    {
        $deviceTypes = RepairDeviceType::with(['service', 'repairBrand'])->orderBy('order')->latest()->get();
        return view('admin.repair-device-types.index', compact('deviceTypes'));
    }

    public function create()
    {
        $services = RepairService::where('is_active', true)->orderBy('order')->get();
        $brands = RepairBrand::where('is_active', true)->orderBy('order')->get();
        return view('admin.repair-device-types.create', compact('services', 'brands'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'repair_service_id' => 'required|exists:repair_services,id',
            'repair_brand_id' => 'nullable|exists:repair_brands,id',
            'name' => 'required|string|max:255',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:4096',
            'brand' => 'nullable|string|max:255', // Keep for backward compatibility
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('repair-device-types/featured', 'public');
        }

        $validated['is_active'] = $request->has('is_active');

        RepairDeviceType::create($validated);

        return redirect()->route('admin.repair-device-types.index')->with('success', 'Device type created successfully.');
    }

    public function edit(string $id)
    {
        $deviceType = RepairDeviceType::findOrFail($id);
        $services = RepairService::where('is_active', true)->orderBy('order')->get();
        $brands = RepairBrand::where('is_active', true)->orderBy('order')->get();
        return view('admin.repair-device-types.edit', compact('deviceType', 'services', 'brands'));
    }

    public function update(Request $request, string $id)
    {
        $deviceType = RepairDeviceType::findOrFail($id);

        $validated = $request->validate([
            'repair_service_id' => 'required|exists:repair_services,id',
            'repair_brand_id' => 'nullable|exists:repair_brands,id',
            'name' => 'required|string|max:255',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:4096',
            'brand' => 'nullable|string|max:255', // Keep for backward compatibility
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('featured_image')) {
            if ($deviceType->featured_image && Storage::disk('public')->exists($deviceType->featured_image)) {
                Storage::disk('public')->delete($deviceType->featured_image);
            }
            $validated['featured_image'] = $request->file('featured_image')->store('repair-device-types/featured', 'public');
        } else {
            unset($validated['featured_image']);
        }

        $validated['is_active'] = $request->has('is_active');

        $deviceType->update($validated);

        return redirect()->route('admin.repair-device-types.index')->with('success', 'Device type updated successfully.');
    }

    public function destroy(string $id)
    {
        $deviceType = RepairDeviceType::findOrFail($id);

        if ($deviceType->featured_image && Storage::disk('public')->exists($deviceType->featured_image)) {
            Storage::disk('public')->delete($deviceType->featured_image);
        }

        $deviceType->delete();

        return redirect()->route('admin.repair-device-types.index')->with('success', 'Device type deleted successfully.');
    }
}

