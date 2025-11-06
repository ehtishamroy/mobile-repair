<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServicePageContent;
use Illuminate\Http\Request;

class ServicePageContentController extends Controller
{
    /**
     * Display the service page content editing form.
     */
    public function index()
    {
        $content = ServicePageContent::getContent();
        return view('admin.service-page-content.index', compact('content'));
    }

    /**
     * Update the service page content.
     */
    public function update(Request $request)
    {
        $content = ServicePageContent::getContent();

        $validated = $request->validate([
            // Hero Section
            'hero_title' => 'nullable|string|max:500',
            'hero_description' => 'nullable|string',
            
            // What We Offer Section
            'what_we_offer_badge' => 'nullable|string|max:255',
            'what_we_offer_title' => 'nullable|string|max:500',
            'what_we_offer_description' => 'nullable|string',
            'what_we_offer_button_text' => 'nullable|string|max:255',
            'services' => 'nullable|array',
            'services.*.title' => 'nullable|string|max:255',
            'services.*.description' => 'nullable|string',
        ]);

        // Clean up empty arrays
        if (isset($validated['services']) && empty(array_filter($validated['services']))) {
            $validated['services'] = null;
        }

        $content->update($validated);

        return redirect()->route('admin.service-page-content.index')->with('success', 'Service page content updated successfully.');
    }
}
