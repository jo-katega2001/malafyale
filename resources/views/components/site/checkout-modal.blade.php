<div id="checkoutModal" class="fixed inset-0 z-[70] hidden">
  <div class="absolute inset-0 bg-slate-950/50 backdrop-blur-sm" data-close-checkout></div>
  <div class="absolute inset-x-0 bottom-0 max-h-[90vh] overflow-y-auto rounded-t-[30px] bg-white p-5 shadow-lift md:bottom-4 md:right-4 md:left-auto md:top-4 md:w-[28rem] md:rounded-2xl">
    <div class="flex items-start justify-between gap-4">
      <div>
        <p class="text-xs font-semibold uppercase tracking-[0.12em] text-slate-500">Checkout Summary</p>
        <h2 id="checkoutName" class="mt-2 font-display text-2xl font-semibold tracking-tight text-ink">Offer Name</h2>
      </div>
      <button
        type="button"
        data-close-checkout
        class="inline-flex h-11 w-11 items-center justify-center rounded-full border border-slate-200 text-slate-600"
        aria-label="Close checkout summary"
      >
        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M6 6l12 12M18 6L6 18"></path>
        </svg>
      </button>
    </div>

    <div class="mt-5 space-y-4">
      <div class="rounded-2xl bg-slate-50 p-4">
        <p class="text-xs font-semibold uppercase tracking-[0.1em] text-slate-500">Who it is for</p>
        <p id="checkoutFor" class="mt-2 text-sm leading-7 text-slate-600"></p>
      </div>
      <div class="grid gap-3 sm:grid-cols-2">
        <div class="rounded-2xl bg-slate-50 p-4">
          <p class="text-xs font-semibold uppercase tracking-[0.1em] text-slate-500">Format</p>
          <p id="checkoutFormat" class="mt-2 text-sm leading-7 text-slate-600"></p>
        </div>
        <div class="rounded-2xl bg-slate-50 p-4">
          <p class="text-xs font-semibold uppercase tracking-[0.1em] text-slate-500">Investment</p>
          <p id="checkoutPrice" class="mt-2 text-sm font-semibold text-ink"></p>
        </div>
      </div>
      <div class="rounded-2xl bg-slate-50 p-4">
        <p class="text-xs font-semibold uppercase tracking-[0.1em] text-slate-500">Clear outcome</p>
        <p id="checkoutOutcome" class="mt-2 text-sm leading-7 text-slate-600"></p>
      </div>
      <div class="rounded-2xl bg-slate-50 p-4">
        <p class="text-xs font-semibold uppercase tracking-[0.1em] text-slate-500">Supported payment methods</p>
        <div id="checkoutMethods" class="mt-3 flex flex-wrap gap-2"></div>
      </div>
      <div class="rounded-2xl border border-emerald-200 bg-emerald-50 p-4">
        <p class="text-sm font-semibold text-emerald-900">Need help? Chat first.</p>
        <p class="mt-2 text-sm leading-7 text-emerald-800">Secure checkout guidance, mobile money support, and clear next steps remain available even if you prefer to ask before paying.</p>
      </div>
      <div class="rounded-2xl bg-slate-50 p-4">
        <p class="text-xs font-semibold uppercase tracking-[0.1em] text-slate-500">What happens next</p>
        <p id="checkoutNextSteps" class="mt-2 text-sm leading-7 text-slate-600"></p>
      </div>
    </div>

    <div class="mt-6 grid gap-3">
      <button
        type="button"
        id="checkoutPrimary"
        class="inline-flex min-h-[54px] items-center justify-center rounded-2xl bg-accent px-5 py-3 text-base font-semibold text-ink transition hover:bg-amber-300"
      >
        Continue
      </button>
      <a
        href="#"
        id="checkoutSupport"
        data-wa-link
        data-message="Habari Paul, ningependa msaada kabla ya kulipia."
        class="inline-flex min-h-[54px] items-center justify-center rounded-2xl border border-slate-300 px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50"
      >
        Chat on WhatsApp Instead
      </a>
    </div>

    <div id="checkoutStatus" class="mt-4 hidden rounded-2xl border border-amber-200 bg-amber-50 px-4 py-3 text-sm leading-7 text-amber-900" aria-live="polite"></div>
  </div>
</div>
