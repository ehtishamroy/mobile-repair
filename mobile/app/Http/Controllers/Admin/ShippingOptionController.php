<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShippingOption;
use Illuminate\Http\Request;

class ShippingOptionController extends Controller
{
    /**
     * Display the shipping options management page.
     */
    public function index()
    {
        $shippingOptions = ShippingOption::orderBy('order')->orderBy('id')->get();
        return view('admin.shipping-options.index', compact('shippingOptions'));
    }

    /**
     * Store a new shipping option.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'cost' => 'required|numeric|min:0',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        ShippingOption::create($validated);

        return redirect()->route('admin.shipping-options.index')
            ->with('success', 'Shipping option created successfully.');
    }

    /**
     * Update a shipping option.
     */
    public function update(Request $request, ShippingOption $shippingOption)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'cost' => 'required|numeric|min:0',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $shippingOption->update($validated);

        return redirect()->route('admin.shipping-options.index')
            ->with('success', 'Shipping option updated successfully.');
    }

    /**
     * Delete a shipping option.
     */
    public function destroy(ShippingOption $shippingOption)
    {
        $shippingOption->delete();

        return redirect()->route('admin.shipping-options.index')
            ->with('success', 'Shipping option deleted successfully.');
    }
}

