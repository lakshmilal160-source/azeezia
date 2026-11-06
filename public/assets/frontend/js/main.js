/**
 * AZEEZIA CONVENTION CENTRE & ORGANIC FARM RESORT
 * Luxury Event Planner & Venue Website - Master JavaScript
 * Handles navigation, testimonial carousel, form submission, tabs, and interactive modals.
 */

document.addEventListener('DOMContentLoaded', () => {
  // --------------------------------------------------------------------------
  // 1. STICKY HEADER & SCROLL BEHAVIOR
  // --------------------------------------------------------------------------
  const siteHeader = document.querySelector('.site-header');
  const backToTopBtn = document.querySelector('.back-to-top');

  const handleScroll = () => {
    const scrollY = window.scrollY || window.pageYOffset;

    if (siteHeader) {
      if (scrollY > 50) {
        siteHeader.classList.add('scrolled');
      } else {
        siteHeader.classList.remove('scrolled');
      }
    }

    if (backToTopBtn) {
      if (scrollY > 400) {
        backToTopBtn.classList.add('visible');
      } else {
        backToTopBtn.classList.remove('visible');
      }
    }

    // Scroll spy: Update active class only on hash anchor links (if present)
    const hashNavLinks = document.querySelectorAll('.nav-link[href^="#"], .center-nav-item[href^="#"]');
    if (hashNavLinks.length > 0) {
      const sections = ['home', 'event-planning', 'special-events', 'services', 'about-moments', 'about', 'resort-nature', 'resort', 'organic-farm', 'gallery', 'contact'];
      let currentActive = 'home';
      sections.forEach(id => {
        const el = document.getElementById(id);
        if (el) {
          const top = el.getBoundingClientRect().top;
          if (top <= 160) {
            currentActive = id;
          }
        }
      });

      // Map sub-anchors to primary menu items
      const anchorMap = {
        'home': '#home',
        'event-planning': '#about-moments',
        'about-moments': '#about-moments',
        'about': '#about-moments',
        'special-events': '#special-events',
        'services': '#special-events',
        'resort-nature': '#resort-nature',
        'resort': '#resort-nature',
        'organic-farm': '#organic-farm',
        'gallery': '#gallery',
        'contact': '#contact'
      };
      const activeTarget = anchorMap[currentActive] || ('#' + currentActive);

      hashNavLinks.forEach(link => {
        const href = link.getAttribute('href');
        if (href === activeTarget || href === '#' + currentActive) {
          link.classList.add('active');
        } else {
          link.classList.remove('active');
        }
      });
    }
  };

  window.addEventListener('scroll', handleScroll, { passive: true });
  handleScroll(); // Initial check

  if (backToTopBtn) {
    backToTopBtn.addEventListener('click', () => {
      window.scrollTo({
        top: 0,
        behavior: 'smooth'
      });
    });
  }

  // Instant active highlight feedback when clicking any nav item
  const allNavClickItems = document.querySelectorAll('.center-nav-item, .nav-drawer-links .nav-link');
  allNavClickItems.forEach(item => {
    item.addEventListener('click', function () {
      allNavClickItems.forEach(nav => nav.classList.remove('active'));
      this.classList.add('active');
    });
  });

  // --------------------------------------------------------------------------
  // 2. MOBILE NAVIGATION MENU
  // --------------------------------------------------------------------------
  const mobileToggle = document.querySelector('.mobile-toggle');
  const navMenu = document.querySelector('.nav-menu');
  const navLinks = document.querySelectorAll('.nav-link');

  if (mobileToggle && navMenu) {
    mobileToggle.addEventListener('click', () => {
      const isExpanded = mobileToggle.getAttribute('aria-expanded') === 'true';
      mobileToggle.setAttribute('aria-expanded', !isExpanded);
      navMenu.classList.toggle('active');

      const icon = mobileToggle.querySelector('i');
      if (icon) {
        if (navMenu.classList.contains('active')) {
          icon.className = 'fas fa-times';
        } else {
          icon.className = 'fas fa-bars';
        }
      }
    });

    // Close menu when a link is clicked
    navLinks.forEach(link => {
      link.addEventListener('click', () => {
        if (navMenu.classList.contains('active')) {
          navMenu.classList.remove('active');
          mobileToggle.setAttribute('aria-expanded', 'false');
          const icon = mobileToggle.querySelector('i');
          if (icon) icon.className = 'fas fa-bars';
        }
      });
    });

    // Close menu when close button inside drawer is clicked
    const navCloseBtn = document.querySelector('.nav-close-btn');
    if (navCloseBtn) {
      navCloseBtn.addEventListener('click', () => {
        navMenu.classList.remove('active');
        mobileToggle.setAttribute('aria-expanded', 'false');
        const icon = mobileToggle.querySelector('i');
        if (icon) icon.className = 'fas fa-bars';
      });
    }

    // Close menu on click outside
    document.addEventListener('click', (e) => {
      if (!navMenu.contains(e.target) && !mobileToggle.contains(e.target)) {
        if (navMenu.classList.contains('active')) {
          navMenu.classList.remove('active');
          mobileToggle.setAttribute('aria-expanded', 'false');
          const icon = mobileToggle.querySelector('i');
          if (icon) icon.className = 'fas fa-bars';
        }
      }
    });
  }

  // --------------------------------------------------------------------------
  // 2B. WEDDING JOURNEY CAR SCROLL ANIMATION (PLACED JUST ABOVE ABOUT SECTION)
  // (Groom & Bride inside car moves from Left to Right as user scrolls down,
  //  with slowly rotating tires, reaching the right end upon scroll completion)
  // --------------------------------------------------------------------------
  const carScrollTrack = document.querySelector('.car-scroll-track');
  const heroWeddingCar = document.getElementById('heroWeddingCar');
  const wheelRear = document.getElementById('wheelRear');
  const wheelFront = document.getElementById('wheelFront');
  const carTrackHeader = document.getElementById('carTrackHeader');
  const carScrollHint = document.getElementById('carScrollHint');
  const carParticles = document.getElementById('carParticles');

  if (carScrollTrack && heroWeddingCar) {
    let journeyPetalsCreated = false;
    let hasScrolled = false;

    // Calculate maximum travel distance across the viewport from left to right end
    const calculateCarMetrics = () => {
      const windowWidth = window.innerWidth;
      const isMobile = windowWidth <= 768;
      
      const carRect = heroWeddingCar.getBoundingClientRect();
      const carWidth = carRect.width || (isMobile ? 300 : 520);
      
      // Starting left offset (matches CSS clamp)
      const startLeft = isMobile ? 8 : (windowWidth * 0.025);
      // Right buffer so car reaches the right edge gracefully
      const rightBuffer = isMobile ? 12 : 36;
      
      // Total travel distance from left to right end
      const maxTravel = Math.max(0, windowWidth - carWidth - startLeft - rightBuffer);

      return {
        maxTravel,
        carWidth
      };
    };

    let carMetrics = calculateCarMetrics();

    window.addEventListener('resize', () => {
      carMetrics = calculateCarMetrics();
      updateCarAnimation();
    }, { passive: true });

    // Floating romantic rose petals generator for journey track
    const createJourneyPetals = () => {
      if (!carParticles || journeyPetalsCreated) return;
      journeyPetalsCreated = true;

      const roseVarieties = [
        'petal-soft-pink',
        'petal-blush',
        'petal-rose-red',
        'petal-dusty-rose',
        'petal-crimson-velvet'
      ];

      for (let i = 0; i < 34; i++) {
        const petal = document.createElement('div');
        const variety = roseVarieties[i % roseVarieties.length];
        petal.className = `petal-particle ${variety}`;
        petal.style.left = (Math.random() * 100) + '%';
        petal.style.width = (Math.random() * 12 + 8) + 'px';
        petal.style.height = (Math.random() * 16 + 10) + 'px';
        petal.style.animationDuration = (Math.random() * 4 + 4.5) + 's';
        petal.style.animationDelay = (Math.random() * 5) + 's';
        petal.style.opacity = (Math.random() * 0.45 + 0.45).toString();
        carParticles.appendChild(petal);
      }
    };

    // Update car position & wheel rotation based on scroll progress (0.0 to 1.0)
    const updateCarAnimation = () => {
      const rect = carScrollTrack.getBoundingClientRect();
      const viewportHeight = window.innerHeight;
      
      // Calculate progress smoothly as the section scrolls through the viewport
      const totalRange = rect.height + viewportHeight;
      const currentScroll = viewportHeight - rect.top;
      const rawProgress = currentScroll / totalRange;
      const progress = Math.min(1, Math.max(0, rawProgress));

      if (progress > 0.05 && progress < 0.95 && !hasScrolled) {
        hasScrolled = true;
        heroWeddingCar.classList.remove('idle-drive');
      } else if ((progress <= 0.05 || progress >= 0.95) && hasScrolled) {
        hasScrolled = false;
        heroWeddingCar.classList.add('idle-drive');
      }

      // 1. Move Car from Left to Right: reaches right end smoothly as user scrolls
      const currentShiftX = progress * carMetrics.maxTravel;
      // Gentle vintage car suspension bob while driving
      const carBob = Math.sin(progress * Math.PI * 12) * 2.2 * (1 - Math.pow(progress - 0.5, 4));

      heroWeddingCar.style.transform = `translateX(${currentShiftX}px) translateY(${carBob}px)`;

      // 2. Slow, smooth tire rotation proportional to distance driven
      const totalRotationDeg = 1440;
      const currentWheelDeg = progress * totalRotationDeg;

      if (wheelRear) {
        wheelRear.style.transform = `translate(-50%, -50%) rotate(${currentWheelDeg}deg)`;
      }
      if (wheelFront) {
        wheelFront.style.transform = `translate(-50%, -50%) rotate(${currentWheelDeg}deg)`;
      }

      // 3. Section Title / Header stays clearly visible
      if (carTrackHeader) {
        carTrackHeader.style.opacity = '1';
        carTrackHeader.style.transform = 'none';
      }

      // 4. Scroll action hint fades out smoothly
      if (carScrollHint) {
        carScrollHint.style.opacity = Math.max(0, 1 - progress * 3.5);
      }

      // 5. Emit romantic petals when driving
      if (progress > 0.1 && progress < 0.95) {
        createJourneyPetals();
      }
    };

    window.addEventListener('scroll', () => {
      requestAnimationFrame(updateCarAnimation);
    }, { passive: true });

    // Initial setup
    carMetrics = calculateCarMetrics();
    createJourneyPetals();
    updateCarAnimation();

    // Clicking car also smoothly drives it forward
    heroWeddingCar.addEventListener('click', () => {
      const scrollY = window.scrollY || window.pageYOffset;
      const trackHeight = carScrollTrack.offsetHeight;
      const viewportHeight = window.innerHeight;
      const targetScroll = carScrollTrack.offsetTop + (trackHeight - viewportHeight);

      if (scrollY < targetScroll * 0.5) {
        window.scrollTo({ top: targetScroll, behavior: 'smooth' });
      } else {
        window.scrollTo({ top: carScrollTrack.offsetTop, behavior: 'smooth' });
      }
    });
  }

  // --------------------------------------------------------------------------
  // 3. TESTIMONIALS SLIDER
  // --------------------------------------------------------------------------
  const testimonialSlides = document.querySelectorAll('.testimonial-slide');
  const prevBtn = document.querySelector('.testimonial-prev');
  const nextBtn = document.querySelector('.testimonial-next');
  const dotsContainer = document.querySelector('.testimonial-dots');

  if (testimonialSlides.length > 0) {
    let currentSlide = 0;
    let autoSlideInterval = null;

    // Create dot indicators dynamically if dots container exists
    if (dotsContainer) {
      dotsContainer.innerHTML = '';
      testimonialSlides.forEach((_, idx) => {
        const dot = document.createElement('span');
        dot.className = `testimonial-dot ${idx === 0 ? 'active' : ''}`;
        dot.dataset.index = idx;
        dot.addEventListener('click', () => {
          goToSlide(idx);
          restartAutoSlide();
        });
        dotsContainer.appendChild(dot);
      });
    }

    const dots = document.querySelectorAll('.testimonial-dot');

    const goToSlide = (index) => {
      testimonialSlides.forEach(slide => slide.classList.remove('active'));
      dots.forEach(dot => dot.classList.remove('active'));

      currentSlide = (index + testimonialSlides.length) % testimonialSlides.length;
      testimonialSlides[currentSlide].classList.add('active');
      if (dots[currentSlide]) {
        dots[currentSlide].classList.add('active');
      }
    };

    if (prevBtn) {
      prevBtn.addEventListener('click', () => {
        goToSlide(currentSlide - 1);
        restartAutoSlide();
      });
    }

    if (nextBtn) {
      nextBtn.addEventListener('click', () => {
        goToSlide(currentSlide + 1);
        restartAutoSlide();
      });
    }

    const startAutoSlide = () => {
      autoSlideInterval = setInterval(() => {
        goToSlide(currentSlide + 1);
      }, 6500);
    };

    const restartAutoSlide = () => {
      if (autoSlideInterval) clearInterval(autoSlideInterval);
      startAutoSlide();
    };

    startAutoSlide();

    // Pause on hover
    const wrapper = document.querySelector('.testimonials-slider-wrapper');
    if (wrapper) {
      wrapper.addEventListener('mouseenter', () => clearInterval(autoSlideInterval));
      wrapper.addEventListener('mouseleave', () => startAutoSlide());
    }
  }

  // --------------------------------------------------------------------------
  // 3B. SPECIAL EVENTS CAROUSEL (1 Slide Displayed at a Time: Corporate, Wedding, Reception, Birthday)
  // --------------------------------------------------------------------------
  const eventsCarousel = document.getElementById('azEventsCarousel');
  if (eventsCarousel) {
    const eventSlides = eventsCarousel.querySelectorAll('.az-carousel-slide');
    const eventTabs = document.querySelectorAll('.az-carousel-tab');
    const prevBtn = document.getElementById('azEventsPrev');
    const nextBtn = document.getElementById('azEventsNext');
    const counterCurrent = document.getElementById('azCounterCurrent');
    const progressFill = document.getElementById('azProgressFill');

    let currentEventIndex = 0;
    let eventAutoplayTimer = null;
    const totalEventSlides = eventSlides.length;

    const showEventSlide = (index) => {
      currentEventIndex = (index + totalEventSlides) % totalEventSlides;

      // Update slides (strictly 1 slide displayed at a time)
      eventSlides.forEach((slide, idx) => {
        const isActive = idx === currentEventIndex;
        if (isActive) {
          slide.classList.add('active');
          slide.setAttribute('aria-hidden', 'false');
          // Re-trigger fade-in-up animation on slide title
          const slideTitle = slide.querySelector('.az-slide-title');
          if (slideTitle) {
            slideTitle.classList.remove('is-visible');
            void slideTitle.offsetWidth; // Force DOM reflow
            slideTitle.classList.add('is-visible');
          }
        } else {
          slide.classList.remove('active');
          slide.setAttribute('aria-hidden', 'true');
        }
      });

      // Update tabs
      eventTabs.forEach((tab, idx) => {
        const isActive = idx === currentEventIndex;
        if (isActive) {
          tab.classList.add('active');
          tab.setAttribute('aria-selected', 'true');
        } else {
          tab.classList.remove('active');
          tab.setAttribute('aria-selected', 'false');
        }
      });

      // Update counter (01, 02, 03, 04)
      if (counterCurrent) {
        counterCurrent.textContent = String(currentEventIndex + 1).padStart(2, '0');
      }

      // Update progress bar
      if (progressFill && totalEventSlides > 0) {
        const percent = ((currentEventIndex + 1) / totalEventSlides) * 100;
        progressFill.style.width = `${percent}%`;
      }
    };

    const startAutoplay = () => {
      if (eventAutoplayTimer) clearInterval(eventAutoplayTimer);
      eventAutoplayTimer = setInterval(() => {
        showEventSlide(currentEventIndex + 1);
      }, 6500);
    };

    const resetAutoplay = () => {
      startAutoplay();
    };

    // Tab click handlers
    eventTabs.forEach((tab, idx) => {
      tab.addEventListener('click', () => {
        showEventSlide(idx);
        resetAutoplay();
      });
    });

    // Prev / Next button handlers
    if (prevBtn) {
      prevBtn.addEventListener('click', () => {
        showEventSlide(currentEventIndex - 1);
        resetAutoplay();
      });
    }

    if (nextBtn) {
      nextBtn.addEventListener('click', () => {
        showEventSlide(currentEventIndex + 1);
        resetAutoplay();
      });
    }

    // Keyboard navigation (Arrow keys when focused inside carousel)
    eventsCarousel.addEventListener('keydown', (e) => {
      if (e.key === 'ArrowLeft') {
        showEventSlide(currentEventIndex - 1);
        resetAutoplay();
      } else if (e.key === 'ArrowRight') {
        showEventSlide(currentEventIndex + 1);
        resetAutoplay();
      }
    });

    // Touch swipe gesture support for mobile devices
    let touchStartX = 0;
    let touchEndX = 0;

    eventsCarousel.addEventListener('touchstart', (e) => {
      touchStartX = e.changedTouches[0].screenX;
    }, { passive: true });

    eventsCarousel.addEventListener('touchend', (e) => {
      touchEndX = e.changedTouches[0].screenX;
      const swipeDistance = touchEndX - touchStartX;
      if (Math.abs(swipeDistance) > 45) {
        if (swipeDistance < 0) {
          showEventSlide(currentEventIndex + 1); // Swipe left -> Next
        } else {
          showEventSlide(currentEventIndex - 1); // Swipe right -> Prev
        }
        resetAutoplay();
      }
    }, { passive: true });

    // Pause on hover
    eventsCarousel.addEventListener('mouseenter', () => {
      if (eventAutoplayTimer) clearInterval(eventAutoplayTimer);
    });

    eventsCarousel.addEventListener('mouseleave', () => {
      startAutoplay();
    });

    // Initialize carousel on load
    showEventSlide(0);
    startAutoplay();
  }

  // --------------------------------------------------------------------------
  // 4. SERVICES FILTER TABS
  // --------------------------------------------------------------------------
  const filterBtns = document.querySelectorAll('.service-filter-btn');
  const serviceCards = document.querySelectorAll('.service-card');

  if (filterBtns.length > 0 && serviceCards.length > 0) {
    filterBtns.forEach(btn => {
      btn.addEventListener('click', () => {
        filterBtns.forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        const category = btn.dataset.filter;

        serviceCards.forEach(card => {
          if (category === 'all' || card.dataset.category === category) {
            card.style.display = 'flex';
            card.style.animation = 'fadeIn 0.4s ease';
          } else {
            card.style.display = 'none';
          }
        });
      });
    });
  }

  // --------------------------------------------------------------------------
  // 4B. GALLERY FILTER TABS
  // --------------------------------------------------------------------------
  const galleryFilterBtns = document.querySelectorAll('.gallery-filter-btn');
  const galleryItems = document.querySelectorAll('.gallery-item');

  if (galleryFilterBtns.length > 0 && galleryItems.length > 0) {
    galleryFilterBtns.forEach(btn => {
      btn.addEventListener('click', () => {
        galleryFilterBtns.forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        const filterCategory = btn.dataset.galleryFilter;

        galleryItems.forEach(item => {
          if (filterCategory === 'all' || item.dataset.category === filterCategory) {
            item.style.display = 'block';
            item.style.animation = 'fadeIn 0.4s ease';
          } else {
            item.style.display = 'none';
          }
        });
      });
    });
  }

  // --------------------------------------------------------------------------
  // 5. OFFERS INTERACTION -> PREFILL CONTACT FORM
  // --------------------------------------------------------------------------
  const claimOfferButtons = document.querySelectorAll('.btn-claim-offer');
  const eventTypeSelect = document.getElementById('eventType');
  const preferredVenueSelect = document.getElementById('preferredVenue');
  const messageInput = document.getElementById('clientMessage');

  claimOfferButtons.forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      const offerName = btn.dataset.offerName || 'Special Privilege Promotion';
      const recommendedVenue = btn.dataset.venue || 'thrissur';
      const eventCategory = btn.dataset.eventType || 'Wedding';

      // Prefill fields
      if (eventTypeSelect && eventCategory) {
        eventTypeSelect.value = eventCategory;
      }
      if (preferredVenueSelect && recommendedVenue) {
        preferredVenueSelect.value = recommendedVenue;
      }
      if (messageInput) {
        messageInput.value = `Hello Azeezia Team, I would like to enquire about the approved offer: "${offerName}". Please share details regarding available dates and package inclusions.`;
      }

      // Smooth scroll to contact form
      const contactSec = document.getElementById('contact');
      if (contactSec) {
        contactSec.scrollIntoView({ behavior: 'smooth' });
        // Highlight form momentarily
        const formPanel = document.querySelector('.contact-form-panel');
        if (formPanel) {
          formPanel.style.outline = '2px solid var(--color-gold-champagne)';
          setTimeout(() => {
            formPanel.style.outline = 'none';
          }, 2000);
        }
      }
    });
  });

  // --------------------------------------------------------------------------
  // 6. CONTACT FORM SUBMISSION & CLIENT-SIDE VALIDATION
  // --------------------------------------------------------------------------
  const bookingForm = document.getElementById('azeeziaBookingForm');
  const formStatus = document.getElementById('formStatusMsg');
  const submitBtn = document.getElementById('btnSubmitBooking');
  const toastNotice = document.getElementById('toastNotice');

  if (bookingForm) {
    bookingForm.addEventListener('submit', (e) => {
      e.preventDefault();

      // Clear previous status
      if (formStatus) {
        formStatus.textContent = '';
        formStatus.className = 'form-status-msg';
      }

      // Collect field values
      const name = document.getElementById('clientName')?.value.trim();
      const mobile = document.getElementById('clientMobile')?.value.trim();
      const eventType = document.getElementById('eventType')?.value;
      const venue = document.getElementById('preferredVenue')?.value;
      const date = document.getElementById('eventDate')?.value;
      const guestCount = document.getElementById('guestCount')?.value;
      const message = document.getElementById('clientMessage')?.value.trim();

      // Validate required fields
      if (!name || !mobile || !eventType || !venue || !date || !guestCount) {
        if (formStatus) {
          formStatus.textContent = 'Please complete all required fields marked with an asterisk (*).';
          formStatus.className = 'form-status-msg error';
        }
        return;
      }

      // Validate phone number format (basic check)
      const phoneClean = mobile.replace(/[^0-9]/g, '');
      if (phoneClean.length < 9) {
        if (formStatus) {
          formStatus.textContent = 'Please provide a valid mobile or phone number.';
          formStatus.className = 'form-status-msg error';
        }
        return;
      }

      // Simulate submission loading
      if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> TRANSMITTING ENQUIRY...';
      }

      setTimeout(() => {
        if (submitBtn) {
          submitBtn.disabled = false;
          submitBtn.innerHTML = '<i class="fas fa-check"></i> ENQUIRY RECEIVED';
        }

        if (formStatus) {
          formStatus.textContent = 'Thank you! Your event consultation request has been received. Our event directors will contact you within 2 hours.';
          formStatus.className = 'form-status-msg success';
        }

        // Show Toast Notice
        showToast(`Thank you, ${name}! Your celebration request has been forwarded to our team.`);

        // Reset form
        bookingForm.reset();

        // Restore submit button after 4 seconds
        setTimeout(() => {
          if (submitBtn) {
            submitBtn.innerHTML = 'SUBMIT CELEBRATION ENQUIRY';
          }
        }, 4000);
      }, 1200);
    });
  }

  // Toast Notice Function
  const showToast = (message) => {
    if (!toastNotice) return;
    const toastText = toastNotice.querySelector('.toast-text');
    if (toastText) toastText.textContent = message;
    toastNotice.classList.add('show');

    setTimeout(() => {
      toastNotice.classList.remove('show');
    }, 4500);
  };

  // --------------------------------------------------------------------------
  // 7. MODAL POPUP FOR VENUE DETAILS / BROCHURE
  // --------------------------------------------------------------------------
  const modalOverlay = document.getElementById('venueInfoModal');
  const modalTitle = document.getElementById('modalVenueTitle');
  const modalBody = document.getElementById('modalVenueBody');
  const modalClose = document.querySelectorAll('.close-modal-trigger');
  const openModalButtons = document.querySelectorAll('.open-venue-modal');

  const venueData = {
    thrissur: {
      title: "Azeezia Organic Farm Resort & Convention Centre • Thrissur",
      html: `
        <p style="margin-bottom: 14px; font-size: 0.92rem; color: var(--color-plum-main);"><strong>Location:</strong> Pazhuvil, Cherpu - Thriprayar Road, Thrissur, Kerala - 680564</p>
        <p style="margin-bottom: 14px; line-height: 1.8; color: #555;">Spanning 37 acres of certified organic plantations and lush rural tranquility, Azeezia Thrissur is Kerala’s foremost eco-luxury destination for grand open-air weddings, pre-wedding ceremonies, and corporate retreats.</p>
        <h4 style="font-family: var(--font-serif); font-size: 1.15rem; margin-top: 18px; margin-bottom: 10px; color: var(--color-plum-dark);">Highlights & Features:</h4>
        <ul style="list-style: square; padding-left: 20px; line-height: 1.8; color: #666; font-size: 0.88rem;">
          <li>37-Acre Integrated Organic Spice & Fruit Sanctuary</li>
          <li>Open Twilight Celebration Lawn with Stargazing Mandap</li>
          <li>Farm-to-Table Organic Feasts & Live Culinary Stations</li>
          <li>Serene Private Cottages & Bridal Villa Suites</li>
          <li>Convenient Multi-Road Connectivity with Ample Parking</li>
        </ul>
        <div style="margin-top: 24px;">
          <a href="#contact" class="btn btn-plum close-modal-trigger" style="width: 100%;">REQUEST THRISSUR DATES</a>
        </div>
      `
    },
    kochi: {
      title: "Azeezia Convention Centre Flagship • Kochi",
      html: `
        <p style="margin-bottom: 14px; font-size: 0.92rem; color: var(--color-plum-main);"><strong>Location:</strong> Civil Line Road, Padivattom, Edappally, Kochi, Kerala - 682024</p>
        <p style="margin-bottom: 14px; line-height: 1.8; color: #555;">Established in 2015 in central Kochi, Azeezia Convention Centre is a premier venue accommodating up to 2,000 guests with award-winning acoustic architecture and 5-star hospitality.</p>
        <h4 style="font-family: var(--font-serif); font-size: 1.15rem; margin-top: 18px; margin-bottom: 10px; color: var(--color-plum-dark);">Highlights & Features:</h4>
        <ul style="list-style: square; padding-left: 20px; line-height: 1.8; color: #666; font-size: 0.88rem;">
          <li>2,000-Capacity Grand Pillarless Auditorium with Digital Carpet</li>
          <li>Zidan & Majlis 5-Star Dining Halls separated by Soundproof Glass</li>
          <li>Audiophile 25,000W JBL Acoustic Sound Architecture</li>
          <li>Nano White Granite Marble Dining Tables & Premium Chairs</li>
          <li>Air-Conditioned VIP Green Rooms & 200+ Secure Car Parking</li>
        </ul>
        <div style="margin-top: 24px;">
          <a href="#contact" class="btn btn-plum close-modal-trigger" style="width: 100%;">REQUEST KOCHI DATES</a>
        </div>
      `
    }
  };

  openModalButtons.forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      const venueKey = btn.dataset.venueKey || 'thrissur';
      const info = venueData[venueKey] || venueData.thrissur;

      if (modalTitle) modalTitle.textContent = info.title;
      if (modalBody) modalBody.innerHTML = info.html;

      if (modalOverlay) {
        modalOverlay.classList.add('active');
        document.body.style.overflow = 'hidden';
      }

      // Re-attach close listeners for links inside the modal
      const newCloseTriggers = modalBody.querySelectorAll('.close-modal-trigger');
      newCloseTriggers.forEach(trigger => {
        trigger.addEventListener('click', () => {
          closeModal();
        });
      });
    });
  });

  const closeModal = () => {
    if (modalOverlay) {
      modalOverlay.classList.remove('active');
      document.body.style.overflow = '';
    }
  };

  modalClose.forEach(btn => {
    btn.addEventListener('click', closeModal);
  });

  if (modalOverlay) {
    modalOverlay.addEventListener('click', (e) => {
      if (e.target === modalOverlay) closeModal();
    });
  }

  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && modalOverlay && modalOverlay.classList.contains('active')) {
      closeModal();
    }
  });

  // --------------------------------------------------------------------------
  // 9. TESTIMONIALS CAROUSEL ("WHAT OUR GUESTS SAY")
  // --------------------------------------------------------------------------
  const testiStage = document.querySelector('.az-testi-stage');
  const testiPrevBtn = document.getElementById('testiPrevBtn');
  const testiNextBtn = document.getElementById('testiNextBtn');
  const testiCurrNum = document.getElementById('testiCurrentNum');
  const testiTotalNum = document.querySelector('.az-testi-total');
  const testiLeftArchImg = document.getElementById('testiLeftArchImg');
  const testiRightArchImg = document.getElementById('testiRightArchImg');
  const testiAvatarImg = document.getElementById('testiAvatarImg');
  const testiAuthorName = document.getElementById('testiAuthorName');
  const testiAuthorEvent = document.getElementById('testiAuthorEvent');
  const testiQuoteText = document.querySelector('.az-testi-quote-text');

  const fallbackTestimonials = [
    {
      name: "Rohit & Aiswarya",
      event: "WEDDING CELEBRATION",
      avatar: "assets/images/profile.webp",
      quote: "A truly memorable experience! The venue, hospitality and attention to detail made our special day absolutely perfect.",
      rating: 5
    },
    {
      name: "Karthik & Meera",
      event: "GRAND RECEPTION",
      avatar: "assets/images/profile.webp",
      quote: "From the magnificent hall lighting to the stellar banquet service, Azeezia exceeded every expectation. Our guests are still raving about it!",
      rating: 5
    },
    {
      name: "Dr. Suresh Menon & Family",
      event: "50TH MILESTONE JUBILEE",
      avatar: "assets/images/profile.webp",
      quote: "The serene natural environment, attentive staff, and peaceful resort backdrop made my milestone jubilee truly unforgettable. Pure perfection.",
      rating: 5
    },
    {
      name: "Ananya & Varun",
      event: "DESTINATION WEDDING",
      avatar: "assets/images/profile.webp",
      quote: "The open lawn under twilight and the farm-fresh banquet was an absolute fairy tale. Azeezia is genuinely Kerala’s finest destination venue.",
      rating: 5
    },
    {
      name: "Rajesh Nair & Associates",
      event: "CORPORATE LEADERSHIP SUMMIT",
      avatar: "assets/images/profile.webp",
      quote: "World-class acoustic architecture, seamless digital display integration, and immaculate dining. Perfectly executed from beginning to end.",
      rating: 5
    },
    {
      name: "Devi & Gautham",
      event: "SANGEET & COCKTAIL EVENING",
      avatar: "assets/images/wedding-couple.jpg",
      quote: "The electric sound atmosphere and organic culinary delicacies created everlasting memories for all of us. Azeezia’s team is simply world class.",
      rating: 5
    }
  ];

  const testimonialsData = (window.azTestimonialsData && Array.isArray(window.azTestimonialsData) && window.azTestimonialsData.length > 0)
    ? window.azTestimonialsData
    : fallbackTestimonials;

  if (testiTotalNum && testimonialsData.length > 0) {
    testiTotalNum.textContent = String(testimonialsData.length).padStart(2, '0');
  }

  let currentTestiIndex = 0;

  function updateTestimonial(index) {
    if (!testiStage || testimonialsData.length === 0) return;
    if (index < 0) index = testimonialsData.length - 1;
    if (index >= testimonialsData.length) index = 0;
    currentTestiIndex = index;

    const data = testimonialsData[index];
    const card = document.querySelector('.az-testi-card');
    
    if (card) {
      card.style.opacity = '0';
      card.style.transform = 'translateY(8px)';
    }

    setTimeout(() => {
      if (testiCurrNum) {
        testiCurrNum.textContent = String(index + 1).padStart(2, '0');
      }
      if (testiTotalNum) {
        testiTotalNum.textContent = String(testimonialsData.length).padStart(2, '0');
      }
      if (testiAuthorName) testiAuthorName.textContent = data.name || '';
      if (testiAuthorEvent) testiAuthorEvent.textContent = data.event || '';
      if (testiQuoteText) {
        const cleanQuote = (data.quote || '').replace(/^["“\s]+|["”\s]+$/g, '');
        testiQuoteText.textContent = `“${cleanQuote}”`;
      }
      if (testiAvatarImg) {
        testiAvatarImg.src = data.avatar || 'assets/frontend/images/profile.webp';
        testiAvatarImg.alt = data.name || 'Testimonial Avatar';
      }

      const starsContainer = document.querySelector('.az-testi-stars');
      if (starsContainer) {
        const starCount = Math.max(1, Math.min(5, parseInt(data.rating, 10) || 5));
        starsContainer.innerHTML = '<span>&#9733;</span>'.repeat(starCount);
        starsContainer.setAttribute('aria-label', `${starCount} out of 5 stars`);
      }

      // Left and right arch images are left constant intentionally as requested.

      if (card) {
        card.style.opacity = '1';
        card.style.transform = 'translateY(0)';
      }
    }, 180);
  }

  if (testiPrevBtn) {
    testiPrevBtn.addEventListener('click', () => updateTestimonial(currentTestiIndex - 1));
  }
  if (testiNextBtn) {
    testiNextBtn.addEventListener('click', () => updateTestimonial(currentTestiIndex + 1));
  }

  // Touch swipe support for Testimonial Carousel
  if (testiStage) {
    let testiTouchStartX = 0;
    let testiTouchEndX = 0;

    testiStage.addEventListener('touchstart', (e) => {
      testiTouchStartX = e.changedTouches[0].screenX;
    }, { passive: true });

    testiStage.addEventListener('touchend', (e) => {
      testiTouchEndX = e.changedTouches[0].screenX;
      const swipeDistance = testiTouchEndX - testiTouchStartX;
      if (Math.abs(swipeDistance) > 40) {
        if (swipeDistance < 0) {
          updateTestimonial(currentTestiIndex + 1); // Swipe left -> Next
        } else {
          updateTestimonial(currentTestiIndex - 1); // Swipe right -> Prev
        }
      }
    }, { passive: true });
  }

  // --------------------------------------------------------------------------
  // 10. PLAN YOUR EVENT FORM HANDLER
  // --------------------------------------------------------------------------
  const planEventForm = document.getElementById('planEventForm');
  if (planEventForm) {
    planEventForm.addEventListener('submit', (e) => {
      e.preventDefault();
      const name = document.getElementById('planEventName')?.value.trim();
      const phone = document.getElementById('planEventPhone')?.value.trim();
      const email = document.getElementById('planEventEmail')?.value.trim();
      const details = document.getElementById('planEventDetails')?.value.trim();
      const captchaError = planEventForm.querySelector('.az-captcha-error');
      const responseBox = planEventForm.querySelector('.az-plan-response');

      if (captchaError) captchaError.style.display = 'none';
      if (responseBox) {
        responseBox.style.display = 'none';
        responseBox.innerHTML = '';
      }

      if (!name || !phone || !email) {
        showToast('Please fill in your name, phone number and email.');
        return;
      }

      let captchaResponse = '';
      if (typeof grecaptcha !== 'undefined') {
        try {
          captchaResponse = grecaptcha.getResponse();
        } catch (err) {}
      }

      if (!captchaResponse) {
        if (captchaError) {
          captchaError.textContent = 'Please verify that you are not a robot.';
          captchaError.style.display = 'block';
        }
        showToast('Please verify that you are not a robot.');
        return;
      }

      const submitBtn = planEventForm.querySelector('.az-plan-submit-btn, .az-plan-circular-stamp');
      const btnText = submitBtn ? submitBtn.querySelector('.az-sig-btn-text') : null;
      const originalText = btnText ? btnText.textContent : 'SEND ENQUIRY';

      if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.style.opacity = '0.7';
        if (btnText) btnText.textContent = 'SENDING...';
      }

      const formData = new FormData(planEventForm);

      fetch(planEventForm.action || '/contact/store', {
        method: 'POST',
        body: formData,
        headers: {
          'X-Requested-With': 'XMLHttpRequest',
          'Accept': 'application/json'
        }
      })
      .then(async (res) => {
        const data = await res.json().catch(() => ({}));
        if (res.ok && data.success) {
          showToast(data.message || `Thank you, ${name}! Your event enquiry has been received.`);
          if (responseBox) {
            responseBox.innerHTML = '<div style="background:rgba(109,139,40,0.12);border:1px solid #6D8B28;color:#2D4A16;padding:12px 18px;border-radius:4px;font-size:0.95rem;font-family:var(--font-sans);">' + (data.message || 'Thank you! Your enquiry has been received.') + '</div>';
            responseBox.style.display = 'block';
          }
          planEventForm.reset();
          if (typeof grecaptcha !== 'undefined') {
            try { grecaptcha.reset(); } catch (err) {}
          }
        } else {
          let errorMsg = 'Please verify that you are not a robot.';
          if (data.errors) {
            const firstKey = Object.keys(data.errors)[0];
            if (firstKey && data.errors[firstKey][0]) {
              errorMsg = data.errors[firstKey][0];
            }
          } else if (data.message) {
            errorMsg = data.message;
          }
          if (captchaError && errorMsg.toLowerCase().includes('robot')) {
            captchaError.textContent = errorMsg;
            captchaError.style.display = 'block';
          }
          showToast(errorMsg);
          if (responseBox) {
            responseBox.innerHTML = '<div style="background:rgba(220,38,38,0.1);border:1px solid #dc2626;color:#991b1b;padding:12px 18px;border-radius:4px;font-size:0.95rem;font-family:var(--font-sans);">' + errorMsg + '</div>';
            responseBox.style.display = 'block';
          }
          if (typeof grecaptcha !== 'undefined') {
            try { grecaptcha.reset(); } catch (err) {}
          }
        }
      })
      .catch((err) => {
        showToast('Something went wrong. Please try again or reach our team directly.');
        if (typeof grecaptcha !== 'undefined') {
          try { grecaptcha.reset(); } catch (e) {}
        }
      })
      .finally(() => {
        if (submitBtn) {
          submitBtn.disabled = false;
          submitBtn.style.opacity = '';
          submitBtn.style.transform = '';
          if (btnText) btnText.textContent = originalText;
        }
      });
    });
  }

  // --------------------------------------------------------------------------
  // 8. SMOOTH SCROLLING FOR ALL ANCHOR LINKS
  // --------------------------------------------------------------------------
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      const targetId = this.getAttribute('href');
      if (targetId === '#' || targetId === '') return;

      const targetElem = document.querySelector(targetId);
      if (targetElem) {
        e.preventDefault();
        const headerOffset = 70;
        const elementPosition = targetElem.getBoundingClientRect().top;
        const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

        window.scrollTo({
          top: offsetPosition,
          behavior: 'smooth'
        });
      }
    });
  });

  // --------------------------------------------------------------------------
  // 9. FADE-IN-UP SCROLL ANIMATION FOR ALL MAIN HEADINGS
  // --------------------------------------------------------------------------
  const initHeadingFadeInUp = () => {
    // Flag the document so CSS transitions take effect smoothly
    document.documentElement.classList.add('has-heading-animations');

    const headingSelectors = [
      '.heading-fade-in-up',
      '.hero-grand-title',
      '.about-banner-title',
      '.services-banner-title',
      '.gallery-banner-title',
      '.contact-banner-title',
      '.cc-grand-headline',
      '.cc-word-meet',
      '.az-about-headline',
      '.az-slide-title',
      '.car-track-title',
      '.az-editorial-heading',
      '.az-testi-heading',
      '.az-plan-heading',
      '.arch-story-title',
      '.arch-mvv-title',
      '.about-testi-heading',
      '.editorial-statement-title',
      '.editorial-invitation-title',
      '.locations-main-heading',
      '.resort-section-title',
      '.resort-panorama-title',
      '.farm-headline',
      '.farm-wordmark-title',
      '.pillars-title',
      'h1',
      'h2'
    ];

    const allHeadings = Array.from(document.querySelectorAll(headingSelectors.join(', ')));
    const uniqueHeadings = Array.from(new Set(allHeadings)).filter(el => {
      // Exclude off-canvas navigation drawer headings and modal titles if any
      return !el.closest('.nav-menu') && !el.closest('#venueModal');
    });

    uniqueHeadings.forEach(heading => {
      heading.classList.add('heading-fade-in-up');
    });

    if ('IntersectionObserver' in window) {
      const observerOptions = {
        root: null,
        rootMargin: '0px 0px -30px 0px',
        threshold: 0.08
      };

      const headingObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.classList.add('is-visible');
            headingObserver.unobserve(entry.target);
          }
        });
      }, observerOptions);

      uniqueHeadings.forEach(heading => {
        // Inactive carousel slides will be observed when their slide becomes active
        const isInactiveSlide = heading.closest('.az-carousel-slide:not(.active)');
        if (!isInactiveSlide) {
          headingObserver.observe(heading);
        }
      });
    } else {
      // Fallback for older browsers without IntersectionObserver
      uniqueHeadings.forEach(heading => heading.classList.add('is-visible'));
    }
  };

  initHeadingFadeInUp();

  // --------------------------------------------------------------------------
  // AUTOMATIC IMAGE SLIDERS: THRISSUR CONVENTION CENTRE FEATURES
  // Smooth cross-fading feature showcase for left & right photo columns
  // --------------------------------------------------------------------------
  const initThrissurFeaturesSlider = () => {
    const leftSliders = document.querySelectorAll('.az-about-slider[data-slider-group="left"]');
    const rightSliders = document.querySelectorAll('.az-about-slider[data-slider-group="right"]');

    if (!leftSliders.length && !rightSliders.length) return;

    const advanceSliders = (sliders) => {
      sliders.forEach(slider => {
        const slides = slider.querySelectorAll('.az-about-slide');
        if (slides.length <= 1) return;
        let activeIdx = -1;
        slides.forEach((slide, i) => {
          if (slide.classList.contains('active')) activeIdx = i;
        });
        if (activeIdx === -1) activeIdx = 0;
        const nextIdx = (activeIdx + 1) % slides.length;

        const currentSlide = slides[activeIdx];
        const nextSlide = slides[nextIdx];

        // Clean up any stale prev-active classes
        slides.forEach(s => s.classList.remove('prev-active'));

        // Keep outgoing slide fully visible underneath at z-index 2
        currentSlide.classList.add('prev-active');
        currentSlide.classList.remove('active');

        // Smoothly fade incoming slide in on top at z-index 3
        nextSlide.classList.add('active');

        // Clean up previous slide after fade transition completes
        setTimeout(() => {
          currentSlide.classList.remove('prev-active');
        }, 1300);
      });
    };

    // Cycle duration: 4.5 seconds per transition
    const intervalMs = 4500;
    let leftTimer = null;
    let rightTimer = null;

    const startSliders = () => {
      if (leftTimer) clearInterval(leftTimer);
      if (rightTimer) clearInterval(rightTimer);

      leftTimer = setInterval(() => {
        if (!document.hidden) advanceSliders(leftSliders);
      }, intervalMs);

      // Stagger right group by 2.25s for smooth alternating transitions
      setTimeout(() => {
        rightTimer = setInterval(() => {
          if (!document.hidden) advanceSliders(rightSliders);
        }, intervalMs);
      }, intervalMs / 2);
    };

    startSliders();

    // Pause on visibility change when tab is hidden, resume when visible
    document.addEventListener('visibilitychange', () => {
      if (!document.hidden) {
        startSliders();
      } else {
        if (leftTimer) clearInterval(leftTimer);
        if (rightTimer) clearInterval(rightTimer);
      }
    });
  };

  initThrissurFeaturesSlider();

  // --------------------------------------------------------------------------
  // FULL-WIDTH SLIDING MOVING GALLERY (SINGLE ROW, 4 IMAGES SCROLL AT A TIME)
  // Automatic moving reel with 4 images per view on desktop, touch swipe & lightbox
  // --------------------------------------------------------------------------
  const initMovingGallerySlider = () => {
    const viewport = document.getElementById('azGalleryViewport');
    const track = document.getElementById('azGalleryTrack');
    const prevBtn = document.getElementById('azGalleryMovePrev');
    const nextBtn = document.getElementById('azGalleryMoveNext');
    const currentNum = document.getElementById('azGalleryMoveCurrent');
    const totalNum = document.getElementById('azGalleryMoveTotal');
    const dotsContainer = document.getElementById('azGalleryDots');

    if (!viewport || !track) return;

    const cards = Array.from(track.querySelectorAll('.az-moving-gallery-card'));
    if (!cards.length) return;

    let currentPage = 0;
    let autoTimer = null;
    const intervalMs = 4500;

    const getItemsPerPage = () => {
      if (window.innerWidth >= 1024) return 4;
      if (window.innerWidth >= 641) return 2;
      return 1;
    };

    const getTotalPages = () => {
      const perPage = getItemsPerPage();
      return Math.ceil(cards.length / perPage);
    };

    const updateDots = () => {
      if (!dotsContainer) return;
      const pages = getTotalPages();
      dotsContainer.innerHTML = '';
      for (let i = 0; i < pages; i++) {
        const dot = document.createElement('button');
        dot.className = `az-gallery-dot${i === currentPage ? ' active' : ''}`;
        dot.setAttribute('data-page', i);
        dot.setAttribute('role', 'tab');
        dot.setAttribute('aria-selected', i === currentPage ? 'true' : 'false');
        dot.setAttribute('aria-label', `Slide ${i + 1}`);
        dot.addEventListener('click', (e) => {
          e.stopPropagation();
          goToPage(i);
          resetAuto();
        });
        dotsContainer.appendChild(dot);
      }
    };

    const updateUI = () => {
      const itemsPerPage = getItemsPerPage();
      const pages = getTotalPages();

      if (currentPage >= pages) currentPage = pages - 1;
      if (currentPage < 0) currentPage = 0;

      const cardRect = cards[0].getBoundingClientRect();
      const style = window.getComputedStyle(track);
      const gap = parseFloat(style.gap) || 16;

      // Scroll exactly itemsPerPage (4 images at a time on desktop)
      const shiftDistance = currentPage * (itemsPerPage * (cardRect.width + gap));
      track.style.transform = `translateX(-${shiftDistance}px)`;

      if (currentNum) currentNum.textContent = String(currentPage + 1).padStart(2, '0');
      if (totalNum) totalNum.textContent = String(pages).padStart(2, '0');

      if (dotsContainer) {
        const dots = dotsContainer.querySelectorAll('.az-gallery-dot');
        dots.forEach((dot, idx) => {
          const isActive = idx === currentPage;
          dot.classList.toggle('active', isActive);
          dot.setAttribute('aria-selected', isActive ? 'true' : 'false');
        });
      }
    };

    const goToPage = (page) => {
      const pages = getTotalPages();
      currentPage = (page + pages) % pages;
      updateUI();
    };

    const nextSlide = () => {
      const pages = getTotalPages();
      currentPage = (currentPage + 1) % pages;
      updateUI();
    };

    const prevSlide = () => {
      const pages = getTotalPages();
      currentPage = (currentPage - 1 + pages) % pages;
      updateUI();
    };

    if (nextBtn) {
      nextBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        nextSlide();
        resetAuto();
      });
    }

    if (prevBtn) {
      prevBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        prevSlide();
        resetAuto();
      });
    }

    // Auto-moving timers
    const startAuto = () => {
      if (autoTimer) clearInterval(autoTimer);
      autoTimer = setInterval(() => {
        if (!document.hidden) nextSlide();
      }, intervalMs);
    };

    const stopAuto = () => {
      if (autoTimer) {
        clearInterval(autoTimer);
        autoTimer = null;
      }
    };

    const resetAuto = () => {
      stopAuto();
      startAuto();
    };

    viewport.addEventListener('mouseenter', stopAuto);
    viewport.addEventListener('mouseleave', startAuto);

    // Touch & pointer swipe support
    let startX = 0;
    let currentX = 0;
    let isTouching = false;

    viewport.addEventListener('touchstart', (e) => {
      startX = e.touches[0].clientX;
      currentX = startX;
      isTouching = true;
      stopAuto();
    }, { passive: true });

    viewport.addEventListener('touchmove', (e) => {
      if (!isTouching) return;
      currentX = e.touches[0].clientX;
    }, { passive: true });

    viewport.addEventListener('touchend', () => {
      if (!isTouching) return;
      isTouching = false;
      const diff = startX - currentX;
      if (Math.abs(diff) > 40) {
        if (diff > 0) {
          nextSlide();
        } else {
          prevSlide();
        }
      }
      startAuto();
    });

    // Window resize handler with debounce
    let resizeTimer = null;
    window.addEventListener('resize', () => {
      clearTimeout(resizeTimer);
      resizeTimer = setTimeout(() => {
        updateDots();
        updateUI();
      }, 100);
    });

    // ------------------------------------------------------------------------
    // LIGHTBOX CINEMA MODAL INTEGRATION
    // ------------------------------------------------------------------------
    const lightboxModal = document.getElementById('galleryLightboxModal');
    const lightboxImg = document.getElementById('lightboxActiveImg');
    const lightboxTitle = document.getElementById('lightboxCaptionTitle');
    const lightboxLoc = document.getElementById('lightboxCaptionLoc');
    const lightboxTag = document.getElementById('lightboxCategoryTag');
    const lightboxCounter = document.getElementById('lightboxCounter');
    const lightboxClose = document.getElementById('lightboxCloseBtn');
    const lightboxPrev = document.getElementById('lightboxPrevBtn');
    const lightboxNext = document.getElementById('lightboxNextBtn');

    let activeCardIndex = 0;

    const openLightbox = (index) => {
      if (!lightboxModal) return;
      activeCardIndex = (index + cards.length) % cards.length;
      const card = cards[activeCardIndex];
      const img = card.querySelector('.az-moving-gallery-img');
      const title = card.getAttribute('data-title') || 'Azeezia Space';
      const loc = card.getAttribute('data-location') || 'Thrissur, Kerala';
      const tag = card.getAttribute('data-tag') || 'Photo Gallery';

      if (lightboxImg && img) {
        lightboxImg.src = img.src;
        lightboxImg.alt = img.alt || title;
      }
      if (lightboxTitle) lightboxTitle.textContent = title;
      if (lightboxLoc) lightboxLoc.innerHTML = `<i class="fas fa-map-marker-alt"></i> ${loc}`;
      if (lightboxTag) lightboxTag.textContent = tag;
      if (lightboxCounter) {
        const cur = String(activeCardIndex + 1).padStart(2, '0');
        const tot = String(cards.length).padStart(2, '0');
        lightboxCounter.textContent = `${cur} / ${tot}`;
      }

      lightboxModal.classList.add('is-active');
      document.body.style.overflow = 'hidden';
      stopAuto();
    };

    const closeLightbox = () => {
      if (!lightboxModal) return;
      lightboxModal.classList.remove('is-active');
      document.body.style.overflow = '';
      startAuto();
    };

    cards.forEach((card, idx) => {
      card.addEventListener('click', () => {
        openLightbox(idx);
      });
    });

    if (lightboxClose) lightboxClose.addEventListener('click', closeLightbox);
    if (lightboxNext) {
      lightboxNext.addEventListener('click', (e) => {
        e.stopPropagation();
        openLightbox(activeCardIndex + 1);
      });
    }
    if (lightboxPrev) {
      lightboxPrev.addEventListener('click', (e) => {
        e.stopPropagation();
        openLightbox(activeCardIndex - 1);
      });
    }

    if (lightboxModal) {
      lightboxModal.addEventListener('click', (e) => {
        if (e.target === lightboxModal || e.target.classList.contains('lightbox-stage') || e.target.classList.contains('lightbox-img-wrapper')) {
          closeLightbox();
        }
      });
    }

    document.addEventListener('keydown', (e) => {
      if (!lightboxModal || !lightboxModal.classList.contains('is-active')) return;
      if (e.key === 'Escape') closeLightbox();
      if (e.key === 'ArrowRight') openLightbox(activeCardIndex + 1);
      if (e.key === 'ArrowLeft') openLightbox(activeCardIndex - 1);
    });

    // Initialize gallery
    updateDots();
    updateUI();
    startAuto();

    document.addEventListener('visibilitychange', () => {
      if (!document.hidden) {
        startAuto();
      } else {
        stopAuto();
      }
    });
  };

  initMovingGallerySlider();

  // --------------------------------------------------------------------------
  // FAQ ACCORDION: SMOOTH EXPAND / COLLAPSE
  // --------------------------------------------------------------------------
  const initFaqAccordion = () => {
    const faqItems = document.querySelectorAll('.az-faq-item');
    if (!faqItems.length) return;

    faqItems.forEach((item) => {
      const btn = item.querySelector('.az-faq-question-btn');
      const answer = item.querySelector('.az-faq-answer');
      if (!btn || !answer) return;

      btn.addEventListener('click', () => {
        const isOpen = item.classList.contains('is-open');

        // Close other items
        faqItems.forEach((otherItem) => {
          if (otherItem !== item && otherItem.classList.contains('is-open')) {
            otherItem.classList.remove('is-open');
            const otherBtn = otherItem.querySelector('.az-faq-question-btn');
            const otherAnswer = otherItem.querySelector('.az-faq-answer');
            if (otherBtn) otherBtn.setAttribute('aria-expanded', 'false');
            if (otherAnswer) otherAnswer.style.maxHeight = null;
          }
        });

        // Toggle current item
        if (isOpen) {
          item.classList.remove('is-open');
          btn.setAttribute('aria-expanded', 'false');
          answer.style.maxHeight = null;
        } else {
          item.classList.add('is-open');
          btn.setAttribute('aria-expanded', 'true');
          if (answer.hasAttribute('hidden')) {
            answer.removeAttribute('hidden');
          }
          answer.style.maxHeight = answer.scrollHeight + 'px';
        }
      });
    });

    // Auto-open first question if navigating directly to FAQ section
    const checkFaqHash = () => {
      const hash = window.location.hash;
      if (hash === '#about-faq' || hash === '#faq') {
        const firstItem = faqItems[0];
        if (firstItem && !firstItem.classList.contains('is-open')) {
          const firstBtn = firstItem.querySelector('.az-faq-question-btn');
          const firstAns = firstItem.querySelector('.az-faq-answer');
          if (firstBtn && firstAns) {
            firstItem.classList.add('is-open');
            firstBtn.setAttribute('aria-expanded', 'true');
            if (firstAns.hasAttribute('hidden')) {
              firstAns.removeAttribute('hidden');
            }
            firstAns.style.maxHeight = firstAns.scrollHeight + 'px';
          }
        }
      }
    };
    checkFaqHash();
    window.addEventListener('hashchange', checkFaqHash);

    // Resize recalculation for open FAQ items
    window.addEventListener('resize', () => {
      const openItem = document.querySelector('.az-faq-item.is-open');
      if (openItem) {
        const openAnswer = openItem.querySelector('.az-faq-answer');
        if (openAnswer) {
          openAnswer.style.maxHeight = openAnswer.scrollHeight + 'px';
        }
      }
    });
  };

  initFaqAccordion();
});
