<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RepairBrand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RepairBrandController extends Controller
{
    public function index()
    {
        $brands = RepairBrand::orderBy('order')->latest()->get();
        return view('admin.repair-brands.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.repair-brands.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:repair_brands,name',
            'slug' => 'nullable|string|max:255|unique:repair_brands,slug',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('repair-brands', 'public');
        }

        $validated['is_active'] = $request->has('is_active');

        RepairBrand::create($validated);

        return redirect()->route('admin.repair-brands.index')->with('success', 'Repair brand created successfully.');
    }

    public function edit(string $id)
    {
        $brand = RepairBrand::findOrFail($id);
        return view('admin.repair-brands.edit', compact('brand'));
    }

    public function update(Request $request, string $id)
    {
        $brand = RepairBrand::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:repair_brands,name,' . $id,
            'slug' => 'nullable|string|max:255|unique:repair_brands,slug,' . $id,
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('logo')) {
            if ($brand->logo && Storage::disk('public')->exists($brand->logo)) {
                Storage::disk('public')->delete($brand->logo);
            }
            $validated['logo'] = $request->file('logo')->store('repair-brands', 'public');
        } else {
            unset($validated['logo']);
        }

        $validated['is_active'] = $request->has('is_active');

        $brand->update($validated);

        return redirect()->route('admin.repair-brands.index')->with('success', 'Repair brand updated successfully.');
    }

    public function destroy(string $id)
    {
        $brand = RepairBrand::findOrFail($id);

        if ($brand->logo && Storage::disk('public')->exists($brand->logo)) {
            Storage::disk('public')->delete($brand->logo);
        }

        $brand->delete();

        return redirect()->route('admin.repair-brands.index')->with('success', 'Repair brand deleted successfully.');
    }
}

