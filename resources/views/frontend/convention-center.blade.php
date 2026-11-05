@extends('frontend.layout.default')
@push('style')
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/convention-center.css') }}">
@endpush 
@section('content')
@section('body-class', 'convention-center-page')
<main id="mainContent">
    @include('frontend.partials.banner', [
        'image_url' => $banner['banner_image'] ?? '',
        'title' => $banner['title_part1'] ?? '',
        'subtitle' => $banner['title_part2'] ?? '',
    ])

    <!-- ========================================================================
         SECTION 2: INTRO & MISSION STATEMENT
         - Small tracking uppercase kicker
         - Centered luxury display serif headline
         - Centered editorial mission statement paragraph
         ======================================================================== -->
    <section class="convention-intro-section" aria-label="About Azeezia Convention Centre">
      <div class="convention-intro-container">
        <span class="convention-eyebrow">SERVING THRISSUR &amp; CENTRAL KERALA</span>
        <h2 class="az-editorial-heading convention-hero-title">
          <span class="az-title-dark">THRISSUR'S GRAND WEDDING &amp;</span><br>
          <span class="az-title-accent">EVENT DESIGN EXPERTS</span>
        </h2>
        <p class="convention-mission-text">
          {{ $centre->short_description ?? "Where architectural grandeur meets nature's timeless tranquility. Azeezia Convention Centre is crafted for Kerala's most prestigious weddings, cultural galas, and landmark celebrations — offering a 2,000-guest pillarless grand auditorium, dedicated banquet dining, world-class acoustic engineering, and legendary hospitality nestled in Thrissur." }}
        </p>
      </div>
    </section>

    <!-- ========================================================================
         SECTION 3: AMENITIES & WHAT WE OFFER (FEATURES SECTION)
         - Faint watermark background headline "WHAT WE OFFER"
         - Left: Dual staggered portrait photographs
         - Right: Dynamic amenities icon box cards from database ($offers)
         ======================================================================== -->
    <section class="convention-offer-section" aria-label="Amenities & Offerings">
      <div class="convention-offer-container">

        <!-- Watermark Background Text -->
        <div class="convention-watermark-wrap" aria-hidden="true">
          <div class="convention-watermark-text">WHAT WE OFFER</div>
        </div>

        <!-- Main Content Grid -->
        <div class="convention-offer-grid">

          <!-- Left: Dual Staggered Photographs -->
          @php
            $offerImages = $offers->filter(fn($o) => !empty($o->image_url))->values();
            $backImg = $offerImages[0]->image_url ?? asset('assets/frontend/images/stage-full.webp');
            $frontImg = $offerImages[1]->image_url ?? asset('assets/frontend/images/convention-hall-2.webp');
          @endphp
          <div class="convention-staggered-col">
            <div class="convention-staggered-images">
              <!-- Back Image (Upper Left) -->
              <div class="staggered-img-back-wrap">
                <img src="{{ $backImg }}" alt="Azeezia Convention Centre Showcase" class="staggered-img-back">
              </div>
              <!-- Front Overlapping Image (Lower Right) -->
              <div class="staggered-img-front-wrap">
                <img src="{{ $frontImg }}" alt="Azeezia Grand Banquet Stage and Lighting" class="staggered-img-front">
              </div>
            </div>
          </div>

          <!-- Right: Amenities Icon Box Cards -->
          <div class="convention-amenities-col">
            <div class="amenity-icon-list">

              @forelse ($offers as $offer)
                <div class="amenity-icon-box-card">
                  <div class="amenity-icon-box" aria-hidden="true">
                    @if ($offer->icon_url)
                      <img src="{{ $offer->icon_url }}" alt="{{ $offer->title }}" style="width: 26px; height: 26px; object-fit: contain;">
                    @elseif ($offer->icon && !str_contains($offer->icon, '/') && !str_contains($offer->icon, '.'))
                      <i class="{{ $offer->icon }}"></i>
                    @else
                      @php
                        $fallbackIcons = [
                          'fas fa-concierge-bell',
                          'fas fa-music',
                          'fas fa-utensils',
                          'fas fa-sliders-h',
                          'fas fa-crown',
                          'fas fa-heart',
                          'fas fa-sparkles',
                        ];
                        $fallbackIcon = $fallbackIcons[$loop->index % count($fallbackIcons)];
                      @endphp
                      <i class="{{ $fallbackIcon }}"></i>
                    @endif
                  </div>
                  <div class="amenity-box-content">
                    <h3 class="amenity-item-title">{{ $offer->title }}</h3>
                    @if ($offer->description)
                      <p class="amenity-item-desc">{{ $offer->description }}</p>
                    @endif
                  </div>
                </div>
              @empty
                <div class="amenity-icon-box-card">
                  <div class="amenity-icon-box" aria-hidden="true">
                    <i class="fas fa-concierge-bell"></i>
                  </div>
                  <div class="amenity-box-content">
                    <h3 class="amenity-item-title">Day-Of Coordination &amp; Banquet Care</h3>
                    <p class="amenity-item-desc">Personal bridal escorts, dedicated stage floor managers, VIP concierges, and round-the-clock service staff ensuring your day unfolds with absolute grace.</p>
                  </div>
                </div>
              @endforelse

            </div>
          </div>

        </div>
      </div>
    </section>

    <!-- ========================================================================
         SECTION 4: KEY SPECIFICATIONS & DYNAMIC NUMBER COUNTERS
         ======================================================================== -->
    <section class="convention-specs-section" aria-label="Venue Capacities and Specifications">
      <div class="container">
        <div class="convention-specs-grid">

          <div class="spec-card">
            <div class="spec-number">
              <span class="stat-counter-val" data-target="2000" data-format="comma">2,000</span><span class="spec-suffix">+</span>
            </div>
            <div class="spec-label">Auditorium Capacity</div>
          </div>

          <div class="spec-card">
            <div class="spec-number">
              <span class="stat-counter-val" data-target="800">800</span><span class="spec-suffix">+</span>
            </div>
            <div class="spec-label">Simultaneous Dining</div>
          </div>

          <div class="spec-card">
            <div class="spec-number">
              <span class="stat-counter-val" data-target="100">100</span><span class="spec-suffix">%</span>
            </div>
            <div class="spec-label">Pillarless Sightlines</div>
          </div>

          <div class="spec-card">
            <div class="spec-number">
              <span class="stat-counter-val" data-target="{{ $centre->car_parking_capacity ?? 500 }}">{{ $centre->car_parking_capacity ?? 500 }}</span><span class="spec-suffix">+</span>
            </div>
            <div class="spec-label">Car Parking &amp; Valet</div>
          </div>

        </div>
      </div>
    </section>

    <!-- ========================================================================
         SECTION 5: DISTINCT SPACES & VENUE FACILITIES (INFRASTRUCTURE SECTION)
         Dynamic Infrastructure Spaces from Database ($infrastructures)
         ======================================================================== -->
    <section class="convention-spaces-section" aria-label="Venue Spaces & Facilities">
      <div class="container">
        <div class="spaces-header-wrap">
          <span class="convention-eyebrow">WORLD-CLASS INFRASTRUCTURE</span>
          <h2 class="az-editorial-heading spaces-title">
            <span class="az-title-dark">SPACES DESIGNED FOR</span>
            <span class="az-title-accent">CELEBRATION</span>
          </h2>
          <p class="spaces-subtitle">
            Every architectural detail at Azeezia is designed to provide uncompromised luxury, royal hospitality, and total comfort for you and your guests.
          </p>
        </div>

        <div class="spaces-grid">
          @php
            $defaultInfraImages = [
              asset('assets/frontend/images/stage-full.webp'),
              asset('assets/frontend/images/convention-hall-2.webp'),
              asset('assets/frontend/images/seating.webp'),
              asset('assets/frontend/images/azeezia-stage.webp'),
            ];
          @endphp

          @forelse ($infrastructures as $infra)
            @php
              $infraImg = $infra->image_url ?: $defaultInfraImages[$loop->index % count($defaultInfraImages)];
            @endphp
            <article class="space-card">
              <div class="space-card-img-wrap">
                <img src="{{ $infraImg }}" alt="{{ $infra->title }}" class="space-card-img" loading="lazy">
              </div>
              <div class="space-card-body">
                <span class="space-card-badge">SPACE {{ $infra->formatted_order }}</span>
                <h3 class="space-card-title">{{ $infra->title }}</h3>
                @if ($infra->description)
                  <p class="space-card-desc">{{ $infra->description }}</p>
                @endif
                @if (!empty($infra->points_array))
                  <ul class="space-card-features">
                    @foreach ($infra->points_array as $point)
                      <li><i class="fas fa-check"></i> {{ $point }}</li>
                    @endforeach
                  </ul>
                @endif
              </div>
            </article>
          @empty
            <article class="space-card">
              <div class="space-card-img-wrap">
                <img src="{{ asset('assets/frontend/images/stage-full.webp') }}" alt="Azeezia Pillarless Grand Auditorium" class="space-card-img" loading="lazy">
              </div>
              <div class="space-card-body">
                <span class="space-card-badge">MAIN AUDITORIUM</span>
                <h3 class="space-card-title">Pillarless Grand Hall</h3>
                <p class="space-card-desc">An expansive high-ceiling hall offering uninterrupted visibility from all vantage points, central air-conditioning, and expansive elevated stage design.</p>
                <ul class="space-card-features">
                  <li><i class="fas fa-check"></i> 2,000+ Guest Capacity</li>
                  <li><i class="fas fa-check"></i> Zero Pillar Obstructions</li>
                  <li><i class="fas fa-check"></i> Broadcast AV Integration</li>
                </ul>
              </div>
            </article>
          @endforelse
        </div>
      </div>
    </section>

    <!-- ========================================================================
         SECTION 6: RESERVATION & INQUIRY CALL-TO-ACTION
         ======================================================================== -->
    <section class="convention-cta-section" aria-label="Book Azeezia Convention Centre">
      <div class="convention-cta-bg-layer" aria-hidden="true"></div>
      <div class="container">
        <div class="convention-cta-inner">
          <span class="convention-cta-eyebrow">RESERVE YOUR EVENT</span>
          <h2 class="az-editorial-heading convention-cta-title">
            <span class="az-title-dark-invert">CREATE UNFORGETTABLE</span>
            <span class="az-title-accent">MEMORIES AT AZEEZIA</span>
          </h2>
          <p class="convention-cta-desc">
            Connect with our event curation team to check date availability, schedule a private venue walkthrough, and begin crafting your dream celebration.
          </p>
          <div class="convention-cta-btns">
            <a href="{{ route('contact') }}" class="btn-convention-primary">
              <i class="fas fa-calendar-check"></i>
              <span>Enquire for Dates</span>
            </a>
            @php
              $phone = $centre->contact_phone ?? '+91 75 94 95 0777';
              $rawPhone = preg_replace('/[^0-9+]/', '', $phone);
            @endphp
            <a href="tel:{{ $rawPhone }}" class="btn-convention-secondary">
              <i class="fas fa-phone-alt"></i>
              <span>Call Concierge: {{ $phone }}</span>
            </a>
          </div>
        </div>
      </div>
    </section>

</main>
@endsection
