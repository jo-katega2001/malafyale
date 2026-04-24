<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin') — Paul Mwaikenda</title>
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><rect width='100' height='100' rx='20' fill='%23081423'/><text x='50' y='68' font-family='sans-serif' font-size='42' font-weight='bold' fill='%23c7964d' text-anchor='middle'>PM</text></svg>">
    <link rel="preconnect" href="https://fonts.bunny.net" crossorigin>
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        ink: "#081423",
                        panel: "#10233c",
                        sand: "#f7f2ea",
                        accent: "#c7964d",
                        surface: "#0d1c30",
                    },
                    fontFamily: {
                        sans: ['Instrument Sans', 'ui-sans-serif', 'system-ui', 'sans-serif']
                    },
                    boxShadow: {
                        lift: "0 20px 60px rgba(8,20,35,0.18)",
                        soft: "0 14px 40px rgba(16,35,60,0.12)",
                    }
                }
            }
        };
    </script>
    <style>
        body { font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif; }
        .sidebar-link { transition: all 0.15s ease; }
        .sidebar-link:hover, .sidebar-link.active { background: rgba(199,150,77,0.12); color: #c7964d; }
        .sidebar-link.active { border-right: 3px solid #c7964d; }
    </style>
</head>
<body class="bg-ink text-slate-200 antialiased min-h-screen flex">

    <!-- Sidebar -->
    <aside class="hidden lg:flex lg:flex-col w-64 bg-surface border-r border-white/5 fixed inset-y-0 left-0 z-30">
        <div class="px-6 py-5 border-b border-white/5">
            <a href="/admin" class="flex items-center gap-3">
                <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-accent text-sm font-bold text-ink">PM</span>
                <span class="leading-tight">
                    <span class="block text-sm font-semibold text-white">Admin Panel</span>
                    <span class="block text-xs text-slate-500">Paul Mwaikenda</span>
                </span>
            </a>
        </div>

        <nav class="flex-1 py-4">
            <a href="{{ route('admin.dashboard') }}" class="sidebar-link flex items-center gap-3 px-6 py-3 text-sm font-medium text-slate-400 {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z"/></svg>
                Dashboard
            </a>
            <a href="{{ route('admin.leads.index') }}" class="sidebar-link flex items-center gap-3 px-6 py-3 text-sm font-medium text-slate-400 {{ request()->routeIs('admin.leads.*') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/></svg>
                Leads
            </a>
            <a href="{{ route('admin.visitors.index') }}" class="sidebar-link flex items-center gap-3 px-6 py-3 text-sm font-medium text-slate-400 {{ request()->routeIs('admin.visitors.*') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                Page Visitors
            </a>
        </nav>

        <div class="border-t border-white/5 px-6 py-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-white">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-slate-500">{{ auth()->user()->email }}</p>
                </div>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="rounded-lg p-2 text-slate-500 transition hover:bg-white/5 hover:text-red-400" title="Logout">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9"/></svg>
                    </button>
                </form>
            </div>
            <a href="/" target="_blank" class="mt-3 block text-center text-xs text-accent hover:underline">← View Website</a>
        </div>
    </aside>

    <!-- Mobile header -->
    <div class="lg:hidden fixed top-0 inset-x-0 z-30 bg-surface border-b border-white/5 px-4 py-3 flex items-center justify-between">
        <a href="/admin" class="flex items-center gap-2">
            <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-accent text-xs font-bold text-ink">PM</span>
            <span class="text-sm font-semibold text-white">Admin</span>
        </a>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.dashboard') }}" class="rounded-lg p-2 text-slate-400 hover:text-white"><svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z"/></svg></a>
            <a href="{{ route('admin.leads.index') }}" class="rounded-lg p-2 text-slate-400 hover:text-white"><svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/></svg></a>
            <a href="{{ route('admin.visitors.index') }}" class="rounded-lg p-2 text-slate-400 hover:text-white"><svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg></a>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="rounded-lg p-2 text-slate-400 hover:text-red-400"><svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9"/></svg></button>
            </form>
        </div>
    </div>

    <!-- Main content -->
    <main class="flex-1 lg:ml-64 pt-16 lg:pt-0 min-h-screen">
        <!-- Top bar -->
        <div class="border-b border-white/5 bg-surface/50 px-6 py-4 backdrop-blur hidden lg:block">
            <div class="flex items-center justify-between">
                <h1 class="text-lg font-semibold text-white">@yield('page-title', 'Dashboard')</h1>
                <div class="flex items-center gap-4">
                    @yield('page-actions')
                </div>
            </div>
        </div>

        <div class="p-4 md:p-6 lg:p-8">
            @if (session('success'))
                <div class="mb-6 rounded-xl bg-emerald-500/10 border border-emerald-500/20 px-5 py-3 text-sm text-emerald-400">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="mb-6 rounded-xl bg-red-500/10 border border-red-500/20 px-5 py-3 text-sm text-red-400">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </div>
    </main>
</body>
</html>
