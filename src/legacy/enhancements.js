const ready = (cb) => (document.readyState !== 'loading' ? cb() : document.addEventListener('DOMContentLoaded', cb));

const splitClasses = (value) => (value ? value.split(/\s+/).filter(Boolean) : []);

const initNavigationToggle = () => {
  const navToggle = document.querySelector('[data-nav-toggle]');
  const navMenu = document.querySelector('[data-nav-menu]');
  if (!navToggle || !navMenu) return;

  let navOpen = false;

  const openNav = () => {
    navMenu.classList.remove('hidden');
    document.body.classList.add('overflow-hidden', 'md:overflow-auto');
    navToggle.setAttribute('aria-expanded', 'true');
    navOpen = true;
  };

  const closeNav = () => {
    navMenu.classList.add('hidden');
    document.body.classList.remove('overflow-hidden');
    navToggle.setAttribute('aria-expanded', 'false');
    navOpen = false;
  };

  navToggle.addEventListener('click', (event) => {
    event.stopPropagation();
    navOpen ? closeNav() : openNav();
  });

  document.addEventListener('click', (event) => {
    if (!navOpen) return;
    if (!navMenu.contains(event.target) && !navToggle.contains(event.target)) {
      closeNav();
    }
  });

  navMenu.querySelectorAll('a').forEach((link) => {
    link.addEventListener('click', () => {
      if (navOpen) closeNav();
    });
  });
};

const initSmoothScroll = () => {
  document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    const href = anchor.getAttribute('href');
    if (!href || href.length === 1) return;
    const target = document.getElementById(href.slice(1));
    if (!target) return;

    anchor.addEventListener('click', (event) => {
      event.preventDefault();
      target.scrollIntoView({ behavior: 'smooth', block: 'start' });
    });
  });
};

const initScrollAnimations = () => {
  const animateElements = document.querySelectorAll('[data-animate]');
  if (!animateElements.length) return;

  if ('IntersectionObserver' in window) {
    const observer = new IntersectionObserver((entries, obs) => {
      entries.forEach((entry) => {
        if (!entry.isIntersecting) return;
        const el = entry.target;
        el.style.opacity = '1';
        el.style.transform = 'translateY(0)';
        obs.unobserve(el);
      });
    }, { threshold: 0.2 });

    animateElements.forEach((el) => {
      const delay = parseInt(el.getAttribute('data-animate-delay') || '0', 10);
      el.style.opacity = '0';
      el.style.transform = 'translateY(20px)';
      el.style.transition = `opacity 0.6s ease-out ${delay}ms, transform 0.6s ease-out ${delay}ms`;
      observer.observe(el);
    });
  } else {
    animateElements.forEach((el) => {
      el.style.opacity = '1';
      el.style.transform = 'translateY(0)';
    });
  }
};

const initSelectableGroups = () => {
  document.querySelectorAll('[data-select-group]').forEach((group) => {
    const buttons = Array.from(group.querySelectorAll('[data-selectable]'));
    if (!buttons.length) return;

    const activeClasses = splitClasses(group.getAttribute('data-active-classes'));
    const inactiveClasses = splitClasses(group.getAttribute('data-inactive-classes'));
    const outputKey = group.getAttribute('data-select-output');
    const displayTargets = outputKey ? document.querySelectorAll(`[data-select-display="${outputKey}"]`) : [];
    const inputTargets = outputKey ? document.querySelectorAll(`[data-select-input="${outputKey}"]`) : [];

    const applyState = (button, active) => {
      inactiveClasses.forEach((cls) => button.classList[active ? 'remove' : 'add'](cls));
      activeClasses.forEach((cls) => button.classList[active ? 'add' : 'remove'](cls));
      button.setAttribute('aria-pressed', active ? 'true' : 'false');
    };

    const selectButton = (button) => {
      buttons.forEach((btn) => applyState(btn, btn === button));
      const value = button.dataset.value ? button.dataset.value : button.textContent.trim();
      displayTargets.forEach((el) => { el.textContent = value; });
      inputTargets.forEach((el) => { el.value = value; });
    };

    const defaultButton = buttons.find((btn) => btn.hasAttribute('data-default-active')) || buttons[0];
    buttons.forEach((btn) => applyState(btn, btn === defaultButton));
    if (defaultButton) selectButton(defaultButton);

    buttons.forEach((btn) => {
      btn.addEventListener('click', (event) => {
        event.preventDefault();
        selectButton(btn);
      });

      btn.addEventListener('keydown', (event) => {
        if (event.key === 'Enter' || event.key === ' ') {
          event.preventDefault();
          selectButton(btn);
        }
      });
    });
  });
};

ready(() => {
  initNavigationToggle();
  initSmoothScroll();
  initScrollAnimations();
  initSelectableGroups();
});
