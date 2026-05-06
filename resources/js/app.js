import './bootstrap';

// ── Scroll Reveal Animation ──────────────────────────────────────────────────
const observerOptions = {
    threshold: 0.12,
    rootMargin: '0px 0px -40px 0px',
};

const scrollObserver = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
        if (entry.isIntersecting) {
            entry.target.classList.add('visible');
            scrollObserver.unobserve(entry.target);
        }
    });
}, observerOptions);

document.querySelectorAll('.animate-on-scroll').forEach((el) => {
    scrollObserver.observe(el);
});

// ── Navbar scroll behavior ───────────────────────────────────────────────────
const navbar = document.getElementById('navbar');
if (navbar) {
    let lastScroll = 0;

    window.addEventListener('scroll', () => {
        const currentScroll = window.scrollY;

        if (currentScroll > 60) {
            navbar.classList.add('navbar-scrolled');
        } else {
            navbar.classList.remove('navbar-scrolled');
        }

        lastScroll = currentScroll;
    }, { passive: true });
}

// ── Mobile menu toggle ───────────────────────────────────────────────────────
const menuBtn = document.getElementById('menu-btn');
const mobileMenu = document.getElementById('mobile-menu');

if (menuBtn && mobileMenu) {
    menuBtn.addEventListener('click', () => {
        const isOpen = mobileMenu.classList.contains('menu-open');

        if (isOpen) {
            mobileMenu.classList.remove('menu-open');
            mobileMenu.style.maxHeight = '0';
            menuBtn.setAttribute('aria-expanded', 'false');
        } else {
            mobileMenu.classList.add('menu-open');
            mobileMenu.style.maxHeight = mobileMenu.scrollHeight + 'px';
            menuBtn.setAttribute('aria-expanded', 'true');
        }
    });
}

// ── Smooth Counter Animation ─────────────────────────────────────────────────
function animateCounter(el) {
    const target = parseInt(el.dataset.target, 10);
    const duration = 1800;
    const step = target / (duration / 16);
    let current = 0;

    const update = () => {
        current = Math.min(current + step, target);
        el.textContent = Math.floor(current).toLocaleString();
        if (current < target) requestAnimationFrame(update);
    };

    requestAnimationFrame(update);
}

const counterObserver = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
        if (entry.isIntersecting) {
            animateCounter(entry.target);
            counterObserver.unobserve(entry.target);
        }
    });
}, { threshold: 0.5 });

document.querySelectorAll('[data-counter]').forEach((el) => {
    counterObserver.observe(el);
});

// ── Alert auto-dismiss ───────────────────────────────────────────────────────
document.querySelectorAll('[data-auto-dismiss]').forEach((alert) => {
    setTimeout(() => {
        alert.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
        alert.style.opacity = '0';
        alert.style.transform = 'translateY(-8px)';
        setTimeout(() => alert.remove(), 400);
    }, parseInt(alert.dataset.autoDismiss, 10) || 4000);
});

// ── Gallery lightbox ─────────────────────────────────────────────────────────
const lightbox = document.getElementById('lightbox');
const lightboxImg = document.getElementById('lightbox-img');

if (lightbox && lightboxImg) {
    document.querySelectorAll('[data-lightbox]').forEach((img) => {
        img.addEventListener('click', () => {
            lightboxImg.src = img.dataset.lightbox;
            lightbox.classList.remove('hidden');
            lightbox.classList.add('flex');
        });
    });

    lightbox.addEventListener('click', (e) => {
        if (e.target === lightbox) {
            lightbox.classList.add('hidden');
            lightbox.classList.remove('flex');
        }
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            lightbox.classList.add('hidden');
            lightbox.classList.remove('flex');
        }
    });
}

// ── Marquee pause on hover ───────────────────────────────────────────────────
document.querySelectorAll('.marquee-track').forEach((track) => {
    track.addEventListener('mouseenter', () => {
        track.style.animationPlayState = 'paused';
    });
    track.addEventListener('mouseleave', () => {
        track.style.animationPlayState = 'running';
    });
});
