@extends('frontend.layout.default')
@push('style')
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/organic-farm.css') }}">
@endpush 
@section('content')
@section('body-class', 'farm-page')
<main >
    @include('frontend.partials.banner', [
        'image_url' => $banner['banner_image'] ?? '',
        'title' => $banner['title_part1'] ?? '',
        'subtitle' => $banner['title_part2'] ?? '',
    ])
     <!-- ========================================================================
         SECTION 2: EDITORIAL HEADLINE & ASYMMETRIC COLLAGE
         (Exact Reference Composition: "We create your brand's visuals where storytelling...")
         ======================================================================== -->
    <section class="farm-hero-section" id="farm-hero">
      <div class="farm-hero-header">
      
        <h2 class="farm-headline cc-grand-headline az-about-headline heading-fade-in-up">
          <span class="cc-hl-line cc-hl-line-1">SUSTAINABLE EARTH,</span>
          <span class="cc-hl-line cc-hl-line-3">MINDFUL FARMING AND</span>
          <span class="cc-hl-line cc-hl-line-4">PURE ORGANIC HARVEST</span>
        </h2>
      </div>

      <!-- Overlapping Editorial Collage Stage -->
      <div class="farm-collage-wrapper">
        <div class="farm-collage-stage">
          
          <!-- Left Peeking Image (Farm Lifestyle & Morning Sun) -->
          <div class="collage-peeking-left">
            <img src="{{asset('assets/frontend/images/collage.webp')}}" alt="Azeezia fresh organic farm produce" loading="eager">
          </div>

          <!-- Central Floating Crisp White Card (Exact Reference Design) -->
          <div class="collage-white-card">
            <h3 class="card-title">65+ ACRE INTEGRATED<br>ORGANIC ESTATE</h3>
            <p class="card-text">
              From zero-chemical living soils and heirloom spice gardens to restorative agro-ecology, Azeezia nurtures a thriving sanctuary where pristine Kerala nature, biodiversity, and pure wellness flourish side by side.
            </p>
          </div>

          <!-- Center-Right Overlapping Photo (Hands Gently Holding Fresh Botanical Harvest) -->
          <div class="collage-center-right">
            <img src="{{asset('assets/frontend/images/sir.webp')}}" alt="Hands gently holding freshly harvested organic herbs at Azeezia" loading="eager">
          </div>

          <!-- Far Right Peeking Image -->
          <div class="collage-peeking-right">
            <img src="{{asset('assets/frontend/images/entrance1.webp')}}" alt="Verdant landscape at Azeezia Organic Estate" loading="eager">
          </div>

        </div>
      </div>
    </section>

    <!-- ========================================================================
         HERO SECTION 2: FLOATING THREE-CARD SHOWCASE & ROTATING SEAL
         (Exact Reference Design: "Portfolio / Services / The Shop" + Rotating Stamp + STORYMUSE)
         ======================================================================== -->
    <section class="farm-showcase-backdrop" id="farm-showcase">
      <!-- Ambient blurred nature backdrop for editorial depth -->
      <div class="farm-ambient-blur" style="background-image: url('assets/images/azeezia-farm-thrissur-hd.jpg');"></div>

      <!-- Floating Crisp White Showcase Container -->
      <div class="farm-floating-white-box">
        <div class="farm-three-cards-grid">
          
          <!-- Card 1: The Harvest (Artisan Honey / Spices) -->
          <a href="#produce-catalog" class="farm-tri-card">
            <div class="tri-card-media">
              <img src="{{asset('assets/frontend/images/animal.webp')}}" alt="Artisanal pure wild honey from Azeezia organic apiary" loading="lazy">
              <div class="tri-card-overlay-title">The Harvest</div>
            </div>
            <span class="tri-card-footer-link">EXPLORE HARVEST</span>
          </a>

          <!-- Card 2: Farm Experiences (Agro-Tourism Walk) -->
          <a href="#visit-enquiry" class="farm-tri-card">
            <div class="tri-card-media">
              <img src="{{asset('assets/frontend/images/farm-visit.webp')}}" alt="Guided morning agro-tourism trail along Azeezia coconut groves" loading="lazy">
              <div class="tri-card-overlay-title">Experiences</div>
            </div>
            <span class="tri-card-footer-link">VIEW EXPERIENCES</span>
          </a>

          <!-- Card 3: The Farm Stand (Fresh Produce Basket) -->
          <a href="#produce-catalog" class="farm-tri-card">
            <div class="tri-card-media">
              <img src="{{asset('assets/frontend/images/vegetables.webp')}}" alt="Azeezia handwoven fresh organic produce basket" loading="lazy">
              <div class="tri-card-overlay-title">The Farm Stand</div>
            </div>
            <span class="tri-card-footer-link">VISIT THE STAND</span>
          </a>

        </div>

        <!-- Delicate Circular Rotating Seal Stamp (Exact Reference Component) -->
        <div class="farm-seal-wrapper" title="Azeezia Organic Farm Verified Ecological Purity">
          <svg class="farm-seal-svg" viewBox="0 0 160 160">
            <path id="sealPath" d="M 80, 80 m -62, 0 a 62,62 0 1,1 124,0 a 62,62 0 1,1 -124,0" fill="transparent"/>
            <text>
              <textPath href="#sealPath" startOffset="0%" textLength="389" lengthAdjust="spacing">
                &bull; AZEEZIA ORGANIC FARM &bull; 65+  ACRES &bull; THRISSUR &bull; PURE BOTANICAL &bull;
              </textPath>
            </text>
          </svg>
          <div class="farm-seal-center-icon">
            <i class="fas fa-leaf"></i>
          </div>
        </div>
      </div>
    </section>

    <!-- ========================================================================
         SIGNATURE EDITORIAL WORDMARK BANNER
         (Exact Reference Component: Dark Rich Tone + Large Spaced Serif "STORYMUSE")
         ======================================================================== -->
    <section class="farm-wordmark-banner">
      <h2 class="farm-wordmark-title heading-fade-in-up">A Z E E Z I A</h2>
      <div class="farm-wordmark-sub">ORGANIC ESTATE &bull; BOTANICAL SANCTUARY &bull; THRISSUR, KERALA</div>
    </section>

    <!-- ========================================================================
         SECTION 3: THE 4 ECOLOGICAL PILLARS OF AZEEZIA
         ======================================================================== -->
    <section class="farm-pillars-section" id="pillars">
      <div class="pillars-header-block">
        <span class="pillars-kicker">ROOTED IN RESPONSIBILITY</span>
        <h2 class="pillars-title heading-fade-in-up"><span class="az-title-dark">THE FOUR PILLARS OF</span> <span class="az-title-accent">LIVING ECOLOGY</span></h2>
        <p class="pillars-desc">
          We don't merely avoid synthetic chemicals; we actively regenerate our soil microbial biology, preserve heritage cultivars, and respect the natural microclimates of Central Kerala.
        </p>
      </div>

      <div class="pillars-grid">
        <!-- Pillar 01 -->
        <div class="pillar-item">
          <span class="pillar-number">01 /</span>
          <h3 class="pillar-name">Living Soils &amp; Zero Synthetic Inputs</h3>
          <p class="pillar-body">
            Enriched with traditional Jeevamrutha, cow compost, and organic green mulch. Our soil microbiome is teeming with natural bio-diversity, free of chemical fertilizers and toxic pesticides.
          </p>
        </div>

        <!-- Pillar 02 -->
        <div class="pillar-item">
          <span class="pillar-number">02 /</span>
          <h3 class="pillar-name">65+ Acre Integrated Agroforestry</h3>
          <p class="pillar-body">
            Multi-tiered canopy farming where towering coconut palms shelter cardamom, nutmeg, Malabar pepper vines, vanilla, and heirloom banana groves in natural synergy.
          </p>
        </div>

        <!-- Pillar 03 -->
        <div class="pillar-item">
          <span class="pillar-number">03 /</span>
          <h3 class="pillar-name">Apiculture &amp; Natural Pollination</h3>
          <p class="pillar-body">
            Home to native stingless bee colonies (Cerana &amp; Trigona) that naturally pollinate our fruit orchards and produce raw, unpasteurized wild honey known for ancient wellness properties.
          </p>
        </div>

        <!-- Pillar 04 -->
        <div class="pillar-item">
          <span class="pillar-number">04 /</span>
          <h3 class="pillar-name">Rainwater Harvest &amp; Closed Loops</h3>
          <p class="pillar-body">
            100% of monsoon rainwater is captured across bio-retention ponds and aquifers. Agricultural biomass is vermicomposted, creating a perpetual zero-waste regenerative cycle.
          </p>
        </div>
      </div>
    </section>

    <!-- ========================================================================
         SECTION 4: 65+ ACRE SANCTUARY GALLERY (3 COLUMNS × 2 ROWS)
         ======================================================================== -->
    <section class="farm-produce-section" id="produce-catalog" aria-label="Organic Farm Photo Gallery">
      <div class="produce-container">
        
        <div class="pillars-header-block">
          <span class="pillars-kicker">65+ ACRE SANCTUARY MOMENTS</span>
          <h2 class="pillars-title heading-fade-in-up">
            <span class="az-title-dark">ORGANIC FARM</span>
            <span class="az-title-accent">GALLERY</span>
          </h2>
          <p class="pillars-desc">
            Explore the tranquil groves, living soils, heirloom spices, and authentic harvest moments captured across our 65+ acre integrated farm sanctuary in Thrissur.
          </p>
        </div>

        <!-- 3 Columns in 2 Rows Image Gallery Grid -->
        <div class="farm-gallery-grid">
          @forelse($galleryImages as $item)
            <div class="farm-gallery-item">
              <div class="farm-gallery-img-wrap">
                <img src="{{ $item->image_url }}" alt="{{ $item->alt_text ?: ($item->title ?: 'Azeezia Organic Farm Sanctuary') }}" class="farm-gallery-img" loading="lazy">
                <div class="farm-gallery-overlay">
                  <span class="farm-gallery-caption">{{ $item->title ?: ($item->category?->name ?? 'Organic Farm') }}</span>
                </div>
              </div>
            </div>
          @empty
            <!-- Fallback Image 1 -->
            <div class="farm-gallery-item">
              <div class="farm-gallery-img-wrap">
                <img src="{{ asset('assets/images/organic-farm-thrissur.jpg') }}" alt="Azeezia 65+ Acre Integrated Organic Farm Sanctuary" class="farm-gallery-img" loading="lazy">
                <div class="farm-gallery-overlay">
                  <span class="farm-gallery-caption">65+ Acre Integrated Farm</span>
                </div>
              </div>
            </div>

            <!-- Fallback Image 2 -->
            <div class="farm-gallery-item">
              <div class="farm-gallery-img-wrap">
                <img src="{{ asset('assets/images/farm-showcase-honey.jpg') }}" alt="Artisanal Raw Wild Forest Honey and Bee Boxes" class="farm-gallery-img" loading="lazy">
                <div class="farm-gallery-overlay">
                  <span class="farm-gallery-caption">Artisanal Apiary &amp; Honey</span>
                </div>
              </div>
            </div>

            <!-- Fallback Image 3 -->
            <div class="farm-gallery-item">
              <div class="farm-gallery-img-wrap">
                <img src="{{ asset('assets/images/farm-showcase-stand.jpg') }}" alt="Freshly Harvested Organic Farm Stand Basket" class="farm-gallery-img" loading="lazy">
                <div class="farm-gallery-overlay">
                  <span class="farm-gallery-caption">Fresh Seasonal Harvest</span>
                </div>
              </div>
            </div>

            <!-- Fallback Image 4 -->
            <div class="farm-gallery-item">
              <div class="farm-gallery-img-wrap">
                <img src="{{ asset('assets/images/farm-hero-editorial-hands.jpg') }}" alt="Hand-Harvested Organic Alleppey Turmeric and Spices" class="farm-gallery-img" loading="lazy">
                <div class="farm-gallery-overlay">
                  <span class="farm-gallery-caption">Heirloom Spices &amp; Roots</span>
                </div>
              </div>
            </div>

            <!-- Fallback Image 5 -->
            <div class="farm-gallery-item">
              <div class="farm-gallery-img-wrap">
                <img src="{{ asset('assets/images/farm-showcase-trail.jpg') }}" alt="Agro-Tourism Nature Trails and Coconut Groves" class="farm-gallery-img" loading="lazy">
                <div class="farm-gallery-overlay">
                  <span class="farm-gallery-caption">Botanical Nature Trails</span>
                </div>
              </div>
            </div>

            <!-- Fallback Image 6 -->
            <div class="farm-gallery-item">
              <div class="farm-gallery-img-wrap">
                <img src="{{ asset('assets/images/farm-to-table-dining.jpg') }}" alt="Farm-To-Table Culinary Harvest Experience" class="farm-gallery-img" loading="lazy">
                <div class="farm-gallery-overlay">
                  <span class="farm-gallery-caption">Farm-To-Table Dining</span>
                </div>
              </div>
            </div>
          @endforelse
        </div>

      </div>
    </section>

    <!-- ========================================================================
         SECTION 6: EDITORIAL CURATOR INVITATION (MINIMAL LUXURY INVITATION)
         Exact design matching Services page reference (Reserve Your Moment)
         ======================================================================== -->
    <section class="editorial-invitation-section" id="visit-enquiry" aria-label="Reserve Your Farm Experience">
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
          <span class="invitation-title-line az-title-accent">ORGANIC ESTATE JOURNEY</span>
        </h2>
        <p class="editorial-invitation-desc">
          Connect directly with our dedicated estate curators to tour our organic botanical groves, curate bespoke culinary menus, and reserve preferred dates for your milestone gathering.
        </p>
        <div class="editorial-invitation-actions">
          <a href="{{ route('contact') }}" class="az-signature-btn" aria-label="Connect with Estate Curator">
            <span class="az-sig-btn-line" aria-hidden="true"></span>
            <span class="az-sig-btn-text">CONNECT WITH ESTATE CURATOR</span>
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
