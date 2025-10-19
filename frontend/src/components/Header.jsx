import { useEffect, useState } from 'react';
import { Link, NavLink } from 'react-router-dom';
import { motion, AnimatePresence } from 'framer-motion';
import {
  buttonClassName,
  navLinkStyles,
  bgHover,
  focusStyles,
  activeScale
} from '../utils/styles';
import {
  hoverScale,
  navItem,
  staggerContainer
} from '../utils/animations';

const navItems = [
  { slug: 'home', href: '/', label: 'Beranda' },
  { slug: 'services', href: '/services', label: 'Layanan' },
  { slug: 'portfolio', href: '/portfolio', label: 'Portofolio' },
  { slug: 'pricing', href: '/pricing', label: 'Harga & Konsultasi' },
  { slug: 'contact', href: '/contact', label: 'Kontak' },
];

const linkClassName = (isActive) =>
  `relative inline-flex items-center gap-1 text-sm transition-all duration-300 ${
    isActive
      ? 'text-primary font-semibold'
      : `${navLinkStyles}`
  } after:absolute after:left-0 after:-bottom-1 after:h-0.5 after:w-full after:rounded-full after:bg-primary after:scale-x-${
    isActive ? '100' : '0'
  } after:transition-transform after:duration-300 after:origin-left hover:after:scale-x-100`;

const mobileLinkClassName = (isActive) =>
  `block px-3 py-2 rounded-lg transition-all duration-300 ${
    isActive
      ? 'bg-primary.light text-primary font-semibold'
      : 'text-slate-600 hover:bg-primary/5 hover:text-primary'
  }`;

const Header = () => {
  const [navOpen, setNavOpen] = useState(false);

  useEffect(() => {
    document.body.classList.toggle('overflow-hidden', navOpen);
    if (!navOpen) {
      document.body.classList.remove('md:overflow-auto');
    }
  }, [navOpen]);

  const closeNav = () => setNavOpen(false);

  return (
    <motion.header
      className="bg-white/80 backdrop-blur border-b border-slate-100 sticky top-0 z-50"
      initial={{ y: -100, opacity: 0 }}
      animate={{ y: 0, opacity: 1 }}
      transition={{ duration: 0.6, ease: [0.22, 1, 0.36, 1] }}
    >
      <div className="max-w-6xl mx-auto px-4">
        <div className="flex items-center justify-between py-4">
          <div className="flex items-center gap-8">
            <motion.div
              whileHover={{ scale: 1.05 }}
              transition={{ duration: 0.2 }}
            >
              <Link
                to="/"
                className="text-xl font-semibold text-slate-900 hover:text-primary transition-colors duration-200"
                onClick={closeNav}
              >
                Syntaxtrus
              </Link>
            </motion.div>
            <motion.span
              className={`hidden sm:inline-flex items-center gap-2 text-sm bg-primary.light text-primary font-medium px-3 py-1 rounded-full ${bgHover}`}
              whileHover={{ scale: 1.05 }}
              transition={{ duration: 0.2 }}
            >
              Website Mahasiswa
            </motion.span>
          </div>

          <motion.button
            type="button"
            className={`md:hidden inline-flex items-center justify-center w-10 h-10 rounded-full border border-slate-200 text-slate-600 hover:border-primary hover:text-primary hover:bg-primary/5 ${focusStyles} ${activeScale}`}
            aria-label="Toggle navigation"
            aria-expanded={navOpen}
            onClick={() => setNavOpen((prev) => !prev)}
            whileHover={{ scale: 1.05 }}
            whileTap={{ scale: 0.95 }}
          >
            <motion.svg
              xmlns="http://www.w3.org/2000/svg"
              className="w-5 h-5"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
              animate={{
                rotate: navOpen ? 90 : 0,
                transition: { duration: 0.3 }
              }}
            >
              <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.5" d="M4 6h16M4 12h16M4 18h16" />
            </motion.svg>
          </motion.button>

          <motion.nav
            className="hidden md:flex items-center gap-8 text-sm"
            variants={staggerContainer(0.1, 0)}
            initial="hidden"
            animate="show"
          >
            {navItems.map((item, index) => (
              <motion.div
                key={item.slug}
                variants={navItem}
                custom={index}
              >
                <NavLink
                  to={item.href}
                  className={({ isActive }) => linkClassName(isActive)}
                  onClick={closeNav}
                >
                  {item.label}
                </NavLink>
              </motion.div>
            ))}
          </motion.nav>

          <motion.div
            className="hidden md:flex items-center gap-3"
            variants={staggerContainer(0.1, 0.2)}
            initial="hidden"
            animate="show"
          >
            <Link
              to="/schedule"
              className={buttonClassName('outline')}
              onClick={closeNav}
              {...hoverScale}
            >
              Konsultasi Gratis
            </Link>
            <Link
              to="/pricing"
              className={buttonClassName('primary')}
              onClick={closeNav}
              {...hoverScale}
            >
              Nego Harga
            </Link>
          </motion.div>
        </div>

        <AnimatePresence>
          {navOpen && (
            <motion.div
              className="md:hidden pb-4 space-y-2 border-t border-slate-100"
              initial={{ opacity: 0, height: 0 }}
              animate={{ opacity: 1, height: 'auto' }}
              exit={{ opacity: 0, height: 0 }}
              transition={{ duration: 0.3 }}
            >
              {navItems.map((item, index) => (
                <motion.div
                  key={item.slug}
                  initial={{ opacity: 0, x: -20 }}
                  animate={{ opacity: 1, x: 0 }}
                  transition={{ delay: index * 0.05, duration: 0.2 }}
                >
                  <NavLink
                    to={item.href}
                    className={({ isActive }) => mobileLinkClassName(isActive)}
                    onClick={closeNav}
                  >
                    {item.label}
                  </NavLink>
                </motion.div>
              ))}
              <motion.div
                className="grid grid-cols-1 sm:grid-cols-2 gap-2 pt-2"
                initial={{ opacity: 0, y: 20 }}
                animate={{ opacity: 1, y: 0 }}
                transition={{ delay: 0.3, duration: 0.3 }}
              >
                <Link
                  to="/schedule"
                  className={buttonClassName('outline')}
                  onClick={closeNav}
                  {...hoverScale}
                >
                  Konsultasi Gratis
                </Link>
                <Link
                  to="/pricing"
                  className={buttonClassName('primary')}
                  onClick={closeNav}
                  {...hoverScale}
                >
                  Nego Harga
                </Link>
              </motion.div>
            </motion.div>
          )}
        </AnimatePresence>
      </div>
    </motion.header>
  );
};

export default Header;
