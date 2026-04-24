@props([
    'src',
    'title',
    'thumbnail',
    'alt',
    'featured' => false,
])

<div
  class="video-card {{ $featured ? 'featured-video-card w-full mb-6' : '' }}"
  data-video-src="{{ $src }}"
  data-video-title="{{ $title }}"
  role="button"
  tabindex="0"
  aria-label="Play video: {{ strip_tags($title) }}"
>
  <img
    src="{{ $thumbnail }}"
    alt="{{ $alt }}"
    style="aspect-ratio:16/9; object-fit:cover; {{ $featured ? 'object-position:top center; ' : '' }}width:100%;"
    loading="lazy"
  >
  <div class="play-overlay">
    <div class="play-btn">
      <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M8 5v14l11-7z"/></svg>
    </div>
    <div class="card-meta">
      @if ($featured)
        <div class="card-duration">▶ Featured</div>
      @endif
      <div class="card-title">{!! $title !!}</div>
    </div>
  </div>
</div>
