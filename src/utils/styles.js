export const buttonVariants = {
  primary:
    'inline-flex items-center justify-center gap-2 rounded-full bg-primary text-white font-semibold text-sm px-5 py-3 shadow-soft transition-all duration-300 hover:-translate-y-0.5 hover:shadow-lg hover:bg-primary/90 active:scale-[0.98] focus:outline-none focus-visible:ring-2 focus-visible:ring-primary/40',
  outline:
    'inline-flex items-center justify-center gap-2 rounded-full border border-primary/25 text-primary font-semibold text-sm px-5 py-3 transition-all duration-300 hover:border-primary hover:bg-primary.light/50 hover:-translate-y-0.5 focus:outline-none focus-visible:ring-2 focus-visible:ring-primary/30 active:scale-[0.98]',
  ghost:
    'inline-flex items-center justify-center gap-2 rounded-full bg-white text-primary font-semibold text-sm px-5 py-3 transition-all duration-300 hover:bg-primary.light/50 hover:-translate-y-0.5 hover:shadow-sm focus:outline-none focus-visible:ring-2 focus-visible:ring-primary/20 active:scale-[0.98]',
  subtle:
    'inline-flex items-center justify-center gap-2 rounded-full bg-primary.light text-primary font-semibold text-sm px-5 py-3 transition-all duration-300 hover:bg-primary/20 hover:-translate-y-0.5 hover:shadow-sm focus:outline-none focus-visible:ring-2 focus-visible:ring-primary/20 active:scale-[0.98]',
};

export const buttonClassName = (variant = 'primary', extra = '') => {
  const base = buttonVariants[variant] || buttonVariants.primary;
  return `${base}${extra ? ` ${extra}` : ''}`;
};

// Card Styles
export const cardStyles = {
  base: 'bg-white rounded-2xl p-6 sm:p-8 shadow-soft transition-all duration-300',
  hover: 'hover:shadow-lg hover:-translate-y-1',
  border: 'border border-slate-100 hover:border-primary/20',
  feature: 'group bg-white rounded-2xl p-6 sm:p-8 border border-slate-100 hover:border-primary/20 transition-all duration-300',
};

export const cardHover = 'transition-all duration-300 hover:-translate-y-1 hover:shadow-lg';
export const linkHover = 'transition-colors duration-200 hover:text-primary';
export const scaleOnHover = 'transition-transform duration-300 hover:scale-[1.02]';

// Section Variants
export const sectionVariants = {
  hero: 'relative overflow-hidden rounded-[2.5rem] border border-primary/10 bg-gradient-to-br from-white via-primary.light/40 to-transparent p-8 sm:p-12 shadow-soft transition-all duration-500 hover:shadow-lg',
  card: 'bg-white rounded-2xl p-6 sm:p-8 shadow-soft hover:shadow-lg transition-all duration-300',
  featureCard: 'group bg-white rounded-2xl p-6 sm:p-8 border border-slate-100 hover:border-primary/20 transition-all duration-300',
};

// Input Styles
export const inputStyles = 'w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all duration-200 hover:border-slate-300';

// Navigation Styles
export const navLinkStyles = 'text-slate-700 hover:text-primary font-medium transition-colors duration-200';

// Animation Variants
export const hoverScale = {
  whileHover: {
    scale: 1.03,
    transition: {
      type: 'spring',
      stiffness: 400,
      damping: 10
    }
  },
  whileTap: {
    scale: 0.98
  }
};

// Fade In Animation
export const fadeInItem = (delay = 0) => ({
  initial: {
    opacity: 0,
    y: 20
  },
  animate: {
    opacity: 1,
    y: 0
  },
  transition: {
    duration: 0.4,
    ease: [0.22, 1, 0.36, 1],
    delay
  },
});

// Stagger Container
export const staggerContainer = (staggerChildren = 0.1, delayChildren = 0.1) => ({
  hidden: { opacity: 0 },
  show: {
    opacity: 1,
    transition: {
      staggerChildren,
      delayChildren,
      ease: [0.4, 0, 0.2, 1],
    },
  },
});

// Icon hover effects
export const iconHover = 'transition-all duration-300 hover:scale-110 hover:-translate-y-1';

// Image hover effects
export const imageHover = 'transition-all duration-300 hover:scale-105 hover:shadow-lg';

// Text hover effects
export const textHover = 'transition-colors duration-200 hover:text-primary';

// Background hover effects
export const bgHover = 'transition-colors duration-200 hover:bg-primary/5';

// Focus styles
export const focusStyles = 'focus:outline-none focus-visible:ring-2 focus-visible:ring-primary/40';

// Active states
export const activeScale = 'active:scale-[0.98] transition-transform duration-150';

// Disabled states
export const disabledStyles = 'disabled:opacity-50 disabled:cursor-not-allowed disabled:pointer-events-none';

// Loading states
export const loadingStyles = 'animate-pulse opacity-75';

// Gradient backgrounds
export const gradientBg = {
  primary: 'bg-gradient-to-r from-primary to-primary/80',
  subtle: 'bg-gradient-to-br from-primary.light/50 to-white',
  accent: 'bg-gradient-to-t from-primary/10 to-transparent',
};

// Shadow utilities
export const shadowStyles = {
  soft: 'shadow-soft',
  medium: 'shadow-lg',
  large: 'shadow-xl',
  hover: 'hover:shadow-lg hover:shadow-primary/20',
};

// Border utilities
export const borderStyles = {
  primary: 'border border-primary/20',
  hover: 'hover:border-primary/40',
  focus: 'focus:border-primary',
};

// Spacing utilities for animations
export const spacing = {
  section: 'py-16',
  card: 'p-6 sm:p-8',
  button: 'px-5 py-3',
};
