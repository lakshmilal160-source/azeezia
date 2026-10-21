document.addEventListener('DOMContentLoaded', () => {
    // Mobile Menu Toggle
    const navToggle = document.getElementById('navToggle');
    const navMenu = document.getElementById('navMenu');

    if (navToggle && navMenu) {
        navToggle.addEventListener('click', () => {
            navToggle.classList.toggle('active');
            navMenu.classList.toggle('active');
        });

        // Close menu when clicking a link
        const navLinks = navMenu.querySelectorAll('a');
        navLinks.forEach(link => {
            link.addEventListener('click', () => {
                navToggle.classList.remove('active');
                navMenu.classList.remove('active');
            });
        });
    }

    // Enhanced Accordion Toggle
    const accordionItems = document.querySelectorAll('.accordion-item');

    accordionItems.forEach(item => {
        const header = item.querySelector('.accordion-header');

        header.addEventListener('click', () => {
            const isActive = item.classList.contains('active');

            // Close all items in the same container (optional, but good for UX)
            const parent = item.parentElement;
            const siblingItems = parent.querySelectorAll('.accordion-item');
            
            siblingItems.forEach(i => {
                i.classList.remove('active');
                const p = i.querySelector('.plus');
                if (p) p.textContent = '>';
            });

            // Toggle current item
            if (!isActive) {
                item.classList.add('active');
                const p = item.querySelector('.plus');
                if (p) p.textContent = '−';
            }
        });
    });

    // Sticky Header effect
    const header = document.querySelector('header');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            header.style.background = 'rgba(1, 6, 13, 0.95)';
            header.style.padding = '1.5rem 0';
        } else {
            header.style.background = 'rgba(1, 6, 13, 0.8)';
            header.style.padding = '2rem 0';
        }
    });

    // Smooth reveal for sections
    const observerOptions = {
        threshold: 0.1
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                
                // Trigger SVG arrow drawing animation inside the section
                const arrowPaths = entry.target.querySelectorAll('.arrow-svg path, .about-arrow path');
                arrowPaths.forEach(path => {
                    path.style.strokeDashoffset = '0';
                });
            }
        });
    }, observerOptions);

    // Initialize SVG Arrow paths for drawing animation
    const arrowPaths = document.querySelectorAll('.arrow-svg path, .about-arrow path');
    arrowPaths.forEach(path => {
        const length = path.getTotalLength();
        path.style.strokeDasharray = length;
        path.style.strokeDashoffset = length;
        path.style.transition = 'stroke-dashoffset 2s cubic-bezier(0.4, 0, 0.2, 1)';
    });

    const sections = document.querySelectorAll('main > section:not(.services-steps):not(.portfolio-grid-section)');
    const items = document.querySelectorAll('.step-row, .portfolio-item');
    
    const revealTargets = [...sections, ...items];
    revealTargets.forEach(el => {
        el.classList.add('reveal-fadeup');
        observer.observe(el);
    });

    // Portfolio Carousel
    // const projects = [
    //     { title: 'Order to Cash (O2C)', desc: 'Streamlining the entire lifecycle of a sales order from start to finish.' },
    //     { title: 'Agency ERP', desc: 'Comprehensive management software for modern creative and digital agencies.' },
    //     { title: 'Agency Marketplace', desc: 'A dynamic platform connecting agencies with top-tier talent and services.' },
    //     { title: 'Container Booking System', desc: 'Advanced logistics solution for efficient maritime cargo management.' },
    //     { title: 'Logistics & Inventory Module', desc: 'Real-time tracking and optimization of supply chain and warehouse operations.' },
    // ];

    const cards = document.querySelectorAll('.portfolio-card');
    const titleEl = document.getElementById('portfolioTitle');
    const descEl = document.getElementById('portfolioDesc');
    const prevBtn = document.getElementById('portfolioPrev');
    const nextBtn = document.getElementById('portfolioNext');

    if (cards.length && prevBtn && nextBtn) {
        let activeIndex = 1;

        function updateCarousel() {
            cards.forEach((card, i) => {
                card.classList.remove('active', 'side', 'hidden');
                if (i === activeIndex) {
                    card.classList.add('active');
                } else if (i === (activeIndex - 1 + cards.length) % cards.length || i === (activeIndex + 1) % cards.length) {
                    card.classList.add('side');
                } else {
                    card.classList.add('hidden');
                }
            });
            if (titleEl) titleEl.textContent = projects[activeIndex].title;
            if (descEl) descEl.textContent = projects[activeIndex].desc;
        }

        prevBtn.addEventListener('click', () => {
            activeIndex = (activeIndex - 1 + cards.length) % cards.length;
            updateCarousel();
        });

        nextBtn.addEventListener('click', () => {
            activeIndex = (activeIndex + 1) % cards.length;
            updateCarousel();
        });

        cards.forEach((card, i) => {
            card.addEventListener('click', () => {
                activeIndex = i;
                updateCarousel();
            });
        });

        updateCarousel();
    }

    // Testimonials Slider (Movable like slider)
    const testimonialSlider = document.getElementById('testimonialSlider');
    const testimonialPrev = document.getElementById('testimonialPrev');
    const testimonialNext = document.getElementById('testimonialNext');
    const testimonialDotsContainer = document.getElementById('testimonialDots');
    const testimonialCards = document.querySelectorAll('.testimonial-card');

    if (testimonialSlider && testimonialCards.length) {
        let currentIndex = 0;
        let isDragging = false;
        let startX = 0;
        let animationId = 0;
        let currentTranslate = 0;
        let prevTranslate = 0;

        const totalCards = testimonialCards.length;
        
        // Create dots
        testimonialCards.forEach((_, index) => {
            const dot = document.createElement('div');
            dot.classList.add('dot');
            if (index === 0) dot.classList.add('active');
            dot.addEventListener('click', () => {
                currentIndex = index;
                snapToSlide();
            });
            testimonialDotsContainer.appendChild(dot);
        });

        const dots = testimonialDotsContainer.querySelectorAll('.dot');

        function getCardsToShow() {
            if (window.innerWidth > 1200) return 3;
            if (window.innerWidth > 768) return 2;
            return 1;
        }

        function updateSlider() {
            const cardWidth = testimonialCards[0].offsetWidth;
            const gap = parseFloat(getComputedStyle(testimonialSlider).gap) || 32;
            currentTranslate = -currentIndex * (cardWidth + gap);
            prevTranslate = currentTranslate;
            testimonialSlider.style.transform = `translateX(${currentTranslate}px)`;
            
            dots.forEach((dot, index) => {
                dot.classList.toggle('active', index === currentIndex);
            });
        }

        function snapToSlide() {
            const cardsToShow = getCardsToShow();
            const maxIndex = totalCards - cardsToShow;
            if (currentIndex > maxIndex) currentIndex = maxIndex;
            if (currentIndex < 0) currentIndex = 0;
            
            testimonialSlider.style.transition = 'transform 0.5s cubic-bezier(0.4, 0, 0.2, 1)';
            updateSlider();
        }

        // Drag functionality
        testimonialSlider.addEventListener('mousedown', dragStart);
        testimonialSlider.addEventListener('touchstart', dragStart);
        testimonialSlider.addEventListener('mouseup', dragEnd);
        testimonialSlider.addEventListener('touchend', dragEnd);
        testimonialSlider.addEventListener('mousemove', dragAction);
        testimonialSlider.addEventListener('touchmove', dragAction);
        testimonialSlider.addEventListener('mouseleave', dragEnd);

        function dragStart(e) {
            isDragging = true;
            startX = getPositionX(e);
            testimonialSlider.style.transition = 'none';
            testimonialSlider.style.cursor = 'grabbing';
            animationId = requestAnimationFrame(animation);
        }

        function dragAction(e) {
            if (isDragging) {
                const currentX = getPositionX(e);
                currentTranslate = prevTranslate + (currentX - startX);
            }
        }

        function dragEnd() {
            isDragging = false;
            cancelAnimationFrame(animationId);
            testimonialSlider.style.cursor = 'grab';
            
            const movedBy = currentTranslate - prevTranslate;

            if (movedBy < -100) {
                currentIndex += 1;
            } else if (movedBy > 100) {
                currentIndex -= 1;
            }

            snapToSlide();
        }

        function getPositionX(e) {
            return e.type.includes('mouse') ? e.pageX : e.touches[0].clientX;
        }

        function animation() {
            if (isDragging) {
                testimonialSlider.style.transform = `translateX(${currentTranslate}px)`;
                requestAnimationFrame(animation);
            }
        }

        // Button controls
        testimonialNext.addEventListener('click', () => {
            const cardsToShow = getCardsToShow();
            if (currentIndex < totalCards - cardsToShow) {
                currentIndex++;
            } else {
                currentIndex = 0;
            }
            snapToSlide();
        });

        testimonialPrev.addEventListener('click', () => {
            const cardsToShow = getCardsToShow();
            if (currentIndex > 0) {
                currentIndex--;
            } else {
                currentIndex = totalCards - cardsToShow;
            }
            snapToSlide();
        });

        window.addEventListener('resize', () => {
            testimonialSlider.style.transition = 'none';
            updateSlider();
        });
        
        updateSlider();
    }

    // Back to Top Logic
    const backToTop = document.getElementById('backToTop');
    if (backToTop) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 500) {
                backToTop.classList.add('show');
            } else {
                backToTop.classList.remove('show');
            }
        });

        backToTop.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }
    // About Us Quote Slider
    const introQuoteSlider = document.getElementById('introQuoteSlider');
    const quoteDots = document.querySelectorAll('.q-dot');
    
    if (introQuoteSlider && quoteDots.length) {
        quoteDots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                // Update dots
                quoteDots.forEach(d => d.classList.remove('active'));
                dot.classList.add('active');
                
                // Slide
                introQuoteSlider.style.transform = `translateX(-${index * 100}%)`;
            });
        });
    }

    // Portfolio Page Pagination
    const portfolioGrid = document.querySelector('.portfolio-grid');
    const portfolioItems = document.querySelectorAll('.portfolio-grid .portfolio-item');
    const prevPageBtn = document.querySelector('.pagination-btn.prev-page');
    const nextPageBtn = document.querySelector('.pagination-btn.next-page');
    const pageNumbersContainer = document.querySelector('.pagination-numbers');

    if (portfolioGrid && portfolioItems.length && prevPageBtn && nextPageBtn && pageNumbersContainer) {
        const itemsPerPage = 4;
        let currentPage = 1;
        const totalPages = Math.ceil(portfolioItems.length / itemsPerPage);

        // Generate page numbers dynamically
        pageNumbersContainer.innerHTML = '';
        for (let i = 1; i <= totalPages; i++) {
            const btn = document.createElement('button');
            btn.classList.add('page-number');
            if (i === 1) btn.classList.add('active');
            btn.textContent = i;
            btn.addEventListener('click', () => {
                goToPage(i);
            });
            pageNumbersContainer.appendChild(btn);
        }

        function updatePaginationButtons() {
            prevPageBtn.disabled = currentPage === 1;
            nextPageBtn.disabled = currentPage === totalPages;
            
            const numBtns = pageNumbersContainer.querySelectorAll('.page-number');
            numBtns.forEach((btn, idx) => {
                btn.classList.toggle('active', idx + 1 === currentPage);
            });
        }

        function goToPage(page, scroll = true) {
            if (page < 1 || page > totalPages) return;
            currentPage = page;

            const startIndex = (currentPage - 1) * itemsPerPage;
            const endIndex = startIndex + itemsPerPage;

            portfolioItems.forEach((item, index) => {
                if (index >= startIndex && index < endIndex) {
                    item.style.display = 'flex';
                    // Reset fade-up transition classes
                    item.classList.remove('is-visible');
                    // Force a reflow to reset transition state
                    void item.offsetWidth;
                    // Re-add visibility after a short timeout to let the browser process the display change
                    setTimeout(() => {
                        item.classList.add('is-visible');
                    }, 20);
                } else {
                    item.style.display = 'none';
                    item.classList.remove('is-visible');
                }
            });

            updatePaginationButtons();
            
            if (scroll) {
                // Scroll to the portfolio grid top smoothly (if user is scrolled down)
                const gridOffset = portfolioGrid.getBoundingClientRect().top + window.scrollY - 120;
                if (window.scrollY > gridOffset) {
                    window.scrollTo({ top: gridOffset, behavior: 'smooth' });
                }
            }
        }

        prevPageBtn.addEventListener('click', () => {
            goToPage(currentPage - 1);
        });

        nextPageBtn.addEventListener('click', () => {
            goToPage(currentPage + 1);
        });

        // Initialize first page without scrolling
        goToPage(1, false);
    }
});

