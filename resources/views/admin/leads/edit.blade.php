@extends('admin.layout')

@section('title', 'Edit: ' . $lead->name)
@section('page-title', 'Edit Lead')

@section('page-actions')
    <a href="{{ route('admin.leads.show', $lead) }}" class="rounded-xl border border-white/10 px-4 py-2 text-sm text-slate-400 hover:text-white transition">← Cancel</a>
@endsection

@section('content')
    <div class="max-w-2xl">
        <div class="rounded-2xl bg-panel border border-white/5 p-6 md:p-8">
            @if ($errors->any())
                <div class="mb-6 rounded-xl bg-red-500/10 border border-red-500/20 px-4 py-3 text-sm text-red-400">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.leads.update', $lead) }}">
                @csrf
                @method('PUT')

                <div class="space-y-5">
                    <div>
                        <label for="name" class="block text-sm font-medium text-slate-300 mb-1.5">Full Name *</label>
                        <input id="name" name="name" type="text" value="{{ old('name', $lead->name) }}" required class="w-full rounded-xl border border-white/10 bg-white/5 px-4 py-3 text-white placeholder-slate-500 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent transition">
                    </div>
                    <div>
                        <label for="occupation" class="block text-sm font-medium text-slate-300 mb-1.5">Occupation</label>
                        <input id="occupation" name="occupation" type="text" value="{{ old('occupation', $lead->occupation) }}" class="w-full rounded-xl border border-white/10 bg-white/5 px-4 py-3 text-white placeholder-slate-500 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent transition">
                    </div>
                    <div>
                        <label for="location" class="block text-sm font-medium text-slate-300 mb-1.5">Location</label>
                        <input id="location" name="location" type="text" value="{{ old('location', $lead->location) }}" class="w-full rounded-xl border border-white/10 bg-white/5 px-4 py-3 text-white placeholder-slate-500 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent transition">
                    </div>
                    <div class="grid gap-5 sm:grid-cols-2">
                        <div>
                            <label for="email" class="block text-sm font-medium text-slate-300 mb-1.5">Email</label>
                            <input id="email" name="email" type="email" value="{{ old('email', $lead->email) }}" class="w-full rounded-xl border border-white/10 bg-white/5 px-4 py-3 text-white placeholder-slate-500 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent transition">
                        </div>
                        <div>
                            <label for="phone" class="block text-sm font-medium text-slate-300 mb-1.5">Phone / WhatsApp</label>
                            <input id="phone" name="phone" type="text" value="{{ old('phone', $lead->phone) }}" class="w-full rounded-xl border border-white/10 bg-white/5 px-4 py-3 text-white placeholder-slate-500 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent transition">
                        </div>
                    </div>
                    <div>
                        <label for="instagram" class="block text-sm font-medium text-slate-300 mb-1.5">Instagram</label>
                        <input id="instagram" name="instagram" type="text" value="{{ old('instagram', $lead->instagram) }}" class="w-full rounded-xl border border-white/10 bg-white/5 px-4 py-3 text-white placeholder-slate-500 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent transition">
                    </div>
                    <div>
                        <label for="interest" class="block text-sm font-medium text-slate-300 mb-1.5">Interest</label>
                        <input id="interest" name="interest" type="text" value="{{ old('interest', $lead->interest) }}" class="w-full rounded-xl border border-white/10 bg-white/5 px-4 py-3 text-white placeholder-slate-500 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent transition">
                    </div>
                    <div>
                        <label for="status" class="block text-sm font-medium text-slate-300 mb-1.5">Status</label>
                        <select id="status" name="status" class="w-full rounded-xl border border-white/10 bg-white/5 px-4 py-3 text-white focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent transition">
                            <option value="new" {{ old('status', $lead->status) === 'new' ? 'selected' : '' }}>🟢 New</option>
                            <option value="contacted" {{ old('status', $lead->status) === 'contacted' ? 'selected' : '' }}>🟡 Contacted</option>
                            <option value="converted" {{ old('status', $lead->status) === 'converted' ? 'selected' : '' }}>🟠 Converted</option>
                        </select>
                    </div>

                    <div class="flex items-center gap-3 pt-4 border-t border-white/5">
                        <button type="submit" class="rounded-xl bg-accent px-6 py-3 text-sm font-semibold text-ink hover:bg-amber-400 transition">Save Changes</button>
                        <a href="{{ route('admin.leads.show', $lead) }}" class="rounded-xl border border-white/10 px-6 py-3 text-sm text-slate-400 hover:text-white transition">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
