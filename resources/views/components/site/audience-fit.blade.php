@php
    $audienceItems = [
        [
            'title' => 'Employed professionals',
            'description' => 'People with a full-time job who want a practical side-business path without walking away from steady responsibilities.',
        ],
        [
            'title' => 'Beginners who need guidance',
            'description' => 'Those who are willing to learn but want clarity, structure, and mentorship instead of confusing information.',
        ],
        [
            'title' => 'Entrepreneurs seeking focus',
            'description' => 'Business-minded people who need a more structured plan for income-generating activities and execution.',
        ],
        [
            'title' => 'People with limited time',
            'description' => 'Visitors who need options that can fit around work, study, family, or another business.',
        ],
        [
            'title' => 'People who want to ask first',
            'description' => 'Buyers who prefer to chat on WhatsApp before paying, especially when trust and clarity matter.',
        ],
        [
            'title' => 'People who want practical, not flashy',
            'description' => 'This is for visitors who value a calm, grounded path over aggressive promises or unrealistic claims.',
        ],
    ];
@endphp

<section class="mx-auto max-w-6xl px-4 py-8 md:py-14">
  <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
    <div>
      <p class="text-xs font-semibold uppercase tracking-[0.12em] text-slate-500">Who This Is For</p>
      <h2 class="mt-2 font-display text-3xl font-semibold tracking-tight text-ink">A fast self-selection section for the right audience</h2>
    </div>
    <p class="max-w-xl text-sm leading-7 text-slate-600">If a visitor sees themselves here, they can move quickly. If they need reassurance, the WhatsApp path stays close at hand.</p>
  </div>

  <div class="mt-6 grid gap-4 md:grid-cols-2 xl:grid-cols-3">
    @foreach ($audienceItems as $item)
      <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-soft">
        <h3 class="text-lg font-semibold text-ink">{{ $item['title'] }}</h3>
        <p class="mt-2 text-sm leading-7 text-slate-600">{{ $item['description'] }}</p>
      </div>
    @endforeach
  </div>
</section>
