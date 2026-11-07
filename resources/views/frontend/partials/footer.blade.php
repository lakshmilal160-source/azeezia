  <footer class="site-footer" id="contact">
    <div class="container footer-inner">
      <div class="footer-top-grid">

        <!-- Column 1: Convention Centre (Thrissur) -->
        <div class="footer-col">
          <h4 class="footer-col-title">Convention Centre</h4>
          <div class="footer-location-card">
            <span class="footer-loc-name">{{ $conventionContact['name'] ?? 'Azeezia Convention Centre' }}</span>
            <div class="footer-loc-address">
              <i class="fas fa-map-marker-alt" aria-hidden="true"></i>
              <span>{{ $conventionContact['address'] ?? 'Padukkad, Thrissur, Kerala 680005' }}</span>
            </div>
            <div class="footer-loc-phone">
              <i class="fas fa-phone-alt" aria-hidden="true"></i>
              <a href="tel:{{ preg_replace('/[^0-9+]/', '', $conventionContact['phone'] ?? '+918876643210') }}">{{ $conventionContact['phone'] ?? '+91 88 76 64 3210' }}</a>
            </div>
            <div class="footer-loc-email">
              <i class="fas fa-envelope" aria-hidden="true"></i>
              <a href="mailto:{{ $conventionContact['email'] ?? 'events@azeezia.com' }}">{{ $conventionContact['email'] ?? 'events@azeezia.com' }}</a>
            </div>
            <a href="{{ $conventionContact['url'] ?? 'https://maps.google.com/?q=Padukkad,Thrissur,Kerala' }}" target="_blank" rel="noopener" class="footer-map-btn">
              <span>Get Directions</span> <i class="fas fa-arrow-right" aria-hidden="true"></i>
            </a>
          </div>
        </div>

        <!-- Column 2: Resort & Organic Farm (Thrissur) -->
        <div class="footer-col">
          <h4 class="footer-col-title">Resort &amp; Organic Farm</h4>
          <div class="footer-location-card">
            <span class="footer-loc-name">{{ $resortContact['name'] ?? 'Azeezia Resort & 65+ Acre Farm' }}</span>
            <div class="footer-loc-address">
              <i class="fas fa-map-marker-alt" aria-hidden="true"></i>
              <span>{{ $resortContact['address'] ?? 'Near Heritage Valley, Thrissur, Kerala 680005' }}</span>
            </div>
            <div class="footer-loc-phone">
              <i class="fas fa-phone-alt" aria-hidden="true"></i>
              <a href="tel:{{ preg_replace('/[^0-9+]/', '', $resortContact['phone'] ?? '+917594950777') }}">{{ $resortContact['phone'] ?? '+91 75 94 95 0777' }}</a>
            </div>
            <div class="footer-loc-email">
              <i class="fas fa-envelope" aria-hidden="true"></i>
              <a href="mailto:{{ $resortContact['email'] ?? 'farm@azeezia.com' }}">{{ $resortContact['email'] ?? 'farm@azeezia.com' }}</a>
            </div>
            <a href="{{ $resortContact['url'] ?? 'https://maps.google.com/?q=Thrissur,Kerala' }}" target="_blank" rel="noopener" class="footer-map-btn">
              <span>Get Directions</span> <i class="fas fa-arrow-right" aria-hidden="true"></i>
            </a>
          </div>
        </div>

        <!-- Column 3: Quick Navigation Links -->
        <div class="footer-col">
          <h4 class="footer-col-title">Quick Links</h4>
          <nav class="footer-nav-list" aria-label="Footer Navigation">
            {{-- <a href="{{route('home')}}">Home</a> --}}
            <a href="{{route('about')}}">About</a>
            <a href="{{route('convention-center')}}">Convention Centre</a>
            <a href="{{route('services')}}">Services</a>
            <a href="{{route('resort')}}">Resort</a>
            <a href="{{route('organic-farm')}}">Organic Farm</a>
            <a href="{{route("gallery")}}">Gallery</a>
            {{-- <a href="about.html#about-faq">FAQ</a> --}}
            <a href="{{route('contact')}}">Contact</a>
          </nav>
        </div>

        <!-- Column 4: Brand & Social Connections -->
        <div class="footer-col">
          <div class="footer-brand-wrap">
            <a href="{{route('home')}}" aria-label="{{ $siteSettings['site_name'] ?? 'Azeezia' }} - with the nature">
              <img src="{{ !empty($siteSettings['logo']) ? asset('storage/' . $siteSettings['logo']) : asset('assets/frontend/images/logo.webp') }}" alt="{{ $siteSettings['site_name'] ?? 'Azeezia' }} - with the nature" class="footer-logo-img">
            </a>
            <p class="footer-about-text">
              {{ $siteSettings['meta_description'] ?? 'Where life\'s finest celebrations meet peaceful nature. Premier convention centre, private luxury resort pool villas, and organic farm experiences in Thrissur, Kerala.' }}
            </p>
            <div class="footer-social-row">
              <a href="{{ !empty($siteSettings['instagram_url']) ? $siteSettings['instagram_url'] : 'https://instagram.com' }}" target="_blank" rel="noopener" class="social-circle-link" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
              <a href="{{ !empty($siteSettings['facebook_url']) ? $siteSettings['facebook_url'] : 'https://facebook.com' }}" target="_blank" rel="noopener" class="social-circle-link" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
              {{-- <a href="{{ !empty($siteSettings['youtube_url']) ? $siteSettings['youtube_url'] : 'https://youtube.com' }}" target="_blank" rel="noopener" class="social-circle-link" aria-label="YouTube"><i class="fab fa-youtube"></i></a> --}}
              {{-- <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $conventionContact['phone'] ?? '+917594950777') }}" target="_blank" rel="noopener" class="social-circle-link" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a> --}}
            </div>
          </div>
        </div>

      </div>
    </div>

    <!-- Footer Bottom Copyright Bar -->
    <div class="footer-bottom-bar">
      <div class="container footer-bottom-inner">
        <p class="footer-copyright">&copy; {{ date('Y') }} {{ $siteSettings['site_name'] ?? 'Azeezia' }} Convention Centre &amp; Organic Farm Resort. All Rights Reserved.</p>
        <p class="footer-tagline">Made with <i _ngcontent-ng-c2257550061=""
                      class="fas fa-heart text-danger"></i> by Sensations Solutions.</p> 
      </div>
    </div>
  </footer>

  <!-- ========================================================================
       FLOATING ACTIONS & MODALS
       ======================================================================== -->
  <!-- Floating WhatsApp Quick Connect -->
  <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $conventionContact['phone'] ?? '+917594950777') }}?text=Hello%20Azeezia%20Team%2C%20I%20would%20like%20to%20enquire%20about%20booking%20dates%20for%20an%20event." 
     class="floating-whatsapp" 
     target="_blank" 
     rel="noopener" 
     aria-label="Direct WhatsApp Chat with Azeezia Specialists">
    <i class="fab fa-whatsapp"></i>
  </a>

  <!-- Back to Top Button -->
  <button class="back-to-top" id="backToTop" aria-label="Return to top of page">
    <i class="fas fa-chevron-up"></i>
  </button>

  <!-- Interactive Venue Detail Modal -->
  <div class="modal-overlay" id="venueInfoModal" role="dialog" aria-modal="true" aria-labelledby="modalVenueTitle">
    <div class="modal-box">
      <button class="modal-close-btn close-modal-trigger" aria-label="Close dialog">
        <i class="fas fa-times"></i>
      </button>
      <div class="modal-body">
        <span class="eyebrow">VENUE PROFILE</span>
        <h3 id="modalVenueTitle" class="editorial-title" style="margin-bottom: 16px;">Venue Details</h3>
        <div id="modalVenueBody"></div>
      </div>
    </div>
  </div>

  <!-- Fullscreen Lightbox Modal (Cinema View for Moving Gallery) -->
  <div class="gallery-lightbox-modal" id="galleryLightboxModal" role="dialog" aria-modal="true" aria-label="Image Viewport">
    <div class="lightbox-top-bar">
      <span class="lightbox-category-tag" id="lightboxCategoryTag">Convention Centre</span>
      <button class="lightbox-close-btn" id="lightboxCloseBtn" aria-label="Close fullscreen view">
        <i class="fas fa-times"></i>
      </button>
    </div>

    <div class="lightbox-stage">
      <button class="lightbox-nav-btn lightbox-prev-btn" id="lightboxPrevBtn" aria-label="Previous photograph">
        <i class="fas fa-chevron-left"></i>
      </button>

      <div class="lightbox-img-wrapper">
        <img src="{{asset('assets/frontend/images/event-wedding-hd.webp')}}" alt="Azeezia Expanded View" class="lightbox-active-img" id="lightboxActiveImg">
      </div>

      <button class="lightbox-nav-btn lightbox-next-btn" id="lightboxNextBtn" aria-label="Next photograph">
        <i class="fas fa-chevron-right"></i>
      </button>
    </div>

    <div class="lightbox-bottom-bar">
      <div class="lightbox-caption-col">
        <h4 class="lightbox-caption-title" id="lightboxCaptionTitle">Grand  Auditorium</h4>
        <span class="lightbox-caption-location" id="lightboxCaptionLoc"><i class="fas fa-map-marker-alt"></i> Pazhuvil, Thrissur</span>
      </div>
      <div class="lightbox-counter" id="lightboxCounter">01 / 16</div>
    </div>
  </div>

  <!-- Toast Notice -->
  <div class="toast-notice" id="toastNotice" role="status" aria-live="polite">
    <i class="fas fa-check-circle"></i>
    <span class="toast-text">Thank you for contacting Azeezia.</span>
  </div>

  <!-- Master JavaScript (Separated JS file) -->
  <!-- Google reCAPTCHA v2 -->
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <script src="{{asset('assets/frontend/js/main.js')}}"></script>
  @stack('script')
</body>
</html>
