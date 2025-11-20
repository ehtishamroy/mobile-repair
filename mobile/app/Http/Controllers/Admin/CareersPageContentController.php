<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CareersPageContent;
use Illuminate\Http\Request;

class CareersPageContentController extends Controller
{
    /**
     * Display the careers page content editing form.
     */
    public function index()
    {
        $content = CareersPageContent::getContent();
        return view('admin.careers-page-content.index', compact('content'));
    }

    /**
     * Update the careers page content.
     */
    public function update(Request $request)
    {
        $content = CareersPageContent::getContent();

        $validated = $request->validate([
            // Hero Section
            'hero_title' => 'nullable|string|max:500',
            'hero_description' => 'nullable|string',
            
            // Why Join Us Section
            'why_join_badge' => 'nullable|string|max:255',
            'why_join_title' => 'nullable|string|max:500',
            'why_join_description' => 'nullable|string',
            'why_join_items' => 'nullable|array',
            'why_join_items.*' => 'nullable|string|max:255',
            
            // Open Positions Section
            'open_positions_badge' => 'nullable|string|max:255',
            'open_positions_title' => 'nullable|string|max:500',
            'open_positions_description' => 'nullable|string',
            'job_positions' => 'nullable|array',
            'job_positions.*.title' => 'nullable|string|max:255',
            'job_positions.*.department' => 'nullable|string|max:255',
            'job_positions.*.location' => 'nullable|string|max:255',
            'job_positions.*.type' => 'nullable|string|max:255',
            'job_positions.*.description' => 'nullable|string',
            
            // Benefits Section
            'benefits_badge' => 'nullable|string|max:255',
            'benefits_title' => 'nullable|string|max:500',
            'benefits_items' => 'nullable|array',
            'benefits_items.*.title' => 'nullable|string|max:255',
            'benefits_items.*.description' => 'nullable|string',
            
            // How to Apply Section
            'how_to_apply_badge' => 'nullable|string|max:255',
            'how_to_apply_title' => 'nullable|string|max:500',
            'how_to_apply_description' => 'nullable|string',
            'application_steps' => 'nullable|array',
            'application_steps.*.step' => 'nullable|string|max:255',
            'application_steps.*.description' => 'nullable|string',
            
            // Contact Section
            'contact_badge' => 'nullable|string|max:255',
            'contact_title' => 'nullable|string|max:500',
            'contact_description' => 'nullable|string',
            'contact_email' => 'nullable|email|max:255',
            'contact_button_text' => 'nullable|string|max:255',
        ]);

        // Clean up empty arrays
        if (isset($validated['why_join_items']) && empty(array_filter($validated['why_join_items']))) {
            $validated['why_join_items'] = null;
        }
        if (isset($validated['job_positions']) && empty(array_filter($validated['job_positions'], function($item) {
            return !empty($item['title']);
        }))) {
            $validated['job_positions'] = null;
        }
        if (isset($validated['benefits_items']) && empty(array_filter($validated['benefits_items'], function($item) {
            return !empty($item['title']);
        }))) {
            $validated['benefits_items'] = null;
        }
        if (isset($validated['application_steps']) && empty(array_filter($validated['application_steps'], function($item) {
            return !empty($item['step']);
        }))) {
            $validated['application_steps'] = null;
        }

        $content->update($validated);

        return redirect()->route('admin.careers-page-content.index')->with('success', 'Careers page content updated successfully.');
    }
}
