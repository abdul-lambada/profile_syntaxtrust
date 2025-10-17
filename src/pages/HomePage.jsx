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
  inputStyles,
  iconHover,
  imageHover,
  textHover,
  bgHover,
  focusStyles,
  activeScale,
  disabledStyles,
  loadingStyles,
  loadingContainerStyles,
  shimmerStyles
} from '../utils/styles';

const HomePage = () => {
  const [isLoading, setIsLoading] = useState(true);
  const [formLoading, setFormLoading] = useState(false);
  const [heroLoaded, setHeroLoaded] = useState(false);

  useEffect(() => {
    // Simulate initial page load
    const timer = setTimeout(() => {
      setIsLoading(false);
    }, 1500);

    return () => clearTimeout(timer);
  }, []);

  const handleFormSubmit = async (e) => {
    e.preventDefault();
    setFormLoading(true);

    // Simulate form submission
    setTimeout(() => {
      setFormLoading(false);
      alert('Brief berhasil dikirim!');
    }, 2000);
  };

  if (isLoading) {
    return (
      <PageTransition loading={true} loadingMessage="Memuat halaman utama...">
        <div className="space-y-8">
          {/* Hero skeleton */}
          <div className="py-16">
            <div className="max-w-6xl mx-auto px-4">
              <div className="grid lg:grid-cols-2 gap-10 lg:gap-20 items-center">
                <div className="space-y-6">
                  <SkeletonLoader lines={3} />
                  <div className="flex gap-3">
                    <div className="h-10 bg-slate-200 rounded-full animate-pulse w-32" />
                    <div className="h-10 bg-slate-200 rounded-full animate-pulse w-28" />
                  </div>
                </div>
                <div className="space-y-4">
                  <div className="h-16 bg-slate-200 rounded-2xl animate-pulse" />
                  <div className="grid grid-cols-2 gap-4">
                    <div className="h-24 bg-slate-200 rounded-2xl animate-pulse" />
                    <div className="h-24 bg-slate-200 rounded-2xl animate-pulse" />
                  </div>
                </div>
              </div>
            </div>
          </div>

          {/* Features skeleton */}
          <div className="py-16 bg-slate-50">
            <div className="max-w-6xl mx-auto px-4">
              <div className="grid md:grid-cols-3 gap-6">
                {[1, 2, 3].map((i) => (
                  <div key={i} className="bg-white rounded-2xl p-6 shadow-soft">
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
          <div className="max-w-6xl mx-auto px-4">
            <div className="grid lg:grid-cols-2 gap-10 lg:gap-20 items-center">
              <motion.div
                className="space-y-6"
                variants={fadeInUp(0)}
              >
                <motion.h1
                  className="text-3xl sm:text-4xl lg:text-5xl font-semibold text-slate-900 leading-tight"
                  variants={fadeInUp(0.1)}
                >
                  Jasa Pembuatan Website Mahasiswa
                </motion.h1>
                <motion.p
                  className="text-base sm:text-lg text-slate-600 leading-relaxed"
                  variants={fadeInUp(0.2)}
                >
                  Syntaxtrus fokus mengerjakan website tugas mata kuliah, modifikasi website mahasiswa,
                  dan pengembangan website custom untuk Skripsi/Tugas Akhir. Kami tidak menyediakan
                  layanan penulisan dokumen akademik.
                </motion.p>
                <motion.div
                  className="flex flex-wrap gap-3"
                  variants={fadeInUp(0.3)}
                >
                  <Link
                    to="/schedule"
                    className={buttonClassName('primary')}
                    {...hoverScale}
                  >
                    Mulai Konsultasi Gratis
                  </Link>
                  <Link
                    to="/pricing"
                    className={buttonClassName('subtle')}
                    {...hoverScale}
                  >
                    Lihat Paket Layanan
                  </Link>
                </motion.div>
              </motion.div>

              <motion.div
                className={`${sectionVariants.hero} flex flex-col gap-6`}
                variants={scaleUp(0.1)}
              >
                <motion.div
                  className={`flex items-center gap-4 ${bgHover} p-4 rounded-2xl`}
                  {...fadeInUp(0.15)}
                  whileHover={{ scale: 1.02, transition: { duration: 0.2 } }}
                >
                  <motion.div
                    className={`w-12 h-12 rounded-2xl bg-primary.light flex items-center justify-center text-primary ${iconHover}`}
                    whileHover={{ rotate: 5, scale: 1.1 }}
                  >
                    <svg xmlns="http://www.w3.org/2000/svg" className="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.4" d="M12 6v12m6-6H6" />
                    </svg>
                  </motion.div>
                  <div>
                    <p className="text-sm text-slate-500">Tiga fokus utama</p>
                    <p className="text-lg font-semibold text-slate-900">Pilih jalur yang kamu butuhkan</p>
                  </div>
                </motion.div>

                <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
                  {[
                    {
                      title: 'Website Tugas Mata Kuliah',
                      body: ['Mapping rubrik dosen ke fitur website', 'UI responsif siap demonstrasi kelas'],
                      link: 'Cek Paket Tugas',
                      href: '/pricing',
                      extraClasses: 'bg-primary.light hover:bg-primary/20',
                    },
                    {
                      title: 'Modifikasi & Custom Website Mahasiswa',
                      body: ['Perbaikan fitur, integrasi, dan adaptasi rubrik', 'Optimasi tampilan, performa, dan user flow'],
                      link: 'Lihat Estimasi Modifikasi',
                      href: '/pricing',
                      extraClasses: 'bg-[#EFF5FF] hover:bg-blue-50',
                    },
                  ].map((card, index) => (
                    <motion.div
                      key={card.title}
                      className={`${card.extraClasses} rounded-2xl p-4 ${cardHover}`}
                      variants={fadeInUp(0.1 * (index + 1))}
                      whileHover={{ y: -2, transition: { duration: 0.2 } }}
                    >
                      <p className="text-sm font-semibold text-primary mb-2">{card.title}</p>
                      <ul className="space-y-2 text-sm text-slate-600">
                        {card.body.map((item) => (
                          <li key={item} className="flex items-start gap-2">
                            <span className="mt-0.5 text-primary">•</span>
                            <span>{item}</span>
                          </li>
                        ))}
                      </ul>
                      <Link
                        to={card.href}
                        className={`inline-flex items-center gap-2 mt-4 px-4 py-2 text-sm font-semibold bg-white text-primary rounded-full ${activeScale} ${focusStyles} ${textHover}`}
                      >
                        {card.link}
                      </Link>
                    </motion.div>
                  ))}

                  <motion.div
                    className="bg-white rounded-2xl p-4 border border-slate-100 sm:col-span-2 hover:border-primary/30"
                    {...fadeInUp(0.3)}
                    whileHover={{ y: -2, transition: { duration: 0.2 } }}
                  >
                    <div className="flex items-center gap-3 mb-3">
                      <motion.div
                        className={`w-10 h-10 rounded-full bg-primary.light flex items-center justify-center text-primary ${iconHover}`}
                        whileHover={{ rotate: 5, scale: 1.1 }}
                      >
                        <svg xmlns="http://www.w3.org/2000/svg" className="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.4" d="M16 7a4 4 0 11-8 0 4 4 0 018 0z" />
                          <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.4" d="M12 14.5c-4 0-6 1.8-6 3.5V20h12v-2c0-1.7-2-3.5-6-3.5z" />
                        </svg>
                      </motion.div>
                      <div>
                        <p className="text-sm text-slate-500">Website Proyek Skripsi/Tugas Akhir</p>
                        <p className="text-base font-semibold text-slate-900">Sesuaikan dengan kebutuhan anda.</p>
                      </div>
                    </div>
                    <div className="flex flex-wrap gap-3">
                      <Link
                        to="/pricing"
                        className={`px-4 py-2 text-sm font-semibold bg-primary.light text-primary rounded-full ${activeScale} ${focusStyles} ${textHover}`}
                      >
                        Pelajari Paket Proyek
                      </Link>
                    </div>
                  </motion.div>
                </div>
              </motion.div>
            </div>
          </div>
        </AnimatedSection>

        <AnimatedSection className="py-12">
          <div className="max-w-6xl mx-auto px-4 grid lg:grid-cols-[1.2fr_0.8fr] gap-8">
            <motion.div
              className="bg-white rounded-3xl p-6 sm:p-8 shadow-soft hover:shadow-lg"
              {...fadeInUp(0)}
              whileHover={{ y: -2, transition: { duration: 0.2 } }}
            >
              <motion.div
                className="inline-flex items-center text-xs font-semibold text-white bg-[#F59E0B] px-3 py-1 rounded-full mb-6"
                {...fadeIn(0.05)}
              >
                Langkah Berikutnya
              </motion.div>
              <h2 className="text-2xl font-semibold text-slate-900 mb-6">Brief Cepat untuk Website Mahasiswa</h2>
              <p className="text-sm text-slate-600 mb-6">
                Pilih layanan website tugas mata kuliah, modifikasi/custom, atau Skripsi/Tugas Akhir.
                Cantumkan ekspektasi dosen agar kami dapat menilai ruang lingkup dan timeline.
              </p>
              <form className="grid grid-cols-1 sm:grid-cols-2 gap-4" onSubmit={handleFormSubmit}>
                <motion.select
                  className={`${inputStyles} ${focusStyles} ${activeScale}`}
                  {...fadeInUp(0.05)}
                  disabled={formLoading}
                >
                  <option value="">Pilih Layanan</option>
                  <option value="tugas">Website Tugas Mata Kuliah</option>
                  <option value="modifikasi">Modifikasi Website</option>
                  <option value="proyek">Website Proyek Skripsi/Tugas Akhir</option>
                </motion.select>
                <motion.input
                  type="text"
                  placeholder="Nama"
                  className={`${inputStyles} ${focusStyles} ${activeScale}`}
                  {...fadeInUp(0.08)}
                  disabled={formLoading}
                />
                <motion.input
                  type="email"
                  placeholder="Email"
                  className={`${inputStyles} ${focusStyles} ${activeScale}`}
                  {...fadeInUp(0.11)}
                  disabled={formLoading}
                />
                <motion.input
                  type="text"
                  placeholder="Deadline"
                  className={`${inputStyles} ${focusStyles} ${activeScale}`}
                  {...fadeInUp(0.14)}
                  disabled={formLoading}
                />
                <motion.textarea
                  rows="3"
                  placeholder="Ceritakan singkat kebutuhanmu & referensi"
                  className={`${inputStyles} sm:col-span-2 ${focusStyles} ${activeScale}`}
                  {...fadeInUp(0.17)}
                  disabled={formLoading}
                />
                <motion.div
                  className="sm:col-span-2 flex justify-end"
                  {...fadeInUp(0.2)}
                >
                  <LoadingButton
                    type="submit"
                    loading={formLoading}
                    loadingText="Mengirim Brief..."
                    className={buttonClassName('primary')}
                  >
                    Kirim Brief
                  </LoadingButton>
                </motion.div>
              </form>
            </motion.div>

            <motion.div
              className="bg-white rounded-3xl p-6 sm:p-8 border border-slate-100 hover:border-primary/30"
              {...fadeInUp(0.1)}
              whileHover={{ y: -2, transition: { duration: 0.2 } }}
            >
              <h3 className="text-xl font-semibold text-slate-900 mb-4">Kenapa mahasiswa pilih Syntaxtrus?</h3>
              <ul className="space-y-4 text-sm text-slate-600">
                {[
                  {
                    icon: (
                      <svg xmlns="http://www.w3.org/2000/svg" className="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.5" d="M9 5l7 7-7 7" />
                      </svg>
                    ),
                    text: 'Rubrik tugas diterjemahkan menjadi struktur halaman yang jelas',
                  },
                  {
                    icon: (
                      <svg xmlns="http://www.w3.org/2000/svg" className="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.5" d="M12 8v8m-4-4h8" />
                      </svg>
                    ),
                    text: 'Modifikasi fleksibel untuk proyek yang sudah berjalan',
                  },
                  {
                    icon: (
                      <svg xmlns="http://www.w3.org/2000/svg" className="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.5" d="M4 12h16" />
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.5" d="M12 4v16" />
                      </svg>
                    ),
                    text: 'Handover lengkap untuk demo dan presentasi kampus',
                  },
                ].map((item, index) => (
                  <motion.li
                    key={item.text}
                    className={`flex items-start gap-3 ${textHover}`}
                    {...fadeInUp(0.1 * (index + 1))}
                    whileHover={{ x: 4, transition: { duration: 0.2 } }}
                  >
                    <motion.div
                      className={`w-8 h-8 rounded-full bg-primary.light flex items-center justify-center text-primary ${iconHover}`}
                      whileHover={{ scale: 1.1, rotate: 5 }}
                    >
                      {item.icon}
                    </motion.div>
                    <span>{item.text}</span>
                  </motion.li>
                ))}
                <motion.li
                  className="pt-4 text-xs text-slate-500 leading-relaxed"
                  {...fadeIn(0.4)}
                >
                  Handover meliputi source code, panduan presentasi, dan dukungan revisi sesuai pilihan paket.
                  Seluruh layanan berfokus pada pembuatan website, bukan penulisan dokumen akademik.
                </motion.li>
              </ul>
            </motion.div>
          </div>
        </AnimatedSection>
      </motion.main>
    </PageTransition>
  );
};

export default HomePage;

