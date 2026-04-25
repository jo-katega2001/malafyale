@php
    $page = trans('linktree');
    $brandConfig = config('brand');
    $locale = app()->getLocale();
    $isSw = $locale === 'sw';
    $whatsappNumber = $brandConfig['contact']['whatsapp_number'] ?? '+255789412904';
    $cleanNumber = preg_replace('/[^0-9]/', '', $whatsappNumber);
    
    // For SEO meta tags
    $canonicalUrl = $isSw ? url('/sw') : url('/');
    $alternateUrl = $isSw ? route('home') : route('home.sw');
    $alternateLocale = $isSw ? 'en' : 'sw';
    $metaTitle = 'Malafyale Wellness | ' . $page['name'];
    $metaDescription = $page['tagline1'] . ' - ' . $page['tagline2'];
@endphp
<!doctype html>
<html lang="{{ $locale }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $metaTitle }}</title>
    <meta name="description" content="{{ $metaDescription }}">
    <meta name="theme-color" content="#f3f4f6">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="index, follow, max-image-preview:large">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ $canonicalUrl }}">
    <meta property="og:site_name" content="{{ $page['name'] }}">
    <meta property="og:title" content="{{ $metaTitle }}">
    <meta property="og:description" content="{{ $metaDescription }}">
    <meta property="og:image" content="{{ asset('media/paul-mwaikenda/images/profile-picture.png') }}">
    <meta property="og:locale" content="{{ $isSw ? 'sw_TZ' : 'en_TZ' }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $metaTitle }}">
    <meta name="twitter:description" content="{{ $metaDescription }}">
    <meta name="twitter:image" content="{{ asset('media/paul-mwaikenda/images/profile-picture.png') }}">
    <link rel="canonical" href="{{ $canonicalUrl }}">
    <link rel="alternate" hreflang="en" href="{{ route('home') }}">
    <link rel="alternate" hreflang="sw" href="{{ route('home.sw') }}">
    <link rel="alternate" hreflang="x-default" href="{{ route('home') }}">
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><rect width='100' height='100' rx='20' fill='%23f3f4f6'/><text x='50' y='68' font-family='sans-serif' font-size='42' font-weight='bold' fill='%23000' text-anchor='middle'>PM</text></svg>">
    <link rel="preconnect" href="https://fonts.bunny.net" crossorigin>
    <link href="https://fonts.bunny.net/css?family=inter:400,600,700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css'])
    <style>
      body {
        font-family: 'Inter', sans-serif;
        background-color: #f3f4f6;
        color: #111827;
      }
      .link-button {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background-color: white;
        border-radius: 0.75rem;
        padding: 1rem 1.25rem;
        margin-bottom: 1rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        transition: transform 0.2s, box-shadow 0.2s;
        text-decoration: none;
        color: #111827;
        min-height: 4.5rem;
      }
      .link-button:hover {
        transform: scale(1.02);
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
      }
      .link-button .icon {
        width: 1.5rem;
        height: 1.5rem;
        color: #111827;
        flex-shrink: 0;
      }
      .link-button .text {
        flex-grow: 1;
        text-align: center;
        font-weight: 600;
        font-size: 0.95rem;
        padding: 0 1rem;
      }
      .link-button .dots {
        width: 1.25rem;
        height: 1.25rem;
        color: #9ca3af;
        flex-shrink: 0;
      }
      .profile-img {
        width: 96px;
        height: 96px;
        border-radius: 50%;
        object-fit: cover;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
      }
      .share-btn {
        position: absolute;
        top: 1.5rem;
        right: 1.5rem;
        width: 2.5rem;
        height: 2.5rem;
        border-radius: 50%;
        background-color: rgba(255,255,255,0.8);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #111827;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        backdrop-filter: blur(4px);
      }
      .star-btn {
        position: absolute;
        top: 1.5rem;
        left: 1.5rem;
        width: 2.5rem;
        height: 2.5rem;
        border-radius: 50%;
        background-color: rgba(255,255,255,0.8);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #111827;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        backdrop-filter: blur(4px);
      }
      .footer-nav a {
        color: #111827;
        text-decoration: none;
        font-size: 0.8rem;
      }
      .footer-nav a:hover {
        text-decoration: underline;
      }
      .bottom-sticky {
        position: fixed;
        bottom: 1.5rem;
        left: 0;
        right: 0;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        pointer-events: none;
        z-index: 50;
      }
      .bottom-sticky > * {
        pointer-events: auto;
      }
      .bottom-pill {
        background-color: white;
        border-radius: 9999px;
        padding: 0.5rem 1rem;
        font-size: 0.875rem;
        font-weight: 600;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
        color: #111827;
      }
      .bg-gradient-bottom {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        height: 120px;
        background: linear-gradient(to top, rgba(0,0,0,0.6), transparent);
        pointer-events: none;
        z-index: 40;
      }
    </style>
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@graph": [
        {
          "@@type": "Person",
          "@@id": "{{ url('/') }}#person",
          "name": "{{ $page['name'] }}",
          "jobTitle": "Business & Personal Brand Coach",
          "url": "{{ url('/') }}",
          "image": "{{ asset('media/paul-mwaikenda/images/profile-picture.png') }}",
          "sameAs": [
            "{{ $brandConfig['instagram_url'] ?? '' }}"
          ]
        },
        {
          "@@type": "WebSite",
          "@@id": "{{ url('/') }}#website",
          "url": "{{ url('/') }}",
          "name": "{{ $page['name'] }}",
          "inLanguage": "{{ $locale }}",
          "publisher": {
            "@@id": "{{ url('/') }}#person"
          }
        }
      ]
    }
    </script>
  </head>
  <body class="relative min-h-screen pb-6 antialiased">
    
    <!-- Top Icons -->
    <a href="{{ $alternateUrl }}" class="star-btn" aria-label="Language" title="Switch Language">
      <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/></svg>
    </a>
    
    <button class="share-btn" aria-label="Share" onclick="if(navigator.share){navigator.share({url: window.location.href});}">
      <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
    </button>

    <main class="mx-auto max-w-2xl px-4 pt-16 relative z-10">
      <!-- Profile -->
      <div class="mb-8 flex flex-col items-center text-center">
        <img src="{{ asset('media/paul-mwaikenda/images/profile-picture.png') }}" alt="{{ $page['name'] }}" class="profile-img mb-4">
        <h1 class="mb-1 text-2xl font-bold tracking-tight text-gray-900">{{ $page['name'] }}</h1>
        <p class="mb-2 text-sm font-semibold text-gray-900">{{ $page['tagline1'] }}</p>
        <p class="text-sm font-semibold text-gray-900">{{ $page['tagline2'] }}</p>
      </div>

      <!-- Links -->
      <div class="flex flex-col">
        @php
            $waLink = function($message) use ($cleanNumber) {
                return "https://wa.me/{$cleanNumber}?text=" . urlencode($message);
            };
        @endphp

        <!-- Video -->
        <a href="{{ $isSw ? route('videos.sw') : route('videos.en') }}" class="link-button">
          <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
          <span class="text">{{ $page['buttons']['video'] }}</span>
          <svg class="dots" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/></svg>
        </a>

        <!-- Social Media -->
        <a href="{{ $waLink($page['messages']['social_media']) }}" class="link-button" target="_blank" rel="noopener">
          <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
          <span class="text">{{ $page['buttons']['social_media'] }}</span>
          <svg class="dots" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/></svg>
        </a>

        <!-- Meeting -->
        <a href="{{ $waLink($page['messages']['meeting']) }}" class="link-button" target="_blank" rel="noopener">
          <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
          <span class="text">{{ $page['buttons']['meeting'] }}</span>
          <svg class="dots" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/></svg>
        </a>

        <!-- Weight Loss -->
        <a href="{{ $waLink($page['messages']['weight_loss']) }}" class="link-button" target="_blank" rel="noopener">
          <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
          <span class="text">{{ $page['buttons']['weight_loss'] }}</span>
          <svg class="dots" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/></svg>
        </a>

        <!-- Contact -->
        <a href="{{ $waLink($page['messages']['contact']) }}" class="link-button" target="_blank" rel="noopener">
          <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
          <span class="text">{{ $page['buttons']['contact'] }}</span>
          <svg class="dots" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/></svg>
        </a>

        <!-- Facebook -->
        <a href="{{ $waLink($page['messages']['facebook']) }}" class="link-button" target="_blank" rel="noopener">
          <svg class="icon" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd"/></svg>
          <span class="text">{{ $page['buttons']['facebook'] }}</span>
          <svg class="dots" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/></svg>
        </a>

      </div>

      <!-- Footer -->
      <footer class="mt-8 text-center pb-32">
        <div class="footer-nav mb-4 flex flex-wrap items-center justify-center gap-x-3 gap-y-2">
          <a href="#">{{ $page['footer']['cookie'] }}</a>
          <span class="text-gray-400">&bull;</span>
          <a href="#">{{ $page['footer']['report'] }}</a>
          <span class="text-gray-400">&bull;</span>
          <a href="#">{{ $page['footer']['privacy'] }}</a>
          <span class="text-gray-400">&bull;</span>
          <a href="https://www.instagram.com/malafyalewellness?igsh=YXY0d3hrbWl0azR1" target="_blank" rel="noopener">Instagram</a>
        </div>
      </footer>
    </main>

    <!-- Bottom Sticky Area -->
    <div class="bg-gradient-bottom"></div>
    <div class="bottom-sticky">
      <a href="#" class="bottom-pill mb-2">
        <span>malafyale.co.tz</span>
        <svg class="h-4 w-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
      </a>
      <p class="text-xs font-medium text-white shadow-sm" style="text-shadow: 0 1px 2px rgba(0,0,0,0.8);">Join {{ $page['name'] }} today</p>
    </div>

  </body>
</html>
