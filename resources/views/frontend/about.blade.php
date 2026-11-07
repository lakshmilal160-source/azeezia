@extends('frontend.layout.default')
@push('style')
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/about.css') }}">
@endpush
@section('content')
@section('body-class', 'about-page')
<main id="mainContent">
    @include('frontend.partials.banner', [
        'image_url' => $banner['banner_image'] ?? '',
        'title' => $banner['title_part1'] ?? '',
        'subtitle' => $banner['title_part2'] ?? '',
    ])
    <!-- ========================================================================
        SECTION 2: ABOUT AZEEZIA / WELCOME INTRODUCTION
        Spacious, warm off-white, aligned toward upper-left with generous space.
        Concise and welcoming brand introduction from existing authentic content.
        ======================================================================== -->
    <section class="about-intro-section" id="about-intro" aria-label="About Azeezia Introduction">
        <div class="about-intro-container">
            <div class="about-intro-content">
                <p class="about-intro-lead">
                    At Azeezia, we believe life's most cherished milestones deserve an extraordinary setting. Conceived
                    with a deep reverence for nature and grand architectural hospitality, Azeezia seamlessly unites
                    Kerala's finest  convention facilities with secluded private pool villas and a
                    flourishing 65+ acre organic sanctuary in Thrissur.
                </p>
            </div>
        </div>
    </section>

    <!-- ========================================================================
        SECTION 3: CIRCULAR BRAND HIGHLIGHTS (DYNAMIC NUMBER COUNTERS)
        Organic cluster of overlapping circles with smooth counting animation:
        - 1 Large Central Circle: 2,000+ Auditorium Guest Capacity
        - 2 Smaller Supporting Circles: 65+ Acres Nature Haven & 3 Unique Destinations
        - 1 Small Circular Photo (Joyful Celebration)
        - 1 Circular Interactive Explore Button
        - 1 Small Supporting Circular Photo (Private Pool Villa)
        - 1 Subtle Ambient Dot
        ======================================================================== -->
    <section class="about-circles-section" id="brand-highlights" aria-label="Azeezia Brand Highlights">
        <div class="about-circles-container">
            <div class="circles-cluster-stage">

                <!-- 1. Left Medium Circle: 65+ Acres of Nature Haven -->
                <div class="brand-circle circle-stat-left">
                    <span class="stat-number stat-counter" data-target="65" data-suffix="">65+</span>
                    <span class="stat-label">ACRES NATURE<br>HAVEN</span>
                </div>

                <!-- 2. Bottom-Left Circular Photo: Resort Villa Poolside -->
                <div class="brand-circle circle-img-bottom">
                    <img src="{{asset('assets/frontend/images/azeezia-1.webp')}}" alt="Azeezia luxury resort poolside villa">
                </div>

                <!-- 3. Ambient Soft Dot (Far Left) -->
                <div class="brand-circle circle-ambient-dot" aria-hidden="true"></div>

                <!-- 4. Large Central Circle: Verified 2,000+ Auditorium Capacity -->
                <div class="brand-circle circle-central">
                    <span class="stat-number stat-counter" data-target="2000" data-suffix="+"
                        data-format="comma">2,000+</span>
                    <span class="stat-label">AUDITORIUM CAPACITY</span>
                </div>

                <!-- 5. Top-Right Circular Photo: Happy Wedding Celebration -->
                <div class="brand-circle circle-img-top">
                    <img src="{{asset('assets/frontend/images/seating.webp')}}" alt="Cherished wedding ceremony moment at Azeezia">
                </div>

                <!-- 6. Right Medium Circle: 3 Unique Destinations -->
                <div class="brand-circle circle-stat-right">
                    <span class="stat-number stat-counter" data-target="3" data-suffix="">3</span>
                    <span class="stat-label">UNIQUE DESTINATIONS</span>
                </div>

                <!-- 7. Bottom-Right Interactive About / Explore Button Circle -->
                <a href="#our-story" class="brand-circle circle-btn-about" aria-label="Explore Our Story">
                    <span class="btn-about-text">EXPLORE</span>
                </a>

            </div>
        </div>
    </section>

    <!-- ========================================================================
        SECTION 4: OUR STORY (EXACT DESIGN REFERENCE COMPOSITION)
        Eyebrow: ENJOY OUR MOMENT TOGETHER
        Grand Title: PLAN YOUR FOREVER, BETTER
        Left narrative + Circular wireframe button
        Center tall arch window photo + Right floating landscape photo
        ======================================================================== -->
    <section class="arch-story-section" id="our-story" aria-label="Our Story and Heritage">
        <div class="arch-story-container">
            <div class="arch-story-layout">

                <!-- Left Column: Story Narrative & Wireframe Button -->
                <div class="arch-story-content">

                    <h2 class="arch-story-title heading-fade-in-up">
                        <span class="title-row az-title-dark">PLAN YOUR</span>
                        <span class="az-title-accent">FOREVER, BETTER</span>
                    </h2>
                    <p class="arch-story-desc">
                        Born from a passion to celebrate life’s grandest milestones in harmony with nature, Azeezia
                        began as an aspiration by Mr. Abdul Azeez P.M. to create South India’s most inspiring
                        destination for weddings, celebrations, and restorative retreats. Spanning 65+ serene acres in
                        Pazhuvil, Thrissur, every hall, villa, and orchard is curated for pure elegance and lasting
                        joy.
                    </p>
                    <a href="contact.html" class="az-signature-btn" aria-label="Explore Our Story at Azeezia">
                        <span class="az-sig-btn-line" aria-hidden="true"></span>
                        <span class="az-sig-btn-text">EXPLORE OUR STORY</span>
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

                <!-- Center Column: Tall Arch Window Photo (Joyful Celebration) -->
                <div class="arch-center-frame">
                    <img src="{{asset('assets/frontend/images/testimonial-arch-left.webp')}}"
                        alt="Joyful wedding celebration moment at Azeezia" loading="lazy">
                </div>

                <div class="arch-center-frame">
                    <img src="{{asset('assets/frontend/images/testimonial-arch-right.webp')}}"
                        alt="Joyful wedding celebration moment at Azeezia" loading="lazy">
                </div>

            </div>
        </div>
    </section>

    <!-- ========================================================================
        SECTION 5: MISSION, VISION & VALUES (EXACT DESIGN REFERENCE COMPOSITION)
        Eyebrow: GUIDED BY PURPOSE &amp; INTEGRITY
        Grand Title: MISSION, VISION &amp; VALUES
        Decorative Wire Ring Motif with Pip
        3 Arched Pedestal Cards:
        - Card 1: Our Vision (Auditorium Architectural Grandeur)
        - Card 2: Our Mission (Hospitality & Private Pool Villa Serenity)
        - Card 3: Our Values (65+ Acre Nature Purity & Care)
        ======================================================================== -->
    <section class="arch-mvv-section" id="mission-vision-values" aria-label="Our Mission, Vision, and Values">
        <div class="arch-mvv-container">

            <!-- Section Header with Fine Decorative Ring -->
            <div class="arch-mvv-header">
                <div class="arch-mvv-deco-ring" aria-hidden="true">
                    <span class="arch-mvv-deco-pip"></span>
                </div>

                <h2 class="arch-mvv-title heading-fade-in-up"><span class="az-title-dark">MISSION, VISION</span> <span
                        class="az-title-accent">&amp; VALUES</span></h2>
            </div>

            <!-- 3 Arched Pedestal Cards Grid -->
            <div class="arch-mvv-grid">

                <!-- Card 1: Vision -->
                <article class="arch-mvv-card">
                    <div class="arch-card-top-photo">
                        <img src="{{asset('assets/frontend/images/vision.webp')}}" alt="Azeezia Vision — Target and Path to Excellence"
                            loading="lazy">
                    </div>
                    <div class="arch-card-pedestal">
                        <h3 class="arch-card-title">OUR VISION</h3>
                        <p class="arch-card-desc">
                            To stand as South India's most cherished sanctuary for life's landmark celebrations —
                            celebrated for harmonizing grand architectural scale with sustainable natural tranquility.
                        </p>
                    </div>
                </article>

                <!-- Card 2: Mission -->
                <article class="arch-mvv-card">
                    <div class="arch-card-top-photo">
                        <img src="{{asset('assets/frontend/images/mission.webp')}}"
                            alt="Azeezia Mission — Compass, Direction and Continuous Progress" loading="lazy">
                    </div>
                    <div class="arch-card-pedestal">
                        <h3 class="arch-card-title">OUR MISSION</h3>
                        <p class="arch-card-desc">
                            To curate flawless, stress-free gatherings through heartfelt Kerala hospitality, authentic
                            farm-to-table cuisine, modern amenities, and meticulous attention to every guest's joy.
                        </p>
                    </div>
                </article>

                <!-- Card 3: Values -->
                <article class="arch-mvv-card">
                    <div class="arch-card-top-photo">
                        <img src="{{asset('assets/frontend/images/value.webp')}}"
                            alt="Azeezia Values — Foundation of Integrity and Nature Harmony" loading="lazy">
                    </div>
                    <div class="arch-card-pedestal">
                        <h3 class="arch-card-title">OUR VALUES</h3>
                        <p class="arch-card-desc">
                            Rooted in authentic warmth, architectural perfection, uncompromised natural purity, and an
                            enduring respect for the land and families who trust us with their memories.
                        </p>
                    </div>
                </article>

            </div>

        </div>
    </section>

    <!-- ========================================================================
        SECTION: FREQUENTLY ASKED QUESTIONS (FAQ ACCORDION)
        ======================================================================== -->

    <section class="az-faq-section" id="about-faq" aria-label="Frequently Asked Questions">
        <span id="faq" class="section-anchor" aria-hidden="true"></span>

        <div class="az-faq-container">
            <div class="az-faq-header-wrap">
                <h2 class="az-editorial-heading heading-fade-in-up">
                    <span class="az-title-dark">FREQUENTLY ASKED</span>
                    <span class="az-title-accent">QUESTIONS</span>
                </h2>

                <p class="az-faq-subtitle">
                    Find answers to common questions about hosting celebrations,
                    visiting our venues, and planning your stay at Azeezia.
                </p>
            </div>

            <div class="az-faq-list" role="region" aria-label="Frequently Asked Questions Accordion">

                @forelse ($faqs as $faq)
                    <div class="az-faq-item">
                        <button type="button" class="az-faq-question-btn" id="faq-question-{{ $faq->id }}"
                            aria-expanded="false" aria-controls="faq-answer-{{ $faq->id }}">

                            <span class="az-faq-question-text">
                                {{ $faq->question }}
                            </span>

                            <span class="az-faq-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="12" y1="5" x2="12" y2="19"></line>
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg>
                            </span>
                        </button>

                        <div class="az-faq-answer" id="faq-answer-{{ $faq->id }}" role="region"
                            aria-labelledby="faq-question-{{ $faq->id }}">
                            <p>{{ $faq->answer }}</p>
                        </div>
                    </div>
                @empty
                    <p>No FAQs available currently.</p>
                @endforelse

            </div>
        </div>
    </section>

</main>
@endsection
