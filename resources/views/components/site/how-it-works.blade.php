@php
    $steps = [
        [
            'label' => 'Step 1',
            'title' => 'Discover the right offer',
            'description' => 'Use Quick Actions, browse the offers, or ask directly on WhatsApp if you want help choosing.',
        ],
        [
            'label' => 'Step 2',
            'title' => 'Chat or buy',
            'description' => 'Low-ticket offers can go to hosted checkout. Higher-touch offers can begin with a WhatsApp conversation or call.',
        ],
        [
            'label' => 'Step 3',
            'title' => 'Receive next steps',
            'description' => 'After payment or reservation, confirmation and onboarding guidance are sent clearly so nobody is left wondering what happens next.',
        ],
        [
            'label' => 'Step 4',
            'title' => 'Move at your pace',
            'description' => 'The journey is built for real schedules, which makes it easier to continue consistently over time.',
        ],
    ];
@endphp

<section class="mx-auto max-w-6xl px-4 py-8 md:py-14">
  <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-soft md:p-8">
    <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
      <div>
        <p class="text-xs font-semibold uppercase tracking-[0.12em] text-slate-500">How It Works</p>
        <h2 class="mt-2 font-display text-3xl font-semibold tracking-tight text-ink">A simple journey that respects how people actually buy</h2>
      </div>
      <a
        href="#"
        data-wa-link
        data-message="Habari Paul, naomba unielekeze hatua ya kununua au kujiunga."
        class="inline-flex min-h-[48px] items-center justify-center rounded-full border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-50"
      >
        Need guidance? Chat first
      </a>
    </div>

    <div class="mt-6 grid gap-4 md:grid-cols-2 xl:grid-cols-4">
      @foreach ($steps as $step)
        <div class="rounded-2xl bg-slate-50 p-5">
          <p class="text-xs font-bold uppercase tracking-[0.1em] text-slate-500">{{ $step['label'] }}</p>
          <h3 class="mt-3 text-lg font-semibold text-ink">{{ $step['title'] }}</h3>
          <p class="mt-2 text-sm leading-7 text-slate-600">{{ $step['description'] }}</p>
        </div>
      @endforeach
    </div>
  </div>
</section>
