@php
    $brandConfig = config('brand');
    $setupStatus = [
        'whatsapp' => filled($brandConfig['contact']['whatsapp_number'] ?? null),
        'phone' => filled($brandConfig['contact']['phone_number'] ?? null),
        'starterGuidePayment' => filled($brandConfig['payment']['links']['starter_guide'] ?? null),
        'starterKitPayment' => filled($brandConfig['payment']['links']['starter_kit'] ?? null),
        'workshopPayment' => filled($brandConfig['payment']['links']['workshop'] ?? null),
        'coachingPayment' => filled($brandConfig['payment']['links']['coaching'] ?? null),
        'privateMentorshipPayment' => filled($brandConfig['payment']['links']['private_mentorship'] ?? null),
        'programPayment' => filled($brandConfig['payment']['links']['program_90_day'] ?? null),
    ];
@endphp

<section id="payments" class="section-anchor mx-auto max-w-6xl px-4 py-8 md:py-14">
  <div class="grid gap-6 lg:grid-cols-[1fr_0.95fr]">
    <div class="rounded-2xl bg-ink p-6 text-white shadow-lift md:p-8">
      <p class="text-xs font-semibold uppercase tracking-[0.12em] text-white/60">Payment Info</p>
      <h2 class="mt-3 font-display text-3xl font-semibold tracking-tight">Mobile-money-friendly checkout, with human support close by</h2>
      <p class="mt-4 text-base leading-8 text-slate-200">
        Buyers in Tanzania often want both trust and convenience. This page supports direct hosted checkout for selected offers and WhatsApp-assisted purchase for buyers who want clarity first.
      </p>
      <div class="mt-6 grid gap-3 sm:grid-cols-2">
        <div class="rounded-2xl border border-white/10 bg-white/10 p-4">
          <h3 class="text-base font-semibold text-white">Accepted methods</h3>
          <p class="mt-2 text-sm leading-7 text-slate-200">M-Pesa, Tigo Pesa, Airtel Money, Halo Pesa, card, and bank transfer.</p>
        </div>
        <div class="rounded-2xl border border-white/10 bg-white/10 p-4">
          <h3 class="text-base font-semibold text-white">Gateway direction</h3>
          <p class="mt-2 text-sm leading-7 text-slate-200">Frontend placeholders are ready for Selcom, DPO / Direct Pay, Pesapal, AzamPay, or a similar Tanzania-suitable gateway.</p>
        </div>
        <div class="rounded-2xl border border-white/10 bg-white/10 p-4">
          <h3 class="text-base font-semibold text-white">Secure checkout guidance</h3>
          <p class="mt-2 text-sm leading-7 text-slate-200">Each offer can point to a hosted checkout link. If a buyer needs help first, WhatsApp remains a visible fallback path.</p>
        </div>
        <div class="rounded-2xl border border-white/10 bg-white/10 p-4">
          <h3 class="text-base font-semibold text-white">After payment</h3>
          <p class="mt-2 text-sm leading-7 text-slate-200">The buyer should receive confirmation, the next action, and access details or onboarding guidance right away.</p>
        </div>
      </div>
      <div class="mt-6 rounded-2xl border border-white/10 bg-white/10 p-4">
        <p class="text-xs font-semibold uppercase tracking-[0.1em] text-white/60">Reassurance</p>
        <p class="mt-2 text-sm leading-7 text-slate-200">Need help before paying? Chat first. Prefer a call? Tap to call. Want to buy directly? Use the offer card or checkout panel. Lipa kwa urahisi, with clarity.</p>
      </div>
    </div>

    <div class="space-y-6">
      <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-soft md:p-8">
        <p class="text-xs font-semibold uppercase tracking-[0.12em] text-slate-500">What happens next</p>
        <div class="mt-4 space-y-4">
          <div class="rounded-2xl bg-slate-50 p-4">
            <h3 class="text-base font-semibold text-ink">1. Choose an offer</h3>
            <p class="mt-2 text-sm leading-7 text-slate-600">Each offer card explains who it is for, what it delivers, and whether to buy now, reserve, apply, or chat first.</p>
          </div>
          <div class="rounded-2xl bg-slate-50 p-4">
            <h3 class="text-base font-semibold text-ink">2. Pay directly or request help</h3>
            <p class="mt-2 text-sm leading-7 text-slate-600">Hosted links are best for low-ticket speed. WhatsApp-assisted payment is available when human support matters more.</p>
          </div>
          <div class="rounded-2xl bg-slate-50 p-4">
            <h3 class="text-base font-semibold text-ink">3. Get confirmation and onboarding</h3>
            <p class="mt-2 text-sm leading-7 text-slate-600">Confirmation, joining details, or delivery guidance should be sent immediately after verification.</p>
          </div>
        </div>
      </div>

      <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-soft md:p-8">
        <p class="text-xs font-semibold uppercase tracking-[0.12em] text-slate-500">Laravel setup checklist for contact and payments</p>
        <div class="mt-4 grid gap-3">
          <div class="rounded-2xl bg-slate-50 p-4">
            <div class="flex items-center justify-between gap-3">
              <code class="text-sm font-semibold text-ink">BRAND_WHATSAPP_NUMBER</code>
              <span class="rounded-full px-3 py-1 text-xs font-bold uppercase tracking-[0.14em] {{ $setupStatus['whatsapp'] ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-900' }}">
                {{ $setupStatus['whatsapp'] ? 'Configured' : 'Pending' }}
              </span>
            </div>
            <p class="mt-2 text-sm leading-7 text-slate-600">Primary conversion channel for quick questions, assisted purchase, and guided next steps.</p>
          </div>
          <div class="rounded-2xl bg-slate-50 p-4">
            <div class="flex items-center justify-between gap-3">
              <code class="text-sm font-semibold text-ink">BRAND_PHONE_NUMBER</code>
              <span class="rounded-full px-3 py-1 text-xs font-bold uppercase tracking-[0.14em] {{ $setupStatus['phone'] ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-900' }}">
                {{ $setupStatus['phone'] ? 'Configured' : 'Pending' }}
              </span>
            </div>
            <p class="mt-2 text-sm leading-7 text-slate-600">Secondary tap-to-call path for visitors who prefer direct voice clarification before committing.</p>
          </div>
          <div class="rounded-2xl bg-slate-50 p-4">
            <div class="flex items-center justify-between gap-3">
              <code class="text-sm font-semibold text-ink">PAYMENT_LINK_*</code>
              <span class="rounded-full px-3 py-1 text-xs font-bold uppercase tracking-[0.14em] {{ $setupStatus['starterKitPayment'] || $setupStatus['workshopPayment'] || $setupStatus['coachingPayment'] || $setupStatus['privateMentorshipPayment'] || $setupStatus['programPayment'] ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-900' }}">
                {{ $setupStatus['starterKitPayment'] || $setupStatus['workshopPayment'] || $setupStatus['coachingPayment'] || $setupStatus['privateMentorshipPayment'] || $setupStatus['programPayment'] ? 'Partially Ready' : 'Pending' }}
              </span>
            </div>
            <p class="mt-2 text-sm leading-7 text-slate-600">Hosted checkout URLs for specific offers. If a link is missing, the page falls back to WhatsApp support instead of breaking the flow.</p>
          </div>
          <div class="rounded-2xl bg-slate-50 p-4">
            <div class="flex items-center justify-between gap-3">
              <code class="text-sm font-semibold text-ink">API_ENDPOINT_CREATE_ORDER / VERIFY / WEBHOOK</code>
              <span class="rounded-full bg-slate-200 px-3 py-1 text-xs font-bold uppercase tracking-[0.14em] text-slate-700">Architecture Ready</span>
            </div>
            <p class="mt-2 text-sm leading-7 text-slate-600">Reserved for gateway integration when you are ready to connect Selcom, DPO, Pesapal, AzamPay, or another supported payment backend.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
