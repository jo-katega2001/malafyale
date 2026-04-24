@extends('admin.layout')

@section('title', 'Lead: ' . $lead->name)
@section('page-title', 'Lead Details')

@section('page-actions')
    <a href="{{ route('admin.leads.edit', $lead) }}" class="rounded-xl bg-accent px-4 py-2 text-sm font-semibold text-ink hover:bg-amber-400 transition">Edit Lead</a>
    <a href="{{ route('admin.leads.index') }}" class="rounded-xl border border-white/10 px-4 py-2 text-sm text-slate-400 hover:text-white transition">← Back</a>
@endsection

@section('content')
    <div class="max-w-3xl">
        <!-- Status Bar -->
        <div class="rounded-2xl bg-panel border border-white/5 p-5 mb-6 flex flex-wrap items-center justify-between gap-4">
            <div>
                <h2 class="text-xl font-bold text-white">{{ $lead->name }}</h2>
                <p class="text-sm text-slate-400 mt-1">Submitted {{ $lead->created_at->format('d M Y, H:i') }} · {{ $lead->created_at->diffForHumans() }}</p>
            </div>
            <form method="POST" action="{{ route('admin.leads.update-status', $lead) }}">
                @csrf
                @method('PATCH')
                <div class="flex items-center gap-2">
                    <select name="status" onchange="this.form.submit()" class="rounded-xl border border-white/10 bg-white/5 px-4 py-2 text-sm text-white focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent cursor-pointer">
                        <option value="new" {{ $lead->status === 'new' ? 'selected' : '' }}>🟢 New</option>
                        <option value="contacted" {{ $lead->status === 'contacted' ? 'selected' : '' }}>🟡 Contacted</option>
                        <option value="converted" {{ $lead->status === 'converted' ? 'selected' : '' }}>🟠 Converted</option>
                    </select>
                </div>
            </form>
        </div>

        <!-- Details Grid -->
        <div class="grid gap-4 sm:grid-cols-2 mb-6">
            <div class="rounded-2xl bg-panel border border-white/5 p-5">
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500 mb-3">Personal Info</p>
                <dl class="space-y-3">
                    <div>
                        <dt class="text-xs text-slate-500">Full Name</dt>
                        <dd class="text-sm text-white font-medium">{{ $lead->name }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs text-slate-500">Occupation</dt>
                        <dd class="text-sm text-white">{{ $lead->occupation ?: '—' }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs text-slate-500">Location</dt>
                        <dd class="text-sm text-white">{{ $lead->location ?: '—' }}</dd>
                    </div>
                </dl>
            </div>
            <div class="rounded-2xl bg-panel border border-white/5 p-5">
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500 mb-3">Contact Info</p>
                <dl class="space-y-3">
                    <div>
                        <dt class="text-xs text-slate-500">Phone / WhatsApp</dt>
                        <dd class="text-sm text-white font-mono">{{ $lead->phone ?: '—' }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs text-slate-500">Email</dt>
                        <dd class="text-sm text-white">{{ $lead->email ?: '—' }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs text-slate-500">Instagram</dt>
                        <dd class="text-sm text-white">{{ $lead->instagram ?: '—' }}</dd>
                    </div>
                </dl>
            </div>
        </div>

        <!-- Other Info -->
        <div class="rounded-2xl bg-panel border border-white/5 p-5 mb-6">
            <p class="text-xs font-semibold uppercase tracking-wider text-slate-500 mb-3">Other Details</p>
            <dl class="grid gap-3 sm:grid-cols-2">
                <div>
                    <dt class="text-xs text-slate-500">Interest</dt>
                    <dd class="text-sm text-white">{{ $lead->interest ?: '—' }}</dd>
                </div>
                <div>
                    <dt class="text-xs text-slate-500">Source</dt>
                    <dd class="text-sm text-white">{{ $lead->source }}</dd>
                </div>
                @if($lead->metadata)
                    <div>
                        <dt class="text-xs text-slate-500">IP Address</dt>
                        <dd class="text-sm text-white font-mono">{{ $lead->metadata['ip_address'] ?? '—' }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs text-slate-500">Submitted At</dt>
                        <dd class="text-sm text-white">{{ $lead->metadata['submitted_at'] ?? '—' }}</dd>
                    </div>
                @endif
            </dl>
        </div>

        <!-- Actions -->
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.leads.edit', $lead) }}" class="rounded-xl bg-accent px-5 py-2.5 text-sm font-semibold text-ink hover:bg-amber-400 transition">Edit Lead</a>
            <form method="POST" action="{{ route('admin.leads.destroy', $lead) }}" onsubmit="return confirm('Are you sure you want to delete this lead?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="rounded-xl border border-red-500/30 px-5 py-2.5 text-sm font-semibold text-red-400 hover:bg-red-500/10 transition">Delete Lead</button>
            </form>
        </div>
    </div>
@endsection
