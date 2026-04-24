@php
    $faqs = [
        [
            'question' => 'Can I do this part-time?',
            'answer' => 'Yes. The website and offers are positioned for people who want to build gradually while managing current responsibilities. The point is not to disrupt life, but to grow with structure.',
        ],
        [
            'question' => 'Do I need experience?',
            'answer' => 'Not necessarily. Some offers are designed specifically for beginners who need a clear starting point, guidance, and simple next steps.',
        ],
        [
            'question' => 'How do payments work?',
            'answer' => 'Depending on the offer, you either use a hosted checkout link, reserve your spot, or chat first on WhatsApp. The page is built to support both direct payment and assisted checkout guidance.',
        ],
        [
            'question' => 'Which payment methods are accepted?',
            'answer' => 'The architecture supports M-Pesa, Tigo Pesa, Airtel Money, Halo Pesa, card, and bank transfer, depending on the final gateway setup and offer flow.',
        ],
        [
            'question' => 'What happens after payment?',
            'answer' => 'You should receive confirmation, a next-step message, and either digital delivery details or onboarding guidance. This page explains that clearly to reduce uncertainty.',
        ],
        [
            'question' => 'Do I need to chat first?',
            'answer' => 'No. For some offers, direct checkout is available. But many people prefer to chat first, and the page keeps that path visible because it is a natural buying behavior.',
        ],
        [
            'question' => 'Is this beginner-friendly?',
            'answer' => 'Yes. The tone, offer structure, and support paths are designed to reduce overwhelm, answer basic questions, and help people choose a reasonable next step.',
        ],
    ];
@endphp

<section id="faq" class="section-anchor mx-auto max-w-6xl px-4 py-8 md:py-14">
  <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-soft md:p-8">
    <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
      <div>
        <p class="text-xs font-semibold uppercase tracking-[0.12em] text-slate-500">FAQ</p>
        <h2 class="mt-2 font-display text-3xl font-semibold tracking-tight text-ink">Quick answers to the most common questions</h2>
      </div>
      <a
        href="#"
        data-wa-link
        data-message="Habari Paul, nina swali ambalo halipo kwenye FAQ yako."
        class="inline-flex min-h-[48px] items-center justify-center rounded-full border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-50"
      >
        Ask a Different Question
      </a>
    </div>

    <div class="mt-6 grid gap-4">
      @foreach ($faqs as $faq)
        <details class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
          <summary class="cursor-pointer text-base font-semibold text-ink">{{ $faq['question'] }}</summary>
          <p class="mt-3 text-sm leading-7 text-slate-600">{{ $faq['answer'] }}</p>
        </details>
      @endforeach
    </div>
  </div>
</section>
