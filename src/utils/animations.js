export const easeOutExpo = [0.22, 1, 0.36, 1];
export const easeInOut = [0.4, 0, 0.2, 1];
export const spring = { type: 'spring', damping: 20, stiffness: 300 };

// Basic Animations
export const fadeInUp = (delay = 0, distance = 24, duration = 0.6) => ({
  initial: { opacity: 0, y: distance },
  whileInView: { opacity: 1, y: 0 },
  viewport: { once: true, amount: 0.3 },
  transition: { delay, duration, ease: easeOutExpo },
});

export const fadeIn = (delay = 0, duration = 0.6) => ({
  initial: { opacity: 0 },
  whileInView: { opacity: 1 },
  viewport: { once: true, amount: 0.3 },
  transition: { delay, duration, ease: easeOutExpo },
});

export const scaleUp = (delay = 0, duration = 0.45) => ({
  initial: { opacity: 0, scale: 0.96 },
  whileInView: { opacity: 1, scale: 1 },
  viewport: { once: true, amount: 0.3 },
  transition: { delay, duration, ease: easeOutExpo },
});

// Stagger Animations
export const staggerContainer = (staggerChildren = 0.1, delayChildren = 0.1) => ({
  hidden: { opacity: 0 },
  show: {
    opacity: 1,
    transition: {
      staggerChildren,
      delayChildren,
      ease: easeInOut,
    },
  },
});

export const staggerFadeIn = (delay = 0, y = 20) => ({
  hidden: { opacity: 0, y },
  show: {
    opacity: 1,
    y: 0,
    transition: {
      duration: 0.6,
      ease: easeOutExpo,
      delay,
    },
  },
});

// Hover Effects
export const hoverScale = {
  whileHover: {
    scale: 1.03,
    transition: {
      type: 'spring',
      stiffness: 400,
      damping: 10,
    },
  },
  whileTap: {
    scale: 0.98,
  },
};

export const cardHover = {
  initial: {
    y: 0,
    boxShadow: '0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06)'
  },
  whileHover: {
    y: -4,
    boxShadow: '0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04)',
    transition: {
      type: 'spring',
      stiffness: 300,
      damping: 15,
    },
  },
};

export const buttonHover = {
  initial: {
    y: 0,
    boxShadow: '0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06)'
  },
  whileHover: {
    y: -2,
    boxShadow: '0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06)',
    transition: {
      type: 'spring',
      stiffness: 300,
      damping: 10,
    }
  },
  whileTap: {
    scale: 0.98,
  }
};

export const navItem = {
  hidden: { opacity: 0, y: -10 },
  show: {
    opacity: 1,
    y: 0,
    transition: {
      duration: 0.3,
      ease: easeInOut
    }
  }
};

// Enhanced animations
export const slideInLeft = (delay = 0) => ({
  initial: { opacity: 0, x: -30 },
  whileInView: {
    opacity: 1,
    x: 0,
    transition: { delay, duration: 0.6, ease: easeOutExpo }
  },
  viewport: { once: true, amount: 0.3 },
});

export const slideInRight = (delay = 0) => ({
  initial: { opacity: 0, x: 30 },
  whileInView: {
    opacity: 1,
    x: 0,
    transition: { delay, duration: 0.6, ease: easeOutExpo }
  },
  viewport: { once: true, amount: 0.3 },
});

export const bounceIn = (delay = 0) => ({
  initial: { opacity: 0, scale: 0.3 },
  whileInView: {
    opacity: 1,
    scale: 1,
    transition: {
      delay,
      duration: 0.6,
      ease: [0.68, -0.55, 0.265, 1.55]
    }
  },
  viewport: { once: true, amount: 0.3 },
});
