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

        $validated = $request->validate([
            'website_name' => 'nullable|string|max:255',
            'website_title' => 'nullable|string|max:255',
            'website_description' => 'nullable|string',
            'website_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'favicon' => 'nullable|image|mimes:ico,png,jpg|max:512',
            'promo_title' => 'nullable|string|max:255',
            'currency' => 'required|in:USD,GBP',
            'currency_symbol' => 'nullable|string|max:10',
            'facebook_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'tiktok_url' => 'nullable|url|max:255',
            'youtube_url' => 'nullable|url|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:500',
            'og_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

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
            unset($validated['og_image']);
        }

        $settings->update($validated);

        return redirect()->route('admin.settings.index')->with('success', 'Settings updated successfully.');
    }
}
