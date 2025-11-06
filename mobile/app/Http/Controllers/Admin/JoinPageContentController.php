<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JoinPageContent;
use Illuminate\Http\Request;

class JoinPageContentController extends Controller
{
    /**
     * Display the join page content editing form.
     */
    public function index()
    {
        $content = JoinPageContent::getContent();
        return view('admin.join-page-content.index', compact('content'));
    }

    /**
     * Update the join page content.
     */
    public function update(Request $request)
    {
        $content = JoinPageContent::getContent();

        $validated = $request->validate([
            // Hero Section
            'hero_title' => 'nullable|string|max:500',
            'hero_description' => 'nullable|string',
            
            // Our Team Section
            'our_team_badge' => 'nullable|string|max:255',
            'our_team_title' => 'nullable|string|max:500',
            'our_team_description' => 'nullable|string',
            'our_team_features' => 'nullable|array',
            'our_team_features.*' => 'nullable|string|max:255',
            
            // Meet Our Team Section
            'meet_team_badge' => 'nullable|string|max:255',
            'meet_team_title' => 'nullable|string|max:500',
            'team_members' => 'nullable|array',
            'team_members.*.name' => 'nullable|string|max:255',
            'team_members.*.designation' => 'nullable|string|max:255',
            
            // Join Us Section
            'join_us_badge' => 'nullable|string|max:255',
            'join_us_title' => 'nullable|string|max:500',
            'join_us_description' => 'nullable|string',
            'join_us_button_text' => 'nullable|string|max:255',
        ]);

        // Clean up empty arrays
        if (isset($validated['our_team_features']) && empty(array_filter($validated['our_team_features']))) {
            $validated['our_team_features'] = null;
        }
        if (isset($validated['team_members']) && empty(array_filter($validated['team_members']))) {
            $validated['team_members'] = null;
        }

        $content->update($validated);

        return redirect()->route('admin.join-page-content.index')->with('success', 'Join page content updated successfully.');
    }
}
