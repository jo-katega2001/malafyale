@props(['offer'])

<article class="{{ $offer['article_classes'] }}">
  <span class="inline-flex rounded-full px-3 py-1 text-xs font-bold uppercase tracking-[0.1em] {{ $offer['badge_classes'] }}">{{ $offer['badge'] }}</span>
  <h3 class="mt-4 font-display text-2xl font-semibold tracking-tight text-ink">{{ $offer['title'] }}</h3>
  <p class="mt-2 text-sm font-semibold text-slate-500">Who it is for: {{ $offer['for_label'] }}</p>
  <p class="mt-4 text-sm leading-7 text-slate-600">{{ $offer['description'] }}</p>
  <div class="mt-5 space-y-2 text-sm text-slate-600">
    <p><span class="font-semibold text-slate-800">Outcome:</span> {{ $offer['outcome_label'] }}</p>
    <p><span class="font-semibold text-slate-800">Format:</span> {{ $offer['format_label'] }}</p>
    <p><span class="font-semibold text-slate-800">Price:</span> {{ $offer['price_label'] }}</p>
    <p><span class="font-semibold text-slate-800">Payment label:</span> {{ $offer['payment_label'] }}</p>
  </div>
  <div class="mt-6 flex flex-col gap-3">
    <button
      type="button"
      data-open-offer
      data-offer-name="{{ $offer['modal']['name'] }}"
      data-price="{{ $offer['modal']['price'] }}"
      data-format="{{ $offer['modal']['format'] }}"
      data-for="{{ $offer['modal']['for'] }}"
      data-outcome="{{ $offer['modal']['outcome'] }}"
      data-payment-link="{{ $offer['modal']['payment_link'] }}"
      data-payment-type="{{ $offer['modal']['payment_type'] }}"
      data-payment-methods="{{ $offer['modal']['payment_methods'] }}"
      data-whatsapp-message="{{ $offer['modal']['whatsapp_message'] }}"
      data-next-steps="{{ $offer['modal']['next_steps'] }}"
      class="{{ $offer['primary_classes'] }}"
    >
      {{ $offer['primary_text'] }}
    </button>

    @if (($offer['secondary_type'] ?? 'whatsapp') === 'call')
      <a href="#" data-call-link class="{{ $offer['secondary_classes'] }}">
        {{ $offer['secondary_text'] }}
      </a>
    @else
      <a
        href="#"
        data-wa-link
        data-message="{{ $offer['secondary_message'] }}"
        class="{{ $offer['secondary_classes'] }}"
      >
        {{ $offer['secondary_text'] }}
      </a>
    @endif
  </div>
</article>
