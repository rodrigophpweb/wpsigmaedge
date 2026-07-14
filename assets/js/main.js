/**
 * Main JavaScript - Sigma Edge
 * Industrial Precision Design System
 */

(function () {
    'use strict';

    /* ============================================
       MOBILE MENU TOGGLE
       ============================================ */

    const menuToggle = document.querySelector('.site-header__toggle');
    const headerMenu = document.querySelector('.site-header__menu');

    if (menuToggle && headerMenu) {
        menuToggle.addEventListener('click', function () {
            const isOpen = headerMenu.getAttribute('data-open') === 'true';
            headerMenu.setAttribute('data-open', String(!isOpen));
            menuToggle.setAttribute('aria-expanded', String(!isOpen));
        });

        document.addEventListener('click', function (event) {
            if (!event.target.closest('.site-header__nav')) {
                headerMenu.setAttribute('data-open', 'false');
                menuToggle.setAttribute('aria-expanded', 'false');
            }
        });
    }

    /* ============================================
       SEARCH OVERLAY
       ============================================ */

    const searchToggle = document.querySelector('.site-header__search-toggle');
    const searchOverlay = document.querySelector('.site-header__search-overlay');
    const searchClose = document.querySelector('.site-header__search-close');

    if (searchToggle && searchOverlay) {
        searchToggle.addEventListener('click', function () {
            searchOverlay.setAttribute('aria-hidden', 'false');

            window.setTimeout(function () {
                const searchInput = searchOverlay.querySelector('input[type="search"]');
                if (searchInput) {
                    searchInput.focus();
                }
            }, 300);
        });
    }

    if (searchClose && searchOverlay) {
        const closeSearch = function () {
            searchOverlay.setAttribute('aria-hidden', 'true');
        };

        searchClose.addEventListener('click', closeSearch);

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape' && searchOverlay.getAttribute('aria-hidden') === 'false') {
                closeSearch();
            }
        });

        searchOverlay.addEventListener('click', function (event) {
            if (event.target === searchOverlay) {
                closeSearch();
            }
        });
    }

    /* ============================================
       SELETOR DE IDIOMA
       ============================================ */

    const langToggle = document.querySelector('.site-header__lang-toggle');
    const langMenu = document.querySelector('.site-header__lang-menu');

    if (langToggle && langMenu) {
        langToggle.addEventListener('click', function (event) {
            event.stopPropagation();
            const isOpen = !langMenu.hidden;
            langMenu.hidden = isOpen;
            langToggle.setAttribute('aria-expanded', String(!isOpen));
        });

        document.addEventListener('click', function (event) {
            if (!event.target.closest('.site-header__lang')) {
                langMenu.hidden = true;
                langToggle.setAttribute('aria-expanded', 'false');
            }
        });

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape' && !langMenu.hidden) {
                langMenu.hidden = true;
                langToggle.setAttribute('aria-expanded', 'false');
            }
        });
    }

    /* ============================================
       HEADER - SOMBRA AO ROLAR
       ============================================ */

    const header = document.querySelector('.site-header');

    if (header) {
        window.addEventListener('scroll', function () {
            header.classList.toggle('is-scrolled', window.scrollY > 20);
        });
    }

    /* ============================================
       SERVICES TABS
       ============================================ */

    const serviceTabs = document.querySelectorAll('.section-services__tabs button[data-tab]');
    const servicePanels = document.querySelectorAll('.section-services__grid[role="tabpanel"]');

    serviceTabs.forEach(function (tab) {
        tab.addEventListener('click', function () {
            const targetId = 'tab-panel-' + tab.getAttribute('data-tab');

            serviceTabs.forEach(function (t) {
                t.setAttribute('aria-selected', 'false');
            });
            tab.setAttribute('aria-selected', 'true');

            servicePanels.forEach(function (panel) {
                panel.toggleAttribute('hidden', panel.id !== targetId);
            });
        });
    });

    /* ============================================
       PRODUCT CAROUSEL
       ============================================ */

    const carouselTrack = document.querySelector('.product-carousel__track');
    const carouselPrev = document.querySelector('.product-carousel__control--prev');
    const carouselNext = document.querySelector('.product-carousel__control--next');
    const carouselIndicators = document.querySelectorAll('.product-carousel__indicators button');

    if (carouselTrack && carouselPrev && carouselNext) {
        const getStep = function () {
            const firstCard = carouselTrack.querySelector('.product-card');
            if (!firstCard) return 0;
            const style = window.getComputedStyle(carouselTrack);
            const gap = parseFloat(style.columnGap || style.gap || '0');
            return firstCard.getBoundingClientRect().width + gap;
        };

        const updateIndicators = function () {
            const step = getStep();
            if (!step) return;
            const activeIndex = Math.round(carouselTrack.scrollLeft / step);

            carouselIndicators.forEach(function (indicator, index) {
                indicator.setAttribute('aria-selected', String(index === Math.min(activeIndex, carouselIndicators.length - 1)));
            });

            carouselPrev.disabled = carouselTrack.scrollLeft <= 0;
            carouselNext.disabled = carouselTrack.scrollLeft + carouselTrack.clientWidth >= carouselTrack.scrollWidth - 1;
        };

        carouselPrev.addEventListener('click', function () {
            carouselTrack.scrollBy({ left: -getStep(), behavior: 'smooth' });
        });

        carouselNext.addEventListener('click', function () {
            carouselTrack.scrollBy({ left: getStep(), behavior: 'smooth' });
        });

        carouselIndicators.forEach(function (indicator, index) {
            indicator.addEventListener('click', function () {
                carouselTrack.scrollTo({ left: getStep() * index, behavior: 'smooth' });
            });
        });

        carouselTrack.addEventListener('scroll', updateIndicators, { passive: true });
        window.addEventListener('resize', updateIndicators);
        updateIndicators();
    }

    /* ============================================
       MÁSCARA DE TELEFONE (formulário de contato)
       ============================================ */

    const phoneInput = document.querySelector('.contact-form input[type="tel"]');

    if (phoneInput) {
        phoneInput.addEventListener('input', function (event) {
            let value = event.target.value.replace(/\D/g, '').slice(0, 11);

            if (value.length > 2) {
                value = '(' + value.slice(0, 2) + ') ' + value.slice(2);
            }
            if (value.length > 10) {
                value = value.slice(0, 10) + '-' + value.slice(10);
            }

            event.target.value = value;
        });
    }

    /* ============================================
       SCROLL SUAVE PARA ÂNCORAS
       ============================================ */

    document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
        anchor.addEventListener('click', function (event) {
            const href = anchor.getAttribute('href');
            if (href === '#' || href === '#!') return;

            const target = document.querySelector(href);
            if (!target) return;

            event.preventDefault();

            const headerHeight = header ? header.offsetHeight : 0;
            window.scrollTo({
                top: target.getBoundingClientRect().top + window.scrollY - headerHeight - 20,
                behavior: 'smooth',
            });

            if (headerMenu) {
                headerMenu.setAttribute('data-open', 'false');
                if (menuToggle) menuToggle.setAttribute('aria-expanded', 'false');
            }
        });
    });
})();
