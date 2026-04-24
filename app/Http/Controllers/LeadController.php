<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'occupation' => ['nullable', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'instagram' => ['nullable', 'string', 'max:120'],
            'interest' => ['nullable', 'string', 'max:255'],
            'source' => ['nullable', 'string', 'max:60'],
        ]);

        $lead = Lead::create([
            'name' => $validated['name'],
            'occupation' => $validated['occupation'] ?? null,
            'location' => $validated['location'] ?? null,
            'email' => $validated['email'] ?? null,
            'phone' => $validated['phone'] ?? null,
            'instagram' => $validated['instagram'] ?? null,
            'interest' => $validated['interest'] ?? null,
            'source' => $validated['source'] ?? 'website',
            'status' => 'new',
            'metadata' => [
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'submitted_at' => now()->toIso8601String(),
            ],
        ]);

        return response()->json([
            'message' => __('messages.lead.request_received'),
            'lead_id' => $lead->id,
        ], 201);
    }
}
