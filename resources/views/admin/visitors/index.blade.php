@extends('admin.layout')

@section('title', 'Page Visitors')
@section('page-title', 'Page Visitors')

@section('page-actions')
    <span class="text-sm text-slate-400">{{ $visitors->total() }} total · {{ $totalToday }} today · {{ $uniqueToday }} unique</span>
@endsection

@section('content')
    <!-- Filters -->
    <div class="rounded-2xl bg-panel border border-white/5 p-5 mb-6">
        <form method="GET" action="{{ route('admin.visitors.index') }}" class="flex flex-col gap-3 sm:flex-row sm:items-end">
            <div class="flex-1">
                <label class="block text-xs font-semibold text-slate-500 mb-1.5">Search</label>
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="IP address, URL, referrer..."
                    class="w-full rounded-xl border border-white/10 bg-white/5 px-4 py-2.5 text-sm text-white placeholder-slate-500 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent"
                >
            </div>
            <div class="w-full sm:w-40">
                <label class="block text-xs font-semibold text-slate-500 mb-1.5">From</label>
                <input
                    type="date"
                    name="date_from"
                    value="{{ request('date_from') }}"
                    class="w-full rounded-xl border border-white/10 bg-white/5 px-4 py-2.5 text-sm text-white focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent [color-scheme:dark]"
                >
            </div>
            <div class="w-full sm:w-40">
                <label class="block text-xs font-semibold text-slate-500 mb-1.5">To</label>
                <input
                    type="date"
                    name="date_to"
                    value="{{ request('date_to') }}"
                    class="w-full rounded-xl border border-white/10 bg-white/5 px-4 py-2.5 text-sm text-white focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent [color-scheme:dark]"
                >
            </div>
            <div class="flex gap-2">
                <button type="submit" class="rounded-xl bg-accent px-5 py-2.5 text-sm font-semibold text-ink hover:bg-amber-400 transition">Filter</button>
                @if(request()->hasAny(['search', 'date_from', 'date_to']))
                    <a href="{{ route('admin.visitors.index') }}" class="rounded-xl border border-white/10 px-4 py-2.5 text-sm text-slate-400 hover:text-white hover:border-white/20 transition">Clear</a>
                @endif
            </div>
        </form>
    </div>

    <!-- Table -->
    <div class="rounded-2xl bg-panel border border-white/5 overflow-hidden">
        @if($visitors->isEmpty())
            <div class="px-5 py-12 text-center">
                <p class="text-slate-400 text-sm">No visits recorded yet.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-white/5 text-left">
                            <th class="px-5 py-3 text-xs font-semibold uppercase tracking-wider text-slate-500">IP Address</th>
                            <th class="px-5 py-3 text-xs font-semibold uppercase tracking-wider text-slate-500">URL</th>
                            <th class="px-5 py-3 text-xs font-semibold uppercase tracking-wider text-slate-500 hidden md:table-cell">Referrer</th>
                            <th class="px-5 py-3 text-xs font-semibold uppercase tracking-wider text-slate-500 hidden lg:table-cell">Browser</th>
                            <th class="px-5 py-3 text-xs font-semibold uppercase tracking-wider text-slate-500">Time</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @foreach($visitors as $visit)
                            <tr class="hover:bg-white/5 transition">
                                <td class="px-5 py-3 font-mono text-xs text-white">{{ $visit->ip_address }}</td>
                                <td class="px-5 py-3 text-slate-300 max-w-[200px] truncate">{{ $visit->url }}</td>
                                <td class="px-5 py-3 text-slate-400 max-w-[150px] truncate hidden md:table-cell">{{ $visit->referrer ?: '—' }}</td>
                                <td class="px-5 py-3 text-slate-500 max-w-[200px] truncate text-xs hidden lg:table-cell">
                                    @php
                                        $ua = $visit->user_agent ?? '';
                                        if (str_contains($ua, 'Chrome')) $browser = 'Chrome';
                                        elseif (str_contains($ua, 'Firefox')) $browser = 'Firefox';
                                        elseif (str_contains($ua, 'Safari')) $browser = 'Safari';
                                        elseif (str_contains($ua, 'Edge')) $browser = 'Edge';
                                        else $browser = 'Other';

                                        if (str_contains($ua, 'Mobile')) $device = '📱';
                                        else $device = '🖥️';
                                    @endphp
                                    {{ $device }} {{ $browser }}
                                </td>
                                <td class="px-5 py-3 text-xs text-slate-500 whitespace-nowrap">{{ $visit->visited_at->format('d M Y, H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($visitors->hasPages())
                <div class="border-t border-white/5 px-5 py-4">
                    {{ $visitors->links('pagination::simple-tailwind') }}
                </div>
            @endif
        @endif
    </div>
@endsection
