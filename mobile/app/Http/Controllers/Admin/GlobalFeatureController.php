<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GlobalFeature;
use Illuminate\Http\Request;

class GlobalFeatureController extends Controller
{
    /**
     * Display the global features management page.
     */
    public function index()
    {
        $globalFeatures = GlobalFeature::orderBy('order')->orderBy('id')->get();
        return view('admin.global-features.index', compact('globalFeatures'));
    }

    /**
     * Store a new global feature.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'icon' => 'required|string|max:100',
            'title' => 'required|string|max:255',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        GlobalFeature::create($validated);

        return redirect()->route('admin.global-features.index')
            ->with('success', 'Global feature created successfully.');
    }

    /**
     * Update a global feature.
     */
    public function update(Request $request, GlobalFeature $globalFeature)
    {
        $validated = $request->validate([
            'icon' => 'required|string|max:100',
            'title' => 'required|string|max:255',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $globalFeature->update($validated);

        return redirect()->route('admin.global-features.index')
            ->with('success', 'Global feature updated successfully.');
    }

    /**
     * Delete a global feature.
     */
    public function destroy(GlobalFeature $globalFeature)
    {
        $globalFeature->delete();

        return redirect()->route('admin.global-features.index')
            ->with('success', 'Global feature deleted successfully.');
    }
}

