@php
    $page = trans('landing');
    $brandConfig = config('brand');
    $locale = app()->getLocale();
    $isSw = $locale === 'sw';
    $canonicalUrl = $isSw ? url('/sw') : url('/');
    $alternateUrl = $isSw ? route('home') : route('home.sw');
    $alternateLocale = $isSw ? 'en' : 'sw';
    $offerLookup = collect($page['offers']['items'])->keyBy('key')->all();
    $offerThemes = [
        ['badge' => 'bg-emerald-100 text-emerald-800', 'ring' => 'border-emerald-200/80'],
        ['badge' => 'bg-amber-100 text-amber-900', 'ring' => 'border-amber-200/80'],
        ['badge' => 'bg-sky-100 text-sky-900', 'ring' => 'border-sky-200/80'],
        ['badge' => 'bg-violet-100 text-violet-900', 'ring' => 'border-violet-200/80'],
        ['badge' => 'bg-rose-100 text-rose-900', 'ring' => 'border-rose-200/80'],
    ];
    $leadFields = [
        [
            'id' => 'leadName',
            'name' => 'name',
            'type' => 'text',
            'autocomplete' => 'name',
            'required' => true,
            'label' => $page['lead_form']['fields']['name']['label'],
            'placeholder' => $page['lead_form']['fields']['name']['placeholder'],
            'error' => $page['lead_form']['fields']['name']['error'],
        ],
        [
            'id' => 'leadOccupation',
            'name' => 'occupation',
            'type' => 'text',
            'autocomplete' => 'organization-title',
            'required' => false,
            'label' => $page['lead_form']['fields']['occupation']['label'],
            'placeholder' => $page['lead_form']['fields']['occupation']['placeholder'],
            'error' => $page['lead_form']['fields']['occupation']['error'],
        ],
        [
            'id' => 'leadLocation',
            'name' => 'location',
            'type' => 'text',
            'autocomplete' => 'address-level2',
            'required' => false,
            'label' => $page['lead_form']['fields']['location']['label'],
            'placeholder' => $page['lead_form']['fields']['location']['placeholder'],
            'error' => $page['lead_form']['fields']['location']['error'],
        ],
        [
            'id' => 'leadPhone',
            'name' => 'phone',
            'type' => 'tel',
            'autocomplete' => 'tel',
            'required' => true,
            'label' => $page['lead_form']['fields']['phone']['label'],
            'placeholder' => $page['lead_form']['fields']['phone']['placeholder'],
            'error' => $page['lead_form']['fields']['phone']['error'],
        ],
        [
            'id' => 'leadInstagram',
            'name' => 'instagram',
            'type' => 'text',
            'autocomplete' => 'off',
            'required' => false,
            'label' => $page['lead_form']['fields']['instagram']['label'],
            'placeholder' => $page['lead_form']['fields']['instagram']['placeholder'],
            'error' => $page['lead_form']['fields']['instagram']['error'],
        ],
    ];
    $videoCards = [
        'featured' => [
            'src' => asset('media/paul-mwaikenda/videos/training-entrepreneurs-and-coaching.mp4'),
            'thumbnail' => asset('media/paul-mwaikenda/images/thumb-training-entrepreneurs.png'),
            'title' => $page['video_gallery']['videos']['featured']['title'],
            'subtitle' => $page['video_gallery']['videos']['featured']['subtitle'],
            'alt' => $page['video_gallery']['videos']['featured']['alt'],
        ],
        'items' => [
            [
                'src' => asset('media/paul-mwaikenda/videos/if-i-can-do-it-you-can-too.mp4'),
                'thumbnail' => asset('media/paul-mwaikenda/images/thumb-if-i-can-do-it.png'),
                'title' => $page['video_gallery']['videos']['items'][0]['title'],
                'subtitle' => $page['video_gallery']['videos']['items'][0]['subtitle'],
                'alt' => $page['video_gallery']['videos']['items'][0]['alt'],
            ],
            [
                'src' => asset('media/paul-mwaikenda/videos/part-time-business-leverage-income.mp4'),
                'thumbnail' => asset('media/paul-mwaikenda/images/thumb-part-time-business.png'),
                'title' => $page['video_gallery']['videos']['items'][1]['title'],
                'subtitle' => $page['video_gallery']['videos']['items'][1]['subtitle'],
                'alt' => $page['video_gallery']['videos']['items'][1]['alt'],
            ],
            [
                'src' => asset('media/paul-mwaikenda/videos/teach-train-and-coach.mp4'),
                'thumbnail' => asset('media/paul-mwaikenda/images/thumb-teach-train-coach.png'),
                'title' => $page['video_gallery']['videos']['items'][2]['title'],
                'subtitle' => $page['video_gallery']['videos']['items'][2]['subtitle'],
                'alt' => $page['video_gallery']['videos']['items'][2]['alt'],
            ],
        ],
    ];
    $resolvePaymentLink = function (array $item) use ($brandConfig): string {
        $paymentKey = $item['payment_link_key'] ?? null;

        return $paymentKey ? (string) data_get($brandConfig, 'payment.links.' . $paymentKey, '') : '';
    };
    $siteConfig = [
        'locale' => $locale,
        'brandName' => $page['header']['brand_name'],
        'whatsappNumber' => $brandConfig['contact']['whatsapp_number'],
        'phoneNumber' => $brandConfig['contact']['phone_number'],
        'instagramHandle' => $brandConfig['instagram_handle'],
        'instagramUrl' => $brandConfig['instagram_url'],
        'leadCaptureEndpoint' => route('leads.store'),
        'defaultLeadInterest' => $isSw ? 'Ujumbe wa jumla' : 'General inquiry',
        'defaultWhatsappMessage' => $page['common']['default_whatsapp_message'],
        'leadSuccessMessage' => __('messages.lead.request_received'),
        'leadSubmitLabel' => __('messages.lead.submit_label'),
        'leadSubmittingLabel' => __('messages.lead.submitting_label'),
        'leadSubmittingState' => __('messages.lead.submitting_state'),
        'leadFollowUpReady' => __('messages.lead.follow_up_ready'),
        'leadContinueWhatsappLabel' => __('messages.lead.continue_whatsapp'),
        'leadCompleteFormMessage' => __('messages.lead.complete_form'),
        'leadSubmitFailedMessage' => __('messages.lead.submit_failed'),
        'whatsappMissingMessage' => __('messages.system.whatsapp_missing'),
        'whatsappMissingActionMessage' => __('messages.system.whatsapp_missing_action'),
        'phoneMissingMessage' => __('messages.system.phone_missing'),
        'checkoutLinkMissingMessage' => __('messages.checkout.link_missing'),
        'checkoutPrimaryLabels' => [
            'hosted' => __('messages.checkout.primary_labels.hosted'),
            'reserve' => __('messages.checkout.primary_labels.reserve'),
            'whatsapp' => __('messages.checkout.primary_labels.whatsapp'),
            'apply' => __('messages.checkout.primary_labels.apply'),
        ],
    ];
@endphp
<!doctype html>
<html lang="{{ $locale }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $page['meta']['title'] }}</title>
    <meta name="description" content="{{ $page['meta']['description'] }}">
    <meta name="theme-color" content="#081423">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta property="og:title" content="{{ $page['meta']['title'] }}">
    <meta property="og:description" content="{{ $page['meta']['og_description'] }}">
    <meta property="og:image" content="{{ asset('media/paul-mwaikenda/images/profile-picture.png') }}">
    <meta property="og:locale" content="{{ $isSw ? 'sw_TZ' : 'en_TZ' }}">
    <link rel="canonical" href="{{ $canonicalUrl }}">
    <link rel="alternate" hreflang="en" href="{{ route('home') }}">
    <link rel="alternate" hreflang="sw" href="{{ route('home.sw') }}">
    <link rel="alternate" hreflang="x-default" href="{{ route('home') }}">
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><rect width='100' height='100' rx='20' fill='%23081423'/><text x='50' y='68' font-family='sans-serif' font-size='42' font-weight='bold' fill='%23c7964d' text-anchor='middle'>PM</text></svg>">
    <link rel="preconnect" href="https://fonts.bunny.net" crossorigin>
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css'])
    <style>
      :root {
        color-scheme: light;
        --motion-ease: cubic-bezier(0.22, 1, 0.36, 1);
      }

      html {
        scroll-behavior: smooth;
        background: #f7f2ea;
      }

      body {
        background:
          radial-gradient(circle at top left, rgba(199, 150, 77, 0.1), transparent 24%),
          linear-gradient(180deg, #fbf6ef 0%, #f7f2ea 36%, #f5efe7 100%);
        color: #132238;
        font-family: "Instrument Sans", ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        font-feature-settings: "cv11", "ss01";
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
      }

      h1,
      h2,
      h3,
      h4,
      .font-display {
        font-family: "Instrument Sans", ui-sans-serif, system-ui, sans-serif;
        letter-spacing: -0.02em;
      }

      .section-anchor {
        scroll-margin-top: 5.5rem;
      }

      .content-section {
        content-visibility: auto;
        contain-intrinsic-size: 1px 860px;
      }

      .hero-surface {
        position: relative;
        overflow: hidden;
        background:
          radial-gradient(circle at 0% 0%, rgba(199, 150, 77, 0.18), transparent 30%),
          radial-gradient(circle at 100% 100%, rgba(37, 211, 102, 0.1), transparent 28%),
          linear-gradient(135deg, #081423 0%, #10233c 55%, #0d1c30 100%);
      }

      .hero-grid::before {
        content: "";
        position: absolute;
        inset: 4rem auto auto -7rem;
        width: 16rem;
        height: 16rem;
        border-radius: 999px;
        background: radial-gradient(circle, rgba(199, 150, 77, 0.24), transparent 70%);
        filter: blur(32px);
        pointer-events: none;
      }

      .hero-grid::after {
        content: "";
        position: absolute;
        inset: auto -6rem 2rem auto;
        width: 15rem;
        height: 15rem;
        border-radius: 999px;
        background: radial-gradient(circle, rgba(37, 211, 102, 0.14), transparent 70%);
        filter: blur(34px);
        pointer-events: none;
      }

      .section-card {
        border: 1px solid rgba(148, 163, 184, 0.16);
        background: rgba(255, 255, 255, 0.82);
        box-shadow: 0 18px 40px rgba(16, 35, 60, 0.08);
        backdrop-filter: blur(14px);
      }

      .section-card-dark {
        border: 1px solid rgba(255, 255, 255, 0.12);
        background:
          linear-gradient(145deg, rgba(255, 255, 255, 0.08), rgba(255, 255, 255, 0.04)),
          linear-gradient(135deg, #081423 0%, #10233c 100%);
        box-shadow: 0 26px 70px rgba(8, 20, 35, 0.22);
      }

      .soft-divider {
        border-color: rgba(148, 163, 184, 0.14);
      }

      .button-sheen {
        position: relative;
        overflow: hidden;
        isolation: isolate;
      }

      .metric-chip {
        border: 1px solid rgba(255, 255, 255, 0.14);
        background: rgba(255, 255, 255, 0.08);
      }

      .quick-action-card,
      .offer-card,
      .info-card,
      .faq-card {
        transition:
          transform 260ms var(--motion-ease),
          box-shadow 260ms var(--motion-ease),
          border-color 220ms ease,
          background-color 220ms ease;
      }

      .video-card {
        position: relative;
        overflow: hidden;
        border-radius: 1.6rem;
        border: 1px solid rgba(148, 163, 184, 0.16);
        background: #081423;
        box-shadow: 0 18px 44px rgba(8, 20, 35, 0.16);
      }

      .video-card img {
        width: 100%;
        aspect-ratio: 16 / 9;
        object-fit: cover;
        object-position: center;
        background: #081423;
        display: block;
      }

      .video-card__overlay {
        position: absolute;
        inset: 0;
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 1rem;
        padding: 1.2rem;
        background: linear-gradient(180deg, rgba(8, 20, 35, 0.02), rgba(8, 20, 35, 0.8) 85%);
      }

      .video-play {
        display: inline-flex;
        width: 3.35rem;
        height: 3.35rem;
        align-items: center;
        justify-content: center;
        border-radius: 999px;
        background: rgba(199, 150, 77, 0.95);
        color: #081423;
        box-shadow: 0 10px 30px rgba(199, 150, 77, 0.34);
        flex-shrink: 0;
      }

      .field-input {
        border: 0;
        border-bottom: 2px solid rgba(148, 163, 184, 0.3);
        background: transparent;
        color: #081423;
        width: 100%;
        padding: 0.85rem 0;
      }

      .field-input::placeholder {
        color: #94a3b8;
      }

      .field-input:focus {
        outline: none;
        border-color: #c7964d;
      }

      .focus-ring:focus-visible,
      button:focus-visible,
      a:focus-visible,
      input:focus-visible,
      summary:focus-visible {
        outline: 3px solid rgba(199, 150, 77, 0.9);
        outline-offset: 3px;
      }

      summary::-webkit-details-marker {
        display: none;
      }

      .no-scroll {
        overflow: hidden;
      }

      .motion-item {
        opacity: 0;
        transform: translate3d(0, var(--motion-distance, 18px), 0);
        transition:
          opacity var(--motion-duration, 500ms) var(--motion-ease),
          transform var(--motion-duration, 500ms) var(--motion-ease);
        transition-delay: calc(var(--motion-index, 0) * var(--motion-stagger, 70ms));
      }

      .motion-item.is-visible {
        opacity: 1;
        transform: none;
      }

      [data-motion="hero"] {
        --motion-distance: 14px;
        --motion-duration: 560ms;
      }

      [data-motion="quick-action"] {
        --motion-distance: 18px;
      }

      [data-motion="offer-card"] {
        --motion-distance: 22px;
        --motion-duration: 520ms;
      }

      [data-motion="cta"] {
        --motion-distance: 16px;
      }

      html.motion-mode-lite .motion-item {
        transition-duration: 220ms;
        transition-delay: 0ms !important;
      }

      html.motion-mode-lite .section-card,
      html.motion-mode-lite .section-card-dark {
        backdrop-filter: none;
      }

      html.motion-mode-lite .hero-grid::before,
      html.motion-mode-lite .hero-grid::after,
      html.motion-mode-lite .button-sheen::after {
        display: none;
      }

      #videoLightbox {
        position: fixed;
        inset: 0;
        z-index: 80;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 1rem;
        background: rgba(4, 10, 20, 0.92);
        backdrop-filter: blur(10px);
      }

      #videoLightbox.open {
        display: flex;
      }

      #videoLightbox .lightbox-shell {
        width: min(100%, 56rem);
        overflow: hidden;
        border-radius: 1.8rem;
        background: #000;
        box-shadow: 0 40px 120px rgba(0, 0, 0, 0.6);
      }

      #videoLightbox video {
        width: 100%;
        display: block;
        max-height: 78vh;
        background: #000;
      }

      #videoLightbox .lightbox-title {
        background: #081423;
        color: #fff;
        padding: 0.95rem 1.25rem 1.15rem;
      }

      #checkoutModal {
        position: fixed;
        inset: 0;
        z-index: 75;
        display: none;
      }

      #checkoutModal.open {
        display: block;
      }

      @media (hover: hover) and (pointer: fine) {
        .button-sheen::after {
          content: "";
          position: absolute;
          inset: -120% auto auto -30%;
          width: 42%;
          height: 320%;
          background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.42), transparent);
          opacity: 0;
          transform: rotate(18deg) translateX(-120%);
          transition: transform 650ms var(--motion-ease), opacity 220ms ease;
          pointer-events: none;
          z-index: -1;
        }

        .button-sheen:hover::after,
        .button-sheen:focus-visible::after {
          opacity: 1;
          transform: rotate(18deg) translateX(360%);
        }

        .quick-action-card:hover,
        .offer-card:hover,
        .info-card:hover,
        .faq-card:hover,
        .video-card:hover {
          transform: translateY(-4px);
          box-shadow: 0 26px 60px rgba(8, 20, 35, 0.16);
        }
      }

      @media (max-width: 767px) {
        .content-section {
          contain-intrinsic-size: 1px 720px;
        }
      }

      @media (prefers-reduced-motion: reduce) {
        html {
          scroll-behavior: auto;
        }

        *,
        *::before,
        *::after {
          animation: none !important;
          transition: none !important;
        }

        .motion-item {
          opacity: 1 !important;
          transform: none !important;
        }
      }
    </style>
  </head>
  <body class="antialiased">
    <a
      href="#main"
      class="sr-only focus:not-sr-only focus:fixed focus:left-4 focus:top-4 focus:z-[100] focus:rounded-full focus:bg-white focus:px-4 focus:py-2 focus:text-ink"
    >
      {{ $page['common']['skip_to_content'] }}
    </a>

    <div id="toast" class="pointer-events-none fixed left-1/2 top-5 z-[90] hidden -translate-x-1/2 rounded-full bg-ink px-5 py-3 text-sm font-semibold text-white shadow-lift"></div>

    <header class="sticky top-0 z-50 border-b border-white/10 bg-ink/90 backdrop-blur">
      <div class="mx-auto max-w-6xl px-4">
        <div class="flex h-16 items-center justify-between gap-4">
          <a href="#main" class="flex items-center gap-3 text-white">
            <span class="flex h-10 w-10 items-center justify-center rounded-full bg-accent text-sm font-bold text-ink">PM</span>
            <span class="leading-tight">
              <span class="block font-display text-sm font-semibold uppercase tracking-[0.1em] text-white/70">{{ $page['header']['brand_name'] }}</span>
              <span class="block text-sm text-white">{{ $page['header']['brand_role'] }}</span>
            </span>
          </a>

          <nav class="hidden items-center gap-6 text-sm text-white/80 lg:flex">
            @foreach ($page['navigation'] as $item)
              <a href="{{ $item['href'] }}" class="transition hover:text-white">{{ $item['label'] }}</a>
            @endforeach
          </nav>

          <div class="hidden items-center gap-3 sm:flex">
            <a
              href="{{ $alternateUrl }}"
              hreflang="{{ $alternateLocale }}"
              class="rounded-full border border-white/20 px-4 py-2 text-sm font-semibold text-white transition hover:border-white/40 hover:bg-white/10"
            >
              {{ $page['header']['language_switch'] }}
            </a>
            <a
              href="{{ route('portal.login') }}"
              class="rounded-full border border-white/20 px-4 py-2 text-sm font-semibold text-white transition hover:border-white/40 hover:bg-white/10"
            >
              Portal
            </a>
            <a
              href="#"
              data-call-link
              class="rounded-full border border-white/20 px-4 py-2 text-sm font-semibold text-white transition hover:border-white/40 hover:bg-white/10"
            >
              {{ $page['common']['call_now'] }}
            </a>
            <a
              href="#"
              data-wa-link
              data-message="{{ $page['common']['default_whatsapp_message'] }}"
              class="button-sheen rounded-full bg-whatsapp px-4 py-2 text-sm font-semibold text-white shadow-lg shadow-green-900/20 transition hover:bg-green-500"
            >
              {{ $page['common']['start_whatsapp'] }}
            </a>
          </div>

          <button
            type="button"
            id="menuToggle"
            class="inline-flex h-11 w-11 items-center justify-center rounded-full border border-white/20 text-white lg:hidden"
            aria-controls="mobileMenu"
            aria-expanded="false"
            aria-label="{{ $page['header']['mobile_menu'] }}"
          >
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M4 7h16M4 12h16M4 17h16"></path>
            </svg>
          </button>
        </div>

        <div id="mobileMenu" class="hidden border-t border-white/10 py-4 lg:hidden">
          <div class="grid gap-3">
            <a href="{{ $alternateUrl }}" hreflang="{{ $alternateLocale }}" class="rounded-2xl border border-white/10 px-4 py-3 text-white/90 transition hover:bg-white/10">{{ $page['header']['language_switch'] }}</a>
            @foreach ($page['navigation'] as $item)
              <a href="{{ $item['href'] }}" class="rounded-2xl border border-white/10 px-4 py-3 text-white/90 transition hover:bg-white/10">{{ $item['label'] }}</a>
            @endforeach
            <a href="{{ route('portal.login') }}" class="rounded-2xl border border-white/10 px-4 py-3 text-white/90 transition hover:bg-white/10">Portal Login</a>
            <a
              href="#"
              data-wa-link
              data-message="{{ $page['common']['default_whatsapp_message'] }}"
              class="rounded-2xl bg-whatsapp px-4 py-3 text-center font-semibold text-white"
            >
              {{ $page['common']['start_whatsapp'] }}
            </a>
            <a href="#" data-call-link class="rounded-2xl border border-white/10 px-4 py-3 text-center font-semibold text-white">{{ $page['common']['call_now'] }}</a>
          </div>
        </div>
      </div>
    </header>

    <main id="main" class="pb-12">
      <section class="hero-surface py-8 sm:py-10 lg:flex lg:min-h-[calc(100vh-4rem)] lg:items-center lg:py-0">
        <div class="hero-grid relative mx-auto w-full max-w-6xl px-4">
          <div class="grid items-center gap-6 lg:grid-cols-[1.02fr_0.98fr] lg:gap-12">
            <div class="relative z-10 order-2 flex flex-col space-y-5 lg:order-1 lg:space-y-6">
              <div class="space-y-4 lg:space-y-5">
                <span class="motion-item inline-flex items-center rounded-full border border-accent/25 bg-accent/10 px-3 py-1 text-[10px] font-semibold uppercase tracking-[0.16em] text-accent lg:px-3.5 lg:py-1.5 lg:text-xs" data-motion="hero" style="--motion-index: 0">
                  {{ $page['hero']['eyebrow'] }}
                </span>

                <div class="motion-item space-y-2 lg:space-y-3" data-motion="hero" style="--motion-index: 1">
                  <h1 class="font-display text-[2.1rem] font-semibold leading-[1.04] tracking-tight text-white sm:text-4xl md:text-5xl lg:text-6xl">
                    {{ $page['hero']['title'] }}
                  </h1>
                  <p class="max-w-2xl text-base leading-8 text-slate-200 lg:text-lg">
                    {{ $page['hero']['description'] }}
                  </p>
                </div>

                <div class="motion-item grid gap-2 sm:flex sm:flex-wrap lg:gap-3" data-motion="hero" style="--motion-index: 2">
                  <a
                    href="#"
                    data-wa-link
                    data-message="{{ $page['hero']['primary_message'] }}"
                    class="button-sheen inline-flex min-h-[52px] items-center justify-center rounded-2xl bg-whatsapp px-5 py-3 text-base font-semibold text-white shadow-lg transition hover:bg-green-500 sm:w-auto"
                  >
                    {{ $page['common']['start_whatsapp'] }}
                  </a>
                  <a
                    href="#lead-capture"
                    class="button-sheen inline-flex min-h-[52px] items-center justify-center rounded-2xl bg-accent px-5 py-3 text-base font-semibold text-ink shadow-lg transition hover:bg-accent/90 sm:w-auto"
                  >
                    {{ $page['hero']['request_callback'] }}
                  </a>
                  <a
                    href="#offers"
                    class="button-sheen inline-flex min-h-[52px] items-center justify-center rounded-2xl border border-white/15 bg-white/8 px-5 py-3 text-base font-semibold text-white backdrop-blur transition hover:bg-white/12 sm:w-auto"
                  >
                    {{ $page['common']['view_offers'] }}
                  </a>
                </div>

                <div class="motion-item flex flex-wrap gap-1.5 lg:gap-2" data-motion="hero" style="--motion-index: 3">
                  @foreach ($page['hero']['tags'] as $tag)
                    <span class="metric-chip inline-flex items-center rounded-full px-2 py-1 text-[9px] font-medium text-white/85 lg:px-2.5 lg:py-1.5 lg:text-[10px]">{{ $tag }}</span>
                  @endforeach
                </div>
              </div>
            </div>

            <div class="relative z-10 order-1 lg:order-2">
              <figure class="motion-item group relative mx-auto w-full max-w-sm lg:max-w-[25rem]" data-motion="hero" style="--motion-index: 1">
                <div class="absolute -inset-1 rounded-[2rem] bg-gradient-to-tr from-accent/20 to-whatsapp/10 blur-xl opacity-45"></div>
                <div class="section-card-dark overflow-hidden rounded-[1.6rem] p-2 shadow-2xl lg:rounded-[2rem]">
                  <div class="grid grid-cols-[7.5rem_1fr] items-stretch gap-3 overflow-hidden rounded-[1.2rem] border border-white/10 bg-white/5 sm:grid-cols-1 lg:rounded-[1.5rem]">
                    <img
                      src="{{ asset('media/paul-mwaikenda/images/profile-picture.png') }}"
                      alt="{{ $page['hero']['profile_name'] }}"
                      class="h-full min-h-[10rem] w-full object-cover object-[center_15%] transition-transform duration-700 group-hover:scale-105 sm:aspect-[4/5] sm:h-auto"
                      loading="eager"
                      width="2048"
                      height="3072"
                    >
                    <figcaption class="flex flex-col justify-between p-4 text-white sm:hidden">
                      <div>
                        <p class="text-[10px] font-bold uppercase tracking-[0.16em] text-accent">{{ $page['about']['eyebrow'] }}</p>
                        <p class="mt-2 font-display text-xl font-semibold leading-tight">{{ $page['hero']['profile_name'] }}</p>
                        <p class="mt-2 text-sm leading-6 text-white/70">{{ $page['hero']['profile_role'] }}</p>
                      </div>
                      <a href="#lead-capture" class="mt-4 inline-flex min-h-[44px] items-center justify-center rounded-xl bg-accent px-4 py-2 text-sm font-semibold text-ink">
                        {{ $page['hero']['request_callback'] }}
                      </a>
                    </figcaption>
                  </div>
                  <figcaption class="mt-3 hidden items-center justify-between px-1 sm:flex lg:mt-4">
                    <div>
                      <p class="font-display text-lg font-semibold text-white lg:text-2xl">{{ $page['hero']['profile_name'] }}</p>
                      <p class="mt-1 text-xs text-white/60 lg:text-sm">{{ $page['hero']['profile_role'] }}</p>
                    </div>
                    <div class="flex h-8 w-8 items-center justify-center rounded-full border border-white/10 bg-white/5">
                      <svg class="h-4 w-4 text-accent" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                      </svg>
                    </div>
                  </figcaption>
                </div>
              </figure>
            </div>
          </div>
        </div>
      </section>

      <section id="lead-capture" class="content-section section-anchor relative z-20 mx-auto max-w-6xl px-4 py-8 md:-mt-10 md:pb-12 md:pt-0">
        <div class="motion-item section-card overflow-hidden rounded-[1.6rem] md:rounded-[2rem]" data-motion="cta" style="--motion-index: 0">
          <div class="grid gap-0 lg:grid-cols-[0.88fr_1.12fr]">
            <div class="bg-ink p-5 text-white md:p-8">
              <p class="text-xs font-semibold uppercase tracking-[0.14em] text-white/55">{{ $page['lead_form']['eyebrow'] }}</p>
              <h2 class="mt-3 font-display text-2xl font-semibold tracking-tight md:text-4xl">{{ $page['lead_form']['title'] }}</h2>
              <p class="mt-4 text-sm leading-7 text-slate-200 md:text-base">{{ $page['lead_form']['description'] }}</p>

              <div class="mt-5 grid gap-2">
                @foreach (array_slice($page['hero']['tags'], 0, 3) as $tag)
                  <span class="inline-flex rounded-full border border-white/12 bg-white/8 px-3 py-2 text-xs font-semibold text-white/80">{{ $tag }}</span>
                @endforeach
              </div>
            </div>

            <div class="p-4 md:p-6 lg:p-8">
              <form id="leadForm" class="grid gap-4 sm:grid-cols-2" novalidate>
                @foreach ($leadFields as $field)
                  <div class="{{ $field['name'] === 'instagram' ? 'sm:col-span-2' : '' }} rounded-[1.1rem] border border-slate-200 bg-white px-4 py-3 shadow-sm">
                    <div class="mb-1.5 flex items-center justify-between gap-3">
                      <label for="{{ $field['id'] }}" class="block text-sm font-semibold text-ink">{{ $field['label'] }}</label>
                      <span class="shrink-0 rounded-full bg-slate-100 px-2 py-0.5 text-[9px] font-bold uppercase tracking-[0.12em] text-slate-500">
                        {{ $field['required'] ? $page['lead_form']['required'] : $page['lead_form']['optional'] }}
                      </span>
                    </div>
                    <input
                      id="{{ $field['id'] }}"
                      name="{{ $field['name'] }}"
                      type="{{ $field['type'] }}"
                      autocomplete="{{ $field['autocomplete'] }}"
                      class="field-input"
                      placeholder="{{ $field['placeholder'] }}"
                      @if ($field['required']) required @endif
                    >
                    <p id="{{ $field['id'] }}Error" class="mt-2 hidden text-sm text-red-600">{{ $field['error'] }}</p>
                  </div>
                @endforeach

                <div class="sm:col-span-2">
                  <button
                    type="submit"
                    id="leadSubmit"
                    class="button-sheen inline-flex min-h-[54px] w-full items-center justify-center rounded-2xl bg-ink px-5 py-3 text-base font-semibold text-white transition hover:bg-panel"
                  >
                    {{ __('messages.lead.submit_label') }}
                  </button>

                  <p class="mt-4 text-center text-sm leading-7 text-slate-600">
                    {{ $page['lead_form']['helper'] }}
                    <a
                      href="#"
                      data-wa-link
                      data-message="{{ $page['common']['default_whatsapp_message'] }}"
                      class="font-semibold text-ink underline underline-offset-4"
                    >
                      {{ $page['lead_form']['after_copy'] }}
                    </a>
                  </p>

                  <div id="leadState" class="mt-5 hidden rounded-[1.4rem] border px-5 py-4 text-sm leading-7" aria-live="polite"></div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </section>

      <section id="quick-actions" class="content-section section-anchor mx-auto max-w-6xl px-4 py-8 md:py-12">
        <div class="mb-6 flex flex-col gap-3 md:flex-row md:items-end md:justify-between">
          <div>
            <p class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">{{ $page['quick_actions']['eyebrow'] }}</p>
            <h2 class="mt-2 max-w-3xl font-display text-3xl font-semibold tracking-tight text-ink md:text-4xl">{{ $page['quick_actions']['title'] }}</h2>
          </div>
          <p class="max-w-xl text-sm leading-7 text-slate-600">{{ $page['quick_actions']['description'] }}</p>
        </div>

        <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
          @foreach ($page['quick_actions']['items'] as $item)
            @php
                $linkedOffer = ($item['action'] ?? null) === 'offer' ? ($offerLookup[$item['offer_key']] ?? null) : null;
            @endphp

            @if (($item['action'] ?? null) === 'offer' && $linkedOffer)
              <button
                type="button"
                data-open-offer
                data-offer-name="{{ $linkedOffer['title'] }}"
                data-price="{{ $linkedOffer['investment'] }}"
                data-format="{{ $linkedOffer['includes'] }}"
                data-for="{{ $linkedOffer['for'] }}"
                data-outcome="{{ $linkedOffer['outcome'] }}"
                data-payment-link="{{ $resolvePaymentLink($linkedOffer) }}"
                data-payment-type="{{ $linkedOffer['payment_type'] }}"
                data-payment-methods="{{ implode('|', $linkedOffer['payment_methods']) }}"
                data-whatsapp-message="{{ $linkedOffer['secondary_message'] }}"
                data-next-steps="{{ $linkedOffer['next_steps'] }}"
                class="quick-action-card motion-item section-card flex min-h-[11rem] flex-col justify-between rounded-[1.6rem] p-5 text-left md:min-h-[15rem]"
                data-motion="quick-action"
                style="--motion-index: {{ $loop->index }}"
              >
                <div>
                  <p class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">{{ $item['eyebrow'] }}</p>
                  <h3 class="mt-3 text-xl font-semibold text-ink">{{ $item['title'] }}</h3>
                  <p class="mt-3 text-sm leading-7 text-slate-600">{{ $item['copy'] }}</p>
                </div>
                <span class="mt-4 inline-flex items-center gap-2 text-sm font-semibold text-ink">
                  {{ $linkedOffer['primary_label'] }}
                  <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path d="M11.293 4.293a1 1 0 011.414 0l5 5a1 1 0 010 1.414l-5 5a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-3.293-3.293a1 1 0 010-1.414z"/></svg>
                </span>
              </button>
            @elseif (($item['action'] ?? null) === 'whatsapp')
              <a
                href="#"
                data-wa-link
                data-message="{{ $item['message'] }}"
                class="quick-action-card motion-item section-card flex min-h-[11rem] flex-col justify-between rounded-[1.6rem] p-5 text-left md:min-h-[15rem]"
                data-motion="quick-action"
                style="--motion-index: {{ $loop->index }}"
              >
                <div>
                  <p class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">{{ $item['eyebrow'] }}</p>
                  <h3 class="mt-3 text-xl font-semibold text-ink">{{ $item['title'] }}</h3>
                  <p class="mt-3 text-sm leading-7 text-slate-600">{{ $item['copy'] }}</p>
                </div>
                <span class="mt-4 inline-flex items-center gap-2 text-sm font-semibold text-ink">
                  {{ $page['common']['start_whatsapp'] }}
                  <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path d="M11.293 4.293a1 1 0 011.414 0l5 5a1 1 0 010 1.414l-5 5a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-3.293-3.293a1 1 0 010-1.414z"/></svg>
                </span>
              </a>
            @else
              <a
                href="{{ $item['href'] }}"
                class="quick-action-card motion-item section-card flex min-h-[11rem] flex-col justify-between rounded-[1.6rem] p-5 text-left md:min-h-[15rem]"
                data-motion="quick-action"
                style="--motion-index: {{ $loop->index }}"
              >
                <div>
                  <p class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">{{ $item['eyebrow'] }}</p>
                  <h3 class="mt-3 text-xl font-semibold text-ink">{{ $item['title'] }}</h3>
                  <p class="mt-3 text-sm leading-7 text-slate-600">{{ $item['copy'] }}</p>
                </div>
                <span class="mt-4 inline-flex items-center gap-2 text-sm font-semibold text-ink">
                  {{ $page['common']['browse_offers'] }}
                  <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path d="M11.293 4.293a1 1 0 011.414 0l5 5a1 1 0 010 1.414l-5 5a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-3.293-3.293a1 1 0 010-1.414z"/></svg>
                </span>
              </a>
            @endif
          @endforeach
        </div>
      </section>

      <section id="about" class="content-section section-anchor mx-auto max-w-6xl px-4 py-8 md:py-12">
        <div class="grid gap-6 lg:grid-cols-[1.05fr_0.95fr]">
          <div class="motion-item section-card-dark rounded-[1.8rem] p-6 text-white md:p-8" data-motion="offer-card" style="--motion-index: 0">
            <p class="text-xs font-semibold uppercase tracking-[0.14em] text-white/60">{{ $page['about']['eyebrow'] }}</p>
            <h2 class="mt-3 font-display text-3xl font-semibold tracking-tight md:text-4xl">{{ $page['about']['title'] }}</h2>
            @foreach ($page['about']['body'] as $paragraph)
              <p class="mt-4 text-base leading-8 text-slate-200">{{ $paragraph }}</p>
            @endforeach
            <a
              href="#"
              data-wa-link
              data-message="{{ $page['about']['cta_message'] }}"
              class="button-sheen mt-6 inline-flex min-h-[52px] items-center justify-center rounded-2xl bg-whatsapp px-5 py-3 text-sm font-semibold text-white transition hover:bg-green-500"
            >
              {{ $page['about']['cta'] }}
            </a>
          </div>

          <div class="grid gap-4">
            @foreach ($page['about']['points'] as $point)
              <div class="info-card motion-item section-card rounded-[1.4rem] p-5" data-motion="offer-card" style="--motion-index: {{ $loop->index + 1 }}">
                <h3 class="text-lg font-semibold text-ink">{{ $point['title'] }}</h3>
                <p class="mt-2 text-sm leading-7 text-slate-600">{{ $point['copy'] }}</p>
              </div>
            @endforeach
          </div>
        </div>
      </section>

      <section class="content-section mx-auto max-w-6xl px-4 py-8 md:py-12">
        <div class="mb-6 flex flex-col gap-3 md:flex-row md:items-end md:justify-between">
          <div>
            <p class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">{{ $page['audience']['eyebrow'] }}</p>
            <h2 class="mt-2 font-display text-3xl font-semibold tracking-tight text-ink md:text-4xl">{{ $page['audience']['title'] }}</h2>
          </div>
          <p class="max-w-xl text-sm leading-7 text-slate-600">{{ $page['audience']['description'] }}</p>
        </div>

        <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
          @foreach ($page['audience']['items'] as $item)
            <div class="info-card motion-item section-card rounded-[1.5rem] p-5" data-motion="offer-card" style="--motion-index: {{ $loop->index }}">
              <h3 class="text-lg font-semibold text-ink">{{ $item['title'] }}</h3>
              <p class="mt-2 text-sm leading-7 text-slate-600">{{ $item['copy'] }}</p>
            </div>
          @endforeach
        </div>
      </section>

      <section id="featured-program" class="content-section section-anchor mx-auto max-w-6xl px-4 py-8 md:py-12">
        <div class="section-card-dark overflow-hidden rounded-[2rem] px-6 py-8 text-white md:px-8 md:py-10">
          <div class="grid gap-8 lg:grid-cols-[1.08fr_0.92fr] lg:items-start">
            <div class="motion-item" data-motion="cta" style="--motion-index: 0">
              <p class="text-xs font-semibold uppercase tracking-[0.14em] text-white/60">{{ $page['featured_program']['eyebrow'] }}</p>
              <h2 class="mt-3 max-w-3xl font-display text-3xl font-semibold tracking-tight md:text-4xl">{{ $page['featured_program']['title'] }}</h2>
              <p class="mt-4 max-w-2xl text-base leading-8 text-slate-200">{{ $page['featured_program']['description'] }}</p>

              <div class="mt-6 flex flex-wrap gap-2">
                @foreach ($page['featured_program']['chips'] as $chip)
                  <span class="inline-flex rounded-full border border-white/15 bg-white/8 px-3 py-2 text-xs font-semibold uppercase tracking-[0.12em] text-white/75">{{ $chip }}</span>
                @endforeach
              </div>

              <div class="mt-6 grid gap-3 sm:grid-cols-3">
                <div class="rounded-[1.35rem] border border-white/10 bg-white/8 p-4">
                  <p class="text-xs font-semibold uppercase tracking-[0.12em] text-white/55">{{ $page['checkout']['investment'] }}</p>
                  <p class="mt-2 text-sm leading-7 text-white">{{ $page['featured_program']['investment'] }}</p>
                </div>
                <div class="rounded-[1.35rem] border border-white/10 bg-white/8 p-4">
                  <p class="text-xs font-semibold uppercase tracking-[0.12em] text-white/55">{{ $page['checkout']['format'] }}</p>
                  <p class="mt-2 text-sm leading-7 text-white">{{ $page['featured_program']['format'] }}</p>
                </div>
                <div class="rounded-[1.35rem] border border-white/10 bg-white/8 p-4">
                  <p class="text-xs font-semibold uppercase tracking-[0.12em] text-white/55">{{ $page['checkout']['who_for'] }}</p>
                  <p class="mt-2 text-sm leading-7 text-white">{{ $page['featured_program']['for'] }}</p>
                </div>
              </div>

              <div class="mt-7 flex flex-col gap-3 sm:flex-row">
                <button
                  type="button"
                  data-open-offer
                  data-offer-name="{{ $page['featured_program']['title'] }}"
                  data-price="{{ $page['featured_program']['investment'] }}"
                  data-format="{{ $page['featured_program']['format'] }}"
                  data-for="{{ $page['featured_program']['for'] }}"
                  data-outcome="{{ $page['featured_program']['outcome'] }}"
                  data-payment-link="{{ $resolvePaymentLink($page['featured_program']) }}"
                  data-payment-type="{{ $page['featured_program']['payment_type'] }}"
                  data-payment-methods="{{ implode('|', $page['featured_program']['payment_methods']) }}"
                  data-whatsapp-message="{{ $page['featured_program']['primary_message'] }}"
                  data-next-steps="{{ $page['featured_program']['next_steps'] }}"
                  class="button-sheen inline-flex min-h-[54px] items-center justify-center rounded-2xl bg-accent px-6 py-3.5 text-base font-semibold text-ink transition hover:bg-amber-300"
                >
                  {{ $page['featured_program']['primary_label'] }}
                </button>
                <a
                  href="#offers"
                  class="button-sheen inline-flex min-h-[54px] items-center justify-center rounded-2xl border border-white/15 bg-white/8 px-6 py-3.5 text-base font-semibold text-white transition hover:bg-white/12"
                >
                  {{ $page['featured_program']['secondary_label'] }}
                </a>
              </div>
            </div>

            <div class="motion-item rounded-[1.7rem] bg-white p-5 text-slate-900 shadow-soft" data-motion="cta" style="--motion-index: 1">
              <p class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">{{ $page['featured_program']['support_heading'] }}</p>
              <div class="mt-4 grid gap-3">
                @foreach ($page['featured_program']['support_points'] as $point)
                  <div class="info-card rounded-[1.3rem] bg-slate-50 p-4">
                    <h3 class="text-base font-semibold text-ink">{{ $point['title'] }}</h3>
                    <p class="mt-2 text-sm leading-7 text-slate-600">{{ $point['copy'] }}</p>
                  </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </section>

      <section id="offers" class="content-section section-anchor mx-auto max-w-6xl px-4 py-8 md:py-12">
        <div class="mb-6 flex flex-col gap-3 md:flex-row md:items-end md:justify-between">
          <div>
            <p class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">{{ $page['offers']['eyebrow'] }}</p>
            <h2 class="mt-2 font-display text-3xl font-semibold tracking-tight text-ink md:text-4xl">{{ $page['offers']['title'] }}</h2>
          </div>
          <p class="max-w-xl text-sm leading-7 text-slate-600">{{ $page['offers']['description'] }}</p>
        </div>

        <div class="grid gap-5 xl:grid-cols-3">
          @foreach ($page['offers']['items'] as $offer)
            @php
                $theme = $offerThemes[$loop->index % count($offerThemes)];
            @endphp
            <article class="offer-card motion-item section-card rounded-[1.8rem] border p-6 {{ $theme['ring'] }}" data-motion="offer-card" style="--motion-index: {{ $loop->index }}">
              <span class="inline-flex rounded-full px-3 py-1 text-xs font-bold uppercase tracking-[0.12em] {{ $theme['badge'] }}">{{ $offer['badge'] }}</span>
              <h3 class="mt-4 font-display text-2xl font-semibold tracking-tight text-ink">{{ $offer['title'] }}</h3>
              <p class="mt-3 text-sm leading-7 text-slate-600">{{ $offer['summary'] }}</p>

              <div class="mt-5 space-y-3 text-sm text-slate-600">
                <p><span class="font-semibold text-slate-800">{{ $page['checkout']['who_for'] }}:</span> {{ $offer['for'] }}</p>
                <p><span class="font-semibold text-slate-800">{{ $page['checkout']['format'] }}:</span> {{ $offer['includes'] }}</p>
                <p><span class="font-semibold text-slate-800">{{ $page['checkout']['outcome'] }}:</span> {{ $offer['outcome'] }}</p>
                <p><span class="font-semibold text-slate-800">{{ $page['checkout']['investment'] }}:</span> {{ $offer['investment'] }}</p>
              </div>

              <div class="mt-6 flex flex-col gap-3">
                <button
                  type="button"
                  data-open-offer
                  data-offer-name="{{ $offer['title'] }}"
                  data-price="{{ $offer['investment'] }}"
                  data-format="{{ $offer['includes'] }}"
                  data-for="{{ $offer['for'] }}"
                  data-outcome="{{ $offer['outcome'] }}"
                  data-payment-link="{{ $resolvePaymentLink($offer) }}"
                  data-payment-type="{{ $offer['payment_type'] }}"
                  data-payment-methods="{{ implode('|', $offer['payment_methods']) }}"
                  data-whatsapp-message="{{ $offer['secondary_message'] }}"
                  data-next-steps="{{ $offer['next_steps'] }}"
                  class="button-sheen inline-flex min-h-[52px] items-center justify-center rounded-2xl bg-ink px-5 py-3 text-sm font-semibold text-white transition hover:bg-panel"
                >
                  {{ $offer['primary_label'] }}
                </button>
                <a
                  href="#"
                  data-wa-link
                  data-message="{{ $offer['secondary_message'] }}"
                  class="inline-flex min-h-[52px] items-center justify-center rounded-2xl border border-slate-300 px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50"
                >
                  {{ $offer['secondary_label'] }}
                </a>
              </div>
            </article>
          @endforeach
        </div>
      </section>

      <section id="payments" class="content-section section-anchor mx-auto max-w-6xl px-4 py-8 md:py-12">
        <div class="grid gap-6 lg:grid-cols-[1.04fr_0.96fr]">
          <div class="motion-item section-card-dark rounded-[1.9rem] p-6 text-white md:p-8" data-motion="cta" style="--motion-index: 0">
            <p class="text-xs font-semibold uppercase tracking-[0.14em] text-white/60">{{ $page['payment']['eyebrow'] }}</p>
            <h2 class="mt-3 font-display text-3xl font-semibold tracking-tight md:text-4xl">{{ $page['payment']['title'] }}</h2>
            <p class="mt-4 max-w-2xl text-base leading-8 text-slate-200">{{ $page['payment']['description'] }}</p>

            <div class="mt-6 grid gap-3 sm:grid-cols-2">
              @foreach ($page['payment']['cards'] as $card)
                <div class="info-card rounded-[1.35rem] border border-white/10 bg-white/8 p-4">
                  <h3 class="text-base font-semibold text-white">{{ $card['title'] }}</h3>
                  <p class="mt-2 text-sm leading-7 text-slate-200">{{ $card['copy'] }}</p>
                </div>
              @endforeach
            </div>
          </div>

          <div class="motion-item section-card rounded-[1.9rem] p-6 md:p-8" data-motion="cta" style="--motion-index: 1">
            <p class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">{{ $page['payment']['steps_title'] }}</p>
            <div class="mt-4 grid gap-4">
              @foreach ($page['payment']['steps'] as $step)
                <div class="info-card rounded-[1.3rem] bg-slate-50 p-4">
                  <div class="flex items-start gap-3">
                    <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-accent/15 text-sm font-bold text-accent">{{ $loop->iteration }}</span>
                    <div>
                      <h3 class="text-base font-semibold text-ink">{{ $step['title'] }}</h3>
                      <p class="mt-2 text-sm leading-7 text-slate-600">{{ $step['copy'] }}</p>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        </div>
      </section>

      <section id="intro-video" class="content-section section-anchor mx-auto max-w-6xl px-4 py-8 md:py-12">
        <div class="mb-6 flex flex-col gap-3 md:flex-row md:items-end md:justify-between">
          <div>
            <p class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">{{ $page['video_gallery']['eyebrow'] }}</p>
            <h2 class="mt-2 font-display text-3xl font-semibold tracking-tight text-ink md:text-4xl">{{ $page['video_gallery']['title'] }}</h2>
            <p class="mt-2 max-w-xl text-sm leading-7 text-slate-600">{{ $page['video_gallery']['description'] }}</p>
          </div>
          <a
            href="#"
            data-wa-link
            data-message="{{ $page['video_gallery']['ask_message'] }}"
            class="button-sheen inline-flex min-h-[48px] items-center justify-center rounded-full bg-ink px-5 py-2 text-sm font-semibold text-white transition hover:bg-panel"
          >
            {{ $page['video_gallery']['ask_label'] }}
          </a>
        </div>

        <button
          type="button"
          class="video-card motion-item mb-6 block w-full text-left"
          data-motion="offer-card"
          style="--motion-index: 0"
          data-video-src="{{ $videoCards['featured']['src'] }}"
          data-video-title="{{ $videoCards['featured']['title'] }}"
          aria-label="{{ $videoCards['featured']['title'] }}"
        >
          <img
            src="{{ $videoCards['featured']['thumbnail'] }}"
            alt="{{ $videoCards['featured']['alt'] }}"
            loading="lazy"
          >
          <span class="video-card__overlay">
            <span>
              <span class="inline-flex rounded-full border border-white/15 bg-white/10 px-2.5 py-1 text-[11px] font-semibold uppercase tracking-[0.12em] text-white/80">{{ $page['video_gallery']['eyebrow'] }}</span>
              <span class="mt-3 block font-display text-2xl font-semibold text-white">{{ $videoCards['featured']['title'] }}</span>
              <span class="mt-1 block text-sm text-white/75">{{ $videoCards['featured']['subtitle'] }}</span>
            </span>
            <span class="video-play">
              <svg class="ml-0.5 h-5 w-5" viewBox="0 0 12 12" fill="currentColor" aria-hidden="true"><path d="M2 1.5v9l8-4.5z"></path></svg>
            </span>
          </span>
        </button>

        <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
          @foreach ($videoCards['items'] as $video)
            <button
              type="button"
              class="video-card motion-item block text-left"
              data-motion="offer-card"
              style="--motion-index: {{ $loop->index + 1 }}"
              data-video-src="{{ $video['src'] }}"
              data-video-title="{{ $video['title'] }}"
              aria-label="{{ $video['title'] }}"
            >
              <img
                src="{{ $video['thumbnail'] }}"
                alt="{{ $video['alt'] }}"
                loading="lazy"
              >
              <span class="video-card__overlay">
                <span>
                  <span class="block font-display text-lg font-semibold text-white">{{ $video['title'] }}</span>
                  <span class="mt-1 block text-sm text-white/75">{{ $video['subtitle'] }}</span>
                </span>
                <span class="video-play">
                  <svg class="ml-0.5 h-4 w-4" viewBox="0 0 12 12" fill="currentColor" aria-hidden="true"><path d="M2 1.5v9l8-4.5z"></path></svg>
                </span>
              </span>
            </button>
          @endforeach
        </div>

        <div class="motion-item mt-6 section-card-dark rounded-[1.8rem] p-6 text-white" data-motion="cta" style="--motion-index: 0">
          <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
              <p class="font-display text-2xl font-semibold">{{ $page['video_gallery']['cta_title'] }}</p>
              <p class="mt-2 max-w-2xl text-sm leading-7 text-white/75">{{ $page['video_gallery']['cta_copy'] }}</p>
            </div>
            <div class="flex flex-col gap-3 sm:flex-row">
              <a
                href="#"
                data-wa-link
                data-message="{{ $page['video_gallery']['ask_message'] }}"
                class="button-sheen inline-flex min-h-[50px] items-center justify-center rounded-2xl bg-whatsapp px-5 py-3 text-sm font-semibold text-white transition hover:bg-green-500"
              >
                {{ $page['common']['start_whatsapp'] }}
              </a>
              <a href="#offers" class="inline-flex min-h-[50px] items-center justify-center rounded-2xl border border-white/15 px-5 py-3 text-sm font-semibold text-white transition hover:bg-white/10">{{ $page['common']['view_offers'] }}</a>
            </div>
          </div>
        </div>
      </section>

      <section id="faq" class="content-section section-anchor mx-auto max-w-6xl px-4 py-8 md:py-12">
        <div class="mb-6 flex flex-col gap-3 md:flex-row md:items-end md:justify-between">
          <div>
            <p class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">{{ $page['faq']['eyebrow'] }}</p>
            <h2 class="mt-2 font-display text-3xl font-semibold tracking-tight text-ink md:text-4xl">{{ $page['faq']['title'] }}</h2>
          </div>
          <a
            href="#"
            data-wa-link
            data-message="{{ $page['faq']['ask_message'] }}"
            class="button-sheen inline-flex min-h-[48px] items-center justify-center rounded-full border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-50"
          >
            {{ $page['faq']['ask_label'] }}
          </a>
        </div>

        <div class="grid gap-4">
          @foreach ($page['faq']['items'] as $faq)
            <details class="faq-card motion-item section-card rounded-[1.5rem] p-5" data-motion="offer-card" style="--motion-index: {{ $loop->index }}">
              <summary class="cursor-pointer text-base font-semibold text-ink">{{ $faq['question'] }}</summary>
              <p class="mt-3 text-sm leading-7 text-slate-600">{{ $faq['answer'] }}</p>
            </details>
          @endforeach
        </div>
      </section>

      <section class="content-section mx-auto max-w-6xl px-4 py-8 md:py-12">
        <div class="motion-item section-card-dark rounded-[2rem] p-6 text-white md:p-10" data-motion="cta" style="--motion-index: 0">
          <div class="grid gap-6 lg:grid-cols-[1fr_auto] lg:items-center">
            <div>
              <p class="text-xs font-semibold uppercase tracking-[0.14em] text-white/60">{{ $page['cta']['eyebrow'] }}</p>
              <h2 class="mt-3 max-w-3xl font-display text-3xl font-semibold tracking-tight md:text-4xl">{{ $page['cta']['title'] }}</h2>
              <p class="mt-4 max-w-2xl text-base leading-8 text-slate-200">{{ $page['cta']['description'] }}</p>
            </div>
            <div class="section-card rounded-[1.5rem] p-5 text-slate-900">
              <div class="grid gap-3">
                <a
                  href="#"
                  data-wa-link
                  data-message="{{ $page['cta']['primary_message'] }}"
                  class="button-sheen inline-flex min-h-[52px] items-center justify-center rounded-2xl bg-whatsapp px-5 py-3 text-sm font-semibold text-white transition hover:bg-green-500"
                >
                  {{ $page['common']['start_whatsapp'] }}
                </a>
                <a href="#offers" class="inline-flex min-h-[52px] items-center justify-center rounded-2xl border border-slate-300 px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">{{ $page['common']['browse_offers'] }}</a>
                <a href="#" data-call-link class="inline-flex min-h-[52px] items-center justify-center rounded-2xl border border-slate-300 px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">{{ $page['common']['call_now'] }}</a>
              </div>
              <p class="mt-4 text-sm leading-7 text-slate-600">{{ $page['cta']['note'] }}</p>
            </div>
          </div>
        </div>
      </section>
    </main>

    <footer class="border-t border-slate-200 bg-white/70">
      <div class="mx-auto max-w-6xl px-4 py-8">
        <div class="grid gap-6 md:grid-cols-[1fr_auto]">
          <div>
            <p class="font-display text-xl font-semibold tracking-tight text-ink">{{ $page['header']['brand_name'] }}</p>
            <p class="mt-2 text-sm leading-7 text-slate-600">
              {{ $page['hero']['profile_role'] }}
              <span class="mx-2 text-slate-300">|</span>
              <a href="{{ $brandConfig['instagram_url'] }}" target="_blank" rel="noopener noreferrer" class="font-medium text-ink underline underline-offset-4 decoration-slate-300 hover:decoration-ink">
                {{ $brandConfig['instagram_handle'] }}
              </a>
            </p>
            <p class="mt-4 max-w-md text-sm leading-7 text-slate-500">{{ $page['footer']['summary'] }}</p>
          </div>
          <div class="grid gap-2 text-sm text-slate-500">
            <p>{{ $page['footer']['copyright'] }}</p>
            @foreach ($page['footer']['disclaimers'] as $item)
              <p>{{ $item }}</p>
            @endforeach
          </div>
        </div>
      </div>
    </footer>

    <div id="checkoutModal" aria-hidden="true">
      <div class="absolute inset-0 bg-slate-950/60 backdrop-blur-sm" data-close-checkout></div>
      <div class="absolute inset-x-0 bottom-0 max-h-[90vh] overflow-y-auto rounded-t-[1.9rem] bg-white p-5 shadow-lift md:bottom-6 md:left-auto md:right-6 md:top-6 md:w-[30rem] md:rounded-[1.7rem]">
        <div class="flex items-start justify-between gap-4">
          <div>
            <p class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">{{ $page['checkout']['eyebrow'] }}</p>
            <h2 id="checkoutName" class="mt-2 font-display text-2xl font-semibold tracking-tight text-ink"></h2>
          </div>
          <button
            type="button"
            data-close-checkout
            class="inline-flex h-11 w-11 items-center justify-center rounded-full border border-slate-200 text-slate-600"
            aria-label="{{ $page['checkout']['close_label'] }}"
          >
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M6 6l12 12M18 6L6 18"></path>
            </svg>
          </button>
        </div>

        <div class="mt-5 space-y-4">
          <div class="rounded-[1.3rem] bg-slate-50 p-4">
            <p class="text-xs font-semibold uppercase tracking-[0.12em] text-slate-500">{{ $page['checkout']['who_for'] }}</p>
            <p id="checkoutFor" class="mt-2 text-sm leading-7 text-slate-600"></p>
          </div>
          <div class="grid gap-3 sm:grid-cols-2">
            <div class="rounded-[1.3rem] bg-slate-50 p-4">
              <p class="text-xs font-semibold uppercase tracking-[0.12em] text-slate-500">{{ $page['checkout']['format'] }}</p>
              <p id="checkoutFormat" class="mt-2 text-sm leading-7 text-slate-600"></p>
            </div>
            <div class="rounded-[1.3rem] bg-slate-50 p-4">
              <p class="text-xs font-semibold uppercase tracking-[0.12em] text-slate-500">{{ $page['checkout']['investment'] }}</p>
              <p id="checkoutPrice" class="mt-2 text-sm font-semibold text-ink"></p>
            </div>
          </div>
          <div class="rounded-[1.3rem] bg-slate-50 p-4">
            <p class="text-xs font-semibold uppercase tracking-[0.12em] text-slate-500">{{ $page['checkout']['outcome'] }}</p>
            <p id="checkoutOutcome" class="mt-2 text-sm leading-7 text-slate-600"></p>
          </div>
          <div class="rounded-[1.3rem] bg-slate-50 p-4">
            <p class="text-xs font-semibold uppercase tracking-[0.12em] text-slate-500">{{ $page['checkout']['payment_methods'] }}</p>
            <div id="checkoutMethods" class="mt-3 flex flex-wrap gap-2"></div>
          </div>
          <div class="rounded-[1.3rem] border border-emerald-200 bg-emerald-50 p-4">
            <p class="text-sm font-semibold text-emerald-900">{{ $page['checkout']['help_title'] }}</p>
            <p class="mt-2 text-sm leading-7 text-emerald-800">{{ $page['checkout']['help_copy'] }}</p>
          </div>
          <div class="rounded-[1.3rem] bg-slate-50 p-4">
            <p class="text-xs font-semibold uppercase tracking-[0.12em] text-slate-500">{{ $page['checkout']['next_steps'] }}</p>
            <p id="checkoutNextSteps" class="mt-2 text-sm leading-7 text-slate-600"></p>
          </div>
        </div>

        <div class="mt-6 grid gap-3">
          <button
            type="button"
            id="checkoutPrimary"
            class="button-sheen inline-flex min-h-[54px] items-center justify-center rounded-2xl bg-accent px-5 py-3 text-base font-semibold text-ink transition hover:bg-amber-300"
          >
            {{ __('messages.checkout.primary_labels.hosted') }}
          </button>
          <a
            href="#"
            id="checkoutSupport"
            data-wa-link
            data-message="{{ $page['common']['default_whatsapp_message'] }}"
            class="inline-flex min-h-[54px] items-center justify-center rounded-2xl border border-slate-300 px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50"
          >
            {{ $page['checkout']['support_label'] }}
          </a>
        </div>

        <div id="checkoutStatus" class="mt-4 hidden rounded-[1.2rem] border border-amber-200 bg-amber-50 px-4 py-3 text-sm leading-7 text-amber-900" aria-live="polite"></div>
      </div>
    </div>

    <div id="videoLightbox" role="dialog" aria-modal="true" aria-label="{{ $page['video_gallery']['lightbox_label'] }}">
      <div class="lightbox-shell">
        <div class="relative">
          <button
            type="button"
            id="lightboxClose"
            class="absolute right-3 top-3 z-10 inline-flex h-11 w-11 items-center justify-center rounded-full border border-white/20 bg-white/10 text-white"
            aria-label="{{ $page['video_gallery']['close_label'] }}"
          >
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M6 6l12 12M18 6L6 18"></path>
            </svg>
          </button>
          <video id="lightboxVideo" controls playsinline preload="none"></video>
        </div>
        <div class="lightbox-title">
          <p id="lightboxTitle" class="font-display text-lg font-semibold"></p>
        </div>
      </div>
    </div>

    <script>
      const SITE_CONFIG = {{ \Illuminate\Support\Js::from($siteConfig) }};

      const state = {
        currentOffer: null,
        leadInterest: SITE_CONFIG.defaultLeadInterest
      };

      const prefersReducedMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
      const lowEndDevice = Boolean(
        (navigator.connection && navigator.connection.saveData) ||
        (navigator.deviceMemory && navigator.deviceMemory <= 4) ||
        (navigator.hardwareConcurrency && navigator.hardwareConcurrency <= 4)
      );

      if (prefersReducedMotion) {
        document.documentElement.classList.add("motion-mode-reduced");
      } else if (lowEndDevice) {
        document.documentElement.classList.add("motion-mode-lite");
      }

      const toast = document.getElementById("toast");
      const menuToggle = document.getElementById("menuToggle");
      const mobileMenu = document.getElementById("mobileMenu");
      const checkoutModal = document.getElementById("checkoutModal");
      const checkoutStatus = document.getElementById("checkoutStatus");
      const checkoutPrimary = document.getElementById("checkoutPrimary");
      const checkoutSupport = document.getElementById("checkoutSupport");
      const leadForm = document.getElementById("leadForm");
      const leadState = document.getElementById("leadState");
      const leadSubmit = document.getElementById("leadSubmit");
      const leadName = document.getElementById("leadName");
      const leadPhone = document.getElementById("leadPhone");
      const leadOccupation = document.getElementById("leadOccupation");
      const leadLocation = document.getElementById("leadLocation");
      const leadInstagram = document.getElementById("leadInstagram");

      const digitsOnly = (value) => (value || "").replace(/\D+/g, "");

      function showToast(message) {
        if (!toast) return;
        toast.textContent = message;
        toast.classList.remove("hidden");
        window.clearTimeout(showToast.timer);
        showToast.timer = window.setTimeout(() => toast.classList.add("hidden"), 2800);
      }

      function scrollToLeadForm() {
        const target = document.getElementById("lead-capture");
        if (!target) return;

        target.scrollIntoView({
          behavior: prefersReducedMotion ? "auto" : "smooth",
          block: "start"
        });

        window.setTimeout(() => {
          leadName?.focus({ preventScroll: true });
        }, prefersReducedMotion ? 0 : 260);
      }

      function buildWhatsAppUrl(message) {
        const number = digitsOnly(SITE_CONFIG.whatsappNumber);
        if (!number) return null;

        return "https://wa.me/" + number + "?text=" + encodeURIComponent(message || SITE_CONFIG.defaultWhatsappMessage);
      }

      function buildCallUrl() {
        if (!SITE_CONFIG.phoneNumber) return null;
        return "tel:" + SITE_CONFIG.phoneNumber;
      }

      function wireContactLinks() {
        document.querySelectorAll("[data-wa-link]").forEach((link) => {
          const message = link.dataset.message || SITE_CONFIG.defaultWhatsappMessage;
          const url = buildWhatsAppUrl(message);

          if (url) {
            link.setAttribute("href", url);
            link.setAttribute("target", "_blank");
            link.setAttribute("rel", "noopener noreferrer");
          } else {
            link.setAttribute("href", "#lead-capture");
            link.removeAttribute("target");
            link.removeAttribute("rel");
          }

          link.onclick = (event) => {
            if (buildWhatsAppUrl(link.dataset.message || SITE_CONFIG.defaultWhatsappMessage)) return;
            event.preventDefault();
            scrollToLeadForm();
            showToast(SITE_CONFIG.whatsappMissingMessage);
          };
        });

        document.querySelectorAll("[data-call-link]").forEach((link) => {
          const url = buildCallUrl();

          if (url) {
            link.setAttribute("href", url);
          } else {
            link.setAttribute("href", "#lead-capture");
          }

          link.onclick = (event) => {
            if (buildCallUrl()) return;
            event.preventDefault();
            scrollToLeadForm();
            showToast(SITE_CONFIG.phoneMissingMessage);
          };
        });
      }

      function setMenu(open) {
        if (!mobileMenu || !menuToggle) return;
        mobileMenu.classList.toggle("hidden", !open);
        menuToggle.setAttribute("aria-expanded", String(open));
      }

      if (menuToggle && mobileMenu) {
        menuToggle.addEventListener("click", () => {
          setMenu(menuToggle.getAttribute("aria-expanded") !== "true");
        });

        mobileMenu.querySelectorAll("a").forEach((link) => {
          link.addEventListener("click", () => setMenu(false));
        });
      }

      function openCheckout(offerData) {
        state.currentOffer = offerData;
        state.leadInterest = offerData.name;

        document.getElementById("checkoutName").textContent = offerData.name;
        document.getElementById("checkoutFor").textContent = offerData.for;
        document.getElementById("checkoutFormat").textContent = offerData.format;
        document.getElementById("checkoutPrice").textContent = offerData.price;
        document.getElementById("checkoutOutcome").textContent = offerData.outcome;
        document.getElementById("checkoutNextSteps").textContent = offerData.nextSteps;
        checkoutSupport.dataset.message = offerData.whatsappMessage || SITE_CONFIG.defaultWhatsappMessage;

        const methodsContainer = document.getElementById("checkoutMethods");
        methodsContainer.innerHTML = "";

        offerData.paymentMethods.forEach((method) => {
          const chip = document.createElement("span");
          chip.className = "rounded-full border border-slate-200 bg-white px-3 py-2 text-xs font-bold uppercase tracking-[0.12em] text-slate-600";
          chip.textContent = method;
          methodsContainer.appendChild(chip);
        });

        checkoutPrimary.textContent = SITE_CONFIG.checkoutPrimaryLabels[offerData.paymentType] || SITE_CONFIG.checkoutPrimaryLabels.whatsapp;
        checkoutStatus.classList.add("hidden");
        checkoutStatus.textContent = "";
        checkoutModal.classList.add("open");
        checkoutModal.setAttribute("aria-hidden", "false");
        document.body.classList.add("no-scroll");
        wireContactLinks();
      }

      function closeCheckout() {
        checkoutModal.classList.remove("open");
        checkoutModal.setAttribute("aria-hidden", "true");
        document.body.classList.remove("no-scroll");
      }

      document.querySelectorAll("[data-open-offer]").forEach((trigger) => {
        trigger.addEventListener("click", (event) => {
          event.preventDefault();

          openCheckout({
            name: trigger.dataset.offerName,
            price: trigger.dataset.price,
            format: trigger.dataset.format,
            for: trigger.dataset.for,
            outcome: trigger.dataset.outcome,
            paymentLink: trigger.dataset.paymentLink,
            paymentType: trigger.dataset.paymentType,
            whatsappMessage: trigger.dataset.whatsappMessage,
            nextSteps: trigger.dataset.nextSteps,
            paymentMethods: (trigger.dataset.paymentMethods || "").split("|").filter(Boolean)
          });
        });
      });

      document.querySelectorAll("[data-close-checkout]").forEach((element) => {
        element.addEventListener("click", closeCheckout);
      });

      document.addEventListener("keydown", (event) => {
        if (event.key === "Escape" && checkoutModal.classList.contains("open")) {
          closeCheckout();
        }
      });

      checkoutPrimary?.addEventListener("click", () => {
        if (!state.currentOffer) return;

        const offer = state.currentOffer;

        if (offer.paymentType === "hosted") {
          if (/^https?:\/\//i.test(offer.paymentLink || "")) {
            window.open(offer.paymentLink, "_blank", "noopener,noreferrer");
            return;
          }

          checkoutStatus.textContent = SITE_CONFIG.checkoutLinkMissingMessage;
          checkoutStatus.classList.remove("hidden");
          scrollToLeadForm();
          return;
        }

        const whatsappUrl = buildWhatsAppUrl(offer.whatsappMessage || SITE_CONFIG.defaultWhatsappMessage);

        if (whatsappUrl) {
          window.open(whatsappUrl, "_blank", "noopener,noreferrer");
          return;
        }

        checkoutStatus.textContent = SITE_CONFIG.whatsappMissingActionMessage;
        checkoutStatus.classList.remove("hidden");
        scrollToLeadForm();
      });

      function setFieldValidity(field, errorNode, isValid) {
        if (!field || !errorNode) return;
        errorNode.classList.toggle("hidden", isValid);
        field.setAttribute("aria-invalid", String(!isValid));
      }

      function validateLeadForm() {
        const validations = [
          {
            field: leadName,
            error: document.getElementById("leadNameError"),
            valid: leadName.value.trim().length > 1
          },
          {
            field: leadPhone,
            error: document.getElementById("leadPhoneError"),
            valid: digitsOnly(leadPhone.value).length >= 7
          },
          {
            field: leadOccupation,
            error: document.getElementById("leadOccupationError"),
            valid: true
          },
          {
            field: leadLocation,
            error: document.getElementById("leadLocationError"),
            valid: true
          },
          {
            field: leadInstagram,
            error: document.getElementById("leadInstagramError"),
            valid: true
          }
        ];

        validations.forEach(({ field, error, valid }) => setFieldValidity(field, error, valid));

        return validations.every(({ valid }) => valid);
      }

      leadName?.addEventListener("input", () => setFieldValidity(leadName, document.getElementById("leadNameError"), leadName.value.trim().length > 1));
      leadPhone?.addEventListener("input", () => setFieldValidity(leadPhone, document.getElementById("leadPhoneError"), digitsOnly(leadPhone.value).length >= 7));

      leadForm?.addEventListener("submit", (event) => {
        event.preventDefault();

        if (!validateLeadForm()) {
          showToast(SITE_CONFIG.leadCompleteFormMessage);
          return;
        }

        leadSubmit.disabled = true;
        leadSubmit.textContent = SITE_CONFIG.leadSubmittingLabel;

        leadState.classList.remove("hidden");
        leadState.className = "mt-5 rounded-[1.4rem] border border-slate-200 bg-slate-50 px-5 py-4 text-sm leading-7 text-slate-700";
        leadState.textContent = SITE_CONFIG.leadSubmittingState;

        const payload = {
          name: leadName.value.trim(),
          occupation: leadOccupation.value.trim(),
          location: leadLocation.value.trim(),
          phone: leadPhone.value.trim(),
          instagram: leadInstagram.value.trim(),
          interest: state.leadInterest,
          source: "website"
        };

        fetch(SITE_CONFIG.leadCaptureEndpoint, {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            "Accept": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
          },
          body: JSON.stringify(payload)
        })
          .then(async (response) => {
            const data = await response.json().catch(() => ({}));
            if (!response.ok) {
              throw { status: response.status, data };
            }
            return data;
          })
          .then((data) => {
            leadSubmit.disabled = false;
            leadSubmit.textContent = SITE_CONFIG.leadSubmitLabel;
            leadState.className = "mt-5 rounded-[1.4rem] border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm leading-7 text-emerald-900";
            leadState.innerHTML =
              "<p class=\"text-base font-semibold text-emerald-950\">" + (data.message || SITE_CONFIG.leadSuccessMessage) + "</p>" +
              "<p class=\"mt-2 text-sm leading-7 text-emerald-900\">" + SITE_CONFIG.leadFollowUpReady + "</p>" +
              "<a href=\"#\" data-wa-link data-message=\"" + SITE_CONFIG.defaultWhatsappMessage.replace(/"/g, "&quot;") + "\" class=\"button-sheen mt-4 inline-flex min-h-[48px] items-center rounded-full bg-whatsapp px-4 py-2 text-sm font-semibold text-white\">" + SITE_CONFIG.leadContinueWhatsappLabel + "</a>";

            leadForm.reset();
            state.leadInterest = SITE_CONFIG.defaultLeadInterest;
            wireContactLinks();
          })
          .catch((error) => {
            leadSubmit.disabled = false;
            leadSubmit.textContent = SITE_CONFIG.leadSubmitLabel;

            const errors = error?.data?.errors || {};
            const firstError = Object.values(errors).flat()[0];

            leadState.className = "mt-5 rounded-[1.4rem] border border-red-200 bg-red-50 px-5 py-4 text-sm leading-7 text-red-900";
            leadState.textContent = firstError || SITE_CONFIG.leadSubmitFailedMessage;

            setFieldValidity(leadName, document.getElementById("leadNameError"), !errors.name);
            setFieldValidity(leadPhone, document.getElementById("leadPhoneError"), !errors.phone);
          });
      });

      function initializeMotion() {
        const targets = Array.from(document.querySelectorAll("[data-motion]"));
        if (!targets.length) return;

        const heroTargets = targets.filter((target) => target.dataset.motion === "hero");
        const restTargets = targets.filter((target) => target.dataset.motion !== "hero");

        if (prefersReducedMotion || !("IntersectionObserver" in window)) {
          targets.forEach((target) => target.classList.add("is-visible"));
          return;
        }

        requestAnimationFrame(() => {
          heroTargets.forEach((target) => target.classList.add("is-visible"));
        });

        const observer = new IntersectionObserver((entries) => {
          entries.forEach((entry) => {
            if (!entry.isIntersecting) return;
            entry.target.classList.add("is-visible");
            observer.unobserve(entry.target);
          });
        }, {
          threshold: lowEndDevice ? 0.08 : 0.18,
          rootMargin: "0px 0px -10% 0px"
        });

        restTargets.forEach((target) => observer.observe(target));
      }

      function initializeVideoLightbox() {
        const lightbox = document.getElementById("videoLightbox");
        const lightboxVideo = document.getElementById("lightboxVideo");
        const lightboxTitle = document.getElementById("lightboxTitle");
        const lightboxClose = document.getElementById("lightboxClose");

        function openLightbox(src, title) {
          lightboxVideo.src = src;
          lightboxTitle.textContent = title || "";
          lightbox.classList.add("open");
          document.body.classList.add("no-scroll");
          lightboxVideo.play().catch(() => {});
        }

        function closeLightbox() {
          lightbox.classList.remove("open");
          document.body.classList.remove("no-scroll");
          lightboxVideo.pause();
          lightboxVideo.src = "";
        }

        document.querySelectorAll("[data-video-src]").forEach((card) => {
          card.addEventListener("click", () => openLightbox(card.dataset.videoSrc, card.dataset.videoTitle));
        });

        lightboxClose?.addEventListener("click", closeLightbox);
        lightbox?.addEventListener("click", (event) => {
          if (event.target === lightbox) closeLightbox();
        });

        document.addEventListener("keydown", (event) => {
          if (event.key === "Escape" && lightbox.classList.contains("open")) {
            closeLightbox();
          }
        });
      }

      (function initializeHeroVideo() {
        const video = document.getElementById("heroMainVideo");
        const overlay = document.getElementById("heroPlayOverlay");
        const playButton = document.getElementById("heroPlayButton");

        if (!video || !overlay || !playButton) return;

        function hideOverlay() {
          overlay.style.opacity = "0";
          window.setTimeout(() => {
            overlay.style.display = "none";
          }, 250);
        }

        function playVideo() {
          video.play().catch(() => {});
          hideOverlay();
        }

        playButton.addEventListener("click", playVideo);
        video.addEventListener("play", hideOverlay);
      })();

      (function initializeSectionTracking() {
        const sections = document.querySelectorAll("section[id]");
        const observerOptions = {
          root: null,
          threshold: 0.3,
        };

        const observer = new IntersectionObserver((entries) => {
          entries.forEach((entry) => {
            if (entry.isIntersecting) {
              const sectionId = entry.target.id;
              document.cookie = `current_section=${sectionId}; path=/; max-age=3600`;
            }
          });
        }, observerOptions);

        sections.forEach((section) => observer.observe(section));
      })();

      wireContactLinks();
      initializeMotion();
      initializeVideoLightbox();
    </script>
  </body>
</html>
