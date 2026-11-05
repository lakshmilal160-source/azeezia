@extends('frontend.layout.default')
@push('style')
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/resort.css') }}">
@endpush 
@section('content')
@section('body-class', 'resort-page')
<main >
    @include('frontend.partials.banner', [
        'image_url' => $banner['banner_image'] ?? '',
        'title' => $banner['title_part1'] ?? '',
        'subtitle' => $banner['title_part2'] ?? '',
    ])
<!-- ========================================================================
         SECTION 3: VILLA SUITES SHOWCASE SLIDER (EXACT REFERENCE SECTION 2)
         Vertical line kicker, circular arrow buttons, large main photo, peeking frame & specs
         ======================================================================== -->
    <section class="resort-showcase-section" id="villas-suites">
      <div class="resort-container">
        
        <!-- Section Header with Vertical Line Kicker -->
        <div class="resort-section-header-block">
          <div class="resort-vertical-line-kicker">
            <span class="resort-v-line"></span>
            <span class="resort-kicker-text">PORTFOLIO</span>
          </div>
          <h2 class="resort-section-title heading-fade-in-up">
            <span class="az-title-dark">EXCLUSIVE PRIVATE</span><br>
            <span class="az-title-accent">POOL VILLA SUITES</span>
          </h2>
        </div>

        <!-- Slider Stage -->
        <div class="resort-slider-stage" id="resortSliderStage">
          
          <!-- Left Column: Navigation Arrows & Specifications -->
          <div class="resort-slider-nav-col">
            <div class="resort-slider-btn-row">
              <button class="resort-slider-arrow-btn" id="resortPrevBtn" aria-label="Previous Villa Slide"><i class="fas fa-arrow-left"></i></button>
              <button class="resort-slider-arrow-btn" id="resortNextBtn" aria-label="Next Villa Slide"><i class="fas fa-arrow-right"></i></button>
            </div>
            <div class="resort-slider-spec-caption" id="resortSlideSpecs">
              @if(isset($rooms) && $rooms->isNotEmpty())
                @php
                  $firstRoom = $rooms->first();
                  $firstSpecs = [];
                  if (!empty($firstRoom->description)) {
                      if (str_contains($firstRoom->description, "\n")) {
                          $lines = array_filter(array_map('trim', explode("\n", $firstRoom->description)));
                      } elseif (str_contains($firstRoom->description, ',')) {
                          $lines = array_filter(array_map('trim', explode(',', $firstRoom->description)));
                      } else {
                          $lines = [trim($firstRoom->description)];
                      }
                      foreach ($lines as $line) {
                          $firstSpecs[] = strtoupper($line);
                      }
                  } elseif (!empty($firstRoom->name)) {
                      $firstSpecs[] = strtoupper($firstRoom->name);
                  }
                  if ($firstRoom->price) {
                      $firstSpecs[] = '₹' . number_format($firstRoom->price, 0) . ' ' . strtoupper($firstRoom->price_unit ?? 'per night');
                  }
                @endphp
                {!! implode('<br>', $firstSpecs) !!}
              @else
                PRESIDENTIAL POOL VILLA<br>
                2,400 SQ.FT LIVING SPACE<br>
                PRIVATE PLUNGE POOL<br>
                24/7 DEDICATED BUTLER
              @endif
            </div>
          </div>

          <!-- Center: Large Featured Contemporary Villa Lounge -->
          <div class="resort-slider-main-photo" id="resortMainPhoto">
            @if(isset($rooms) && $rooms->isNotEmpty() && $rooms->first()->image)
              <img src="{{ $rooms->first()->image_url }}" alt="{{ $rooms->first()->name }}" loading="lazy" id="resortMainImg">
            @else
              <img src="{{ asset('assets/frontend/images/pool.webp') }}" alt="Azeezia Contemporary Villa Lounge with Private Pool Access" loading="lazy" id="resortMainImg">
            @endif
          </div>

          <!-- Right: Peeking Preview Photo (Matching Reference Asymmetry) -->
          <div class="resort-slider-peeking-photo" id="resortPeekingPhoto" title="Click to view second photo / next suite" role="button" tabindex="0" aria-label="Next villa preview">
            @if(isset($rooms) && $rooms->isNotEmpty())
              @php 
                $peekingSrc = $rooms->first()->image_2_url ?: ($rooms->count() > 1 ? $rooms[1]->image_url : $rooms->first()->image_url);
              @endphp
              <img src="{{ $peekingSrc }}" alt="{{ $rooms->first()->name }} Secondary View" loading="lazy" id="resortPeekingImg">
            @else
              <img src="{{ asset('assets/frontend/images/bedrrom.webp') }}" alt="Azeezia Sunset Villa Exterior" loading="lazy" id="resortPeekingImg">
            @endif
          </div>

        </div>

      </div>
    </section>

    <!-- ========================================================================
         SECTION 4: ARCHITECTURAL SPACES & AMENITIES (EXACT REFERENCE SECTION 3)
         3-Column Horizontal Photo Cards with Underlined Titles & Captions
         ======================================================================== -->
    <section class="resort-amenities-section" id="amenities">
      <div class="resort-container">
        
        <div class="resort-section-header-block">
          <div class="resort-vertical-line-kicker">
            <span class="resort-v-line"></span>
            <span class="resort-kicker-text">AMENITIES</span>
          </div>
          <h2 class="resort-section-title heading-fade-in-up">
            <span class="az-title-dark">ARCHITECTURAL DETAILS</span><br>
            <span class="az-title-accent">CRAFTED FOR REST</span>
          </h2>
        </div>

        <div class="resort-amenities-grid">
          
          <!-- Card 1: Sun Deck & Pool -->
          <div class="resort-amenity-card">
            <div class="amenity-card-img-wrap">
              <img src="{{asset('assets/frontend/images/pool.webp')}}" alt="Private Sun Deck and Tropical Plunge Pool" loading="lazy">
            </div>
            <div class="amenity-card-body">
              <h3 class="resort-card-title">TROPICAL SUN DECK &amp; POOL</h3>
              <p class="amenity-card-desc">
                Private sun loungers nestled beneath swaying palms and shaded canopies with temperature-controlled crystal water.
              </p>
            </div>
          </div>

          <!-- Card 2: Master Bedroom -->
          <div class="resort-amenity-card">
            <div class="amenity-card-img-wrap">
              <img src="{{asset('assets/frontend/images/bedrrom.webp')}}" alt="Azeezia Luxury Master Bedroom Suite" loading="lazy">
            </div>
            <div class="amenity-card-body">
              <h3 class="resort-card-title">CONTEMPORARY MASTER BEDROOM</h3>
              <p class="amenity-card-desc">
                Plush king bedding, acoustic insulation, customized climate control, and ambient cove lighting designed for deep slumber.
              </p>
            </div>
          </div>

          <!-- Card 3: In-Villa Dining -->
          <div class="resort-amenity-card">
            <div class="amenity-card-img-wrap">
              <img src="{{asset('assets/frontend/images/dining.webp')}}" alt="Bespoke In-Villa Dining and Lounge" loading="lazy">
            </div>
            <div class="amenity-card-body">
              <h3 class="resort-card-title">BESPOKE IN-VILLA DINING</h3>
              <p class="amenity-card-desc">
                Farm-to-table gourmet culinary service served directly on your private patio by dedicated hospitality chefs.
              </p>
            </div>
          </div>

        </div>

      </div>
    </section>

    <!-- ========================================================================
         SECTION 5: PANORAMIC SUNSET HORIZON LOUNGE (EXACT REFERENCE SECTION 4)
         Full-width wide panoramic shot with grand overlay title & floating badge
         ======================================================================== -->
    <section class="resort-panorama-section" id="panorama-view">
      <div class="resort-panorama-bg">
        <img src="{{asset('assets/frontend/images/floating-restaurent.webp')}}" alt="Azeezia Sunset Horizon Luxury Villa Pavilion" loading="lazy">
        <div class="resort-panorama-overlay"></div>
      </div>

      <!-- Top Overlay Title -->
      <div class="resort-panorama-top">
        <h2 class="resort-panorama-title heading-fade-in-up">
          <span class="az-title-dark" style="color: #FFFFFF !important;">FLOATING RESTAURANT</span><br>
          <span class="az-title-accent">COMING SOON</span>
        </h2>
      </div>

      <!-- Bottom Row: Right Floating Caption Badge -->
      <div class="resort-panorama-bottom">
        <div class="resort-panorama-floating-badge">
          <p>
            An extraordinary dining experience is on its way, where serene waters, breathtaking views, and exceptional flavours come together.          </p>
        </div>
      </div>
    </section>

    <!-- ========================================================================
         SECTION 6: ASYMMETRIC BEDROOM & BATH DETAIL (EXACT REFERENCE SECTION 5)
         Master suite photo + Center narrative + Right luxury en-suite
         ======================================================================== -->
    <section class="resort-details-section" id="comfort-spaces">
      <div class="resort-container">
        
        <div class="resort-section-header-block">
          <div class="resort-vertical-line-kicker">
            <span class="resort-v-line"></span>
            <span class="resort-kicker-text">INTERIORS</span>
          </div>
          <h2 class="resort-section-title heading-fade-in-up">
            <span class="az-title-dark">COMFORT &amp; AESTHETICS</span><br>
            <span class="az-title-accent">IN EVERY CREATED SPACE</span>
          </h2>
        </div>

        <div class="resort-details-stage">
          
          <!-- Left: Master Suite Bedroom -->
          <div class="resort-detail-photo-left">
            <img src="{{asset('assets/frontend/images/1bhk.webp')}}" alt="Azeezia Master Bedroom with Ambient Floor Lighting" loading="lazy">
          </div>

          <!-- Center: Narrative Description -->
          <div class="resort-detail-center-content">
            <p class="resort-detail-text">
              Every fixture and surface is carefully curated to offer serene privacy. Tailored for unforgettable honeymoons, intimate destination wedding stays, and holistic weekend retreats amid pristine nature.
            </p>
          </div>

          <!-- Right: En-Suite Bathroom with Glass Partition -->
          <div class="resort-detail-photo-right">
            <img src="{{asset('assets/frontend/images/2bhk.webp')}}" alt="Azeezia Luxury Bathroom En-Suite with Glass Partition" loading="lazy">
          </div>

        </div>

      </div>
    </section>

    <!-- ========================================================================
         SECTION 7: EDITORIAL CURATOR INVITATION (MINIMAL LUXURY INVITATION)
         Exact design matching Services page reference (Reserve Your Moment)
         ======================================================================== -->
    <section class="editorial-invitation-section" id="resort-booking" aria-label="Reserve Your Resort Stay">
      <!-- Delicate Background Contour Art (Identical to reference design) -->
      <div class="editorial-invitation-bg-art" aria-hidden="true">
        <svg class="invitation-contour-svg" viewBox="0 0 1440 600" fill="none" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M 0 120 C 240 180, 280 380, 220 600" stroke="#E6E1D7" stroke-width="1.2" stroke-linecap="round" />
          <path d="M 90 0 C 200 200, 170 420, 40 600" stroke="#EDE8DF" stroke-width="0.8" stroke-dasharray="4 8" stroke-linecap="round" />
          <path d="M 1340 0 C 1220 220, 1320 440, 1440 550" stroke="#E6E1D7" stroke-width="1" stroke-linecap="round" />
          <path d="M 1240 0 C 1380 260, 1280 480, 1380 600" stroke="#EDE8DF" stroke-width="0.8" stroke-dasharray="4 8" stroke-linecap="round" />
        </svg>
      </div>

      <div class="editorial-invitation-inner">
        <span class="editorial-eyebrow">RESERVE YOUR MOMENT</span>
        <h2 class="editorial-invitation-title heading-fade-in-up">
          <span class="invitation-title-line az-title-dark">BEGIN CURATING YOUR</span>
          <span class="invitation-title-line az-title-accent">EXTRAORDINARY RETREAT</span>
        </h2>
        <p class="editorial-invitation-desc">
          Connect directly with our dedicated resort concierge to tour our private pool villas, curate bespoke culinary menus, and reserve preferred dates for your milestone gathering.
        </p>
        <div class="editorial-invitation-actions">
          <a href="{{route('contact')}}" class="az-signature-btn" aria-label="Connect with Resort Concierge">
            <span class="az-sig-btn-line" aria-hidden="true"></span>
            <span class="az-sig-btn-text">CONNECT WITH RESORT CONCIERGE</span>
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
</main>
@endsection

@push('script')
@if(isset($rooms) && $rooms->isNotEmpty())
@php
    $roomSlides = $rooms->map(function ($r) {
        $specs = [];
        if (!empty($r->description)) {
            if (str_contains($r->description, "\n")) {
                $lines = array_filter(array_map('trim', explode("\n", $r->description)));
            } elseif (str_contains($r->description, ',')) {
                $lines = array_filter(array_map('trim', explode(',', $r->description)));
            } else {
                $lines = [trim($r->description)];
            }
            foreach ($lines as $line) {
                $specs[] = strtoupper($line);
            }
        } elseif (!empty($r->name)) {
            $specs[] = strtoupper($r->name);
        }

        if ($r->price) {
            $specs[] = '₹' . number_format($r->price, 0) . ' ' . strtoupper($r->price_unit ?? 'per night');
        }

        return [
            'name' => strtoupper($r->name),
            'specs' => $specs,
            'image' => $r->image_url,
            'image_2' => $r->image_2_url ?: null,
        ];
    });
@endphp
<script>
document.addEventListener('DOMContentLoaded', function () {
    const rooms = @json($roomSlides);

    if (!rooms.length) return;

    let currentRoomIndex = 0;
    let isShowingSecondary = false;

    const prevBtn = document.getElementById('resortPrevBtn');
    const nextBtn = document.getElementById('resortNextBtn');
    const peekingPhoto = document.getElementById('resortPeekingPhoto');
    const mainImg = document.getElementById('resortMainImg');
    const peekingImg = document.getElementById('resortPeekingImg');
    const specCaption = document.getElementById('resortSlideSpecs');
    const mainPhotoWrap = document.getElementById('resortMainPhoto');

    function renderSlide(animate) {
        const current = rooms[currentRoomIndex];
        const nextRoom = rooms[(currentRoomIndex + 1) % rooms.length];

        // Determine which image is primary in the center and which is peeking
        let centerSrc = current.image;
        let peekSrc = current.image_2 || (rooms.length > 1 ? nextRoom.image : current.image);

        if (isShowingSecondary && current.image_2) {
            centerSrc = current.image_2;
            peekSrc = current.image;
        }

        const updateContent = function () {
            if (mainImg) {
                mainImg.src = centerSrc;
                mainImg.alt = current.name + (isShowingSecondary ? ' Secondary Photo' : ' Primary Photo');
            }
            if (peekingImg) {
                peekingImg.src = peekSrc;
                peekingImg.alt = isShowingSecondary ? (current.name + ' Primary Photo') : (current.image_2 ? current.name + ' Secondary Photo' : nextRoom.name);
            }
            if (specCaption) {
                specCaption.innerHTML = current.specs.join('<br>');
            }

            if (animate) {
                if (mainPhotoWrap) mainPhotoWrap.classList.remove('is-fading');
                if (specCaption) specCaption.classList.remove('is-fading');
                if (peekingPhoto) peekingPhoto.classList.remove('is-fading');
            }
        };

        if (animate) {
            if (mainPhotoWrap) mainPhotoWrap.classList.add('is-fading');
            if (specCaption) specCaption.classList.add('is-fading');
            if (peekingPhoto) peekingPhoto.classList.add('is-fading');
            setTimeout(updateContent, 220);
        } else {
            updateContent();
        }
    }

    function changeRoom(newIndex) {
        currentRoomIndex = (newIndex + rooms.length) % rooms.length;
        isShowingSecondary = false;
        renderSlide(true);
    }

    if (prevBtn) {
        prevBtn.addEventListener('click', function (e) {
            e.preventDefault();
            changeRoom(currentRoomIndex - 1);
        });
    }

    if (nextBtn) {
        nextBtn.addEventListener('click', function (e) {
            e.preventDefault();
            changeRoom(currentRoomIndex + 1);
        });
    }

    if (peekingPhoto) {
        peekingPhoto.addEventListener('click', function (e) {
            e.preventDefault();
            const current = rooms[currentRoomIndex];
            if (current.image_2) {
                // Toggle between primary and secondary photo
                isShowingSecondary = !isShowingSecondary;
                renderSlide(true);
            } else if (rooms.length > 1) {
                // If no secondary image, advance to next room
                changeRoom(currentRoomIndex + 1);
            }
        });
    }
});
</script>
@endif
@endpush
