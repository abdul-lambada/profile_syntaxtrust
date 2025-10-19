import { Link } from 'react-router-dom';
import { motion } from 'framer-motion';
import { buttonClassName, textHover, focusStyles, activeScale } from '../utils/styles';
import { hoverScale, staggerContainer, fadeInUp } from '../utils/animations';

const footerNav = [
  { href: '/', label: 'Beranda' },
  { href: '/services', label: 'Layanan' },
  { href: '/portfolio', label: 'Portofolio' },
  { href: '/pricing', label: 'Harga & Konsultasi' },
  { href: '/contact', label: 'Kontak' },
];

const socialLinks = [
  { href: 'https://instagram.com', label: 'Instagram' },
  { href: 'https://linkedin.com', label: 'LinkedIn' },
  { href: 'https://github.com', label: 'GitHub' },
];

const Footer = () => (
  <motion.footer
    className="mt-16 border-t border-slate-200 bg-white"
    initial={{ opacity: 0, y: 20 }}
    whileInView={{ opacity: 1, y: 0 }}
    viewport={{ once: true, amount: 0.3 }}
    transition={{ duration: 0.6, ease: [0.22, 1, 0.36, 1] }}
  >
    <div className="max-w-6xl mx-auto px-4 py-10 grid gap-8 lg:grid-cols-[1.2fr_0.8fr]">
      <motion.div
        className="space-y-4"
        variants={staggerContainer(0.1, 0.1)}
        initial="hidden"
        whileInView="show"
      >
        <motion.div variants={fadeInUp(0)}>
          <motion.p
            className="text-lg font-semibold text-slate-900"
            whileHover={{ scale: 1.02 }}
            transition={{ duration: 0.2 }}
          >
            Syntaxtrus
          </motion.p>
          <p className="text-sm text-slate-500">Solusi website mahasiswa: tugas, modifikasi/custom, Skripsi/Tugas Akhir.</p>
        </motion.div>
        <motion.div
          className="flex flex-wrap gap-3"
          variants={fadeInUp(0.2)}
        >
          <Link
            to="/schedule"
            className={buttonClassName('outline')}
            {...hoverScale}
          >
            Konsultasi Gratis
          </Link>
          <Link
            to="/pricing"
            className={buttonClassName('primary')}
            {...hoverScale}
          >
            Dapatkan Penawaran
          </Link>
        </motion.div>
      </motion.div>

      <motion.div
        className="grid sm:grid-cols-2 gap-6 text-sm text-slate-600"
        variants={staggerContainer(0.1, 0.2)}
        initial="hidden"
        whileInView="show"
      >
        <motion.div variants={fadeInUp(0)}>
          <p className="font-semibold text-slate-900 mb-3">Navigasi</p>
          <ul className="space-y-2">
            {footerNav.map((item, index) => (
              <motion.li
                key={item.href}
                variants={fadeInUp(index * 0.05)}
                whileHover={{ x: 4, transition: { duration: 0.2 } }}
              >
                <Link
                  to={item.href}
                  className={`${textHover} ${focusStyles}`}
                >
                  {item.label}
                </Link>
              </motion.li>
            ))}
          </ul>
        </motion.div>

        <motion.div variants={fadeInUp(0.1)}>
          <p className="font-semibold text-slate-900 mb-3">Terhubung</p>
          <ul className="space-y-2">
            {socialLinks.map((item, index) => (
              <motion.li
                key={item.href}
                variants={fadeInUp(index * 0.05)}
                whileHover={{ x: 4, transition: { duration: 0.2 } }}
              >
                <motion.a
                  href={item.href}
                  target="_blank"
                  rel="noopener noreferrer"
                  className={`${textHover} ${focusStyles} inline-flex items-center gap-2`}
                  whileHover={{ scale: 1.05 }}
                  transition={{ duration: 0.2 }}
                >
                  <motion.svg
                    xmlns="http://www.w3.org/2000/svg"
                    className="w-4 h-4"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    whileHover={{ rotate: 5 }}
                    transition={{ duration: 0.2 }}
                  >
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                  </motion.svg>
                  {item.label}
                </motion.a>
              </motion.li>
            ))}
          </ul>
        </motion.div>
      </motion.div>
    </div>

    <motion.div
      className="border-t border-slate-100 py-4"
      initial={{ opacity: 0 }}
      whileInView={{ opacity: 1 }}
      viewport={{ once: true }}
      transition={{ delay: 0.3, duration: 0.4 }}
    >
      <div className="max-w-6xl mx-auto px-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 text-xs text-slate-500">
        <motion.p
          whileHover={{ scale: 1.02 }}
          transition={{ duration: 0.2 }}
        >
          © {new Date().getFullYear()} Syntaxtrus. Semua hak dilindungi.
        </motion.p>
        <motion.div
          className="flex flex-wrap gap-3"
          variants={staggerContainer(0.05, 0)}
          initial="hidden"
          whileInView="show"
        >
          <motion.div variants={fadeInUp(0)}>
            <Link
              to="/services"
              className={`${textHover} ${focusStyles}`}
            >
              Kebijakan Layanan
            </Link>
          </motion.div>
          <motion.div variants={fadeInUp(0.1)}>
            <Link
              to="/contact"
              className={`${textHover} ${focusStyles}`}
            >
              Hubungi Kami
            </Link>
          </motion.div>
        </motion.div>
      </div>
    </motion.div>
  </motion.footer>
);

export default Footer;
