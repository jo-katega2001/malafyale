@php
    $featuredVideo = [
        'src' => asset('media/paul-mwaikenda/videos/training-entrepreneurs-and-coaching.mp4'),
        'title' => 'Training Entrepreneurs &amp; Coaching',
        'thumbnail' => asset('media/paul-mwaikenda/images/thumb-training-entrepreneurs.png'),
        'alt' => 'Training Entrepreneurs and Coaching — video thumbnail',
    ];

    $videoCards = [
        [
            'src' => asset('media/paul-mwaikenda/videos/if-i-can-do-it-you-can-too.mp4'),
            'title' => 'If I Can Do It, You Can Too',
            'thumbnail' => asset('media/paul-mwaikenda/images/thumb-if-i-can-do-it.png'),
            'alt' => 'If I Can Do It You Can Too — video thumbnail',
        ],
        [
            'src' => asset('media/paul-mwaikenda/videos/part-time-business-leverage-income.mp4'),
            'title' => 'Part-Time Business &amp; Leverage Income',
            'thumbnail' => asset('media/paul-mwaikenda/images/thumb-part-time-business.png'),
            'alt' => 'Part-Time Business Leverage Income — video thumbnail',
        ],
        [
            'src' => asset('media/paul-mwaikenda/videos/teach-train-and-coach.mp4'),
            'title' => 'Teach, Train and Coach',
            'thumbnail' => asset('media/paul-mwaikenda/images/thumb-teach-train-coach.png'),
            'alt' => 'Teach Train and Coach — video thumbnail',
        ],
    ];
@endphp

<section id="intro-video" class="section-anchor mx-auto max-w-6xl px-4 py-8 md:py-14">
  <div class="mb-8 flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
    <div>
      <p class="text-xs font-semibold uppercase tracking-[0.12em] text-slate-500">Watch &amp; Learn</p>
      <h2 class="mt-2 font-display text-3xl font-semibold tracking-tight text-ink md:text-4xl">Paul in his own words</h2>
      <p class="mt-2 max-w-xl text-sm leading-7 text-slate-600">Real video content from Paul — hear the message, feel the tone, and decide your next step.</p>
    </div>
    <a
      href="#"
      data-wa-link
      data-message="Habari Paul, nimeangalia video zako. Naomba unielekeze offer inayonifaa."
      class="inline-flex min-h-[48px] items-center justify-center whitespace-nowrap rounded-full bg-ink px-5 py-2 text-sm font-semibold text-white transition hover:bg-panel"
    >
      Ask After Watching
    </a>
  </div>

  <x-site.video-card
    :src="$featuredVideo['src']"
    :title="$featuredVideo['title']"
    :thumbnail="$featuredVideo['thumbnail']"
    :alt="$featuredVideo['alt']"
    featured
  />

  <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
    @foreach ($videoCards as $video)
      <x-site.video-card
        :src="$video['src']"
        :title="$video['title']"
        :thumbnail="$video['thumbnail']"
        :alt="$video['alt']"
      />
    @endforeach
  </div>

  <div class="mt-6 flex flex-col items-center gap-3 rounded-2xl bg-ink px-6 py-6 text-center sm:flex-row sm:justify-between sm:text-left">
    <div>
      <p class="text-sm font-semibold text-white">Ready to take the next step?</p>
      <p class="mt-1 text-sm text-white/70">Chat with Paul directly — questions welcome before any commitment.</p>
    </div>
    <div class="flex gap-3">
      <a
        href="#"
        data-wa-link
        data-message="Habari Paul, nimetazama video zako na nina maswali. Naomba tuongee."
        class="inline-flex min-h-[48px] items-center rounded-full bg-whatsapp px-5 py-2 text-sm font-semibold text-white transition hover:bg-green-500"
      >
        Chat on WhatsApp
      </a>
      <a href="#offers" class="inline-flex min-h-[48px] items-center rounded-full border border-white/25 px-5 py-2 text-sm font-semibold text-white transition hover:bg-white/10">
        View Offers
      </a>
    </div>
  </div>

  <div id="videoLightbox" role="dialog" aria-modal="true" aria-label="Video player">
    <div class="lb-inner">
      <button class="lb-close" id="lbClose" aria-label="Close video">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <path d="M6 6l12 12M18 6L6 18"/>
        </svg>
      </button>
      <video id="lbVideo" controls playsinline preload="none"></video>
      <div class="lb-title" id="lbTitle"></div>
    </div>
  </div>
</section>
