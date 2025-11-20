<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RepairIssue;
use App\Models\RepairService;
use Illuminate\Http\Request;

class RepairIssueController extends Controller
{
    public function index()
    {
        $issues = RepairIssue::with('service')->orderBy('order')->latest()->paginate(15);
        return view('admin.repair-issues.index', compact('issues'));
    }

    public function create()
    {
        $services = RepairService::where('is_active', true)->orderBy('order')->get();
        return view('admin.repair-issues.create', compact('services'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'repair_service_id' => 'required|exists:repair_services,id',
            'name' => 'required|string|max:255',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        RepairIssue::create($validated);

        return redirect()->route('admin.repair-issues.index')->with('success', 'Issue created successfully.');
    }

    public function edit(string $id)
    {
        $issue = RepairIssue::findOrFail($id);
        $services = RepairService::where('is_active', true)->orderBy('order')->get();
        return view('admin.repair-issues.edit', compact('issue', 'services'));
    }

    public function update(Request $request, string $id)
    {
        $issue = RepairIssue::findOrFail($id);

        $validated = $request->validate([
            'repair_service_id' => 'required|exists:repair_services,id',
            'name' => 'required|string|max:255',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $issue->update($validated);

        return redirect()->route('admin.repair-issues.index')->with('success', 'Issue updated successfully.');
    }

    public function destroy(string $id)
    {
        $issue = RepairIssue::findOrFail($id);
        $issue->delete();

        return redirect()->route('admin.repair-issues.index')->with('success', 'Issue deleted successfully.');
    }
}
