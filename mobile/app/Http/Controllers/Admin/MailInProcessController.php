<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MailInProcess;
use Illuminate\Http\Request;

class MailInProcessController extends Controller
{
    public function index()
    {
        $content = MailInProcess::first();
        return view('admin.mail-in-process.index', compact('content'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'process_title' => 'required|string|max:255',
            'process_description' => 'nullable|string',
            'timeline_title' => 'required|string|max:255',
            'timeline_description' => 'nullable|string',
        ]);

        $content = MailInProcess::first();
        
        if ($content) {
            $content->update($validated);
        } else {
            MailInProcess::create($validated);
        }

        return redirect()->route('admin.mail-in-process.index')->with('success', 'Mail-in process information updated successfully.');
    }
}
