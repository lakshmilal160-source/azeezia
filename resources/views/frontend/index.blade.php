@extends('frontend.layout.default')
@section('content')
    <!-- ========================================================================
           HERO BANNER SECTION (REAL EDITABLE HTML & CSS - EXACT NEW REFERENCE)
           Illuminated Resort Scenery, Luxury Display Typography & Retro Beetle Car
           ======================================================================== -->
    <section class="hero-section hero-luxury-editorial" id="home">

        <!-- Background Scenery: Dusk Resort Driveway & Lit Building -->
        <div class="hero-scenery-backdrop">
            <img src="{{ $banner && $banner->banner_image ? asset('storage/' . $banner->banner_image) : asset('assets/frontend/images/hero-resort-driveway.webp') }}"
                alt="Azeezia Luxury Resort & Convention Centre Driveway" class="hero-backdrop-img">
            <div class="hero-scenery-overlay"></div>
        </div>

        <!-- Left Editorial Typography & Action Signature (Exact Reference Design) -->
        <div class="hero-content-container">
            <div class="hero-editorial-card">

                <!-- Two-line Kicker Eyebrow: A DESTINATION / FOR LIFE'S FINEST MOMENTS -->
                <div class="hero-eyebrow-kicker">
                    <span class="hero-kicker-line">A DESTINATION</span>
                    <span class="hero-kicker-line">FOR LIFE'S FINEST MOMENTS</span>
                </div>

                <!-- Grand Display Heading: EXTRAORDINARY / CELEBRATIONS -->
                <h1 class="hero-grand-title heading-fade-in-up">
                    <span class="hero-title-line az-title-dark">EXTRAORDINARY</span>
                    <span class="hero-title-line az-title-accent">CELEBRATIONS</span>
                </h1>

                <!-- Signature Action: Horizontal Line + AT AZEEZIA + Circular Arrow Button -->
                <div class="hero-action-signature">
                    <a href="{{ route('services') }}" class="hero-signature-link"
                        aria-label="Explore celebrations at Azeezia">
                        <span class="hero-sig-line" aria-hidden="true"></span>
                        <span class="hero-sig-text">AT AZEEZIA</span>
                        <span class="hero-sig-circle-btn">
                            <svg class="sig-arrow-svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </span>
                    </a>
                </div>

            </div>
        </div>

        <!-- Vintage Retro Beetle Car with Groom & Bride (Overlapping Bottom Curve) -->
        <div class="hero-car-forward-stage" id="heroCarForwardStage">
            <!-- Ground Shadow Underneath Car -->
            <div class="hero-car-ground-shadow"></div>

            <!-- Front-Facing Convertible Car with Groom & Bride -->
            <div class="hero-car-composition">
                <img src="{{ asset('assets/frontend/images/hero-front-car.webp') }}"
                    alt="Azeezia Wedding Couple in Retro Convertible Car" class="hero-front-car-img" id="heroFrontCarImg">

                <!-- Glowing Headlight Lens Flares with Shimmer -->
                <div class="car-headlight-flare flare-l"></div>
                <div class="car-headlight-flare flare-r"></div>
            </div>
        </div>

        <!-- Organic Wave Curve Transition into Next Section (Pure White Transition) -->
        <div class="hero-bottom-curve-wrap" aria-hidden="true">
            <svg class="hero-bottom-curve-svg" viewBox="0 0 1440 120" fill="none" preserveAspectRatio="none">
                <path d="M0,70 C280,72 520,96 760,98 C1020,100 1220,62 1440,36 L1440,120 L0,120 Z" fill="#FFFFFF" />
            </svg>
        </div>

    </section>

    <!-- ========================================================================
           SECTION: AZEEZIA CONVENTION CENTRE (EXACT NEW REFERENCE DESIGN)
           "Where grand conventions, seamless gatherings and timeless celebrations meet"
           Matching uploaded reference media_1792246035500_e2d69175.png
           ======================================================================== -->
    <section class="convention-centre-editorial" id="event-planning">
        <span id="convention-centre" class="section-anchor" aria-hidden="true"></span>

        <!-- Atmospheric Ambient Glows (Exact Reference Mood) -->
        <div class="cc-ambient-glow glow-bottom-left" aria-hidden="true"></div>
        <div class="cc-ambient-glow glow-top-right" aria-hidden="true"></div>

        <div class="cc-editorial-container">
            <div class="cc-stage-grid">

                <!-- Left / Main Typographic Area -->
                <div class="cc-main-typography">

                    <!-- Grand Serif Headline (Exact Reference Typography) -->
                    <h2 class="cc-grand-headline az-about-headline heading-fade-in-up">
                        <span class="cc-hl-line cc-hl-line-1 az-title-dark">grand conventions,</span>
                        <span class="cc-hl-line cc-hl-line-3 az-title-dark">seamless gatherings and</span>
                        <span class="cc-hl-line cc-hl-line-4 az-title-accent">timeless celebrations</span>
                    </h2>

                    <!-- Bottom Row: Sub Note & Button on Left, "meet" on Center/Right -->
                    <div class="cc-bottom-stage">

                        <!-- Left Group: Supporting Paragraph + Signature Action Button -->
                        <div class="cc-bottom-left-group">
                            <p class="cc-sub-body-text">
                                Spacious interiors,
                                beautiful ambience and
                                a venue designed to host<br>
                                memorable events with ease.
                            </p>

                            <!-- Signature Action: Horizontal Line + AT AZEEZIA CONVENTION CENTRE + Circle Arrow Button -->
                            <div class="cc-action-signature">
                                <a href="{{ route('services') }}" class="cc-signature-link"
                                    aria-label="Explore Azeezia Convention Centre">
                                    <span class="cc-sig-line" aria-hidden="true"></span>
                                    <span class="cc-sig-text">AT AZEEZIA CONVENTION CENTRE</span>
                                    <span class="cc-sig-circle-btn">
                                        <svg class="cc-sig-arrow" width="16" height="16" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <line x1="5" y1="12" x2="19" y2="12"></line>
                                            <polyline points="12 5 19 12 12 19"></polyline>
                                        </svg>
                                    </span>
                                </a>
                            </div>
                        </div>



                    </div>

                </div>

                <!-- Right Column: Top Right Paragraph + Circular Stamp Badge & Downward Arrow Stem -->
                <aside class="cc-right-column">

                    <!-- Top Right Supporting Paragraph -->
                    <div class="cc-top-body-text">
                        <p>
                            A premium convention centre for weddings,<br>
                            corporate events and special celebrations,<br>
                            Azeezia offers elegant spaces,<br>
                            modern facilities and flawless hospitality<br>
                            for every occasion.
                        </p>
                    </div>

                    <!-- Stamped Circular Badge & Stem Arrow -->
                    <div class="cc-stamp-aside">
                        <a href="{{ route('services') }}" class="cc-scroll-stamp"
                            aria-label="Scroll down to Special Events section">
                            <div class="cc-stamp-badge">
                                <svg class="cc-stamp-svg" viewBox="0 0 100 100">
                                    <defs>
                                        <path id="ccStampCircle" d="M 50,50 m -36,0 a 36,36 0 1,1 72,0 a 36,36 0 1,1 -72,0"
                                            fill="none" />
                                    </defs>
                                    <text class="cc-stamp-letters">
                                        <textPath href="#ccStampCircle" startOffset="0%">
                                            • WEDDINGS • CORPORATE • EVENTS • CONFERENCES
                                        </textPath>
                                    </text>
                                </svg>
                                <div class="cc-stamp-rings" aria-hidden="true">
                                    <svg width="24" height="15" viewBox="0 0 24 15" fill="none"
                                        stroke="currentColor" stroke-width="1.4">
                                        <circle cx="7.5" cy="7.5" r="5.5" />
                                        <circle cx="16.5" cy="7.5" r="5.5" />
                                    </svg>
                                </div>
                            </div>

                            <!-- Downward Arrow Stem Line -->
                            <div class="cc-stamp-stem">
                                <span class="cc-stem-bar"></span>
                                <svg class="cc-stem-arrow-svg" width="14" height="12" viewBox="0 0 14 12"
                                    fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M1 5L7 11L13 5" />
                                </svg>
                            </div>
                        </a>
                    </div>

                </aside>

            </div>
        </div>
    </section>

    <!-- ========================================================================
           SECTION: ABOUT US — A DESTINATION FOR LIFE’S FINEST MOMENTS
           Exact replication of uploaded reference design media_1792262601449_f016128a.jpg
           5-column symmetrical layout: 4 vertical event photo frames + central editorial
           ======================================================================== -->
    <section class="az-about-editorial-section" id="about">
        <span id="about-moments" class="section-anchor" aria-hidden="true"></span>

        <div class="az-about-container">
            <div class="az-about-grid">

                <!-- Column 1: Left Outer Features Slider (Staggered lower) -->
                <div class="az-about-photo-col col-photo-1">
                    <div class="az-about-photo-frame frame-staggered">
                        <div class="az-about-slider" data-slider-group="left"
                            aria-label="Thrissur Convention Centre Features Slider">
                            @forelse ($conventionFeatures as $feature)
                                <div class="az-about-slide {{ $loop->first ? 'active' : '' }}">
                                    <img src="{{ $feature->image_url ?? asset('assets/images/hero-resort-driveway.jpg') }}"
                                        alt="{{ $feature->title }}" class="az-about-img"
                                        loading="lazy">
                                    <div class="az-about-slide-caption">
                                        <h3 class="az-about-slide-title">{{ $feature->title }}</h3>
                                    </div>
                                </div>
                            @empty
                                <div class="az-about-slide active">
                                    <img src="{{ asset('assets/images/hero-resort-driveway.jpg') }}"
                                        alt="Spacious Parking" class="az-about-img" loading="lazy">
                                    <div class="az-about-slide-caption">
                                        <h3 class="az-about-slide-title">Spacious Parking</h3>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Column 2: Left Inner Features Slider (Tall) -->
                <div class="az-about-photo-col col-photo-2">
                    <div class="az-about-photo-frame frame-tall">
                        <div class="az-about-slider" data-slider-group="left"
                            aria-label="Thrissur Convention Centre Features Slider">
                            @forelse ($conventionFeatures as $feature)
                                <div class="az-about-slide {{ ($loop->iteration === 2 || ($loop->first && $loop->count < 2)) ? 'active' : '' }}">
                                    <img src="{{ $feature->image_url ?? asset('assets/images/azeezia_pazhuvil_11.jpg') }}"
                                        alt="{{ $feature->title }}" class="az-about-img"
                                        loading="lazy">
                                    <div class="az-about-slide-caption">
                                        <h3 class="az-about-slide-title">{{ $feature->title }}</h3>
                                    </div>
                                </div>
                            @empty
                                <div class="az-about-slide active">
                                    <img src="{{ asset('assets/images/azeezia_pazhuvil_11.jpg') }}"
                                        alt="Spacious Event Halls" class="az-about-img" loading="lazy">
                                    <div class="az-about-slide-caption">
                                        <h3 class="az-about-slide-title">Spacious Event Halls</h3>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Column 3: Center Editorial Content Column -->
                <div class="az-about-center-col">

                    <!-- Grand Headline (Two-Tone Brand Black & Olive Accent Combination) -->
                    <h2 class="az-about-headline heading-fade-in-up">
                        <span class="az-title-dark">THRISSUR CONVENTION</span><br>
                        <span class="az-title-accent">CENTER FEATURES</span>
                    </h2>

                    <!-- Short Professional Description -->
                    <p class="az-about-desc">
                        Crafted to host grand weddings, corporate conclaves, and milestone celebrations with effortless
                        elegance. Azeezia Thrissur offers expansive pillarless halls, advanced audio-visual and DJ systems,
                        seamless high-speed Wi-Fi, magnificent lighting, spacious parking, and luxurious seating designed
                        for unforgettable gatherings.
                    </p>

                    <!-- Signature Read More Button -->
                    <div class="az-about-action-wrap">
                        <a href="{{ route('services') }}" class="az-signature-btn"
                            aria-label="Read more about Thrissur Convention Center features">
                            <span class="az-sig-btn-line" aria-hidden="true"></span>
                            <span class="az-sig-btn-text">READ MORE</span>
                            <span class="az-sig-btn-circle">
                                <svg class="az-sig-btn-arrow" width="16" height="16" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <polyline points="12 5 19 12 12 19"></polyline>
                                </svg>
                            </span>
                        </a>
                    </div>
                </div>

                <!-- Column 4: Right Inner Features Slider (Tall) -->
                <div class="az-about-photo-col col-photo-3">
                    <div class="az-about-photo-frame frame-tall">
                        <div class="az-about-slider" data-slider-group="right"
                            aria-label="Thrissur Convention Centre Features Slider">
                            @forelse ($conventionFeatures as $feature)
                                <div class="az-about-slide {{ ($loop->iteration === 3 || ($loop->first && $loop->count < 3)) ? 'active' : '' }}">
                                    <img src="{{ $feature->image_url ?? asset('assets/images/event-wedding-hd.jpg') }}"
                                        alt="{{ $feature->title }}" class="az-about-img"
                                        loading="lazy">
                                    <div class="az-about-slide-caption">
                                        <h3 class="az-about-slide-title">{{ $feature->title }}</h3>
                                    </div>
                                </div>
                            @empty
                                <div class="az-about-slide active">
                                    <img src="{{ asset('assets/images/event-wedding-hd.jpg') }}"
                                        alt="Stage Decoration" class="az-about-img" loading="lazy">
                                    <div class="az-about-slide-caption">
                                        <h3 class="az-about-slide-title">Stage Decoration</h3>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Column 5: Right Outer Features Slider (Staggered lower) -->
                <div class="az-about-photo-col col-photo-4">
                    <div class="az-about-photo-frame frame-staggered">
                        <div class="az-about-slider" data-slider-group="right"
                            aria-label="Thrissur Convention Centre Features Slider">
                            @forelse ($conventionFeatures as $feature)
                                <div class="az-about-slide {{ ($loop->iteration === 4 || ($loop->first && $loop->count < 4)) ? 'active' : '' }}">
                                    <img src="{{ $feature->image_url ?? asset('assets/images/stage-musical-event.jpg') }}"
                                        alt="{{ $feature->title }}" class="az-about-img"
                                        loading="lazy">
                                    <div class="az-about-slide-caption">
                                        <h3 class="az-about-slide-title">{{ $feature->title }}</h3>
                                    </div>
                                </div>
                            @empty
                                <div class="az-about-slide active">
                                    <img src="{{ asset('assets/images/stage-musical-event.jpg') }}"
                                        alt="Advanced Audio-Visual Systems" class="az-about-img" loading="lazy">
                                    <div class="az-about-slide-caption">
                                        <h3 class="az-about-slide-title">Advanced Audio-Visual Systems</h3>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Bottom Wave Curve & Botanical Leaf Art -->
        <div class="az-about-bottom-accent" aria-hidden="true">
            <svg class="az-about-wave-svg" viewBox="0 0 1440 120" fill="none" preserveAspectRatio="none"
                xmlns="http://www.w3.org/2000/svg">
                <path d="M0,60 C320,120 420,20 720,50 C1020,80 1120,20 1440,60 L1440,120 L0,120 Z" fill="#F4EFEA"
                    opacity="0.65" />
            </svg>
            <div class="az-about-leaf-art">
                <img src="{{asset('assets/frontend/images/about-bottom-leaf.webp')}}" alt="" class="az-about-leaf-img"
                    aria-hidden="true">
            </div>
        </div>
    </section>

    <!-- ========================================================================
           7A-2. SECTION: SPECIAL EVENTS CAROUSEL
           1 Slide at a time: 1. Corporate Events, 2. Wedding, 3. Reception, 4. Birthday
           Placed directly under Azeezia Convention Centre Section
           ======================================================================== -->
    <section class="az-events-section" id="special-events" aria-label="Special Events Carousel">
        <span id="services" class="section-anchor" aria-hidden="true"></span>
        <!-- Corner Botanical Leaf Art (Exact Match from Reference) -->

        <div class="az-events-container">
            <!-- Centered Heading Group (Subtitle and tabs removed per request) -->


            <!-- Carousel Main Stage (Exactly 1 Slide Displayed at a Time) -->
            <div class="az-carousel-stage-wrapper" id="azEventsCarousel" role="region" aria-roledescription="carousel"
                aria-label="Azeezia Events Showcase">
                @forelse ($services as $index => $service)
                    
                    <article class="az-carousel-slide {{ $index === 0 ? 'active' : '' }}" id="slide-{{ $service->id }}"
                        role="tabpanel" aria-labelledby="tab-corporate"
                        aria-hidden="{{ $index === 0 ? 'false' : 'true' }}">
                        <div class="az-slide-card">
                            <!-- Left Hero Photo Column -->
                            <div class="az-slide-hero-col">
                                <img src="{{ asset('storage/' . $service->image) }}"
                                    alt="Azeezia Executive Corporate Gathering" class="az-slide-hero-img" loading="lazy">
                                {{-- <div class="az-hero-badge-tag">Azeezia Corporate</div> --}}
                            </div>

                            <!-- Right Content Column -->
                            <div class="az-slide-info-col">
                                <!-- Eyebrow Row with Horizontal Olive Accent Line -->
                                <div class="az-slide-eyebrow-row">
                                    {{-- <span class="az-slide-eyebrow-text">WE HOST PROFESSIONAL GATHERINGS</span> --}}
                                    <span class="az-slide-eyebrow-line" aria-hidden="true"></span>
                                </div>

                                <!-- Two-tone Serif Title -->
                                @php
                        $titleParts = explode(' ', trim($service->title), 2);
                    @endphp

                    <h3 class="az-slide-title">
                        <span class="az-title-dark">{{ $titleParts[0] }}</span>
                        @if (isset($titleParts[1]))
                            <span class="az-title-accent">{{ $titleParts[1] }}</span>
                        @endif
                    </h3>
                                <!-- Description & Button Group -->
                                <div class="az-slide-text-body">
                                    <p class="az-slide-desc">
                                        {{ $service->description }}
                                    </p>

                                    <a href="#contact" class="az-signature-btn btn-claim-offer"
                                        data-event-type="Corporate" aria-label="Explore Corporate Events at Azeezia">
                                        <span class="az-sig-btn-line" aria-hidden="true"></span>
                                        <span class="az-sig-btn-text">EXPLORE EVENT</span>
                                        <span class="az-sig-btn-circle">
                                            <svg class="az-sig-btn-arrow" width="16" height="16"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <line x1="5" y1="12" x2="19" y2="12">
                                                </line>
                                                <polyline points="12 5 19 12 12 19"></polyline>
                                            </svg>
                                        </span>
                                    </a>
                                </div>

                                <!-- Floating Visual Montage on Right -->
                                <div class="az-slide-collage" aria-hidden="true">
                                    <div class="az-collage-thumb az-thumb-top">
                                        <img src="{{ asset('assets/frontend/images/azeezia-stage.webp') }}"
                                            alt="Executive Boardroom Meeting Table" loading="lazy">
                                    </div>
                                    <div class="az-collage-thumb az-thumb-bottom">
                                        <img src="{{ asset('assets/frontend/images/azeezia-catering.webp') }}"
                                            alt="Luxury Floral Centrepiece & Votives" loading="lazy">
                                    </div>
                                </div>

                                <!-- Delicate Geometric SVG Line Art at Bottom Right -->
                                <svg class="az-slide-deco-arc" viewBox="0 0 300 260" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <circle cx="260" cy="180" r="130" stroke="#9BB83D" stroke-width="1"
                                        opacity="0.45" />
                                    <circle cx="260" cy="180" r="85" stroke="#9BB83D" stroke-width="1"
                                        opacity="0.35" />
                                    <line x1="120" y1="180" x2="280" y2="180" stroke="#9BB83D"
                                        stroke-width="1" opacity="0.55" />
                                    <circle cx="170" cy="180" r="8" fill="#9BB83D" />
                                </svg>
                            </div>
                        </div>
                    </article>
                @empty
                @endforelse


            </div>

            <!-- Carousel Footer Controls (Arrows, Indicators & Counter) -->
            <div class="az-carousel-controls">
                <div class="az-carousel-counter">
                    <span class="az-counter-current" id="azCounterCurrent">01</span>
                    <span class="az-counter-divider">/</span>
                    <span class="az-counter-total">04</span>
                </div>

                <div class="az-carousel-progress">
                    <div class="az-progress-fill" id="azProgressFill"></div>
                </div>

                <div class="az-carousel-arrow-group">
                    <button class="az-carousel-btn az-btn-prev" id="azEventsPrev" aria-label="Previous Slide">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="15 18 9 12 15 6"></polyline>
                        </svg>
                    </button>
                    <button class="az-carousel-btn az-btn-next" id="azEventsNext" aria-label="Next Slide">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </section>


    <!-- ========================================================================
           SECTION: WEDDING JOURNEY CAR SCROLL ANIMATION
           "ARRIVING IN TIMELESS ELEGANCE"
           (Groom & Bride Driving from Left to Right with Rotating Tires)
           ======================================================================== -->
    <section class="car-scroll-track" id="wedding-journey">
        <div class="car-sticky-frame">
            <!-- Background Luxury Scenic Atmosphere -->
            <div class="car-scenic-backdrop">
                <div class="scenic-gradient-overlay"></div>
                <div class="scenic-stars-layer"></div>
            </div>

            <!-- Scenic Offer-Focused Header -->
            <div class="car-track-header" id="carTrackHeader">

                <h2 class="car-track-title heading-fade-in-up">
                    <span class="car-title-light az-title-dark">EXCLUSIVE EVENT</span>
                    <span class="car-title-accent az-title-accent">SPECIAL OFFER</span>
                </h2>
                <p class="car-track-subtitle">Book your dream celebration at Azeezia to unlock exclusive privileges —
                    including complimentary vintage bridal car entry, luxury decor upgrades &amp; bespoke venue packages.
                </p>
                <div class="car-track-cta">
                    <a href="#contact" class="az-signature-btn light btn-claim-offer"
                        data-offer-name="Azeezia Special Wedding &amp; Event Offer" data-venue="thrissur"
                        data-event-type="Wedding" aria-label="Enquire about Azeezia Special Offers">
                        <span class="az-sig-btn-line" aria-hidden="true"></span>
                        <span class="az-sig-btn-text">ENQUIRE NOW</span>
                        <span class="az-sig-btn-circle">
                            <svg class="az-sig-btn-arrow" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </span>
                    </a>
                </div>
            </div>

            <!-- Scenic Road & Driving Track Stage -->
            <div class="car-road-stage">
                <!-- Road Lane -->
                <div class="car-road-container">
                    <div class="car-road-surface"></div>
                    <div class="car-road-lane-line"></div>
                </div>

                <!-- Animated Wedding Car: Groom & Bride Inside Car Moving Left to Right with Rotating Tires -->
                <div class="hero-wedding-car idle-drive" id="heroWeddingCar"
                    aria-label="Bride and Groom driving in luxury vintage convertible wedding car">
                    <div class="car-body-wrapper">
                        <img src="{{ asset('assets/frontend/images/wedding-car.webp') }}"
                            alt="Bride and Groom in Luxury Vintage Wedding Car" class="wedding-car-img"
                            id="weddingCarImg">
                        <!-- Rotating Wheel Hubcaps -->
                        <div class="car-wheel wheel-rear" id="wheelRear">
                            <img src="{{ asset('assets/frontend/images/car-wheel-hubcap.webp') }}"
                                alt="Rotating Rear Wheel" class="wheel-hubcap-img">
                        </div>
                        <div class="car-wheel wheel-front" id="wheelFront">
                            <img src="{{ asset('assets/frontend/images/car-wheel-hubcap.webp') }}"
                                alt="Rotating Front Wheel" class="wheel-hubcap-img">
                        </div>
                    </div>
                    <div class="car-ground-shadow"></div>
                </div>

                <!-- Floating Petals & Sparkles Layer -->
                <div class="car-particles-layer" id="carParticles"></div>
            </div>
        </div>
    </section>

    <!-- ========================================================================
           SECTION: PHOTO GALLERY (FULL-WIDTH SLIDING MOVING GALLERY)
           Single Row, 4 Images Visible at a Time on Desktop, 4 Images Scroll per Step
           ======================================================================== -->
    <section class="az-moving-gallery-section" id="gallery" aria-label="Azeezia Photo Gallery">

        <!-- Header Container -->
        <div class="az-moving-gallery-header-container">


            <div class="az-moving-gallery-headline-row">
                <h2 class="az-editorial-heading heading-fade-in-up">
                    <span class="az-title-dark">PHOTO</span>
                    <span class="az-title-accent">GALLERY</span>
                </h2>

                <!-- Slider Navigation Controls -->
                <div class="az-moving-gallery-nav-group">
                    <button class="az-moving-gallery-ctrl-btn prev-btn" id="azGalleryMovePrev"
                        aria-label="Scroll back 4 images">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="15 18 9 12 15 6"></polyline>
                        </svg>
                    </button>

                    <div class="az-moving-gallery-counter">
                        <span class="az-moving-gallery-curr" id="azGalleryMoveCurrent">01</span>
                        <span class="az-moving-gallery-sep">/</span>
                        <span class="az-moving-gallery-total" id="azGalleryMoveTotal">04</span>
                    </div>

                    <button class="az-moving-gallery-ctrl-btn next-btn" id="azGalleryMoveNext"
                        aria-label="Scroll next 4 images">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </button>
                </div>
            </div>

            <p class="az-moving-gallery-subtitle">
                Every celebration tells a story. Explore moments from weddings, receptions, corporate gatherings, and grand
                celebrations hosted at Azeezia.
            </p>
        </div>

        <!-- Full-Width Slider Viewport (Edge-to-Edge Single Row) -->
        <div class="az-moving-gallery-viewport" id="azGalleryViewport">
            <div class="az-moving-gallery-track" id="azGalleryTrack">

                @forelse ($gallery as $index => $item)
                    @php
                        $categoryName = $item->category?->name ?? 'Gallery';
                        $location = $item->alt_text ?: ($item->category?->name ?? 'Azeezia Convention Centre');
                        $cardTitle = $item->title ?: $categoryName;
                        $imageSrc = \Illuminate\Support\Str::startsWith($item->image, ['http://', 'https://', 'assets/'])
                            ? asset($item->image)
                            : asset('storage/' . $item->image);
                    @endphp
                    <article class="az-moving-gallery-card" data-index="{{ $index }}" data-title="{{ $cardTitle }}"
                        data-tag="{{ $categoryName }}" data-location="{{ $location }}">
                        <img src="{{ $imageSrc }}"
                            alt="{{ $item->alt_text ?: $cardTitle }}"
                            class="az-moving-gallery-img" loading="lazy">
                        <div class="az-moving-gallery-card-overlay">
                            <div class="az-moving-gallery-card-top">
                                <span class="az-moving-gallery-tag">{{ $categoryName }}</span>
                                <div class="az-moving-gallery-zoom" aria-hidden="true"><i class="fas fa-expand-alt"></i>
                                </div>
                            </div>
                            <div class="az-moving-gallery-card-bottom">
                                <h3 class="az-moving-gallery-card-title">{{ $cardTitle }}</h3>

                            </div>
                        </div>
                    </article>
                @empty
                    <!-- Fallback Cards When No Gallery Images Added Yet -->
                    <article class="az-moving-gallery-card" data-index="0" data-title="Fairytale Destination Wedding"
                        data-tag="Weddings" data-location="Azeezia Convention Centre">
                        <img src="{{ asset('assets/images/event-wedding-hd.jpg') }}"
                            alt="Azeezia fairytale wedding ceremony and floral mandap architecture"
                            class="az-moving-gallery-img" loading="lazy">
                        <div class="az-moving-gallery-card-overlay">
                            <div class="az-moving-gallery-card-top">
                                <span class="az-moving-gallery-tag">Weddings</span>
                                <div class="az-moving-gallery-zoom" aria-hidden="true"><i class="fas fa-expand-alt"></i>
                                </div>
                            </div>
                            <div class="az-moving-gallery-card-bottom">
                                <h3 class="az-moving-gallery-card-title">Fairytale Destination Wedding</h3>
                                <span class="az-moving-gallery-card-meta"><i class="fas fa-map-marker-alt"></i> Azeezia
                                    Convention Centre</span>
                            </div>
                        </div>
                    </article>

                    <article class="az-moving-gallery-card" data-index="1" data-title="Executive Conclave &amp; Summit"
                        data-tag="Events" data-location="Pillarless Grand Hall">
                        <img src="{{ asset('assets/images/event-corporate-hd.jpg') }}"
                            alt="Executive business conclave, stage presentation and seating" class="az-moving-gallery-img"
                            loading="lazy">
                        <div class="az-moving-gallery-card-overlay">
                            <div class="az-moving-gallery-card-top">
                                <span class="az-moving-gallery-tag">Events</span>
                                <div class="az-moving-gallery-zoom" aria-hidden="true"><i class="fas fa-expand-alt"></i>
                                </div>
                            </div>
                            <div class="az-moving-gallery-card-bottom">
                                <h3 class="az-moving-gallery-card-title">Executive Conclave &amp; Summit</h3>
                                <span class="az-moving-gallery-card-meta"><i class="fas fa-map-marker-alt"></i> Pillarless
                                    Grand Hall</span>
                            </div>
                        </div>
                    </article>

                    <article class="az-moving-gallery-card" data-index="2" data-title="Milestone Birthday Celebrations"
                        data-tag="Birthday" data-location="Celebration Banquet Hall">
                        <img src="{{ asset('assets/images/event-birthday-hd.jpg') }}"
                            alt="Vibrant festive birthday celebration with balloon arches and illuminated stage"
                            class="az-moving-gallery-img" loading="lazy">
                        <div class="az-moving-gallery-card-overlay">
                            <div class="az-moving-gallery-card-top">
                                <span class="az-moving-gallery-tag">Birthday</span>
                                <div class="az-moving-gallery-zoom" aria-hidden="true"><i class="fas fa-expand-alt"></i>
                                </div>
                            </div>
                            <div class="az-moving-gallery-card-bottom">
                                <h3 class="az-moving-gallery-card-title">Milestone Birthday Celebrations</h3>
                                <span class="az-moving-gallery-card-meta"><i class="fas fa-map-marker-alt"></i> Celebration
                                    Banquet Hall</span>
                            </div>
                        </div>
                    </article>

                    <article class="az-moving-gallery-card" data-index="3" data-title="Luxury Resort Suite &amp; Lounge"
                        data-tag="Resort Room" data-location="Azeezia Resort, Thrissur">
                        <img src="{{ asset('assets/images/resort-hero-interior.jpg') }}"
                            alt="Luxury resort bedroom suite interior with plush furnishings" class="az-moving-gallery-img"
                            loading="lazy">
                        <div class="az-moving-gallery-card-overlay">
                            <div class="az-moving-gallery-card-top">
                                <span class="az-moving-gallery-tag">Resort Room</span>
                                <div class="az-moving-gallery-zoom" aria-hidden="true"><i class="fas fa-expand-alt"></i>
                                </div>
                            </div>
                            <div class="az-moving-gallery-card-bottom">
                                <h3 class="az-moving-gallery-card-title">Luxury Resort Suite &amp; Lounge</h3>
                                <span class="az-moving-gallery-card-meta"><i class="fas fa-map-marker-alt"></i> Azeezia
                                    Resort, Thrissur</span>
                            </div>
                        </div>
                    </article>
                @endforelse

            </div>

        </div><!-- Bottom Progress Dots & CTA Row -->
        <div class="az-moving-gallery-footer">
            <div class="az-moving-gallery-dots" id="azGalleryDots" role="tablist" aria-label="Gallery slide pages">
            </div>

            <div class="az-moving-gallery-cta">
                <a href="{{ route('gallery') }}" class="az-signature-btn"
                    aria-label="View complete Azeezia photograph collections">
                    <span class="az-sig-btn-line" aria-hidden="true"></span>
                    <span class="az-sig-btn-text">EXPLORE FULL GALLERY</span>
                    <span class="az-sig-btn-circle">
                        <svg class="az-sig-btn-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </span>
                </a>
            </div>
        </div>

    </section>

    <!-- ========================================================================
           SECTION: UPCOMING PROJECTS (TICKET-STYLE LUXURY EDITORIAL SHOWCASE)
           Exact Layout Matching Reference: Left Image, Center Info, Dotted Divider,
           Right Status & Serif Numerals (01, 02, 03, 04)
           ======================================================================== -->
    <section class="az-upcoming-section" id="upcoming-projects" aria-label="Azeezia Upcoming Projects">
        <div class="az-upcoming-container">

            <!-- Section Header -->
            <div class="az-upcoming-header-wrap">
                <div class="az-upcoming-eyebrow-row">
                    <span class="az-upcoming-eyebrow">FUTURE DEVELOPMENTS &amp; INITIATIVES</span>
                    <span class="az-upcoming-eyebrow-line" aria-hidden="true"></span>
                </div>
                <h2 class="az-editorial-heading heading-fade-in-up">
                    <span class="az-title-dark">UPCOMING</span>
                    <span class="az-title-accent">PROJECTS</span>
                </h2>
                <p class="az-upcoming-subtitle">
                    Expanding our vision beyond premier event spaces into holistic wellness sanctuaries, bespoke waterfront
                    dining, and immersive nature experiences.
                </p>
            </div>

            <!-- Ticket Stack Container -->
            <div class="az-upcoming-stack" id="upcomingProjectStack">

                @forelse ($upcomingProjects as $index => $project)
                    @php
                        $projectNum = sprintf('%02d', $project->order ?: ($index + 1));
                        $projectImage = $project->image
                            ? (\Illuminate\Support\Str::startsWith($project->image, ['http://', 'https://', 'assets/'])
                                ? asset($project->image)
                                : asset('storage/' . $project->image))
                            : asset('assets/images/resort-editorial-villa.jpg');
                        $statusClass = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $project->status ?? 'upcoming'));
                    @endphp
                    <article class="az-upcoming-ticket-card" data-project="{{ $projectNum }}">
                        <div class="az-upcoming-card-inner">
                            <!-- Left: Rounded Thumbnail Image -->
                            <div class="az-upcoming-thumb-col">
                                <img src="{{ $projectImage }}"
                                    alt="{{ $project->title }}"
                                    class="az-upcoming-thumb-img" loading="lazy">
                                @if($project->status)
                                    <span class="az-upcoming-status-badge {{ $statusClass }}">{{ $project->status }}</span>
                                @endif
                            </div>

                            <!-- Center: Information Column -->
                            <div class="az-upcoming-info-col">
                                <div class="az-upcoming-meta-row">
                                    <span class="az-upcoming-category">{{ $project->category ?? 'DEVELOPMENT' }}</span>
                                    @if($project->subtitle)
                                        <span class="az-upcoming-meta-dot">&bull;</span>
                                        <span class="az-upcoming-status-tag">{{ $project->subtitle }}</span>
                                    @endif
                                </div>
                                <h3 class="az-upcoming-card-title">{{ $project->title }}</h3>
                                <p class="az-upcoming-card-desc">
                                    {{ $project->description }}
                                </p>
                            </div>

                            <!-- Right: Dotted Separator & Luxury Stub -->
                            <div class="az-upcoming-stub-wrap" aria-hidden="true">
                                <div class="az-upcoming-dotted-line"></div>
                                <div class="az-upcoming-stub-body">
                                    <span class="az-upcoming-stub-status">{{ $project->status ?? 'Upcoming' }}</span>
                                    <span class="az-upcoming-stub-num">{{ $projectNum }}</span>
                                </div>
                            </div>
                        </div>
                    </article>
                @empty
                   
                @endforelse

            </div>

        </div>
    </section>
    <!-- ========================================================================
           SECTION 1: AZEEZIA RESORT & ORGANIC FARM (EDITORIAL SHOWCASE)
           Exact Reference Design: Two-Block Editorial Split
           Block 1: Azeezia Resort (Villas & Luxury Stays)
           Block 2: Organic Farm (37-Acre Integrated Farm & Pure Harvest)
           ======================================================================== -->
    <section class="az-resort-farm-editorial" id="resort-nature">
        <span id="resort" class="section-anchor" aria-hidden="true"></span>
        <span id="organic-farm" class="section-anchor" aria-hidden="true"></span>

        <div class="az-editorial-wrap">

            <!-- BLOCK 1: AZEEZIA RESORT -->
            <div class="az-editorial-block az-resort-block">
                <!-- Left Column: Editorial Details -->
                <div class="az-editorial-col-text resort-col-text">
                    <div class="az-editorial-top-row resort-top-row">
                        <div class="az-editorial-num-box">1</div>
                        <div class="az-editorial-eyebrow-group">
                            <div class="az-editorial-eyebrow">
                                PEACEFUL STAYS<br>
                                BEAUTIFUL SURROUNDINGS
                            </div>
                            <div class="az-editorial-gold-dash"></div>
                        </div>
                    </div>

                    <div class="az-editorial-middle-content resort-middle">
                        <div class="az-editorial-main-text">
                            <h2 class="az-editorial-heading heading-fade-in-up">
                                <span class="az-title-dark">AZEEZIA</span><br>
                                <span class="az-title-accent">RESORT</span>
                            </h2>
                            <p class="az-editorial-description">
                                Experience luxury and natural beauty with peaceful stays, private pool villas, and
                                world-class amenities at Azeezia Resort in Thrissur.
                            </p>
                            <div class="az-editorial-btn-wrap">
                                <a href="{{ route('resort') }}" class="az-signature-btn"
                                    aria-label="Explore Azeezia Resort">
                                    <span class="az-sig-btn-line" aria-hidden="true"></span>
                                    <span class="az-sig-btn-text">EXPLORE RESORT</span>
                                    <span class="az-sig-btn-circle">
                                        <svg class="az-sig-btn-arrow" width="16" height="16"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <line x1="5" y1="12" x2="19" y2="12">
                                            </line>
                                            <polyline points="12 5 19 12 12 19"></polyline>
                                        </svg>
                                    </span>
                                </a>
                            </div>
                        </div>
                        <div class="az-vertical-stamp right-stamp">AZEEZIA RESORT &mdash; ORGANIC FARM</div>
                    </div>
                </div>

                <!-- Right Column: Resort Pool Villa Photo -->
                <div class="az-editorial-col-img">
                    <div class="az-editorial-photo-box">
                        <img src="{{asset('assets/frontend/images/1bhk.webp')}}"
                            alt="Azeezia Resort luxury pool villa at sunset in Thrissur" class="az-editorial-img"
                            loading="lazy">
                    </div>
                    <div class="az-editorial-pagination-tag right-tag">01 / 02</div>
                </div>
            </div>

            <!-- BLOCK 2: ORGANIC FARM -->
            <div class="az-editorial-block az-farm-block">
                <!-- Left Column: Organic Farm Produce Harvest Photo -->
                <div class="az-editorial-col-img">
                    <div class="az-editorial-photo-box">
                        <img src="{{asset('assets/frontend/images/organic-farm.webp')}}"
                            alt="Azeezia Organic Farm fresh produce harvest" class="az-editorial-img" loading="lazy">
                    </div>
                    <div class="az-editorial-pagination-tag left-tag">02 / 02 <span class="tag-line"></span></div>
                </div>

                <!-- Right Column: Farm Editorial Details -->
                <div class="az-editorial-col-text farm-col-text">
                    <div class="az-editorial-top-row farm-top-row">
                        <div class="az-editorial-num-box">2</div>
                        <div class="az-editorial-eyebrow-group">
                            <div class="az-editorial-eyebrow">
                                NOURISHED BY NATURE<br>
                                FOR A BRIGHTER TOMORROW
                            </div>
                            <div class="az-editorial-gold-dash"></div>
                        </div>
                    </div>

                    <div class="az-editorial-middle-content farm-middle">
                        <div class="az-editorial-main-text">
                            <h2 class="az-editorial-heading heading-fade-in-up">
                                <span class="az-title-dark">ORGANIC</span><br>
                                <span class="az-title-accent">FARM</span>
                            </h2>
                            <p class="az-editorial-description">
                                Discover fresh, organic produce and experience nature at its purest across our 37-acre
                                integrated organic farm in Thrissur.
                            </p>
                            <div class="az-editorial-btn-wrap">
                                <a href="{{ route('organic-farm') }}" class="az-signature-btn"
                                    aria-label="Explore Azeezia Organic Farm">
                                    <span class="az-sig-btn-line" aria-hidden="true"></span>
                                    <span class="az-sig-btn-text">EXPLORE FARM</span>
                                    <span class="az-sig-btn-circle">
                                        <svg class="az-sig-btn-arrow" width="16" height="16"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <line x1="5" y1="12" x2="19" y2="12">
                                            </line>
                                            <polyline points="12 5 19 12 12 19"></polyline>
                                        </svg>
                                    </span>
                                </a>
                            </div>
                        </div>
                        <div class="az-vertical-stamp right-stamp">FARM FRESH &bull; NATURALLY BETTER</div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- ========================================================================
           SECTION 2: TESTIMONIALS CAROUSEL ("WHAT OUR GUESTS SAY")
           Exact Reference Design:
           Left Arch Photo, Center Rounded Review Card, Right Arch Photo,
           Arrows & Counter 01 / 06
           ======================================================================== -->
    <section class="az-testimonials-section" id="testimonials">
        <div class="az-testi-container">

            <!-- Testimonials Header -->
            <div class="az-testi-header">
                <div class="az-testi-header-left">

                    <h2 class="az-testi-heading heading-fade-in-up">
                        <span class="az-title-dark">WHAT OUR</span><br>
                        <span class="az-title-accent">GUESTS SAY</span>
                    </h2>
                </div>

                <div class="az-testi-header-mid">
                    <p class="az-testi-subheading">
                        Real experiences.<br>
                        Beautiful celebrations.<br>
                        Lasting memories.
                    </p>
                </div>

                <div class="az-testi-header-right">
                    <div class="az-testi-nav-controls">
                        <button class="az-testi-ctrl-btn prev-btn" id="testiPrevBtn"
                            aria-label="Previous Testimonial">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                                stroke-linejoin="round">
                                <polyline points="15 18 9 12 15 6"></polyline>
                            </svg>
                        </button>
                        <button class="az-testi-ctrl-btn next-btn" id="testiNextBtn" aria-label="Next Testimonial">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                                stroke-linejoin="round">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                        </button>
                    </div>
                    <div class="az-testi-counter-wrap">
                        <span class="az-testi-curr" id="testiCurrentNum">01</span>
                        <span class="az-testi-slash">/</span>
                        <span class="az-testi-total">{{ sprintf('%02d', $testimonials->isNotEmpty() ? $testimonials->count() : 6) }}</span>
                        <span class="az-testi-counter-track"></span>
                    </div>
                </div>
            </div>

            <!-- 3-Column Testimonials Display Row -->
            <div class="az-testi-stage">
                <!-- Left Column: Illuminated Resort Hall / Path Arch -->
                <div class="az-testi-arch az-testi-arch-left">
                    <img src="{{asset('assets/frontend/images/testimonial-arch-left.webp')}}" alt="Azeezia evening lighted garden path"
                        class="az-testi-arch-img" id="testiLeftArchImg" loading="lazy">
                </div>

                <!-- Center Column: Floating White Review Card Stage -->
                <div class="az-testi-card-stage" id="testiCardStage">
                    @php
                        $firstTesti = $testimonials->first();
                        $initialName = $firstTesti?->customer_name ?? 'Rohit & Aiswarya';
                        $initialEvent = $firstTesti?->designation ?? 'WEDDING CELEBRATION';
                        $initialQuote = $firstTesti?->review ?? 'A truly memorable experience! The venue, hospitality and attention to detail made our special day absolutely perfect.';
                        $initialAvatar = $firstTesti && $firstTesti->image
                            ? (\Illuminate\Support\Str::startsWith($firstTesti->image, ['http://', 'https://', 'assets/'])
                                ? asset($firstTesti->image)
                                : asset('storage/' . $firstTesti->image))
                            : asset('assets/frontend/images/profile.webp');
                        $initialRating = $firstTesti?->rating ?? 5;
                    @endphp
                    <div class="az-testi-card active" data-testi-index="1">
                        <div class="az-testi-stars" aria-label="{{ $initialRating }} out of 5 stars">
                            @for ($i = 0; $i < $initialRating; $i++)
                                <span>&#9733;</span>
                            @endfor
                        </div>
                        <blockquote class="az-testi-quote-text">
                            &ldquo;{{ trim($initialQuote, " \t\n\r\0\x0B\"'“”") }}&rdquo;
                        </blockquote>
                        <div class="az-testi-author-row">
                            <img src="{{ $initialAvatar }}" alt="{{ $initialName }}"
                                class="az-testi-avatar" id="testiAvatarImg">
                            <div class="az-testi-meta">
                                <span class="az-testi-author-name" id="testiAuthorName">{{ $initialName }}</span>
                                <span class="az-testi-author-event" id="testiAuthorEvent">{{ $initialEvent }}</span>
                            </div>
                        </div>
                        <span class="az-testi-giant-quote-mark" aria-hidden="true">&rdquo;</span>
                    </div>
                </div>

                <!-- Right Column: Romantic Banquet Arch -->
                <div class="az-testi-arch az-testi-arch-right">
                    <img src="{{asset('assets/frontend/images/testimonial-arch-right.webp')}}" alt="Azeezia luxury candlelit banquet dinner"
                        class="az-testi-arch-img" id="testiRightArchImg" loading="lazy">
                </div>
            </div>

            @if ($testimonials->isNotEmpty())
                @php
                    $testimonialsList = $testimonials->map(function ($item) {
                        return [
                            'name' => $item->customer_name,
                            'event' => $item->designation ?: 'GUEST EXPERIENCE',
                            'quote' => $item->review,
                            'rating' => $item->rating ?: 5,
                            'avatar' => $item->image
                                ?  asset('storage/' . $item->image)
                                : asset('assets/frontend/images/profile.webp'),
                        ];
                    })->values();
                @endphp
                <script>
                    window.azTestimonialsData = @json($testimonialsList);
                </script>
            @endif



        </div>
    </section>

    <!-- ========================================================================
           SECTION 3: LET'S PLAN YOUR EVENT (INTERACTIVE ENQUIRY SECTION)
           Exact Reference Design:
           / CONTACT Label, Grand Serif Heading, Editorial Copy, Underlined Form Fields,
           Luxury Circular "SEND ENQUIRY ->" Stamp CTA & Botanical Branch Accents
           ======================================================================== -->
    <section class="az-plan-event-section" id="plan-event">
        <span id="contact" class="section-anchor" aria-hidden="true"></span>
        <!-- Subtle Botanical Background Accents in Logo Colors -->
        <div class="az-plan-bg-leaf-bottom-left" aria-hidden="true">
            <img src="{{asset('assets/frontend/images/contact-botanical-bottom-left.webp')}}" alt="" loading="lazy">
        </div>
        <div class="az-plan-bg-leaf-right" aria-hidden="true">
            <img src="{{asset('assets/frontend/images/contact-botanical-branch-clean.webp')}}" alt="" loading="lazy">
        </div>
        <div class="az-plan-concentric-arc" aria-hidden="true"></div>

        <div class="az-plan-container">
            <div class="az-plan-content-wrap">

                <!-- Section Header: 2 Columns (Left: Contact + Paragraph, Right: Grand Title) -->
                <div class="az-plan-top-grid">
                    <div class="az-plan-top-left">
                        <span class="az-plan-eyebrow">/ CONTACT</span>
                        <p class="az-plan-description">
                            Tell us about your celebration, stay, or gathering &mdash; and our team will help you plan the
                            perfect experience with the right space, timeline, and hospitality.
                        </p>
                    </div>
                    <div class="az-plan-top-right">
                        <h2 class="az-plan-heading heading-fade-in-up">
                            <span class="az-title-dark">LET'S PLAN</span><br>
                            <span class="az-title-accent">YOUR EVENT</span>
                        </h2>
                    </div>
                </div>

                <!-- Minimalist Luxury Form -->
                <form class="az-plan-form" id="planEventForm" action="{{ route('contact.store') }}" method="POST" autocomplete="on">
                    @csrf
                    <div class="az-plan-response" id="planEventResponse" style="display:none;margin-bottom:20px;"></div>
                    <div class="az-plan-fields-grid">
                        <div class="az-plan-field-group">
                            <input type="text" id="planEventName" name="name" class="az-plan-input"
                                placeholder="Your name" required>
                        </div>
                        <div class="az-plan-field-group">
                            <input type="tel" id="planEventPhone" name="phone" class="az-plan-input"
                                placeholder="Phone number" required>
                        </div>
                        <div class="az-plan-field-group full-width">
                            <input type="email" id="planEventEmail" name="email" class="az-plan-input"
                                placeholder="E-mail" required>
                        </div>
                        <div class="az-plan-field-group full-width">
                            <textarea id="planEventDetails" name="details" class="az-plan-textarea" placeholder="Event details"
                                rows="2" required></textarea>
                        </div>
                        <div class="az-plan-field-group full-width az-plan-captcha-group">
                            <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>
                            <div class="az-captcha-error" style="display:none;color:#b91c1c;font-size:0.85rem;margin-top:6px;"></div>
                        </div>
                    </div>

                    <!-- Signature Action Button (Unified Convention Centre Button Style) -->
                    <div class="az-plan-submit-wrap">
                        <button type="submit" class="az-signature-btn az-plan-submit-btn"
                            aria-label="Send Event Enquiry">
                            <span class="az-sig-btn-line" aria-hidden="true"></span>
                            <span class="az-sig-btn-text">SEND ENQUIRY</span>
                            <span class="az-sig-btn-circle">
                                <svg class="az-sig-btn-arrow" width="16" height="16" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <polyline points="12 5 19 12 12 19"></polyline>
                                </svg>
                            </span>
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </section>

    <!-- ========================================================================
           SECTION: INSTAGRAM FEED (AUTHENTIC AZEEZIA MOMENTS)
           Showcase of weddings, grand auditorium, resort villas, organic harvest,
           conclaves, and waterfront dining with luxury interactive hover state
           ======================================================================== -->
    <section class="az-insta-feed-section" id="instagram-feed" aria-label="Azeezia Instagram Moments">
        <div class="az-insta-container">

            <!-- Editorial Header -->


            <!-- Instagram Profile Bar Card -->
            <div class="az-insta-profile-bar">
                <div class="az-insta-profile-left">
                    <div class="az-insta-avatar-ring">
                        <div class="az-insta-avatar-img" aria-hidden="true">
                            <i class="fab fa-instagram"></i>
                        </div>
                    </div>
                    <div class="az-insta-profile-meta">
                        <div class="az-insta-handle-wrap">
                            <a href="https://instagram.com" target="_blank" rel="noopener"
                                class="az-insta-handle">@azeezia.thrissur</a>
                            <i class="fas fa-check-circle az-insta-verified-badge" title="Verified Brand"></i>
                        </div>
                        <span class="az-insta-bio">Azeezia Convention Centre &amp; Organic Farm Resort &bull;
                            Thrissur</span>
                    </div>
                </div>
                <div class="az-insta-profile-right">
                    <a href="https://instagram.com" target="_blank" rel="noopener" class="az-insta-follow-btn"
                        aria-label="Follow Azeezia Thrissur on Instagram">
                        <i class="fab fa-instagram"></i>
                        <span>Follow</span>
                    </a>
                </div>
            </div>

            <!-- 6-Item Instagram Post Grid -->
            <div class="az-insta-grid">

                <!-- Post 1: Weddings -->
                <a href="https://instagram.com" target="_blank" rel="noopener" class="az-insta-card"
                    aria-label="View Azeezia Weddings post on Instagram">
                    <img src="{{asset('assets/frontend/images/testimonial-arch-left.webp')}}"
                        alt="Fairytale royal wedding celebration at Azeezia Thrissur" class="az-insta-img"
                        loading="lazy">
                    <div class="az-insta-overlay">
                        <div class="az-insta-top-icon" aria-hidden="true"><i class="fab fa-instagram"></i></div>
                        <div class="az-insta-details">
                            <span class="az-insta-tag">#AzeeziaWeddings</span>
                            <div class="az-insta-stats">
                                <span><i class="fas fa-heart"></i> 2.4k</span>
                                <span><i class="fas fa-comment"></i> 168</span>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- Post 2: Events & Grand Stage -->
                <a href="https://instagram.com" target="_blank" rel="noopener" class="az-insta-card"
                    aria-label="View Azeezia Events and Auditorium post on Instagram">
                    <img src="{{asset('assets/frontend/images/azeezia_6.webp')}}"
                        alt="Acoustic concerts and grand stage production at Azeezia" class="az-insta-img"
                        loading="lazy">
                    <div class="az-insta-overlay">
                        <div class="az-insta-top-icon" aria-hidden="true"><i class="fab fa-instagram"></i></div>
                        <div class="az-insta-details">
                            <span class="az-insta-tag">#AzeeziaEvents</span>
                            <div class="az-insta-stats">
                                <span><i class="fas fa-heart"></i> 1.9k</span>
                                <span><i class="fas fa-comment"></i> 124</span>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- Post 3: Birthday & Celebrations -->
                <a href="https://instagram.com" target="_blank" rel="noopener" class="az-insta-card"
                    aria-label="View Birthday and Party Celebrations post on Instagram">
                    <img src="{{asset('assets/frontend/images/testimonial-arch-right.webp')}}"
                        alt="Themed birthday party celebrations and luxury banquet suite at Azeezia"
                        class="az-insta-img" loading="lazy">
                    <div class="az-insta-overlay">
                        <div class="az-insta-top-icon" aria-hidden="true"><i class="fab fa-instagram"></i></div>
                        <div class="az-insta-details">
                            <span class="az-insta-tag">#BirthdayParty</span>
                            <div class="az-insta-stats">
                                <span><i class="fas fa-heart"></i> 1.3k</span>
                                <span><i class="fas fa-comment"></i> 86</span>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- Post 4: Resort Room & Pool Villa -->
                <a href="https://instagram.com" target="_blank" rel="noopener" class="az-insta-card"
                    aria-label="View Azeezia Resort Pool Villa post on Instagram">
                    <img src="{{asset('assets/frontend/images/stage-full.webp')}}"
                        alt="Private luxury pool villa and peaceful resort living at Azeezia" class="az-insta-img"
                        loading="lazy">
                    <div class="az-insta-overlay">
                        <div class="az-insta-top-icon" aria-hidden="true"><i class="fab fa-instagram"></i></div>
                        <div class="az-insta-details">
                            <span class="az-insta-tag">#AzeeziaResort</span>
                            <div class="az-insta-stats">
                                <span><i class="fas fa-heart"></i> 3.2k</span>
                                <span><i class="fas fa-comment"></i> 245</span>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- Post 5: Organic Farm Sanctuary -->
                <a href="https://instagram.com" target="_blank" rel="noopener" class="az-insta-card"
                    aria-label="View 37-Acre Organic Farm Tourism post on Instagram">
                    <img src="{{asset('assets/frontend/images/resort.webp')}}"
                        alt="Verdant 37-acre organic farm tourism and green sanctuary in Thrissur" class="az-insta-img"
                        loading="lazy">
                    <div class="az-insta-overlay">
                        <div class="az-insta-top-icon" aria-hidden="true"><i class="fab fa-instagram"></i></div>
                        <div class="az-insta-details">
                            <span class="az-insta-tag">#OrganicFarm</span>
                            <div class="az-insta-stats">
                                <span><i class="fas fa-heart"></i> 1.7k</span>
                                <span><i class="fas fa-comment"></i> 102</span>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- Post 6: Waterfront Dining & Sunset -->
                <a href="https://instagram.com" target="_blank" rel="noopener" class="az-insta-card"
                    aria-label="View Waterfront Dining and Sunset post on Instagram">
                    <img src="{{asset('assets/frontend/images/azeezia_6.webp')}}"
                        alt="Serene sunset waterfront dining moments at Azeezia" class="az-insta-img" loading="lazy">
                    <div class="az-insta-overlay">
                        <div class="az-insta-top-icon" aria-hidden="true"><i class="fab fa-instagram"></i></div>
                        <div class="az-insta-details">
                            <span class="az-insta-tag">#SunsetMoments</span>
                            <div class="az-insta-stats">
                                <span><i class="fas fa-heart"></i> 2.1k</span>
                                <span><i class="fas fa-comment"></i> 156</span>
                            </div>
                        </div>
                    </div>
                </a>

            </div>



        </div>
    </section>

    <!-- ========================================================================
           FOOTER & CONTACT SECTION
           Convention Centre & Farm Contacts, Navigation Links & Copyright
           ======================================================================== -->
@endsection