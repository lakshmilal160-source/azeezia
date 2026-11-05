  <!-- ========================================================================
         SECTION 1: PREMIUM FULL-WIDTH BANNER (EXACT REFERENCE COMPOSITION)
         Full-width cinematic scenery, bottom-left grand serif display headline:
         "CREATING YOUR MEMORIES", bottom-right introductory philosophy paragraph.
         Dark gradient overlay applied ONLY to bottom portion; upper half clear.
         ======================================================================== -->
    <section class="about-banner-section" id="about-banner" aria-label="Creating Your Memories at Azeezia">
      <div class="about-banner-scenery" aria-hidden="true">
        <img src="{{asset('storage/'. $image_url)}}" alt="{{$image_url}}" class="about-banner-bg-img">
        <div class="about-banner-overlay"></div>
      </div>

      <div class="about-banner-container">
        <div class="about-banner-grid">
          <!-- Grand Serif Headline in Exactly Two Lines (Matching Homepage Style) -->
          <div class="about-banner-title-col">
            <h1 class="about-banner-title heading-fade-in-up">
              <span class="banner-title-line az-title-dark">{{$title}}</span>
              <span class="banner-title-line az-title-accent">{{$subtitle}}</span>
            </h1>
          </div>
        </div>
      </div>
    </section>