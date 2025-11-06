<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutPageContent;
use Illuminate\Http\Request;

class AboutPageContentController extends Controller
{
    /**
     * Display the about page content editing form.
     */
    public function index()
    {
        $content = AboutPageContent::getContent();
        return view('admin.about-page-content.index', compact('content'));
    }

    /**
     * Update the about page content.
     */
    public function update(Request $request)
    {
        $content = AboutPageContent::getContent();

        $validated = $request->validate([
            // Hero Section
            'hero_title' => 'nullable|string|max:500',
            'hero_description' => 'nullable|string',
            
            // Who We Are Section
            'who_we_are_badge' => 'nullable|string|max:255',
            'who_we_are_title' => 'nullable|string|max:500',
            'who_we_are_description' => 'nullable|string',
            'who_we_are_stat_number' => 'nullable|string|max:50',
            'who_we_are_stat_label' => 'nullable|string|max:255',
            'who_we_are_warranty_title' => 'nullable|string|max:255',
            'who_we_are_warranty_description' => 'nullable|string',
            
            // Feature Card Section
            'feature_title' => 'nullable|string|max:500',
            'feature_items' => 'nullable|array',
            'feature_items.*' => 'nullable|string|max:255',
            
            // Customer Satisfaction Section
            'customer_satisfaction_badge' => 'nullable|string|max:255',
            'customer_satisfaction_title' => 'nullable|string|max:500',
            'customer_satisfaction_items' => 'nullable|array',
            'customer_satisfaction_items.*.title' => 'nullable|string|max:500',
            'customer_satisfaction_items.*.description' => 'nullable|string',
            
            // Quality Repairs Section
            'quality_repairs_badge' => 'nullable|string|max:255',
            'quality_repairs_title' => 'nullable|string|max:500',
            'quality_repairs_stats' => 'nullable|array',
            'quality_repairs_stats.*.number' => 'nullable|string|max:50',
            'quality_repairs_stats.*.label' => 'nullable|string|max:255',
            
            // Why Choose Us Section
            'why_choose_us_badge' => 'nullable|string|max:255',
            'why_choose_us_title' => 'nullable|string|max:255',
            'why_choose_us_items' => 'nullable|array',
            'why_choose_us_items.*' => 'nullable|string|max:255',
        ]);

        // Clean up empty arrays
        if (isset($validated['feature_items']) && empty(array_filter($validated['feature_items']))) {
            $validated['feature_items'] = null;
        }
        if (isset($validated['customer_satisfaction_items']) && empty(array_filter($validated['customer_satisfaction_items']))) {
            $validated['customer_satisfaction_items'] = null;
        }
        if (isset($validated['quality_repairs_stats']) && empty(array_filter($validated['quality_repairs_stats']))) {
            $validated['quality_repairs_stats'] = null;
        }
        if (isset($validated['why_choose_us_items']) && empty(array_filter($validated['why_choose_us_items']))) {
            $validated['why_choose_us_items'] = null;
        }

        $content->update($validated);

        return redirect()->route('admin.about-page-content.index')->with('success', 'About page content updated successfully.');
    }
}
