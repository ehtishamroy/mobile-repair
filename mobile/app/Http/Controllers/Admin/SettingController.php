<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Display the settings form.
     */
    public function index()
    {
        $settings = Setting::getSettings();
        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Update the settings.
     */
    public function update(Request $request)
    {
        $settings = Setting::getSettings();

        // Prepare validation rules
        $rules = [
            'website_name' => 'nullable|string|max:255',
            'website_title' => 'nullable|string|max:255',
            'website_description' => 'nullable|string',
            'website_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'favicon' => 'nullable|image|mimes:ico,png,jpg,jpeg|max:512',
            'promo_title' => 'nullable|string|max:255',
            'contact_email' => 'nullable|email|max:255',
            'currency' => 'required|in:USD,GBP',
            'currency_symbol' => 'nullable|string|max:10',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:500',
            'og_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

        // For URL fields, validate only if not empty
        $urlFields = ['facebook_url', 'instagram_url', 'tiktok_url', 'youtube_url'];
        foreach ($urlFields as $field) {
            if ($request->filled($field)) {
                $rules[$field] = 'url|max:255';
            } else {
                $rules[$field] = 'nullable|string|max:255';
            }
        }

        $validated = $request->validate($rules);

        // Ensure all text fields are included even if empty
        $textFields = [
            'website_name', 'website_title', 'website_description', 'promo_title',
            'contact_email', 'currency_symbol', 'facebook_url', 'instagram_url',
            'tiktok_url', 'youtube_url', 'meta_title', 'meta_description', 'meta_keywords'
        ];
        
        foreach ($textFields as $field) {
            if ($request->has($field)) {
                $value = $request->input($field);
                $validated[$field] = !empty(trim($value)) ? trim($value) : null;
            }
        }

        // Set currency symbol based on currency if not provided
        if (!isset($validated['currency_symbol']) || empty($validated['currency_symbol'])) {
            $validated['currency_symbol'] = $validated['currency'] === 'GBP' ? '£' : '$';
        }

        // Handle logo upload
        if ($request->hasFile('website_logo')) {
            // Delete old logo if exists
            if ($settings->website_logo && Storage::disk('public')->exists($settings->website_logo)) {
                Storage::disk('public')->delete($settings->website_logo);
            }
            $validated['website_logo'] = $request->file('website_logo')->store('settings', 'public');
        } else {
            // Keep existing logo if no new file uploaded
            unset($validated['website_logo']);
        }

        // Handle favicon upload
        if ($request->hasFile('favicon')) {
            // Delete old favicon if exists
            if ($settings->favicon && Storage::disk('public')->exists($settings->favicon)) {
                Storage::disk('public')->delete($settings->favicon);
            }
            $validated['favicon'] = $request->file('favicon')->store('settings', 'public');
        } else {
            // Keep existing favicon if no new file uploaded
            unset($validated['favicon']);
        }

        // Handle OG image upload
        if ($request->hasFile('og_image')) {
            // Delete old OG image if exists
            if ($settings->og_image && Storage::disk('public')->exists($settings->og_image)) {
                Storage::disk('public')->delete($settings->og_image);
            }
            $validated['og_image'] = $request->file('og_image')->store('settings', 'public');
        } else {
            // Keep existing OG image if no new file uploaded
            unset($validated['og_image']);
        }

        // Ensure currency is always set
        if (!isset($validated['currency'])) {
            $validated['currency'] = $settings->currency ?? 'USD';
        }

        // Update settings with validated data
        try {
            $settings->fill($validated);
            $settings->save();
            
            return redirect()->route('admin.settings.index')->with('success', 'Settings updated successfully.');
        } catch (\Exception $e) {
            \Log::error('Settings update failed: ' . $e->getMessage());
            return back()->with('error', 'Failed to update settings: ' . $e->getMessage())->withInput();
        }
    }
}
