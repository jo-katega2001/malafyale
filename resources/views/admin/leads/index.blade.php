@extends('admin.layout')

@section('title', 'Leads')
@section('page-title', 'All Leads')

@section('page-actions')
    <span class="text-sm text-slate-400">{{ $leads->total() }} total</span>
@endsection

@section('content')
    <!-- Filters -->
    <div class="rounded-2xl bg-panel border border-white/5 p-5 mb-6">
        <form method="GET" action="{{ route('admin.leads.index') }}" class="flex flex-col gap-3 sm:flex-row sm:items-end">
            <div class="flex-1">
                <label class="block text-xs font-semibold text-slate-500 mb-1.5">Search</label>
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Name, email, phone, Instagram, location..."
                    class="w-full rounded-xl border border-white/10 bg-white/5 px-4 py-2.5 text-sm text-white placeholder-slate-500 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent"
                >
            </div>
            <div class="w-full sm:w-40">
                <label class="block text-xs font-semibold text-slate-500 mb-1.5">Status</label>
                <select name="status" class="w-full rounded-xl border border-white/10 bg-white/5 px-4 py-2.5 text-sm text-white focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                    <option value="">All</option>
                    <option value="new" {{ request('status') === 'new' ? 'selected' : '' }}>New</option>
                    <option value="contacted" {{ request('status') === 'contacted' ? 'selected' : '' }}>Contacted</option>
                    <option value="converted" {{ request('status') === 'converted' ? 'selected' : '' }}>Converted</option>
                </select>
            </div>
            <div class="flex gap-2">
                <button type="submit" class="rounded-xl bg-accent px-5 py-2.5 text-sm font-semibold text-ink hover:bg-amber-400 transition">Filter</button>
                @if(request()->hasAny(['search', 'status']))
                    <a href="{{ route('admin.leads.index') }}" class="rounded-xl border border-white/10 px-4 py-2.5 text-sm text-slate-400 hover:text-white hover:border-white/20 transition">Clear</a>
                @endif
            </div>
        </form>
    </div>

    <!-- Table -->
    <div class="rounded-2xl bg-panel border border-white/5 overflow-hidden">
        @if($leads->isEmpty())
            <div class="px-5 py-12 text-center">
                <p class="text-slate-400 text-sm">No leads found.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-white/5 text-left">
                            <th class="px-5 py-3 text-xs font-semibold uppercase tracking-wider text-slate-500">#</th>
                            <th class="px-5 py-3 text-xs font-semibold uppercase tracking-wider text-slate-500">Name</th>
                            <th class="px-5 py-3 text-xs font-semibold uppercase tracking-wider text-slate-500">Phone</th>
                            <th class="px-5 py-3 text-xs font-semibold uppercase tracking-wider text-slate-500 hidden md:table-cell">Location</th>
                            <th class="px-5 py-3 text-xs font-semibold uppercase tracking-wider text-slate-500 hidden lg:table-cell">Instagram</th>
                            <th class="px-5 py-3 text-xs font-semibold uppercase tracking-wider text-slate-500">Status</th>
                            <th class="px-5 py-3 text-xs font-semibold uppercase tracking-wider text-slate-500">Date</th>
                            <th class="px-5 py-3 text-xs font-semibold uppercase tracking-wider text-slate-500">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @foreach($leads as $lead)
                            <tr class="hover:bg-white/5 transition">
                                <td class="px-5 py-3 text-slate-500">{{ $lead->id }}</td>
                                <td class="px-5 py-3">
                                    <a href="{{ route('admin.leads.show', $lead) }}" class="text-white font-medium hover:text-accent transition">{{ $lead->name }}</a>
                                    <p class="text-xs text-slate-500 mt-0.5">{{ $lead->occupation ?: '—' }}</p>
                                </td>
                                <td class="px-5 py-3 text-slate-300 font-mono text-xs">{{ $lead->phone ?: '—' }}</td>
                                <td class="px-5 py-3 text-slate-400 hidden md:table-cell">{{ $lead->location ?: '—' }}</td>
                                <td class="px-5 py-3 text-slate-400 hidden lg:table-cell">{{ $lead->instagram ?: '—' }}</td>
                                <td class="px-5 py-3">
                                    <form method="POST" action="{{ route('admin.leads.update-status', $lead) }}" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        @php
                                            $colors = ['new' => 'bg-emerald-500/20 text-emerald-400 border-emerald-500/30', 'contacted' => 'bg-amber-500/20 text-amber-400 border-amber-500/30', 'converted' => 'bg-accent/20 text-accent border-accent/30'];
                                            $nextStatus = ['new' => 'contacted', 'contacted' => 'converted', 'converted' => 'new'];
                                        @endphp
                                        <input type="hidden" name="status" value="{{ $nextStatus[$lead->status] ?? 'new' }}">
                                        <button type="submit" title="Click to change status" class="inline-flex items-center rounded-full border px-2.5 py-1 text-[10px] font-bold uppercase tracking-wider {{ $colors[$lead->status] ?? $colors['new'] }} hover:opacity-80 transition cursor-pointer">
                                            {{ $lead->status }}
                                        </button>
                                    </form>
                                </td>
                                <td class="px-5 py-3 text-xs text-slate-500 whitespace-nowrap">{{ $lead->created_at->format('d M Y') }}</td>
                                <td class="px-5 py-3">
                                    <div class="flex items-center gap-1">
                                        <a href="{{ route('admin.leads.show', $lead) }}" class="rounded-lg p-1.5 text-slate-400 hover:text-white hover:bg-white/10 transition" title="View">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                        </a>
                                        <a href="{{ route('admin.leads.edit', $lead) }}" class="rounded-lg p-1.5 text-slate-400 hover:text-white hover:bg-white/10 transition" title="Edit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/></svg>
                                        </a>
                                        <form method="POST" action="{{ route('admin.leads.destroy', $lead) }}" onsubmit="return confirm('Delete this lead?')" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="rounded-lg p-1.5 text-slate-400 hover:text-red-400 hover:bg-red-500/10 transition" title="Delete">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($leads->hasPages())
                <div class="border-t border-white/5 px-5 py-4">
                    {{ $leads->links('pagination::simple-tailwind') }}
                </div>
            @endif
        @endif
    </div>
@endsection
