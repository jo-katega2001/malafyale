<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Illuminate\Http\Request;

class LeadCrudController extends Controller
{
    public function index(Request $request)
    {
        $query = Lead::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('instagram', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        $sortField = $request->input('sort', 'created_at');
        $sortDirection = $request->input('direction', 'desc');
        $allowedSorts = ['name', 'email', 'status', 'created_at', 'location'];
        if (!in_array($sortField, $allowedSorts)) {
            $sortField = 'created_at';
        }

        $leads = $query->orderBy($sortField, $sortDirection)->paginate(20)->withQueryString();

        return view('admin.leads.index', compact('leads'));
    }

    public function show(Lead $lead)
    {
        return view('admin.leads.show', compact('lead'));
    }

    public function edit(Lead $lead)
    {
        return view('admin.leads.edit', compact('lead'));
    }

    public function update(Request $request, Lead $lead)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'occupation' => ['nullable', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'instagram' => ['nullable', 'string', 'max:120'],
            'interest' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'in:new,contacted,converted'],
        ]);

        $lead->update($validated);

        return redirect()->route('admin.leads.show', $lead)
            ->with('success', 'Lead updated successfully.');
    }

    public function destroy(Lead $lead)
    {
        $lead->delete();

        return redirect()->route('admin.leads.index')
            ->with('success', 'Lead deleted successfully.');
    }

    public function updateStatus(Request $request, Lead $lead)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:new,contacted,converted'],
        ]);

        $lead->update(['status' => $validated['status']]);

        return back()->with('success', 'Status updated to ' . $validated['status'] . '.');
    }
}
