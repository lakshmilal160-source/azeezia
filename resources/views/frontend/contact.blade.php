@extends('frontend.layout.default')
@push('style')
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/contact.css') }}">
@endpush 
@section('content')
@section('body-class', 'contact-page')
<main >
    @include('frontend.partials.banner', [
        'image_url' => $banner['banner_image'] ?? '',
        'title' => $banner['title_part1'] ?? '',
        'subtitle' => $banner['title_part2'] ?? '',
    ])
   

    <!-- ========================================================================
         SECTION 2: CONTACT FORM SECTION (EXACT HOMEPAGE CONTACT SECTION DESIGN)
         Exact replicate of index.html lines 948-1012:
         Leaf graphics, concentric arc, 2-column header, form fields & signature button
         ======================================================================== -->
    <section class="az-plan-event-section" id="plan-event">
      <!-- Subtle Botanical Background Accents in Logo Colors (Exact Homepage) -->
      <div class="az-plan-bg-leaf-bottom-left" aria-hidden="true">
        <img src="{{asset('assets/frontend/images/contact-botanical-bottom-left.webp')}}" alt="" loading="lazy">
      </div>
      <div class="az-plan-bg-leaf-right" aria-hidden="true">
        <img src="{{asset('assets/frontend/images/contact-botanical-branch-clean.webp')}}" alt="" loading="lazy">
      </div>
      <div class="az-plan-concentric-arc" aria-hidden="true"></div>

      <div class="az-plan-container">
        <div class="az-plan-content-wrap">
          
          <!-- Section Header: 2 Columns (Left: Paragraph, Right: Grand Title) -->
          <div class="az-plan-top-grid">
            <div class="az-plan-top-left">
              <p class="az-plan-description">
                Tell us about your celebration, stay, or gathering &mdash; and our team will help you plan the perfect experience with the right space, timeline, and hospitality.
              </p>
            </div>
            <div class="az-plan-top-right">
              <h2 class="az-plan-heading heading-fade-in-up">
                <span class="az-title-dark">LET'S PLAN</span><br>
                <span class="az-title-accent">YOUR EVENT</span>
              </h2>
            </div>
          </div>

          <!-- Minimalist Luxury Form (Exact Homepage Form) -->
          <form class="az-plan-form" id="planEventForm" action="{{ route('contact.store') }}" method="POST" autocomplete="on">
            @csrf
            <div class="az-plan-response" id="planEventResponse" style="display:none;margin-bottom:20px;"></div>
            <div class="az-plan-fields-grid">
              <div class="az-plan-field-group">
                <label for="planEventName" class="sr-only">Your name</label>
                <input type="text" id="planEventName" name="name" class="az-plan-input" placeholder="Your name" required>
              </div>
              <div class="az-plan-field-group">
                <label for="planEventPhone" class="sr-only">Phone number</label>
                <input type="tel" id="planEventPhone" name="phone" class="az-plan-input" placeholder="Phone number" required>
              </div>
              <div class="az-plan-field-group full-width">
                <label for="planEventEmail" class="sr-only">E-mail</label>
                <input type="email" id="planEventEmail" name="email" class="az-plan-input" placeholder="E-mail" required>
              </div>
              <div class="az-plan-field-group full-width">
                <label for="planEventDetails" class="sr-only">Event details</label>
                <textarea id="planEventDetails" name="details" class="az-plan-textarea" placeholder="Event details" rows="2" required></textarea>
              </div>
              <div class="az-plan-field-group full-width az-plan-captcha-group">
                <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>
                <div class="az-captcha-error" style="display:none;color:#b91c1c;font-size:0.85rem;margin-top:6px;"></div>
              </div>
            </div>

            <!-- Signature Action Button (Unified Convention Centre Button Style) -->
            <div class="az-plan-submit-wrap">
              <button type="submit" class="az-signature-btn az-plan-submit-btn" aria-label="Send Event Enquiry">
                <span class="az-sig-btn-line" aria-hidden="true"></span>
                <span class="az-sig-btn-text">SEND ENQUIRY</span>
                <span class="az-sig-btn-circle">
                  <svg class="az-sig-btn-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
         SECTION 3: LOCATIONS SECTION (3 EQUAL CARDS IN ONE ROW ON DESKTOP)
         ======================================================================== -->
    <section class="contact-locations-section" id="contact-locations">
      <div class="contact-locations-container">

        <!-- Section Heading & Subtitle -->
        <div class="locations-header-wrap">
          <h2 class="locations-main-heading heading-fade-in-up">
            <span class="heading-dark az-title-dark">VISIT OUR</span> <span class="heading-accent az-title-accent">LOCATIONS</span>
          </h2>
          <p class="locations-subheading">TWO REMARKABLE DESTINATIONS. ONE TIMELESS EXPERIENCE.</p>
        </div>

        <!-- 2 Equal Cards in One Row (Desktop) -->
        <div class="locations-cards-grid">
          
          <!-- Card 1: CONVENTION CENTRE -->
          <div class="location-card-item">
            <div class="loc-card-header">
              <div class="loc-card-icon-circle" aria-hidden="true">
                <!-- Classical Colonnade / Hall Icon -->
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M2 10h20"></path>
                  <path d="M12 3 2 10h20L12 3z"></path>
                  <path d="M4 10v9"></path>
                  <path d="M8 10v9"></path>
                  <path d="M12 10v9"></path>
                  <path d="M16 10v9"></path>
                  <path d="M20 10v9"></path>
                  <path d="M2 19h20"></path>
                  <path d="M1 22h22"></path>
                </svg>
              </div>
              <div class="loc-card-title-group">
                <span class="loc-card-label">CONVENTION CENTRE</span>
                <h3 class="loc-card-title">{{ $conventionContact['name'] ?? 'Azeezia Convention Centre' }}</h3>
              </div>
            </div>

            <div class="loc-card-details">
              <!-- Address -->
              <div class="loc-detail-row">
                <svg class="loc-detail-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                  <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"></path>
                  <circle cx="12" cy="10" r="3"></circle>
                </svg>
                <span class="loc-detail-text">{{ $conventionContact['address'] ?? 'Padukkad, Thrissur, Kerala 680005' }}</span>
              </div>

              <!-- Phone -->
              <div class="loc-detail-row">
                <svg class="loc-detail-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                  <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                </svg>
                <a href="tel:{{ preg_replace('/[^0-9+]/', '', $conventionContact['phone'] ?? '+918876643210') }}" class="loc-detail-link">{{ $conventionContact['phone'] ?? '+91 88 76 64 3210' }}</a>
              </div>

              <!-- Email -->
              <div class="loc-detail-row">
                <svg class="loc-detail-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                  <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                  <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                </svg>
                <a href="mailto:{{ $conventionContact['email'] ?? 'events@azeezia.com' }}" class="loc-detail-link">{{ $conventionContact['email'] ?? 'events@azeezia.com' }}</a>
              </div>
            </div>

            <div class="loc-card-action-wrap">
              <a href="{{ $conventionContact['url'] ?? 'https://maps.google.com/?q=Azeezia+Convention+Centre+Padukkad+Thrissur+Kerala' }}" target="_blank" rel="noopener" class="loc-directions-btn" aria-label="Get directions to Azeezia Convention Centre">
                <span class="btn-text">GET DIRECTIONS</span>
                <span class="btn-dash" aria-hidden="true"></span>
                <span class="btn-circle" aria-hidden="true">
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <polyline points="12 5 19 12 12 19"></polyline>
                  </svg>
                </span>
              </a>
            </div>
          </div>

          <!-- Card 2: RESORT & ORGANIC FARM (Combined in same box) -->
          <div class="location-card-item">
            <div class="loc-card-header">
              <div class="loc-card-icon-circle" aria-hidden="true">
                <!-- Combined Resort Villa Bed & Organic Leaves Icon -->
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M2 4v16"></path>
                  <path d="M2 9h12"></path>
                  <path d="M14 9v11"></path>
                  <path d="M5 14h6"></path>
                  <path d="M5 14v-2a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"></path>
                  <path d="M18 20v-7"></path>
                  <path d="M18 13c-2.2-3.2-5.5-2.6-5.5-2.6s0 2.8 2.5 4.4c1.6 1 3 0 3 0z"></path>
                  <path d="M18 13c2.2-3.2 5.5-2.6 5.5-2.6s0 2.8-2.5 4.4c-1.6 1-3 0-3 0z"></path>
                </svg>
              </div>
              <div class="loc-card-title-group">
                <span class="loc-card-label">RESORT &amp; ORGANIC FARM</span>
                <h3 class="loc-card-title">{{ $resortContact['combined_name'] ?? 'Azeezia Resort & Organic Farm' }}</h3>
              </div>
            </div>

            <div class="loc-card-details">
              <!-- Address (Choose Resort Address as instructed) -->
              <div class="loc-detail-row">
                <svg class="loc-detail-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                  <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"></path>
                  <circle cx="12" cy="10" r="3"></circle>
                </svg>
                <span class="loc-detail-text">{{ $resortContact['address'] ?? 'Near Heritage Valley, Thrissur, Kerala 680005' }}</span>
              </div>

              <!-- Phone -->
              <div class="loc-detail-row">
                <svg class="loc-detail-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                  <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                </svg>
                <a href="tel:{{ preg_replace('/[^0-9+]/', '', $resortContact['phone'] ?? '+917594950777') }}" class="loc-detail-link">{{ $resortContact['phone'] ?? '+91 75 94 95 0777' }}</a>
              </div>

              <!-- Email -->
              <div class="loc-detail-row">
                <svg class="loc-detail-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                  <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                  <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                </svg>
                <a href="mailto:{{ $resortContact['email'] ?? 'farm@azeezia.com' }}" class="loc-detail-link">{{ $resortContact['email'] ?? 'farm@azeezia.com' }}</a>
              </div>
            </div>

            <div class="loc-card-action-wrap">
              <a href="{{ $resortContact['url'] ?? 'https://maps.google.com/?q=Azeezia+Resort+Near+Heritage+Valley+Thrissur+Kerala' }}" target="_blank" rel="noopener" class="loc-directions-btn" aria-label="Get directions to Azeezia Resort & Organic Farm">
                <span class="btn-text">GET DIRECTIONS</span>
                <span class="btn-dash" aria-hidden="true"></span>
                <span class="btn-circle" aria-hidden="true">
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <polyline points="12 5 19 12 12 19"></polyline>
                  </svg>
                </span>
              </a>
            </div>
          </div>

        </div>

      </div>
    </section>

    <!-- ========================================================================
         SECTION 4: FULL-WIDTH GOOGLE MAPS SECTION (PADUKKAD, THRISSUR)
         Directly above footer, spans entire width of page, fully responsive
         ======================================================================== -->
    <section class="contact-fullwidth-map" aria-label="Azeezia Convention Centre Location Map">
      <iframe 
        class="contact-map-iframe"
        title="Azeezia Convention Centre Location Map"
        src="https://maps.google.com/maps?q={{ urlencode($conventionContact['address'] ?? 'Azeezia Convention Centre, Padukkad, Thrissur, Kerala 680005') }}&amp;t=&amp;z=15&amp;ie=UTF8&amp;iwloc=&amp;output=embed"
        loading="lazy" 
        allowfullscreen="" 
        referrerpolicy="no-referrer-when-downgrade">
      </iframe>
    </section>
  </main>
@endsection
