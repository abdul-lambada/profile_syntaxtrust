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
  scaleUp,
  hoverScale,
  cardHover,
  staggerContainer
} from '../utils/animations';
import {
  buttonClassName,
  sectionVariants,
  textHover,
  focusStyles,
  activeScale
} from '../utils/styles';

const PricingPage = () => {
  const [isLoading, setIsLoading] = useState(true);
  const [formLoading, setFormLoading] = useState(false);

  useEffect(() => {
    // Simulate initial page load
    const timer = setTimeout(() => {
      setIsLoading(false);
    }, 1000);

    return () => clearTimeout(timer);
  }, []);

  const handleFormSubmit = async (e) => {
    e.preventDefault();
    setFormLoading(true);

    // Simulate form submission
    setTimeout(() => {
      setFormLoading(false);
      alert('Penawaran berhasil dikirim!');
    }, 2000);
  };

  if (isLoading) {
    return (
      <PageTransition loading={true} loadingMessage="Memuat paket harga...">
        <div className="space-y-8">
          {/* Hero skeleton */}
          <div className="py-16">
            <div className="max-w-5xl mx-auto px-4">
              <div className="text-center space-y-6">
                <SkeletonLoader lines={2} />
                <div className="flex justify-center gap-3">
                  <div className="h-10 bg-slate-200 rounded-full animate-pulse w-32" />
                  <div className="h-10 bg-slate-200 rounded-full animate-pulse w-24" />
                </div>
              </div>
            </div>
          </div>

          {/* Form skeleton */}
          <div className="pb-16">
            <div className="max-w-6xl mx-auto px-4 grid lg:grid-cols-[1.15fr_0.85fr] gap-8">
              <div className="bg-white rounded-3xl p-6 sm:p-8 shadow-soft">
                <SkeletonLoader lines={5} />
              </div>
              <div className="space-y-4">
                {[1, 2, 3].map((i) => (
                  <div key={i} className="bg-white rounded-2xl p-4 border border-slate-100">
                    <SkeletonLoader lines={3} />
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
              <motion.p className="text-sm font-semibold text-primary" {...fadeInUp(0.02)}>
                Nego Harga
              </motion.p>
              <motion.h1 className="text-3xl sm:text-4xl font-semibold text-slate-900" {...fadeInUp(0.04)}>
                Paket Website Mahasiswa: Tugas, Modifikasi, Skripsi/Tugas Akhir
              </motion.h1>
              <motion.p className="text-base sm:text-lg text-slate-600" {...fadeInUp(0.06)}>
                Sampaikan kebutuhan website mahasiswa: tugas mata kuliah, modifikasi atau website custom untuk Skripsi/Tugas Akhir. Kami bantu hitung ruang lingkup dan timeline terbaik untuk mahasiswa. (Tidak meliputi jasa penulisan dokumen akademik.)
              </motion.p>
              <motion.div className="flex flex-wrap justify-center gap-3" {...fadeInUp(0.1)}>
                <a href="#form" className={buttonClassName('primary')}>
                  Mulai Nego Sekarang
                </a>
                <Link to="/schedule" className={buttonClassName('subtle')}>
                  Chat Admin
                </Link>
              </motion.div>
            </motion.div>
          </div>
        </AnimatedSection>

        <AnimatedSection id="form" className="pb-16">
          <div className="max-w-6xl mx-auto px-4 grid lg:grid-cols-[1.15fr_0.85fr] gap-8">
            <motion.div className="bg-white rounded-3xl p-6 sm:p-8 shadow-soft" {...fadeInUp(0)}>
              <h2 className="text-2xl font-semibold text-slate-900 mb-3">Detail Proyek &amp; Anggaran</h2>
              <p className="text-sm text-slate-600 mb-6">
                Tentukan jenis layanan: pembuatan website tugas mata kuliah, modifikasi/custom website, atau website untuk Skripsi/Tugas Akhir. Kami kirim penawaran awal dalam 1–3 jam kerja (WIB).
              </p>
              <form className="grid grid-cols-1 sm:grid-cols-2 gap-4" onSubmit={handleFormSubmit}>
                <motion.div className="sm:col-span-2 flex gap-2 text-xs text-slate-500" {...fadeInUp(0.05)}>
                  <button type="button" className="px-3 py-1 rounded-full bg-primary.light text-primary font-medium">
                    Website Tugas
                  </button>
                  <button type="button" className="px-3 py-1 rounded-full border border-slate-200 text-slate-500">
                    Modifikasi/Custom Website
                  </button>
                  <button type="button" className="px-3 py-1 rounded-full border border-slate-200 text-slate-500">
                    Website Skripsi/Tugas Akhir
                  </button>
                </motion.div>
                <motion.input
                  type="text"
                  placeholder="Nama lengkap"
                  className="px-4 py-3 rounded-xl border border-slate-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none"
                  {...fadeInUp(0.08)}
                  disabled={formLoading}
                />
                <motion.input
                  type="email"
                  placeholder="Email aktif"
                  className="px-4 py-3 rounded-xl border border-slate-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none"
                  {...fadeInUp(0.11)}
                  disabled={formLoading}
                />
                <motion.input
                  type="text"
                  placeholder="Anggaran (contoh: Rp 300K - 500K)"
                  className="px-4 py-3 rounded-xl border border-slate-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none"
                  {...fadeInUp(0.14)}
                  disabled={formLoading}
                />
                <motion.input
                  type="text"
                  placeholder="Deadline (contoh: 3 hari, 1 minggu)"
                  className="px-4 py-3 rounded-xl border border-slate-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none"
                  {...fadeInUp(0.17)}
                  disabled={formLoading}
                />
                <motion.textarea
                  rows="4"
                  placeholder="Ceritakan detail website yang dibutuhkan: fitur apa saja, referensi desain, dan ekspektasi hasil akhir"
                  className="sm:col-span-2 px-4 py-3 rounded-xl border border-slate-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none"
                  {...fadeInUp(0.2)}
                  disabled={formLoading}
                />
                <motion.div className="sm:col-span-2 flex justify-end" {...fadeInUp(0.23)}>
                  <LoadingButton
                    type="submit"
                    loading={formLoading}
                    loadingText="Mengirim Penawaran..."
                    className={buttonClassName('primary')}
                  >
                    Kirim untuk Penawaran
                  </LoadingButton>
                </motion.div>
              </form>
            </motion.div>

            <motion.div className="bg-white rounded-3xl p-6 sm:p-8 border border-slate-100" {...fadeInUp(0.1)}>
              <h3 className="text-xl font-semibold text-slate-900 mb-4">Contoh Estimasi Biaya</h3>
              <ul className="space-y-4 text-sm text-slate-600">
                {[
                  {
                    title: 'Website Tugas Mata Kuliah',
                    range: 'Rp 300K - 500K',
                    features: ['3 halaman inti + form', 'Responsive layout', '3–5 hari kerja'],
                  },
                  {
                    title: 'Modifikasi/Custom Website',
                    range: 'Rp 500K - 1.2JT',
                    features: ['Audit kode + fitur baru', 'Optimasi performa', '7–10 hari kerja'],
                  },
                  {
                    title: 'Website Skripsi/Tugas Akhir',
                    range: 'Rp 2.5JT - 5JT',
                    features: ['Portal presentasi lengkap', 'Fitur sesuai rubrik', '2–4 minggu'],
                  },
                ].map((item, index) => (
                  <motion.li
                    key={item.title}
                    className={`p-4 rounded-2xl border border-slate-100 ${textHover}`}
                    {...fadeInUp(0.05 * (index + 1))}
                    whileHover={{ scale: 1.02, transition: { duration: 0.2 } }}
                  >
                    <p className="font-semibold text-slate-900 mb-1">{item.title}</p>
                    <p className="text-primary font-semibold mb-2">{item.range}</p>
                    <ul className="space-y-1 text-xs text-slate-600">
                      {item.features.map((feature) => (
                        <li key={feature} className="flex items-start gap-2">
                          <span className="mt-0.5 text-primary">•</span>
                          <span>{feature}</span>
                        </li>
                      ))}
                    </ul>
                  </motion.li>
                ))}
              </ul>
              <motion.div className="mt-6 p-4 bg-primary.light rounded-2xl" {...fadeInUp(0.3)}>
                <p className="text-sm font-semibold text-primary mb-1">💡 Tips Hemat</p>
                <p className="text-xs text-slate-600">Estimasi di atas adalah harga dasar. Kami bisa nego berdasarkan kompleksitas proyek dan timeline yang diinginkan.</p>
              </motion.div>
            </motion.div>
          </div>
        </AnimatedSection>
      </main>
    </PageTransition>
  );
};

export default PricingPage;
