@php
    $navItems = [
        ['label' => 'About', 'href' => '#about'],
        ['label' => 'Program', 'href' => '#featured-program'],
        ['label' => 'Offers', 'href' => '#offers'],
        ['label' => 'Payments', 'href' => '#payments'],
        ['label' => 'FAQ', 'href' => '#faq'],
    ];
@endphp

<header class="sticky top-0 z-50 border-b border-white/10 bg-ink/90 backdrop-blur">
  <div class="mx-auto max-w-6xl px-4">
    <div class="flex h-16 items-center justify-between gap-4">
      <a href="#main" class="flex items-center gap-3 text-white">
        <span class="flex h-10 w-10 items-center justify-center rounded-full bg-accent text-sm font-bold text-ink">PM</span>
        <span class="leading-tight">
          <span class="block font-display text-sm font-semibold uppercase tracking-[0.1em] text-white/70">Paul Mwaikenda</span>
          <span class="block text-sm text-white">Part-Time Business Coach</span>
        </span>
      </a>

      <nav class="hidden items-center gap-6 text-sm text-white/80 md:flex">
        @foreach ($navItems as $item)
          <a href="{{ $item['href'] }}" class="transition hover:text-white">{{ $item['label'] }}</a>
        @endforeach
      </nav>

      <div class="hidden items-center gap-3 sm:flex">
        <a
          href="#"
          data-call-link
          class="rounded-full border border-white/20 px-4 py-2 text-sm font-semibold text-white transition hover:border-white/40 hover:bg-white/10"
        >
          Call
        </a>
        <a
          href="#"
          data-wa-link
          data-message="Habari Paul, nimetoka kwenye website yako. Naomba unielekeze hatua ya kuanza."
          class="rounded-full bg-whatsapp px-4 py-2 text-sm font-semibold text-white shadow-lg shadow-green-900/20 transition hover:bg-green-500"
        >
          Chat on WhatsApp
        </a>
      </div>

      <button
        type="button"
        id="menuToggle"
        class="inline-flex h-11 w-11 items-center justify-center rounded-full border border-white/20 text-white md:hidden"
        aria-controls="mobileMenu"
        aria-expanded="false"
        aria-label="Open menu"
      >
        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M4 7h16M4 12h16M4 17h16"></path>
        </svg>
      </button>
    </div>

    <div id="mobileMenu" class="hidden border-t border-white/10 py-4 md:hidden">
      <div class="grid gap-3">
        <a href="#about" class="rounded-2xl border border-white/10 px-4 py-3 text-white/90 transition hover:bg-white/10">Start Here</a>
        <a href="#featured-program" class="rounded-2xl border border-white/10 px-4 py-3 text-white/90 transition hover:bg-white/10">Featured Program</a>
        <a href="#offers" class="rounded-2xl border border-white/10 px-4 py-3 text-white/90 transition hover:bg-white/10">View Offers</a>
        <a href="#payments" class="rounded-2xl border border-white/10 px-4 py-3 text-white/90 transition hover:bg-white/10">Payment Options</a>
        <a
          href="#"
          data-wa-link
          data-message="Habari Paul, nimefungua website yako kwenye simu. Naomba msaada kupitia WhatsApp."
          class="rounded-2xl bg-whatsapp px-4 py-3 text-center font-semibold text-white"
        >
          Chat on WhatsApp
        </a>
        <a href="#" data-call-link class="rounded-2xl border border-white/10 px-4 py-3 text-center font-semibold text-white">Call Now</a>
      </div>
    </div>
  </div>
</header>
