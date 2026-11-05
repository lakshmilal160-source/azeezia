/**
 * Azeezia Convention Centre & Resort - Services Page Script
 * Modular vanilla JavaScript for interactive FAQ accordion and inquiry actions.
 */

(function () {
  'use strict';

  document.addEventListener('DOMContentLoaded', initServicesPage);

  function initServicesPage() {
    // 1. FAQ Accordion Interaction
    const faqItems = document.querySelectorAll('.faq-item');

    faqItems.forEach(item => {
      const button = item.querySelector('.faq-question-btn');
      if (!button) return;

      button.addEventListener('click', () => {
        const isOpen = item.classList.contains('is-open');

        // Close all other FAQs for accordion behavior
        faqItems.forEach(otherItem => {
          if (otherItem !== item) {
            otherItem.classList.remove('is-open');
            const otherBtn = otherItem.querySelector('.faq-question-btn');
            if (otherBtn) otherBtn.setAttribute('aria-expanded', 'false');
          }
        });

        // Toggle current FAQ
        item.classList.toggle('is-open', !isOpen);
        button.setAttribute('aria-expanded', !isOpen ? 'true' : 'false');
      });
    });

    // 2. Smooth Hash Scroll for direct anchors
    if (window.location.hash) {
      const target = document.querySelector(window.location.hash);
      if (target) {
        setTimeout(() => {
          target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }, 200);
      }
    }
  }
})();
