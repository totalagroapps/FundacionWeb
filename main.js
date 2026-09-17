document.addEventListener('DOMContentLoaded', () => {
    // Mobile Menu Toggle
    const mobileBtn = document.querySelector('.mobile-menu-btn');
    const navLinks = document.querySelector('.nav-links');

    if (mobileBtn) {
        mobileBtn.addEventListener('click', () => {
            navLinks.classList.toggle('active');
        });
    }

    // Hero Slider
    const slides = document.querySelectorAll('.slide');
    const nextBtn = document.getElementById('next-slide');
    const prevBtn = document.getElementById('prev-slide');
    let currentSlide = 0;
    let slideInterval;

    function initSlider() {
        if (slides.length === 0) return;
        
        slides[0].classList.add('active');
        startSlideInterval();
    }

    function nextSlide() {
        slides[currentSlide].classList.remove('active');
        currentSlide = (currentSlide + 1) % slides.length;
        slides[currentSlide].classList.add('active');
    }

    function prevSlide() {
        slides[currentSlide].classList.remove('active');
        currentSlide = (currentSlide - 1 + slides.length) % slides.length;
        slides[currentSlide].classList.add('active');
    }

    function startSlideInterval() {
        clearInterval(slideInterval);
        slideInterval = setInterval(nextSlide, 5000);
    }

    if (nextBtn && prevBtn) {
        nextBtn.addEventListener('click', () => {
            nextSlide();
            startSlideInterval(); // Reset timer on manual click
        });

        prevBtn.addEventListener('click', () => {
            prevSlide();
            startSlideInterval(); // Reset timer on manual click
        });
    }

    initSlider();

    // Smooth Scrolling for Anchors
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            
            // Close mobile menu if open
            if (navLinks.classList.contains('active')) {
                navLinks.classList.remove('active');
            }

            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            
            const targetElement = document.querySelector(targetId);
            
            if (targetElement) {
                const headerOffset = 80;
                const elementPosition = targetElement.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                window.scrollTo({
                    top: offsetPosition,
                    behavior: "smooth"
                });
            }
        });
    });
});

// Preloader (5 seconds logic with cache detection)
window.addEventListener('load', () => {
    const preloader = document.getElementById('preloader');
    if (preloader) {
        // Verificar si es la primera vez que entra en esta sesión (las imágenes no están en caché)
        const hasVisited = sessionStorage.getItem('site_loaded');
        
        if (hasVisited) {
            // Ya visitó la web, las imágenes están en caché. Se oculta de inmediato.
            preloader.style.display = 'none';
        } else {
            // Primera visita: mostrar pantalla de carga por 5 segundos
            setTimeout(() => {
                preloader.classList.add('fade-out');
                // Guardar en el navegador que ya cargó las imágenes
                sessionStorage.setItem('site_loaded', 'true');
            }, 5000);
        }
    }
});
