import { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import { motion } from 'framer-motion';
import AnimatedSection from '../components/AnimatedSection';
import PageTransition from '../components/PageTransition';
import {
  LoadingSpinner,
  LoadingButton,
  SkeletonLoader,
  ShimmerEffect
} from '../components/Loading';
import {
  fadeInUp,
  fadeIn,
  scaleUp,
  hoverScale,
  cardHover,
  staggerContainer,
  staggerFadeIn,
  pageTransition,
  slideTransition
} from '../utils/animations';
import {
  buttonClassName,
  sectionVariants,
  textHover,
  focusStyles,
  activeScale
} from '../utils/styles';

const portfolioCards = [
  {
    title: 'Platform Evaluasi Mata Kuliah',
    description: 'Mengubah rubrik penilaian dosen menjadi halaman informasi, form, dan dokumentasi tugas mingguan.',
    badgeLeft: 'Tugas Mata Kuliah',
    badgeRight: 'Landing + Rubrik',
    image: 'https://source.unsplash.com/600x400/?data',
    links: [
      { label: 'Lihat Struktur Rubrik', href: '#', variant: 'light' },
      { label: 'Buat Website Tugas', href: '/schedule', variant: 'primary' },
    ],
  },
  {
    title: 'Modifikasi Website Tugas Mata Kuliah Atau Website Skripsi/Tugas Akhir',
    description: 'Refactor project eksisting: perbaikan bug, integrasi API jadwal, dan optimasi performa sebelum demo.',
    badgeLeft: 'Modifikasi Website',
    badgeRight: 'Integrasi Fitur',
    image: 'https://source.unsplash.com/600x400/?project',
    links: [
      { label: 'Audit & Checklist', href: '#', variant: 'light' },
      { label: 'Diskusi Modifikasi', href: '/schedule', variant: 'primary' },
    ],
  },
  {
    title: 'Website Skripsi/Tugas Akhir',
    description: 'Sesuaikan website dengan kebutuhan Skripsi/Tugas Akhir.',
    badgeLeft: 'Skripsi/Tugas Akhir',
    badgeRight: 'Dokumentasi Program',
    image: 'https://source.unsplash.com/600x400/?portfolio',
    links: [
      { label: 'Lihat Rencana Agenda', href: '#', variant: 'light' },
      { label: 'Rancang Portal Proyek', href: '/schedule', variant: 'primary' },
    ],
  },
  {
    title: 'Peremajaan UI Sistem Praktikum',
    description: 'Peremajaan UI Sistem Praktikum',
    badgeLeft: 'Modifikasi Website',
    badgeRight: 'Refactor UI',
    image: 'https://source.unsplash.com/600x400/?code',
    links: [
      { label: 'Lihat Hasil Audit', href: '#', variant: 'light' },
      { label: 'Upgrade Project-ku', href: '/schedule', variant: 'primary' },
    ],
  },
];

const caseStudies = [
  {
    title: 'Website Tugas Mata Kuliah',
    subtitle: 'UI/UX + Implementasi',
    description: 'Membangun platform untuk menilai karya mahasiswa dengan rubrik otomatis, fitur upload, dan integrasi spreadsheet.',
    bullets: [
      'Audit rubrik dosen → sitemap',
      'Design system & token Tailwind',
      'Implementasi Next.js + hosting',
    ],
    buttons: [
      { label: 'Lihat Detail', href: '#', variant: 'white' },
      { label: 'Diskusikan Proyek', href: '/schedule', variant: 'primary' },
    ],
  },
  {
    title: 'Modifikasi Website Tugas Mata Kuliah Atau Website Skripsi/Tugas Akhir',
    subtitle: 'Desain + Presentasi',
    description: 'Modifikasi website tugas mata kuliah atau website skripsi/tugas akhir.',
    bullets: [
      'Konsep brand & narasi',
      'Prototype Figma → Tailwind',
      'Optimasi mobile demo',
    ],
    buttons: [
      { label: 'Lihat Detail', href: '#', variant: 'white' },
      { label: 'Minta Proposal', href: '/schedule', variant: 'primary' },
    ],
  },
];

const testimonials = [
  {
    initials: 'RA',
    name: 'Rizky Ananta',
    info: 'S1 Informatika',
    quote: '“Rubrik dosen diterjemahkan jadi fitur jelas. Presentasi jadi mulus karena website-nya gampang dipahami.”',
  },
  {
    initials: 'BA',
    name: 'Bangun Aditya',
    info: 'S2 Manajemen',
    quote: '“Timeline pengerjaan sesuai target. Slide dan handover lengkap, jadi tinggal fokus ke sidang.”',
  },
  {
    initials: 'SP',
    name: 'Salsa Putri',
    info: 'Portofolio UI Designer',
    quote: '“Case study-nya ditata rapi, recruiter langsung bisa lihat proses dan hasilnya.”',
  },
];

const PortfolioPage = () => {
  const [isLoading, setIsLoading] = useState(true);

  useEffect(() => {
    // Simulate initial page load
    const timer = setTimeout(() => {
      setIsLoading(false);
    }, 1100);

    return () => clearTimeout(timer);
  }, []);

  if (isLoading) {
    return (
      <PageTransition loading={true} loadingMessage="Memuat portofolio...">
        <div className="space-y-8">
          {/* Hero skeleton */}
          <div className="py-16">
            <div className="max-w-5xl mx-auto px-4">
              <div className="text-center space-y-6">
                <SkeletonLoader lines={2} />
                <div className="flex justify-center gap-3">
                  <div className="h-10 bg-slate-200 rounded-full animate-pulse w-24" />
                  <div className="h-10 bg-slate-200 rounded-full animate-pulse w-32" />
                </div>
              </div>
            </div>
          </div>

          {/* Portfolio cards skeleton */}
          <div className="pb-16">
            <div className="max-w-6xl mx-auto px-4">
              <div className="flex justify-between items-center mb-6">
                <SkeletonLoader lines={2} />
              </div>
              <div className="grid md:grid-cols-3 gap-6">
                {[1, 2, 3, 4].map((i) => (
                  <div key={i} className="bg-white rounded-3xl p-6 shadow-soft">
                    <div className="h-40 bg-slate-200 rounded-2xl mb-4 animate-pulse" />
                    <SkeletonLoader lines={4} />
                  </div>
                ))}
              </div>
            </div>
          </div>

          {/* Case studies skeleton */}
          <div className="bg-white py-16">
            <div className="max-w-6xl mx-auto px-4">
              <div className="flex justify-between items-center mb-10">
                <SkeletonLoader lines={2} />
                <div className="h-10 bg-slate-200 rounded-full animate-pulse w-36" />
              </div>
              <div className="grid lg:grid-cols-2 gap-6">
                {[1, 2].map((i) => (
                  <div key={i} className="bg-primary.light rounded-3xl p-6 sm:p-8">
                    <SkeletonLoader lines={4} />
                  </div>
                ))}
              </div>
            </div>
          </div>
        </div>
      </PageTransition>
    );
  }

  return (
    <PageTransition loading={isLoading}>
      <main>
        <AnimatedSection className="py-16">
          <div className="max-w-5xl mx-auto px-4">
            <motion.div className={`${sectionVariants.hero} text-center space-y-6`} {...fadeInUp(0)}>
              <motion.h1 className="text-3xl sm:text-4xl font-semibold text-slate-900" {...fadeInUp(0.02)}>
                Portofolio Website Mahasiswa
              </motion.h1>
              <motion.p className="text-base sm:text-lg text-slate-600" {...fadeInUp(0.04)}>
                Contoh proyek nyata dari layanan kami: website tugas mata kuliah, modifikasi & website custom mahasiswa, serta Skripsi/Tugas Akhir. Semua fokus pada pembuatan website; kami tidak menulis dokumen akademik.
              </motion.p>
              <motion.div className="flex flex-wrap justify-center gap-3" {...fadeInUp(0.08)}>
                <a href="#projects" className={buttonClassName('primary')}>
                  Lihat Proyek
                </a>
                <Link to="/schedule" className={buttonClassName('subtle')}>
                  Diskusikan Kebutuhanmu
                </Link>
              </motion.div>
            </motion.div>
          </div>
        </AnimatedSection>

        <AnimatedSection id="projects" className="pb-16">
          <div className="max-w-6xl mx-auto px-4">
            <motion.div className="flex flex-wrap items-center justify-between gap-4 mb-6" {...fadeInUp(0)}>
              <div>
                <h2 className="text-2xl font-semibold text-slate-900">Sorotan Proyek</h2>
                <p className="text-sm text-slate-600">Tiga kategori utama kami: tugas mata kuliah, modifikasi website, dan Skripsi/Tugas Akhir.</p>
              </div>
              <div className="flex flex-wrap gap-2 text-sm">
                <button type="button" className="px-4 py-2 rounded-full bg-primary text-white font-semibold">
                  Tugas Mata Kuliah
                </button>
                <button type="button" className="px-4 py-2 rounded-full border border-slate-200 text-slate-600">
                  Modifikasi Website
                </button>
                <button type="button" className="px-4 py-2 rounded-full border border-slate-200 text-slate-600">
                  Skripsi/Tugas Akhir
                </button>
              </div>
            </motion.div>
            <div className="grid md:grid-cols-3 gap-6">
              {portfolioCards.map((card, index) => (
                <motion.article
                  key={card.title}
                  className={`bg-white rounded-3xl overflow-hidden ${index === portfolioCards.length - 1 ? 'border border-slate-100' : 'shadow-soft'} flex flex-col`}
                  {...fadeInUp(0.05 * index)}
                >
                  <motion.img src={card.image} alt={card.title} className="w-full h-40 object-cover" loading="lazy" />
                  <div className="p-6 flex flex-col gap-4 flex-1">
                    <div className="flex justify-between text-xs text-primary font-semibold">
                      <span>{card.badgeLeft}</span>
                      <span>{card.badgeRight}</span>
                    </div>
                    <h3 className="text-lg font-semibold text-slate-900">{card.title}</h3>
                    <p className="text-sm text-slate-600">{card.description}</p>
                    <div className="mt-auto flex flex-wrap gap-2 text-sm">
                      {card.links.map((link) => (
                        link.variant === 'primary' ? (
                          <Link key={link.label} to={link.href} className={buttonClassName('primary')}>
                            {link.label}
                          </Link>
                        ) : (
                          <a key={link.label} href={link.href} className={buttonClassName('subtle')}>
                            {link.label}
                          </a>
                        )
                      ))}
                    </div>
                  </div>
                </motion.article>
              ))}
            </div>
          </div>
        </AnimatedSection>

        <AnimatedSection className="bg-white py-16">
          <div className="max-w-6xl mx-auto px-4">
            <motion.div className="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-10" {...fadeInUp(0)}>
              <div>
                <h2 className="text-2xl font-semibold text-slate-900">Studi Kasus Unggulan</h2>
                <p className="text-sm text-slate-600">Ringkasan proses dari riset hingga implementasi.</p>
              </div>
              <Link to="/schedule" className="px-4 py-2 text-sm font-semibold text-primary bg-primary.light rounded-full">
                Minta Ringkasan Lengkap
              </Link>
            </motion.div>
            <div className="grid lg:grid-cols-2 gap-6">
              {caseStudies.map((item, index) => (
                <motion.article key={item.title} className="bg-primary.light rounded-3xl p-6 sm:p-8 flex flex-col gap-4" {...scaleUp(0.05 * index)}>
                  <div className="text-xs font-semibold text-primary">{item.subtitle}</div>
                  <h3 className="text-xl font-semibold text-slate-900">{item.title}</h3>
                  <p className="text-sm text-slate-600">{item.description}</p>
                  <ul className="space-y-2 text-sm text-slate-600">
                    {item.bullets.map((bullet) => (
                      <li key={bullet} className="flex items-start gap-2"><span className="mt-0.5">•</span><span>{bullet}</span></li>
                    ))}
                  </ul>
                  <div className="flex flex-wrap gap-2 text-sm">
                    {item.buttons.map((button) => (
                      button.variant === 'primary' ? (
                        <Link key={button.label} to={button.href} className={buttonClassName('primary')}>
                          {button.label}
                        </Link>
                      ) : (
                        <a key={button.label} href={button.href} className={buttonClassName('ghost')}>
                          {button.label}
                        </a>
                      )
                    ))}
                  </div>
                </motion.article>
              ))}
            </div>
          </div>
        </AnimatedSection>

        <AnimatedSection className="py-16">
          <div className="max-w-6xl mx-auto px-4">
            <motion.div className="mb-8 text-center" {...fadeInUp(0)}>
              <h2 className="text-2xl font-semibold text-slate-900">Apa Kata Mereka</h2>
              <p className="text-sm text-slate-600">Testimoni mahasiswa yang berhasil presentasi dan lulus tepat waktu.</p>
            </motion.div>
            <div className="grid md:grid-cols-3 gap-6">
              {testimonials.map((testimonial, index) => (
                <motion.article key={testimonial.initials} className="bg-white rounded-3xl p-6 border border-slate-100 flex flex-col gap-4" {...fadeInUp(0.05 * index)}>
                  <div className="flex items-center gap-3">
                    <div className="w-12 h-12 rounded-full bg-primary.light text-primary flex items-center justify-center font-semibold">
                      {testimonial.initials}
                    </div>
                    <div>
                      <p className="text-sm font-semibold text-slate-900">{testimonial.name}</p>
                      <p className="text-xs text-slate-500">{testimonial.info}</p>
                    </div>
                  </div>
                  <p className="text-sm text-slate-600">{testimonial.quote}</p>
                </motion.article>
              ))}
            </div>
          </div>
        </AnimatedSection>

        <AnimatedSection className="bg-white py-16">
          <motion.div className={`${sectionVariants.hero} bg-primary.light text-center`} {...scaleUp(0)}>
            <p className="text-sm font-semibold text-primary mb-2">Tertarik melihat demo sesuai topikmu?</p>
            <h2 className="text-2xl font-semibold text-slate-900 mb-4">Konsultasi gratis dan dapatkan rekomendasi paket yang pas.</h2>
            <div className="flex flex-wrap justify-center gap-3">
              <Link to="/schedule" className={buttonClassName('outline')}>
                Konsultasi Gratis
              </Link>
              <Link to="/pricing" className={buttonClassName('primary')}>
                Minta Penawaran
              </Link>
            </div>
          </motion.div>
        </AnimatedSection>
      </main>
    </PageTransition>
  );
};

export default PortfolioPage;
