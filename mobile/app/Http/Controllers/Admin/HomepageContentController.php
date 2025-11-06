<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomepageContent;
use Illuminate\Http\Request;

class HomepageContentController extends Controller
{
    /**
     * Display the homepage content editing form.
     */
    public function index()
    {
        $content = HomepageContent::getContent();
        return view('admin.homepage-content.index', compact('content'));
    }

    /**
     * Update the homepage content.
     */
    public function update(Request $request)
    {
        $content = HomepageContent::getContent();

        $validated = $request->validate([
            // Hero Section
            'hero_badge' => 'nullable|string|max:255',
            'hero_title' => 'nullable|string|max:500',
            'hero_description' => 'nullable|string',
            'hero_button_text' => 'nullable|string|max:255',
            
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
            
            // What We Offer Section
            'what_we_offer_badge' => 'nullable|string|max:255',
            'what_we_offer_title' => 'nullable|string|max:500',
            'what_we_offer_description' => 'nullable|string',
            'what_we_offer_button_text' => 'nullable|string|max:255',
            'services' => 'nullable|array',
            'services.*.title' => 'nullable|string|max:255',
            'services.*.description' => 'nullable|string',
            
            // Hot Selling Section
            'hot_selling_badge' => 'nullable|string|max:255',
            'hot_selling_title' => 'nullable|string|max:255',
            
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
            
            // Accessories Section
            'accessories_badge' => 'nullable|string|max:255',
            'accessories_title' => 'nullable|string|max:255',
        ]);

        // Clean up empty arrays
        if (isset($validated['feature_items']) && empty(array_filter($validated['feature_items']))) {
            $validated['feature_items'] = null;
        }
        if (isset($validated['services']) && empty(array_filter($validated['services']))) {
            $validated['services'] = null;
        }
        if (isset($validated['quality_repairs_stats']) && empty(array_filter($validated['quality_repairs_stats']))) {
            $validated['quality_repairs_stats'] = null;
        }
        if (isset($validated['why_choose_us_items']) && empty(array_filter($validated['why_choose_us_items']))) {
            $validated['why_choose_us_items'] = null;
        }

        $content->update($validated);

        return redirect()->route('admin.homepage-content.index')->with('success', 'Homepage content updated successfully.');
    }
}
