 @extends('frontend.layout.default')
@push('style')
     <link rel="stylesheet" href="{{ asset('assets/frontend/css/convention-center.css') }}">
 @endpush 
 <main id="mainContent">
    @include('frontend.partials.banner',[
        'image_url' => $banner['banner_image'] ?? '',
        'title' => $banner['title_part1'] ?? '',
        'subtitle' => $banner['title_part2'] ?? '',
    ])

    <!-- ========================================================================
         SECTION 2: INTRO & MISSION STATEMENT (EXACT TOP HALF OF REFERENCE IMAGE)
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
          Where architectural grandeur meets nature's timeless tranquility. Azeezia Convention Centre is crafted for Kerala's most prestigious weddings, cultural galas, and landmark celebrations — offering a 2,000-guest pillarless grand auditorium, dedicated banquet dining, world-class acoustic engineering, and legendary hospitality nestled in Thrissur.
        </p>
      </div>
    </section>

    <!-- ========================================================================
         SECTION 3: AMENITIES & WHAT WE OFFER (EXACT BOTTOM HALF OF REFERENCE)
         - Huge faint watermark background headline "WHAT WE OFFER"
         - Left: Dual staggered portrait photographs
         - Right: Refined icon box amenities with serif titles and dual-tone gallery headings
         ======================================================================== -->
    <section class="convention-offer-section" aria-label="Amenities & Offerings">
      <div class="convention-offer-container">

        <!-- Huge Subtle Watermark Text -->
        <div class="convention-watermark-wrap" aria-hidden="true">
          <div class="convention-watermark-text">WHAT WE OFFER</div>
        </div>

        

        <!-- Main Content Grid -->
        <div class="convention-offer-grid">

          <!-- Left: Dual Staggered Photographs -->
          <div class="convention-staggered-col">
            <div class="convention-staggered-images">
              <!-- Back Image (Upper Left) -->
              <div class="staggered-img-back-wrap">
                <img src="assets/images/wedding-couple.jpg" alt="Azeezia Wedding Couple in Luxury Scenography" class="staggered-img-back">
              </div>
              <!-- Front Overlapping Image (Lower Right) -->
              <div class="staggered-img-front-wrap">
                <img src="assets/images/hero-banquet-scene.jpg" alt="Azeezia Grand Banquet Stage and Lighting" class="staggered-img-front">
              </div>
            </div>
          </div>

          <!-- Right: Amenities Icon Box Cards -->
          <div class="convention-amenities-col">
            <div class="amenity-icon-list">


              <!-- Amenity 3 -->
              <div class="amenity-icon-box-card">
                <div class="amenity-icon-box" aria-hidden="true">
                  <i class="fas fa-concierge-bell"></i>
                </div>
                <div class="amenity-box-content">
                  <h3 class="amenity-item-title">Day-Of Coordination &amp; Banquet Care</h3>
                  <p class="amenity-item-desc">Personal bridal escorts, dedicated stage floor managers, VIP concierges, and round-the-clock service staff ensuring your day unfolds with absolute grace.</p>
                </div>
              </div>

              <!-- Amenity 4 -->
              <div class="amenity-icon-box-card">
                <div class="amenity-icon-box" aria-hidden="true">
                  <i class="fas fa-sliders-h"></i>
                </div>
                <div class="amenity-box-content">
                  <h3 class="amenity-item-title">Acoustic Precision &amp; Concert Stage Lighting</h3>
                  <p class="amenity-item-desc">World-class line-array audio systems, motorized moving-head rigs, broadcast live recording camera feeds, and programmable theatrical scene illumination.</p>
                </div>
              </div>

              <!-- Amenity 5 -->
              <div class="amenity-icon-box-card">
                <div class="amenity-icon-box" aria-hidden="true">
                  <i class="fas fa-utensils"></i>
                </div>
                <div class="amenity-box-content">
                  <h3 class="amenity-item-title">Expansive Dining Hall &amp; Food Stations</h3>
                  <p class="amenity-item-desc">Separate air-conditioned dining facility catering to 800+ guests simultaneously, featuring hygienic preparation zones, buffet islands, and traditional Sadya setups.</p>
                </div>
              </div>

              <!-- Amenity 6 -->
              <div class="amenity-icon-box-card">
                <div class="amenity-icon-box" aria-hidden="true">
                  <i class="fas fa-crown"></i>
                </div>
                <div class="amenity-box-content">
                  <h3 class="amenity-item-title">VIP Bridal Suites &amp; Private Green Rooms</h3>
                  <p class="amenity-item-desc">Lavish en-suite dressing lounges equipped with private salon vanity stations, luxury bathrooms, and discrete stage entrances for seamless bridal changes.</p>
                </div>
              </div>

             

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
              <span class="stat-counter-val" data-target="500">500</span><span class="spec-suffix">+</span>
            </div>
            <div class="spec-label">Car Parking &amp; Valet</div>
          </div>

        </div>
      </div>
    </section>

    <!-- ========================================================================
         SECTION 5: DISTINCT SPACES & VENUE FACILITIES
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
          <!-- Space 1: Pillarless Auditorium -->
          <article class="space-card">
            <div class="space-card-img-wrap">
              <img src="assets/images/azeezia-auditorium.png" alt="Azeezia Pillarless Grand Auditorium" class="space-card-img" loading="lazy">
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

          <!-- Space 2: Dining Concourse -->
          <article class="space-card">
            <div class="space-card-img-wrap">
              <img src="assets/images/azeezia-dining.png" alt="Azeezia Royal Dining Hall" class="space-card-img" loading="lazy">
            </div>
            <div class="space-card-body">
              <span class="space-card-badge">BANQUET DINING</span>
              <h3 class="space-card-title">Royal Dining Hall</h3>
              <p class="space-card-desc">A vast, dedicated banquet dining zone equipped with modern buffet islands, hygienic staging kitchens, and traditional banquet table configurations.</p>
              <ul class="space-card-features">
                <li><i class="fas fa-check"></i> 800+ Simultaneous Dining</li>
                <li><i class="fas fa-check"></i> Dedicated Catering Bays</li>
                <li><i class="fas fa-check"></i> Traditional &amp; Buffet Setups</li>
              </ul>
            </div>
          </article>

          <!-- Space 3: Bridal Lounge & Grounds -->
          <article class="space-card">
            <div class="space-card-img-wrap">
              <img src="assets/images/azeezia_pazhuvil_14.jpg" alt="Azeezia Luxury Bridal Lounge and Open Lawn" class="space-card-img" loading="lazy">
            </div>
            <div class="space-card-body">
              <span class="space-card-badge">PRIVATE SUITES &amp; LAWNS</span>
              <h3 class="space-card-title">VIP Suites &amp; Open Lawn</h3>
              <p class="space-card-desc">Luxury private green rooms and air-conditioned bridal sanctuaries paired with manicured outdoor lawns for cocktail receptions and open-air photography.</p>
              <ul class="space-card-features">
                <li><i class="fas fa-check"></i> Private Salon Vanity Mirrors</li>
                <li><i class="fas fa-check"></i> En-Suite Luxury Bathrooms</li>
                <li><i class="fas fa-check"></i> Direct Stage Access Corridor</li>
              </ul>
            </div>
          </article>
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
            <a href="contact.html" class="btn-convention-primary">
              <i class="fas fa-calendar-check"></i>
              <span>Enquire for Dates</span>
            </a>
            <a href="tel:+918876643210" class="btn-convention-secondary">
              <i class="fas fa-phone-alt"></i>
              <span>Call Concierge: +91 88 76 64 3210</span>
            </a>
          </div>
        </div>
      </div>
    </section>

  </main>