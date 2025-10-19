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
  cardStyles,
  textHover,
  focusStyles,
  activeScale
} from '../utils/styles';

const serviceCards = [
  {
    title: 'Website Tugas Mata Kuliah',
    description: 'Bangun landing page dan halaman fitur sesuai rubrik dosen.',
    points: [
      'Mapping rubrik → user flow & konten',
      'Integrasi form feedback & dokumentasi',
      'Latihan presentasi dengan preview halaman',
    ],
    cta: 'Mulai Brief Tugas',
    href: '/pricing',
    variant: 'primary',
  },
  {
    title: 'Modifikasi & Website Custom Mahasiswa',
    description: 'Optimasi proyek berjalan atau bangun website custom untuk Skripsi/Tugas Akhir.',
    points: [
      'Audit kode, rekomendasi perbaikan, dan adaptasi rubrik',
      'Implementasi fitur tambahan, integrasi API, atau halaman custom',
      'Refactor UI agar responsif, cepat, dan siap demo',
    ],
    cta: 'Estimasi Modifikasi & Custom',
    href: '/pricing',
    variant: 'primary',
  },
  {
    title: 'Website Skripsi/Tugas Akhir',
    description: 'Buat portal presentasi untuk Skripsi/Tugas Akhir.',
    points: [
      'Sesuaikan dengan rubrik dosen',
      'Fitur disesuaikan dengan skripsi anda',
      'Free ERD Diagram',
    ],
    cta: 'Pelajari Paket Proyek',
    href: '/pricing',
    variant: 'outline',
  },
];

const packageCards = [
  {
    title: 'Paket Tugas',
    price: 'Mulai IDR 300K',
    points: ['3 halaman inti + form laporan', 'Responsive layout', 'Estimasi 3–5 hari kerja'],
    href: '/schedule',
    cta: 'Minta Penawaran Tugas',
    variant: 'light',
  },
  {
    title: 'Paket Modifikasi & Custom',
    price: 'Mulai IDR 500K',
    points: ['Audit kode & rekomendasi detail', 'Perbaikan bug + fitur baru ringan atau halaman custom', 'Review ulang bersama mahasiswa'],
    href: '/schedule',
    cta: 'Diskusikan Modifikasi & Custom',
    variant: 'primary',
  },
  {
    title: 'Paket Skripsi/Tugas Akhir',
    price: 'Mulai IDR 2.5JT',
    points: ['Sesuaikan dengan rubrik dosen', 'Fitur disesuaikan dengan skripsi anda', 'Free ERD Diagram dan banyak lagi tergantung kebutuhan anda'],
    href: '/schedule',
    cta: 'Konsultasi Paket Proyek',
    variant: 'outline',
  },
];

const processSteps = [
  {
    title: '1. Brief',
    description: 'Kirim kebutuhan singkat, sertakan referensi jika ada.',
  },
  {
    title: '2. Wireframe',
    description: 'Susun struktur halaman & user journey.',
  },
  {
    title: '3. Desain',
    description: 'Terapkan UI modern, komponen konsisten.',
  },
  {
    title: '4. Implementasi',
    description: 'Integrasi konten, handover, dan panduan revisi.',
  },
];

const quickFacts = [
  {
    question: 'Apakah termasuk hosting/domain?',
    answer: 'Fokus pada pengerjaan website. Kami bantu panduan deployment.',
  },
  {
    question: 'Berapa revisi yang didapat?',
    answer: 'Paket Tugas: 1x revisi besar • Modifikasi & Proyek: hingga 3x revisi.',
  },
  {
    question: 'Bisakah deadline dipercepat?',
    answer: 'Bisa, sesuaikan dengan ruang lingkup dan kesiapan materi. Konsultasikan jadwalmu.',
  },
  {
    question: 'Apakah ada pendampingan presentasi?',
    answer: 'Ya, kami siapkan panduan demo dan Q&A sesuai paket pilihannya.',
  },
  {
    question: 'Apakah termasuk penulisan dokumen akademik?',
    answer: 'Tidak. Kami hanya mengerjakan pembuatan website (tugas, modifikasi/custom, Skripsi/Tugas Akhir). Dokumen tetap disiapkan oleh mahasiswa.',
  },
];

const ServicesPage = () => {
  const [isLoading, setIsLoading] = useState(true);

  useEffect(() => {
    // Simulate initial page load
    const timer = setTimeout(() => {
      setIsLoading(false);
    }, 1200);

    return () => clearTimeout(timer);
  }, []);

  if (isLoading) {
    return (
      <PageTransition loading={true} loadingMessage="Memuat layanan...">
        <div className="space-y-8">
          {/* Hero skeleton */}
          <div className="py-16">
            <div className="max-w-5xl mx-auto px-4">
              <div className="text-center space-y-6">
                <SkeletonLoader lines={2} />
                <div className="flex justify-center gap-3">
                  <div className="h-10 bg-slate-200 rounded-full animate-pulse w-32" />
                  <div className="h-10 bg-slate-200 rounded-full animate-pulse w-28" />
                </div>
              </div>
            </div>
          </div>

          {/* Service cards skeleton */}
          <div className="pb-16">
            <div className="max-w-6xl mx-auto px-4 space-y-10">
              <div className="space-y-3">
                <SkeletonLoader lines={1} />
                <SkeletonLoader lines={1} />
              </div>
              <div className="grid md:grid-cols-3 gap-6">
                {[1, 2, 3].map((i) => (
                  <div key={i} className="bg-white rounded-3xl p-6 shadow-soft">
                    <SkeletonLoader lines={5} />
                  </div>
                ))}
              </div>
            </div>
          </div>

          {/* Package cards skeleton */}
          <div className="bg-primary.light py-16">
            <div className="max-w-6xl mx-auto px-4">
              <div className="flex justify-between items-center mb-8">
                <SkeletonLoader lines={2} />
                <div className="h-10 bg-slate-200 rounded-full animate-pulse w-32" />
              </div>
              <div className="grid lg:grid-cols-3 gap-6">
                {[1, 2, 3].map((i) => (
                  <div key={i} className="bg-white rounded-3xl p-6">
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
      <motion.main
        initial="hidden"
        animate="show"
        variants={staggerContainer()}
      >
        <AnimatedSection className="py-16">
          <div className="max-w-5xl mx-auto px-4">
            <motion.div
              className={`${sectionVariants.hero} text-center space-y-6`}
              variants={fadeInUp(0)}
              whileHover={{ y: -2, transition: { duration: 0.2 } }}
            >
              <motion.h1
                className="text-3xl sm:text-4xl font-semibold text-slate-900"
                variants={fadeInUp(0.02)}
              >
                Layanan Website Mahasiswa
              </motion.h1>
              <motion.p
                className="text-base sm:text-lg text-slate-600"
                variants={fadeInUp(0.04)}
              >
                Kami mengerjakan website tugas mata kuliah, modifikasi & website custom mahasiswa, serta Skripsi/Tugas Akhir. Semua layanan hanya mencakup pembuatan website—bukan penulisan dokumen akademik.
              </motion.p>
              <motion.div
                className="flex flex-wrap justify-center gap-3"
                variants={fadeInUp(0.08)}
              >
                <Link
                  to="/pricing"
                  className={buttonClassName('primary')}
                  {...hoverScale}
                >
                  Lihat Paket Layanan
                </Link>
                <Link
                  to="/schedule"
                  className={buttonClassName('subtle')}
                  {...hoverScale}
                >
                  Jadwalkan Konsultasi
                </Link>
              </motion.div>
            </motion.div>
          </div>
        </AnimatedSection>

        <AnimatedSection className="pb-16">
          <div className="max-w-6xl mx-auto px-4 space-y-10">
            <div className="space-y-3">
              <motion.p
                className="text-sm font-semibold text-primary"
                variants={fadeIn(0)}
              >
                Kategori
              </motion.p>
              <motion.div
                className="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4"
                variants={fadeInUp(0.05)}
              >
                <h2 className="text-2xl font-semibold text-slate-900">Tiga Jalur Utama</h2>
                <Link
                  to="/pricing"
                  className={`px-4 py-2 text-sm font-semibold text-primary bg-primary.light rounded-full ${textHover} ${focusStyles} ${activeScale}`}
                >
                  Bandingkan Paket
                </Link>
              </motion.div>
            </div>

            <motion.div
              className="grid md:grid-cols-3 gap-6"
              variants={staggerContainer(0.1, 0.1)}
              initial="hidden"
              whileInView="show"
            >
              {serviceCards.map((card, index) => (
                <motion.div
                  key={card.title}
                  className={`bg-white rounded-3xl p-6 shadow-soft ${cardHover}`}
                  variants={fadeInUp(index * 0.1)}
                  whileHover={{ y: -4, transition: { duration: 0.2 } }}
                >
                  <p className="text-sm font-semibold text-primary mb-3">{card.title}</p>
                  <p className="text-sm text-slate-600 mb-4">{card.description}</p>
                  <ul className="space-y-2 text-sm text-slate-600">
                    {card.points.map((point) => (
                      <li key={point} className="flex items-start gap-2">
                        <span className="mt-0.5 text-primary">•</span>
                        <span>{point}</span>
                      </li>
                    ))}
                  </ul>
                  <Link
                    to={card.href}
                    className={buttonClassName(card.variant === 'outline' ? 'outline' : 'primary', 'mt-5')}
                    {...hoverScale}
                  >
                    {card.cta}
                  </Link>
                </motion.div>
              ))}
            </motion.div>
          </div>
        </AnimatedSection>

        <AnimatedSection className="bg-primary.light py-16">
          <div className="max-w-6xl mx-auto px-4">
            <motion.div
              className="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8"
              variants={fadeInUp(0)}
            >
              <div>
                <p className="text-sm font-semibold text-primary">Paket</p>
                <h2 className="text-2xl font-semibold text-slate-900">Bundel Khusus Mahasiswa</h2>
                <p className="text-sm text-slate-600">Sesuaikan paket awal sesuai jenis layanan yang kamu butuhkan.</p>
              </div>
              <Link
                to="/schedule"
                className={`px-4 py-2 text-sm font-semibold text-white bg-primary rounded-full shadow-soft ${activeScale} ${focusStyles}`}
                {...hoverScale}
              >
                Diskusikan Budget
              </Link>
            </motion.div>

            <motion.div
              className="grid lg:grid-cols-3 gap-6"
              variants={staggerContainer(0.1, 0.1)}
              initial="hidden"
              whileInView="show"
            >
              {packageCards.map((card, index) => (
                <motion.div
                  key={card.title}
                  className={`bg-white rounded-3xl p-6 ${cardHover}`}
                  variants={fadeInUp(index * 0.1)}
                  whileHover={{ y: -4, transition: { duration: 0.2 } }}
                >
                  <p className="text-sm font-semibold text-primary mb-2">{card.title}</p>
                  <p className="text-xl font-semibold text-slate-900 mb-2">{card.price}</p>
                  <ul className="space-y-2 text-sm text-slate-600">
                    {card.points.map((point) => (
                      <li key={point} className="flex items-start gap-2">
                        <span className="mt-0.5 text-primary">•</span>
                        <span>{point}</span>
                      </li>
                    ))}
                  </ul>
                  <Link
                    to={card.href}
                    className={buttonClassName(
                      card.variant === 'primary' ? 'primary' : card.variant === 'outline' ? 'outline' : 'subtle',
                      'mt-5'
                    )}
                    {...hoverScale}
                  >
                    {card.cta}
                  </Link>
                </motion.div>
              ))}
            </motion.div>
          </div>
        </AnimatedSection>

        <AnimatedSection className="py-16">
          <div className="max-w-6xl mx-auto px-4 grid lg:grid-cols-[1.1fr_0.9fr] gap-8">
            <motion.div
              className={`bg-white rounded-3xl p-6 sm:p-8 shadow-soft ${cardHover}`}
              variants={fadeInUp(0)}
              whileHover={{ y: -2, transition: { duration: 0.2 } }}
            >
              <p className="text-sm font-semibold text-primary mb-2">Alur</p>
              <h2 className="text-2xl font-semibold text-slate-900 mb-6">Proses Kerja</h2>
              <motion.div
                className="grid sm:grid-cols-2 gap-5"
                variants={staggerContainer(0.05, 0.1)}
                initial="hidden"
                whileInView="show"
              >
                {processSteps.map((step, index) => (
                  <motion.div
                    key={step.title}
                    className={`rounded-2xl border border-slate-100 p-4 ${textHover} ${focusStyles}`}
                    variants={fadeInUp(index * 0.1)}
                    whileHover={{ scale: 1.02, transition: { duration: 0.2 } }}
                  >
                    <p className="text-xs font-semibold text-primary mb-1">{step.title}</p>
                    <p className="text-sm text-slate-600">{step.description}</p>
                  </motion.div>
                ))}
              </motion.div>
            </motion.div>

            <div className="space-y-5">
              {quickFacts.map((item, index) => (
                <motion.div
                  key={item.question}
                  className={`bg-white rounded-3xl p-6 border border-slate-100 ${cardHover}`}
                  variants={fadeInUp(index * 0.1)}
                  whileHover={{ y: -2, transition: { duration: 0.2 } }}
                >
                  <p className="text-sm font-semibold text-slate-700 mb-2">{item.question}</p>
                  <p className="text-sm text-slate-600">{item.answer}</p>
                </motion.div>
              ))}
            </div>
          </div>
        </AnimatedSection>
      </motion.main>
    </PageTransition>
  );
};

export default ServicesPage;
