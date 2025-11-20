<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RepairService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RepairServiceController extends Controller
{
    public function index()
    {
        $services = RepairService::orderBy('order')->latest()->paginate(15);
        return view('admin.repair-services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.repair-services.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:repair_services,slug',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('repair-services', 'public');
        }

        $validated['is_active'] = $request->has('is_active');

        RepairService::create($validated);

        return redirect()->route('admin.repair-services.index')->with('success', 'Repair service created successfully.');
    }

    public function edit(string $id)
    {
        $service = RepairService::findOrFail($id);
        return view('admin.repair-services.edit', compact('service'));
    }

    public function update(Request $request, string $id)
    {
        $service = RepairService::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:repair_services,slug,' . $id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            if ($service->image && Storage::disk('public')->exists($service->image)) {
                Storage::disk('public')->delete($service->image);
            }
            $validated['image'] = $request->file('image')->store('repair-services', 'public');
        } else {
            unset($validated['image']);
        }

        $validated['is_active'] = $request->has('is_active');

        $service->update($validated);

        return redirect()->route('admin.repair-services.index')->with('success', 'Repair service updated successfully.');
    }

    public function destroy(string $id)
    {
        $service = RepairService::findOrFail($id);
        
        if ($service->image && Storage::disk('public')->exists($service->image)) {
            Storage::disk('public')->delete($service->image);
        }
        
        $service->delete();

        return redirect()->route('admin.repair-services.index')->with('success', 'Repair service deleted successfully.');
    }
}
