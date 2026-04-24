@extends('admin.layout')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
    <!-- Stats Grid -->
    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4 mb-8">
        <div class="rounded-2xl bg-panel border border-white/5 p-5">
            <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Total Leads</p>
            <p class="mt-2 text-3xl font-bold text-white">{{ $totalLeads }}</p>
            <p class="mt-1 text-sm text-slate-400">{{ $leadsToday }} today · {{ $leadsThisWeek }} this week</p>
        </div>
        <div class="rounded-2xl bg-panel border border-white/5 p-5">
            <p class="text-xs font-semibold uppercase tracking-wider text-emerald-400">New Leads</p>
            <p class="mt-2 text-3xl font-bold text-emerald-400">{{ $newLeads }}</p>
            <p class="mt-1 text-sm text-slate-400">Awaiting first contact</p>
        </div>
        <div class="rounded-2xl bg-panel border border-white/5 p-5">
            <p class="text-xs font-semibold uppercase tracking-wider text-amber-400">Contacted</p>
            <p class="mt-2 text-3xl font-bold text-amber-400">{{ $contactedLeads }}</p>
            <p class="mt-1 text-sm text-slate-400">In conversation</p>
        </div>
        <div class="rounded-2xl bg-panel border border-white/5 p-5">
            <p class="text-xs font-semibold uppercase tracking-wider text-accent">Converted</p>
            <p class="mt-2 text-3xl font-bold text-accent">{{ $convertedLeads }}</p>
            <p class="mt-1 text-sm text-slate-400">Successful conversions</p>
        </div>
    </div>

    <!-- Visitors Stats -->
    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4 mb-8">
        <div class="rounded-2xl bg-panel border border-white/5 p-5">
            <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Total Page Views</p>
            <p class="mt-2 text-3xl font-bold text-white">{{ number_format($totalVisits) }}</p>
            <p class="mt-1 text-sm text-slate-400">All time</p>
        </div>
        <div class="rounded-2xl bg-panel border border-white/5 p-5">
            <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Views Today</p>
            <p class="mt-2 text-3xl font-bold text-white">{{ $visitsToday }}</p>
            <p class="mt-1 text-sm text-slate-400">Since midnight</p>
        </div>
        <div class="rounded-2xl bg-panel border border-white/5 p-5">
            <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Unique Visitors</p>
            <p class="mt-2 text-3xl font-bold text-white">{{ number_format($uniqueVisitors) }}</p>
            <p class="mt-1 text-sm text-slate-400">All time (by IP)</p>
        </div>
        <div class="rounded-2xl bg-panel border border-white/5 p-5">
            <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Unique Today</p>
            <p class="mt-2 text-3xl font-bold text-white">{{ $uniqueToday }}</p>
            <p class="mt-1 text-sm text-slate-400">Today's unique IPs</p>
        </div>
    </div>

    <!-- Two columns: Recent Leads + Recent Visitors -->
    <div class="grid gap-6 lg:grid-cols-2">
        <!-- Recent Leads -->
        <div class="rounded-2xl bg-panel border border-white/5 overflow-hidden">
            <div class="flex items-center justify-between px-5 py-4 border-b border-white/5">
                <h2 class="text-sm font-semibold text-white">Recent Leads</h2>
                <a href="{{ route('admin.leads.index') }}" class="text-xs font-semibold text-accent hover:underline">View All →</a>
            </div>
            @if($recentLeads->isEmpty())
                <div class="px-5 py-8 text-center text-sm text-slate-500">No leads yet. They will appear here once visitors fill the form.</div>
            @else
                <div class="divide-y divide-white/5">
                    @foreach($recentLeads as $lead)
                        <a href="{{ route('admin.leads.show', $lead) }}" class="flex items-center justify-between px-5 py-3 hover:bg-white/5 transition">
                            <div class="min-w-0">
                                <p class="text-sm font-medium text-white truncate">{{ $lead->name }}</p>
                                <p class="text-xs text-slate-500 truncate">{{ $lead->phone ?: $lead->email ?: 'No contact info' }}</p>
                            </div>
                            <div class="flex items-center gap-2 flex-shrink-0 ml-3">
                                @php
                                    $colors = ['new' => 'bg-emerald-500/20 text-emerald-400', 'contacted' => 'bg-amber-500/20 text-amber-400', 'converted' => 'bg-accent/20 text-accent'];
                                @endphp
                                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-[10px] font-bold uppercase tracking-wider {{ $colors[$lead->status] ?? $colors['new'] }}">{{ $lead->status }}</span>
                                <span class="text-[11px] text-slate-500">{{ $lead->created_at->diffForHumans() }}</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Recent Visitors -->
        <div class="rounded-2xl bg-panel border border-white/5 overflow-hidden">
            <div class="flex items-center justify-between px-5 py-4 border-b border-white/5">
                <h2 class="text-sm font-semibold text-white">Recent Visitors</h2>
                <a href="{{ route('admin.visitors.index') }}" class="text-xs font-semibold text-accent hover:underline">View All →</a>
            </div>
            @if($recentVisitors->isEmpty())
                <div class="px-5 py-8 text-center text-sm text-slate-500">No visitors tracked yet. They will appear once people visit the site.</div>
            @else
                <div class="divide-y divide-white/5">
                    @foreach($recentVisitors as $visit)
                        <div class="flex items-center justify-between px-5 py-3">
                            <div class="min-w-0">
                                <p class="text-sm font-mono text-white">{{ $visit->ip_address }}</p>
                                <p class="text-xs text-slate-500 truncate max-w-[250px]">{{ $visit->url }}</p>
                            </div>
                            <span class="text-[11px] text-slate-500 flex-shrink-0 ml-3">{{ $visit->visited_at->diffForHumans() }}</span>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
