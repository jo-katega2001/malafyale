<section id="lead-capture" class="section-anchor mx-auto max-w-6xl px-4 py-8 md:py-14">
  <div class="grid gap-6 lg:grid-cols-[0.95fr_1.05fr]">
    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-soft md:p-8">
      <p class="text-xs font-semibold uppercase tracking-[0.12em] text-slate-500">Lead Capture</p>
      <h2 class="mt-3 font-display text-3xl font-semibold tracking-tight text-ink">Not ready to pay today? Leave your details and keep the conversation moving.</h2>
      <p class="mt-4 text-base leading-8 text-slate-600">
        The form is intentionally small for mobile users. It captures interest without replacing the primary WhatsApp path.
      </p>
      <div class="mt-6 rounded-2xl bg-slate-50 p-5">
        <p class="text-sm font-semibold text-ink">Suggested use</p>
        <p class="mt-2 text-sm leading-7 text-slate-600">
          Use this when a visitor wants updates, a starter guide, or a follow-up path. For urgent questions or purchase help, WhatsApp is still the fastest channel.
        </p>
      </div>
    </div>

    <div class="rounded-2xl bg-ink p-6 text-white shadow-lift md:p-8">
      <form id="leadForm" class="space-y-4" novalidate>
        <div>
          <label for="leadName" class="mb-2 block text-sm font-semibold text-white">Name</label>
          <input
            id="leadName"
            name="name"
            type="text"
            autocomplete="name"
            class="w-full rounded-2xl border border-white/20 bg-white/10 px-4 py-3 text-white placeholder:text-white/40"
            placeholder="Enter your name"
            required
          >
          <p id="nameError" class="mt-2 hidden text-sm text-red-300">Please enter your name.</p>
        </div>
        <div>
          <label for="leadEmail" class="mb-2 block text-sm font-semibold text-white">Email</label>
          <input
            id="leadEmail"
            name="email"
            type="email"
            autocomplete="email"
            class="w-full rounded-2xl border border-white/20 bg-white/10 px-4 py-3 text-white placeholder:text-white/40"
            placeholder="Enter your email"
            required
          >
          <p id="emailError" class="mt-2 hidden text-sm text-red-300">Please enter a valid email address.</p>
        </div>
        <div class="rounded-2xl border border-white/10 bg-white/10 px-4 py-4">
          <p class="text-xs font-semibold uppercase tracking-[0.1em] text-white/60">Current interest</p>
          <p id="leadInterest" class="mt-2 text-sm leading-7 text-white/90">General inquiry</p>
        </div>
        <button
          type="submit"
          id="leadSubmit"
          class="inline-flex min-h-[54px] w-full items-center justify-center rounded-2xl bg-accent px-5 py-3 text-base font-semibold text-ink transition hover:bg-amber-300"
        >
          Request Follow-Up
        </button>
        <p class="text-sm leading-7 text-white/70">
          By submitting, you are asking for a follow-up or resource update. For fastest support, you can still
          <a
            href="#"
            data-wa-link
            data-message="Habari Paul, nimetuma details zangu kwenye website yako na naomba nifuatiliwe."
            class="font-semibold text-white underline underline-offset-4"
          >
            chat on WhatsApp
          </a>.
        </p>
      </form>

      <div id="leadState" class="mt-5 hidden rounded-2xl bg-white px-5 py-4 text-slate-900" aria-live="polite"></div>
    </div>
  </div>
</section>
