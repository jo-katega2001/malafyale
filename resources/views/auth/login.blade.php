<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Portal Login — Paul Mwaikenda</title>
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
                    },
                    fontFamily: {
                        sans: ['Instrument Sans', 'ui-sans-serif', 'system-ui', 'sans-serif']
                    }
                }
            }
        };
    </script>
</head>
<body class="bg-ink min-h-screen flex items-center justify-center font-sans antialiased">
    <div class="w-full max-w-md px-6">
        <div class="text-center mb-8">
            <div class="inline-flex h-16 w-16 items-center justify-center rounded-2xl bg-accent text-2xl font-bold text-ink mx-auto">PM</div>
            <h1 class="mt-4 text-2xl font-semibold text-white tracking-tight">Portal Login</h1>
            <p class="mt-2 text-sm text-slate-400">Sign in to manage leads and view analytics</p>
        </div>

        <div class="rounded-2xl bg-panel border border-white/10 p-8 shadow-2xl">
            @if ($errors->any())
                <div class="mb-6 rounded-xl bg-red-500/10 border border-red-500/20 px-4 py-3 text-sm text-red-400">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.submit') }}">
                @csrf
                <div class="space-y-5">
                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-300 mb-2">Email</label>
                        <input
                            id="email"
                            name="email"
                            type="email"
                            value="{{ old('email') }}"
                            autocomplete="email"
                            required
                            class="w-full rounded-xl border border-white/10 bg-white/5 px-4 py-3 text-white placeholder-slate-500 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent transition"
                            placeholder="admin@mwalafyale.com"
                        >
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-slate-300 mb-2">Password</label>
                        <input
                            id="password"
                            name="password"
                            type="password"
                            autocomplete="current-password"
                            required
                            class="w-full rounded-xl border border-white/10 bg-white/5 px-4 py-3 text-white placeholder-slate-500 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent transition"
                            placeholder="••••••••"
                        >
                    </div>
                    <div class="flex items-center gap-2">
                        <input id="remember" name="remember" type="checkbox" class="h-4 w-4 rounded border-white/20 bg-white/5 text-accent focus:ring-accent">
                        <label for="remember" class="text-sm text-slate-400">Remember me</label>
                    </div>
                    <button
                        type="submit"
                        class="w-full rounded-xl bg-accent px-4 py-3 text-base font-semibold text-ink transition hover:bg-amber-400 focus:outline-none focus:ring-2 focus:ring-accent focus:ring-offset-2 focus:ring-offset-ink"
                    >
                        Sign In
                    </button>
                </div>
            </form>
        </div>

        <p class="mt-6 text-center text-xs text-slate-500">
            <a href="/" class="text-accent hover:underline">← Back to website</a>
        </p>
    </div>
</body>
</html>
