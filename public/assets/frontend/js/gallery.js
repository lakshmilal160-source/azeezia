/**
 * Azeezia Convention Centre & Resort - Filterable Gallery Script
 * Modular vanilla JavaScript for smooth filtering, dynamic counts, URL hash sync,
 * and high-performance fullscreen lightbox with keyboard & mobile swipe support.
 */

(function () {
  'use strict';

  document.addEventListener('DOMContentLoaded', initGallery);

  function initGallery() {
    const filterButtons = document.querySelectorAll('.gallery-filter-btn');
    const galleryCards = document.querySelectorAll('.gallery-card');
    const galleryGrid = document.querySelector('.gallery-grid');
    const emptyNotice = document.querySelector('.gallery-empty-notice');

    if (!galleryCards.length) return;

    // Lightbox Elements
    const lightboxModal = document.getElementById('galleryLightboxModal');
    const lightboxImg = document.getElementById('lightboxActiveImg');
    const lightboxTitle = document.getElementById('lightboxCaptionTitle');
    const lightboxLoc = document.getElementById('lightboxCaptionLoc');
    const lightboxTag = document.getElementById('lightboxCategoryTag');
    const lightboxCounter = document.getElementById('lightboxCounter');
    const lightboxClose = document.getElementById('lightboxCloseBtn');
    const lightboxPrev = document.getElementById('lightboxPrevBtn');
    const lightboxNext = document.getElementById('lightboxNextBtn');

    let currentFilter = 'all';
    let visibleCards = Array.from(galleryCards);
    let activeIndex = 0;

    // 1. Calculate and update counts on each filter button
    function updateFilterCounts() {
      const counts = { all: galleryCards.length };

      galleryCards.forEach(card => {
        const cat = card.getAttribute('data-category');
        if (cat) {
          counts[cat] = (counts[cat] || 0) + 1;
        }
      });

      filterButtons.forEach(btn => {
        const filter = btn.getAttribute('data-filter');
        const countSpan = btn.querySelector('.filter-count');
        if (countSpan && counts[filter] !== undefined) {
          countSpan.textContent = counts[filter];
        }
      });
    }

    // 2. Filter gallery cards by category
    function filterCards(filterKey, updateHash = true) {
      currentFilter = filterKey;

      // Update button active state
      filterButtons.forEach(btn => {
        const isActive = btn.getAttribute('data-filter') === filterKey;
        btn.classList.toggle('active', isActive);
        btn.setAttribute('aria-selected', isActive ? 'true' : 'false');
      });

      if (galleryGrid) galleryGrid.classList.add('is-filtering');

      setTimeout(() => {
        let matchCount = 0;
        visibleCards = [];

        galleryCards.forEach(card => {
          const category = card.getAttribute('data-category');
          const isMatch = filterKey === 'all' || category === filterKey;

          if (isMatch) {
            card.classList.remove('is-hidden');
            visibleCards.push(card);
            matchCount++;
          } else {
            card.classList.add('is-hidden');
          }
        });

        if (emptyNotice) {
          emptyNotice.classList.toggle('is-visible', matchCount === 0);
        }

        if (galleryGrid) galleryGrid.classList.remove('is-filtering');

        if (updateHash && filterKey !== 'all') {
          history.replaceState(null, '', '#' + filterKey);
        } else if (updateHash && filterKey === 'all') {
          history.replaceState(null, '', window.location.pathname);
        }
      }, 150);
    }

    // Bind click events on filter buttons
    filterButtons.forEach(btn => {
      btn.addEventListener('click', () => {
        const filter = btn.getAttribute('data-filter');
        filterCards(filter);
      });
    });

    // 3. Lightbox Functionality
    function openLightbox(index) {
      if (!visibleCards.length || !lightboxModal) return;

      activeIndex = (index + visibleCards.length) % visibleCards.length;
      const card = visibleCards[activeIndex];
      const img = card.querySelector('.gallery-card-img');
      const title = card.getAttribute('data-title') || 'Azeezia Space';
      const category = card.getAttribute('data-category-label') || 'Gallery';
      const location = card.getAttribute('data-location') || 'Azeezia, Kerala';

      if (img && lightboxImg) {
        lightboxImg.src = img.src;
        lightboxImg.alt = img.alt || title;
      }

      if (lightboxTitle) lightboxTitle.textContent = title;
      if (lightboxLoc) lightboxLoc.innerHTML = '<i class="fas fa-map-marker-alt" aria-hidden="true"></i> ' + location;
      if (lightboxTag) lightboxTag.textContent = category;
      if (lightboxCounter) {
        const currentStr = String(activeIndex + 1).padStart(2, '0');
        const totalStr = String(visibleCards.length).padStart(2, '0');
        lightboxCounter.textContent = `${currentStr} / ${totalStr}`;
      }

      lightboxModal.classList.add('is-active');
      document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
      if (!lightboxModal) return;
      lightboxModal.classList.remove('is-active');
      document.body.style.overflow = '';
    }

    function showNext() {
      openLightbox(activeIndex + 1);
    }

    function showPrev() {
      openLightbox(activeIndex - 1);
    }

    // Card click events for opening lightbox
    galleryCards.forEach(card => {
      card.addEventListener('click', (e) => {
        // Find position of this card in currently visible cards
        const index = visibleCards.indexOf(card);
        if (index !== -1) {
          openLightbox(index);
        }
      });
    });

    // Lightbox Controls
    if (lightboxClose) lightboxClose.addEventListener('click', closeLightbox);
    if (lightboxNext) lightboxNext.addEventListener('click', (e) => { e.stopPropagation(); showNext(); });
    if (lightboxPrev) lightboxPrev.addEventListener('click', (e) => { e.stopPropagation(); showPrev(); });

    // Backdrop click to close
    if (lightboxModal) {
      lightboxModal.addEventListener('click', (e) => {
        if (e.target === lightboxModal || e.target.classList.contains('lightbox-stage') || e.target.classList.contains('lightbox-img-wrapper')) {
          closeLightbox();
        }
      });
    }

    // Keyboard controls
    window.addEventListener('keydown', (e) => {
      if (!lightboxModal || !lightboxModal.classList.contains('is-active')) return;
      if (e.key === 'Escape') closeLightbox();
      if (e.key === 'ArrowRight') showNext();
      if (e.key === 'ArrowLeft') showPrev();
    });

    // Mobile Swipe Support
    let touchStartX = 0;
    let touchEndX = 0;

    if (lightboxModal) {
      lightboxModal.addEventListener('touchstart', (e) => {
        touchStartX = e.changedTouches[0].screenX;
      }, { passive: true });

      lightboxModal.addEventListener('touchend', (e) => {
        touchEndX = e.changedTouches[0].screenX;
        handleSwipe();
      }, { passive: true });
    }

    function handleSwipe() {
      const threshold = 40;
      if (touchEndX < touchStartX - threshold) {
        showNext(); // Swiped left -> show next
      }
      if (touchEndX > touchStartX + threshold) {
        showPrev(); // Swiped right -> show prev
      }
    }

    // 5. Cinematic YouTube Video Deck Controls (Editorial Cascading Deck)
    const storyCards = document.querySelectorAll('.az-story-card');
    const deckWrapper = document.getElementById('azStoryDeckWrapper');
    const timelineFill = document.getElementById('azStoryTimelineFill');
    const counterText = document.getElementById('azStoryCounter');
    const prevBtn = document.getElementById('azStoryPrev');
    const nextBtn = document.getElementById('azStoryNext');

    if (storyCards.length) {
      let activeDeckIndex = 0;
      const totalStoryCards = storyCards.length;
      let autoPlayTimer = null;

      function playYouTubeVideo(card) {
        if (!card) return;
        const ytId = card.getAttribute('data-youtube-id') || 'M7lc1UVf-VE';
        const holder = card.querySelector('.az-deck-youtube-holder');

        // Stop all other cards
        storyCards.forEach(c => {
          if (c !== card) {
            c.classList.remove('is-playing');
            const h = c.querySelector('.az-deck-youtube-holder');
            if (h) h.innerHTML = '';
          }
        });

        // Inject active YouTube iframe
        if (holder) {
          holder.innerHTML = `<iframe src="https://www.youtube-nocookie.com/embed/${ytId}?autoplay=1&rel=0&modestbranding=1" title="Azeezia Video" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen class="az-deck-iframe"></iframe>`;
        }

        card.classList.add('is-playing');
        stopAutoPlay(); // Never auto-slide while watching video
      }

      function stopYouTubeVideo(card) {
        if (!card) return;
        card.classList.remove('is-playing');
        const holder = card.querySelector('.az-deck-youtube-holder');
        if (holder) holder.innerHTML = '';
        startAutoPlay();
      }

      // Update positions of cascading cards
      function updateDeckPositions() {
        storyCards.forEach((card, index) => {
          // Remove old position classes
          card.classList.remove('pos-0', 'pos-1', 'pos-2', 'pos-3');
          // Relative position from active index
          const relPos = (index - activeDeckIndex + totalStoryCards) % totalStoryCards;
          card.classList.add(`pos-${relPos}`);

          // If moved to background, stop any video inside it
          if (relPos !== 0) {
            card.classList.remove('is-playing');
            const holder = card.querySelector('.az-deck-youtube-holder');
            if (holder) holder.innerHTML = '';
          }
        });

        // Update progress bar
        if (timelineFill) {
          const stepPercent = 100 / totalStoryCards;
          timelineFill.style.left = `${activeDeckIndex * stepPercent}%`;
          timelineFill.style.width = `${stepPercent}%`;
        }

        // Update counter text
        if (counterText) {
          const curr = String(activeDeckIndex + 1).padStart(2, '0');
          const total = String(totalStoryCards).padStart(2, '0');
          counterText.textContent = `${curr} / ${total}`;
        }
      }

      function nextStoryCard() {
        activeDeckIndex = (activeDeckIndex + 1) % totalStoryCards;
        updateDeckPositions();
      }

      function prevStoryCard() {
        activeDeckIndex = (activeDeckIndex - 1 + totalStoryCards) % totalStoryCards;
        updateDeckPositions();
      }

      // Click card to bring it to front and START PLAYING YOUTUBE VIDEO!
      storyCards.forEach((card, index) => {
        card.addEventListener('click', (e) => {
          // If external link to YouTube clicked, allow default navigation
          if (e.target.closest('.az-deck-yt-btn')) return;

          // If close video button clicked, stop YouTube video
          if (e.target.closest('.az-deck-close-video-btn')) {
            e.stopPropagation();
            stopYouTubeVideo(card);
            return;
          }

          if (activeDeckIndex !== index) {
            // Bring card to front and play video
            activeDeckIndex = index;
            updateDeckPositions();
            playYouTubeVideo(card);
          } else {
            // Already front card: start playing if not playing
            if (!card.classList.contains('is-playing')) {
              playYouTubeVideo(card);
            }
          }
        });
      });

      // Navigation arrow buttons
      if (nextBtn) nextBtn.addEventListener('click', nextStoryCard);
      if (prevBtn) prevBtn.addEventListener('click', prevStoryCard);

      // Auto-rotation every 5 seconds (pauses when user hovers)
      function startAutoPlay() {
        stopAutoPlay();
        autoPlayTimer = setInterval(nextStoryCard, 5000);
      }

      function stopAutoPlay() {
        if (autoPlayTimer) clearInterval(autoPlayTimer);
      }

      if (deckWrapper) {
        deckWrapper.addEventListener('mouseenter', stopAutoPlay);
        deckWrapper.addEventListener('mouseleave', () => {
          const frontCard = storyCards[activeDeckIndex];
          if (!frontCard || !frontCard.classList.contains('is-playing')) {
            startAutoPlay();
          }
        });
      }

      // Initial layout setup
      updateDeckPositions();
      startAutoPlay();
    }

    // 4. Initial setup
    updateFilterCounts();

    // Check URL hash (e.g. #resort)
    const hash = window.location.hash.replace('#', '');
    if (hash && ['convention', 'resort', 'farm', 'events', 'dining'].includes(hash)) {
      filterCards(hash, false);
    }
  }
})();
