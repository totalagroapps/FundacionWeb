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

    // Manejo asíncrono y elegante de envíos de formularios de contacto
    document.querySelectorAll('.contact-form').forEach(form => {
        form.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const submitBtn = this.querySelector('button[type="submit"]');
            const alertBox = this.querySelector('.form-alert');
            const originalBtnHtml = submitBtn ? submitBtn.innerHTML : '';
            
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Enviando...';
            }
            if (alertBox) {
                alertBox.style.display = 'none';
            }

            try {
                const formData = new FormData(this);
                const response = await fetch(this.getAttribute('action') || 'send_form.php', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                const data = await response.json();

                if (data.success) {
                    if (alertBox) {
                        alertBox.style.display = 'block';
                        alertBox.style.background = '#e6f4ea';
                        alertBox.style.color = '#137333';
                        alertBox.style.border = '1px solid #ceead6';
                        alertBox.innerHTML = '<i class="fas fa-check-circle" style="margin-right: 8px;"></i>' + data.message;
                        alertBox.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                    } else {
                        alert(data.message);
                    }
                    this.reset();
                } else {
                    throw new Error(data.message || 'Error al procesar el formulario.');
                }
            } catch (err) {
                if (alertBox) {
                    alertBox.style.display = 'block';
                    alertBox.style.background = '#fce8e6';
                    alertBox.style.color = '#c5221f';
                    alertBox.style.border = '1px solid #fad2cf';
                    alertBox.innerHTML = '<i class="fas fa-exclamation-circle" style="margin-right: 8px;"></i>' + (err.message || 'Ocurrió un error al enviar el mensaje. Por favor intenta de nuevo.');
                    alertBox.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                } else {
                    alert('Ocurrió un error al enviar el mensaje. Por favor contáctanos por WhatsApp.');
                }
            } finally {
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalBtnHtml;
                }
            }
        });
    });
});

// Preloader optimizado (desaparición inmediata y fluida sin esperas artificiales)
const hidePreloader = () => {
    const preloader = document.getElementById('preloader');
    if (preloader && !preloader.classList.contains('fade-out')) {
        preloader.classList.add('fade-out');
        setTimeout(() => {
            preloader.style.display = 'none';
        }, 500);
    }
};

// Se oculta en cuanto el DOM esté listo o máximo tras el evento load
document.addEventListener('DOMContentLoaded', () => {
    setTimeout(hidePreloader, 200);
});
window.addEventListener('load', hidePreloader);
// Fallback de seguridad por si alguna red externa tarda
setTimeout(hidePreloader, 1000);
