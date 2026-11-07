@extends('frontend.layout.default')
@push('style')
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/services.css') }}">
@endpush 
@section('body-class', 'services-page')
@section('content')
  <main id="mainContent" class="editorial-services-main">

     @include('frontend.partials.banner', [
        'image_url' => $banner['banner_image'] ?? '',
        'title' => $banner['title_part1'] ?? '',
        'subtitle' => $banner['title_part2'] ?? '',
    ])

    <!-- Subtle Organic Contour Background Line Artwork (Meandering curves matching editorial reference) -->
    <div class="editorial-bg-art" aria-hidden="true">
      <svg class="contour-svg" viewBox="0 0 1440 4800" fill="none" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
        <!-- Primary delicate meandering contour line tracing organically down the page -->
        <path d="M 110 40 C 50 200, 190 360, 150 560 C 115 720, 65 900, 130 1100 C 210 1340, 410 1420, 270 1680 C 160 1860, 65 2040, 140 2280 C 230 2580, 500 2740, 430 3040 C 370 3300, 160 3500, 200 3780 C 250 4080, 460 4240, 340 4520 C 260 4680, 180 4760, 150 4800" stroke="#DDD7CB" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round" />
        <!-- Secondary delicate accent contour line -->
        <path d="M 260 140 C 200 320, 240 520, 220 720 C 190 960, 300 1200, 240 1440 C 180 1700, 40 1900, 100 2160 C 160 2380, 310 2600, 250 2860 C 200 3100, 70 3340, 130 3600 C 190 3880, 360 4120, 290 4400 C 240 4600, 120 4720, 90 4800" stroke="#E6E1D7" stroke-width="1" stroke-dasharray="7 6" stroke-linecap="round" />
        <!-- Subtle right margin ambient contour line -->
        <path d="M 1340 1600 C 1240 1860, 1120 2140, 1180 2400 C 1240 2680, 1390 2920, 1300 3200 C 1210 3440, 1090 3700, 1150 3980 C 1210 4240, 1350 4500, 1280 4800" stroke="#E6E1D7" stroke-width="1" stroke-linecap="round" />
      </svg>
    </div>

    <div class="editorial-page-container">

      <!-- ====================================================================
           3. CENTER STATEMENT HEADING & ESSENCE (Matching "MODERN DRIED FLOWERS" block)
           Large offset display headline followed by refined narrative
           ==================================================================== -->
      <section class="editorial-statement-section" aria-label="Modern Event Sanctuary Statement">
        <div class="editorial-statement-inner">
          <h2 class="editorial-statement-title heading-fade-in-up">
            <span class="statement-title-line az-title-dark">MODERN ARCHITECTURAL</span>
            <span class="statement-title-line az-title-accent">CELEBRATIONS</span>
          </h2>
          <div class="editorial-statement-body">
            <p class="editorial-statement-text">
              Celebrations have evolved into an enduring architectural art form. Azeezia bridges natural serenity and opulent grandeur — South India's premier 2,000-guest  auditorium, secluded private pool villas, and authentic farm-to-table dining nestled across a 65+ acre organic sanctuary in Thrissur. We orchestrate every occasion with pristine elegance, concert acoustics, and heartfelt hospitality.
            </p>
          </div>
        </div>
      </section>

      <!-- ====================================================================
           4. NUMBERED EDITORIAL CATALOGUE
           Asymmetric staggered pairings matching 01 SCULPTURES, 02 LUXURY ARRANGEMENTS
           ==================================================================== -->
      <section class="editorial-catalog-section" aria-label="Curated Service Catalog">
        <div class="editorial-catalog-items">
          @php
            $defaultServiceImages = [
              asset('assets/frontend/images/stage-full.webp'),
              asset('assets/frontend/images/convention-hall-2.webp'),
              asset('assets/frontend/images/seating.webp'),
              asset('assets/frontend/images/azeezia-1.webp'),
              asset('assets/frontend/images/azeezia-catering.webp'),
              asset('assets/frontend/images/azeezia-stage.webp'),
            ];
          @endphp

          @forelse ($services as $service)
            @php
              $isLeft = $loop->odd;
              $formattedNum = str_pad($loop->iteration, 2, '0', STR_PAD_LEFT);
              $serviceImg = $service->image_url ?: $defaultServiceImages[$loop->index % count($defaultServiceImages)];
              $points = is_array($service->points) ? $service->points : [];
            @endphp
            <article class="editorial-card-row {{ $isLeft ? 'item-left-img' : 'item-right-img' }}" id="{{ $service->slug ?? 'service-' . $service->id }}">
              @if ($isLeft)
                <div class="editorial-card-media-col">
                  <div class="editorial-image-frame">
                    <img src="{{ $serviceImg }}" alt="{{ $service->title }}" loading="lazy">
                  </div>
                </div>
              @endif

              <div class="editorial-card-info-col">
                <span class="editorial-large-num">{{ $formattedNum }}</span>
                <h3 class="editorial-item-title">{{ $service->title }}</h3>
                @if ($service->description)
                  <p class="editorial-item-desc">
                    {{ $service->description }}
                  </p>
                @endif
                @if (!empty($points))
                  <div class="editorial-item-highlights">
                    @foreach ($points as $point)
                      @if (trim($point))
                        <span class="highlight-pill">{{ trim($point) }}</span>
                      @endif
                    @endforeach
                  </div>
                @endif
              </div>

              @if (!$isLeft)
                <div class="editorial-card-media-col">
                  <div class="editorial-image-frame">
                    <img src="{{ $serviceImg }}" alt="{{ $service->title }}" loading="lazy">
                  </div>
                </div>
              @endif
            </article>
          @empty
            <p class="text-muted text-center py-5">No services currently available.</p>
          @endforelse

        </div>
      </section>

      <!-- ====================================================================
           5. EDITORIAL CURATOR INVITATION (Minimal Luxury Invitation)
           Understated invitation to connect with event directors
           ==================================================================== -->
      <section class="editorial-invitation-section" aria-label="Begin Your Event Planning">
        <div class="editorial-invitation-inner">
          <span class="editorial-eyebrow">RESERVE YOUR MOMENT</span>
          <h2 class="editorial-invitation-title heading-fade-in-up">
            <span class="invitation-title-line az-title-dark">BEGIN CURATING YOUR</span>
            <span class="invitation-title-line az-title-accent">EXTRAORDINARY CELEBRATION</span>
          </h2>
          <p class="editorial-invitation-desc">
            Connect directly with our dedicated event directors to tour our architectural venues, curate bespoke culinary menus, and reserve preferred dates for your milestone gathering.
          </p>
          <div class="editorial-invitation-actions">
            <a href="{{ route('contact') }}" class="az-signature-btn" aria-label="Connect with Event Director">
              <span class="az-sig-btn-line" aria-hidden="true"></span>
              <span class="az-sig-btn-text">CONNECT WITH EVENT DIRECTOR</span>
              <span class="az-sig-btn-circle">
                <svg class="az-sig-btn-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <line x1="5" y1="12" x2="19" y2="12"></line>
                  <polyline points="12 5 19 12 12 19"></polyline>
                </svg>
              </span>
            </a>
          </div>
        </div>
      </section>

    </div>
  </main>
@endsection
