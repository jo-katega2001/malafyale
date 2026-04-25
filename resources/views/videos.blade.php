@php
    $page = trans('linktree');
    $brandConfig = config('brand');
    $whatsappNumber = $brandConfig['contact']['whatsapp_number'] ?? '+255789412904';
    $cleanNumber = preg_replace('/[^0-9]/', '', $whatsappNumber);
    
    // For SEO meta tags
    $canonicalUrl = $isSw ? route('videos.sw') : route('videos.en');
    $alternateUrl = $isSw ? route('videos.en') : route('videos.sw');
    $metaTitle = $page['videos_page']['title'] . ' | ' . $page['name'];
    $metaDescription = $page['videos_page']['title'] . ' - ' . $page['name'];
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
    <meta name="robots" content="index, follow">
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
    <link rel="alternate" hreflang="en" href="{{ route('videos.en') }}">
    <link rel="alternate" hreflang="sw" href="{{ route('videos.sw') }}">
    <link rel="alternate" hreflang="x-default" href="{{ route('videos.en') }}">
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
      .video-card {
        background-color: white;
        border-radius: 1rem;
        padding: 1.25rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
      }
      .video-card h3 {
        font-weight: 600;
        font-size: 1.1rem;
        margin-bottom: 0.75rem;
        color: #111827;
      }
      .video-container {
        position: relative;
        padding-bottom: 56.25%;
        height: 0;
        border-radius: 0.5rem;
        overflow: hidden;
        background-color: #000;
      }
      .video-container video {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
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
        transition: transform 0.2s;
      }
      .star-btn:hover {
        transform: scale(1.05);
      }
      .back-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background-color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 9999px;
        font-weight: 600;
        color: #111827;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        margin-bottom: 2rem;
        transition: transform 0.2s, box-shadow 0.2s;
        text-decoration: none;
      }
      .back-btn:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
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
  </head>
  <body class="relative min-h-screen pb-6 antialiased">
    
    <!-- Top Icons -->
    <a href="{{ $alternateUrl }}" class="star-btn" aria-label="Language" title="Switch Language">
      <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/></svg>
    </a>

    <main class="mx-auto max-w-2xl px-4 pt-16 relative z-10 pb-32">
      <div class="flex justify-center">
        <a href="{{ $isSw ? route('home.sw') : route('home') }}" class="back-btn">
          <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
          {{ $page['videos_page']['back'] }}
        </a>
      </div>

      <div class="mb-8 text-center">
        <h1 class="text-2xl font-bold tracking-tight text-gray-900">{{ $page['videos_page']['title'] }}</h1>
      </div>

      <div class="flex flex-col">
        @foreach($page['videos_page']['items'] as $video)
          <div class="video-card">
            <h3>{{ $video['title'] }}</h3>
            <div class="video-container">
              <video controls preload="metadata">
                <source src="{{ asset('media/paul-mwaikenda/videos/' . $video['src']) }}" type="video/mp4">
                Your browser does not support the video tag.
              </video>
            </div>
          </div>
        @endforeach
      </div>
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
