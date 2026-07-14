/**
 * Main JavaScript - Sigma Edge
 * Industrial Precision Design System
 */

(function() {
    'use strict';

    // ============================================
    // HEADER FUNCTIONALITY
    // ============================================

    // Mobile Menu Toggle
    const mobileToggle = document.querySelector('.site-header__mobile-toggle');
    const headerMenu = document.querySelector('.site-header__menu');

    if (mobileToggle && headerMenu) {
        mobileToggle.addEventListener('click', function() {
            this.classList.toggle('active');
            headerMenu.classList.toggle('active');
            document.body.classList.toggle('menu-open');
        });

        // Close menu when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.site-header__nav')) {
                mobileToggle.classList.remove('active');
                headerMenu.classList.remove('active');
                document.body.classList.remove('menu-open');
            }
        });
    }

    // Search Overlay
    const searchToggle = document.querySelector('.site-header__search-toggle');
    const searchOverlay = document.querySelector('.site-header__search-overlay');
    const searchClose = document.querySelector('.site-header__search-close');

    if (searchToggle && searchOverlay) {
        searchToggle.addEventListener('click', function() {
            searchOverlay.classList.add('active');
            document.body.style.overflow = 'hidden';
            
            // Focus on search input
            setTimeout(() => {
                const searchInput = searchOverlay.querySelector('input[type="search"]');
                if (searchInput) {
                    searchInput.focus();
                }
            }, 300);
        });
    }

    if (searchClose && searchOverlay) {
        searchClose.addEventListener('click', function() {
            searchOverlay.classList.remove('active');
            document.body.style.overflow = '';
        });

        // Close on ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && searchOverlay.classList.contains('active')) {
                searchOverlay.classList.remove('active');
                document.body.style.overflow = '';
            }
        });

        // Close on overlay click
        searchOverlay.addEventListener('click', function(e) {
            if (e.target === searchOverlay) {
                searchOverlay.classList.remove('active');
                document.body.style.overflow = '';
            }
        });
    }

    // Sticky Header on Scroll
    let lastScroll = 0;
    const header = document.querySelector('.site-header');

    window.addEventListener('scroll', function() {
        const currentScroll = window.pageYOffset;

        if (currentScroll > 100) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }

        lastScroll = currentScroll;
    });

    // ============================================
    // SERVICES TABS
    // ============================================

    const servicesTabs = document.querySelectorAll('.services-tab');
    const servicesContent = document.querySelectorAll('.services-grid');

    servicesTabs.forEach(tab => {
        tab.addEventListener('click', function() {
            const targetTab = this.getAttribute('data-tab');

            // Remove active class from all tabs
            servicesTabs.forEach(t => t.classList.remove('active'));
            
            // Add active class to clicked tab
            this.classList.add('active');

            // Show corresponding content
            servicesContent.forEach(content => {
                if (content.getAttribute('data-content') === targetTab) {
                    content.style.display = 'grid';
                    
                    // Animate cards
                    const cards = content.querySelectorAll('.service-card');
                    cards.forEach((card, index) => {
                        card.style.opacity = '0';
                        card.style.transform = 'translateY(20px)';
                        
                        setTimeout(() => {
                            card.style.transition = 'all 0.4s ease';
                            card.style.opacity = '1';
                            card.style.transform = 'translateY(0)';
                        }, index * 100);
                    });
                } else {
                    content.style.display = 'none';
                }
            });
        });
    });

    // ============================================
    // PRODUCTS CAROUSEL
    // ============================================

    const carousel = document.querySelector('.products-carousel__track');
    const prevBtn = document.querySelector('.carousel-control--prev');
    const nextBtn = document.querySelector('.carousel-control--next');
    const indicators = document.querySelectorAll('.indicator');

    if (carousel && prevBtn && nextBtn) {
        let currentPosition = 0;
        let currentIndicator = 0;

        // Calculate scroll amount (width of one card + gap)
        const getScrollAmount = () => {
            const card = carousel.querySelector('.product-card');
            if (!card) return 0;
            const cardWidth = card.offsetWidth;
            const gap = 24; // Gap from CSS
            return cardWidth + gap;
        };

        const updateCarousel = () => {
            const scrollAmount = getScrollAmount();
            carousel.scrollTo({
                left: currentPosition * scrollAmount,
                behavior: 'smooth'
            });

            // Update indicators
            indicators.forEach((indicator, index) => {
                if (index === currentIndicator) {
                    indicator.classList.add('active');
                } else {
                    indicator.classList.remove('active');
                }
            });

            // Update button states
            prevBtn.disabled = currentPosition === 0;
            nextBtn.disabled = currentPosition >= carousel.children.length - 3;
        };

        prevBtn.addEventListener('click', () => {
            if (currentPosition > 0) {
                currentPosition--;
                if (currentIndicator > 0) currentIndicator--;
                updateCarousel();
            }
        });

        nextBtn.addEventListener('click', () => {
            const maxPosition = carousel.children.length - 3;
            if (currentPosition < maxPosition) {
                currentPosition++;
                if (currentIndicator < indicators.length - 1) currentIndicator++;
                updateCarousel();
            }
        });

        // Indicator click
        indicators.forEach((indicator, index) => {
            indicator.addEventListener('click', () => {
                currentIndicator = index;
                currentPosition = index;
                updateCarousel();
            });
        });

        // Auto-play carousel (optional)
        let autoplayInterval = setInterval(() => {
            const maxPosition = carousel.children.length - 3;
            if (currentPosition < maxPosition) {
                currentPosition++;
                if (currentIndicator < indicators.length - 1) currentIndicator++;
            } else {
                currentPosition = 0;
                currentIndicator = 0;
            }
            updateCarousel();
        }, 5000);

        // Pause autoplay on hover
        carousel.addEventListener('mouseenter', () => {
            clearInterval(autoplayInterval);
        });

        carousel.addEventListener('mouseleave', () => {
            autoplayInterval = setInterval(() => {
                const maxPosition = carousel.children.length - 3;
                if (currentPosition < maxPosition) {
                    currentPosition++;
                    if (currentIndicator < indicators.length - 1) currentIndicator++;
                } else {
                    currentPosition = 0;
                    currentIndicator = 0;
                }
                updateCarousel();
            }, 5000);
        });

        // Touch/Swipe support for mobile
        let touchStartX = 0;
        let touchEndX = 0;

        carousel.addEventListener('touchstart', (e) => {
            touchStartX = e.changedTouches[0].screenX;
        });

        carousel.addEventListener('touchend', (e) => {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        });

        const handleSwipe = () => {
            const swipeThreshold = 50;
            const diff = touchStartX - touchEndX;

            if (Math.abs(diff) > swipeThreshold) {
                if (diff > 0) {
                    // Swipe left - next
                    nextBtn.click();
                } else {
                    // Swipe right - prev
                    prevBtn.click();
                }
            }
        };

        // Update on resize
        window.addEventListener('resize', updateCarousel);

        // Initial update
        updateCarousel();
    }

    // ============================================
    // SMOOTH SCROLL FOR ANCHOR LINKS
    // ============================================

    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            
            // Ignore empty anchors and special cases
            if (href === '#' || href === '#!') return;

            const target = document.querySelector(href);
            if (target) {
                e.preventDefault();
                
                const headerHeight = header ? header.offsetHeight : 0;
                const targetPosition = target.offsetTop - headerHeight - 20;

                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });

                // Close mobile menu if open
                if (headerMenu && headerMenu.classList.contains('active')) {
                    mobileToggle.classList.remove('active');
                    headerMenu.classList.remove('active');
                    document.body.classList.remove('menu-open');
                }
            }
        });
    });

    // ============================================
    // FORM VALIDATION & ENHANCEMENT
    // ============================================

    const contactForm = document.querySelector('.contact-form');

    if (contactForm) {
        const phoneInput = contactForm.querySelector('input[type="tel"]');
        
        // Phone mask (Brazilian format)
        if (phoneInput) {
            phoneInput.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');
                
                if (value.length <= 11) {
                    value = value.replace(/^(\d{2})(\d)/g, '($1) $2');
                    value = value.replace(/(\d)(\d{4})$/, '$1-$2');
                }
                
                e.target.value = value;
            });
        }

        // Form submit handler
        contactForm.addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('.contact-form__submit');
            const originalText = submitBtn.textContent;
            
            submitBtn.textContent = 'Enviando...';
            submitBtn.disabled = true;

            // If using AJAX, prevent default and handle submission
            // For now, let it submit normally
            // You can add AJAX handling here if needed
        });
    }

    // ============================================
    // ANIMATIONS ON SCROLL
    // ============================================

    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-in');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    // Observe elements for animation
    const animateElements = document.querySelectorAll(
        '.service-card, .product-card, .blog-card, .differential-card, .differential-item'
    );

    animateElements.forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        el.style.transition = 'all 0.6s ease';
        observer.observe(el);
    });

    // Add animation class
    const style = document.createElement('style');
    style.textContent = `
        .animate-in {
            opacity: 1 !important;
            transform: translateY(0) !important;
        }
    `;
    document.head.appendChild(style);

    // ============================================
    // LAZY LOADING IMAGES (Enhanced)
    // ============================================

    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    if (img.dataset.src) {
                        img.src = img.dataset.src;
                        img.removeAttribute('data-src');
                    }
                    imageObserver.unobserve(img);
                }
            });
        });

        document.querySelectorAll('img[data-src]').forEach(img => {
            imageObserver.observe(img);
        });
    }

    // ============================================
    // WHATSAPP BUTTON ANIMATION
    // ============================================

    const whatsappButton = document.querySelector('.button-whatsapp');

    if (whatsappButton) {
        // Pulse animation
        setInterval(() => {
            whatsappButton.style.transform = 'scale(1.1)';
            setTimeout(() => {
                whatsappButton.style.transform = 'scale(1)';
            }, 200);
        }, 3000);

        // Show/hide on scroll
        let scrollTimeout;
        window.addEventListener('scroll', () => {
            whatsappButton.style.opacity = '0.5';
            
            clearTimeout(scrollTimeout);
            scrollTimeout = setTimeout(() => {
                whatsappButton.style.opacity = '1';
            }, 150);
        });
    }

    // ============================================
    // CONSOLE BRANDING
    // ============================================

    console.log(
        '%cSigma Edge',
        'font-size: 24px; font-weight: bold; color: #005291; text-shadow: 2px 2px 4px rgba(0,0,0,0.2);'
    );
    console.log(
        '%cIndustrial Precision Design System',
        'font-size: 12px; color: #424750;'
    );

})();
