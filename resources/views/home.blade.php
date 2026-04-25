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

        <!-- Instagram -->
        <a href="https://www.instagram.com/malafyalewellness?igsh=YXY0d3hrbWl0azR1" class="link-button" target="_blank" rel="noopener">
          <svg class="icon" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd"/></svg>
          <span class="text">{{ $page['buttons']['instagram'] }}</span>
          <svg class="dots" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/></svg>
        </a>

      </div>

      <!-- KYC Form -->
      <div class="mt-10 mb-8 bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
        <h2 class="text-center font-bold text-gray-900 leading-tight mb-3 text-sm tracking-wide">{{ $page['form']['title'] }}</h2>
        <p class="text-[0.85rem] text-gray-600 mb-6 text-center leading-relaxed font-medium">
          {{ $page['form']['description'] }}
        </p>

        <form id="kyc-form" class="space-y-4">
            @csrf
            <div>
              <label class="block text-sm font-bold text-gray-800 mb-1.5">1. {{ $page['form']['fields']['name'] }}</label>
              <input type="text" name="name" required class="w-full border-b-2 border-gray-300 px-2 py-2 focus:border-gray-900 focus:outline-none text-sm transition-colors bg-transparent">
            </div>
            
            <div>
              <label class="block text-sm font-bold text-gray-800 mb-1.5">2. {{ $page['form']['fields']['occupation'] }}</label>
              <input type="text" name="occupation" required class="w-full border-b-2 border-gray-300 px-2 py-2 focus:border-gray-900 focus:outline-none text-sm transition-colors bg-transparent">
            </div>

            <div>
              <label class="block text-sm font-bold text-gray-800 mb-1.5">3. {{ $page['form']['fields']['location'] }}</label>
              <input type="text" name="location" required class="w-full border-b-2 border-gray-300 px-2 py-2 focus:border-gray-900 focus:outline-none text-sm transition-colors bg-transparent">
            </div>

            <div>
              <label class="block text-sm font-bold text-gray-800 mb-1.5">4. {{ $page['form']['fields']['phone'] }}</label>
              <input type="text" name="phone" required class="w-full border-b-2 border-gray-300 px-2 py-2 focus:border-gray-900 focus:outline-none text-sm transition-colors bg-transparent">
            </div>

            <div>
              <label class="block text-sm font-bold text-gray-800 mb-1.5">5. {{ $page['form']['fields']['instagram'] }}</label>
              <input type="text" name="instagram" class="w-full border-b-2 border-gray-300 px-2 py-2 focus:border-gray-900 focus:outline-none text-sm transition-colors bg-transparent">
            </div>

            <div class="flex justify-between items-center pt-4">
               <button type="reset" class="text-xs font-semibold text-gray-500 hover:text-gray-900 bg-white border border-gray-200 px-3 py-1.5 rounded transition-colors">{{ $page['form']['clear'] }}</button>
               <button type="submit" id="submit-btn" class="bg-amber-700 text-white px-6 py-2.5 rounded shadow-sm font-semibold text-sm hover:bg-amber-800 transition-colors">{{ $page['form']['submit'] }}</button>
            </div>
        </form>

        <div id="form-success" class="hidden mt-6 bg-green-50 border border-green-200 text-green-800 p-4 rounded-lg text-sm text-center font-medium">
            {{ $page['form']['success'] }}
        </div>
        <div id="form-error" class="hidden mt-6 bg-red-50 border border-red-200 text-red-800 p-4 rounded-lg text-sm text-center font-medium">
            {{ $page['form']['error'] }}
        </div>
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
          <span class="text-gray-400">&bull;</span>
          <a href="{{ url('/portal/login') }}">Portal</a>
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

    <script>
      document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('kyc-form');
        const successMsg = document.getElementById('form-success');
        const errorMsg = document.getElementById('form-error');
        const submitBtn = document.getElementById('submit-btn');

        if(form) {
          form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            successMsg.classList.add('hidden');
            errorMsg.classList.add('hidden');
            
            const originalBtnText = submitBtn.innerText;
            submitBtn.innerText = '...';
            submitBtn.disabled = true;

            const formData = new FormData(form);
            const data = Object.fromEntries(formData.entries());

            fetch('{{ route('leads.store') }}', {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
              },
              body: JSON.stringify(data)
            })
            .then(response => {
              if(!response.ok) throw new Error('Network response was not ok');
              return response.json();
            })
            .then(data => {
              form.reset();
              successMsg.classList.remove('hidden');
            })
            .catch(error => {
              errorMsg.classList.remove('hidden');
            })
            .finally(() => {
              submitBtn.innerText = originalBtnText;
              submitBtn.disabled = false;
            });
          });
        }
      });
    </script>
  </body>
</html>
