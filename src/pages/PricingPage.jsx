import { Link } from 'react-router-dom';
import { motion } from 'framer-motion';
import AnimatedSection from '../components/AnimatedSection';
import { fadeInUp, scaleUp } from '../utils/animations';
import { buttonClassName, sectionVariants } from '../utils/styles';

const PricingPage = () => (
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
          <form className="grid grid-cols-1 sm:grid-cols-2 gap-4">
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
            <motion.select className="px-4 py-3 rounded-xl border border-slate-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none" {...fadeInUp(0.07)}>
              <option value="">Pilih Jenis Layanan</option>
              <option value="tugas">Website Tugas Mata Kuliah</option>
              <option value="modifikasi">Modifikasi/Custom Website</option>
              <option value="proyek">Website Skripsi/Tugas Akhir</option>
            </motion.select>
            <motion.input type="text" placeholder="Nama lengkap" className="px-4 py-3 rounded-xl border border-slate-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none" {...fadeInUp(0.1)} />
            <motion.input type="email" placeholder="Email kampus atau aktif" className="px-4 py-3 rounded-xl border border-slate-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none" {...fadeInUp(0.13)} />
            <motion.input type="text" placeholder="Nomor WhatsApp" className="px-4 py-3 rounded-xl border border-slate-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none" {...fadeInUp(0.16)} />
            <motion.input type="text" placeholder="Judul/Topik Proyek" className="px-4 py-3 rounded-xl border border-slate-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none" {...fadeInUp(0.19)} />
            <motion.textarea rows="4" placeholder="Deskripsi singkat: tujuan website, fitur utama (mis. landing page, katalog, dashboard), ekspektasi dosen, dan deadline" className="sm:col-span-2 px-4 py-3 rounded-xl border border-slate-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none" {...fadeInUp(0.22)} />
            <motion.div className="sm:col-span-2" {...fadeInUp(0.25)}>
              <p className="text-sm font-medium text-slate-700 mb-3">Skop Pekerjaan</p>
              <div className="grid xs:grid-cols-2 sm:grid-cols-3 gap-2 text-sm">
                {[
                  'Desain UI Sederhana',
                  'Basis Data',
                  'Fitur Dinamis',
                  'Dokumentasi Website',
                  'Bantuan Revisi Website',
                ].map((item) => (
                  <label key={item} className="flex items-center gap-2 px-3 py-2 rounded-xl border border-slate-200 text-slate-600">
                    <input type="checkbox" className="accent-primary" />
                    <span>{item}</span>
                  </label>
                ))}
              </div>
            </motion.div>
            <motion.div className="sm:col-span-2 grid sm:grid-cols-2 gap-4" {...fadeInUp(0.3)}>
              <div>
                <p className="text-sm font-medium text-slate-700 mb-2">Anggaran &amp; Timeline</p>
                <input type="text" placeholder="contoh: 1.500.000" className="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none" />
              </div>
              <div className="pt-6 sm:pt-8">
                <input type="text" placeholder="contoh: 14 hari" className="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none" />
              </div>
            </motion.div>
            <motion.div className="sm:col-span-2 flex flex-wrap gap-3 pt-2" {...fadeInUp(0.35)}>
              <button type="button" className={buttonClassName('subtle')}>
                Lampirkan Brief / Rubrik
              </button>
              <button type="submit" className={buttonClassName('primary')}>
                Ajukan Nego
              </button>
            </motion.div>
          </form>
        </motion.div>
        <motion.div className="space-y-6" {...fadeInUp(0.05)}>
          <motion.div className="bg-white rounded-3xl p-6 sm:p-8 border border-slate-100" {...fadeInUp(0.1)}>
            <h3 className="text-lg font-semibold text-slate-900 mb-4">Ringkasan Penawaran Mahasiswa</h3>
            <ul className="space-y-4 text-sm text-slate-600">
              {[
                ['Tipe layanan', 'Tugas / Modifikasi / Proyek Kampus'],
                ['Skop Awal', 'UI responsif, integrasi fitur, dokumentasi website'],
                ['Estimasi Waktu', '5–21 hari'],
                ['Jaminan Revisi', '2x revisi besar'],
                ['Catatan Layanan', 'Website mahasiswa saja, tanpa penulisan dokumen akademik'],
                ['Skema Pembayaran', 'DP 20% + Pelunasan'],
              ].map(([label, value]) => (
                <li key={label} className="flex justify-between">
                  <span className="text-slate-500">{label}</span>
                  <span className="font-medium text-slate-800">{value}</span>
                </li>
              ))}
            </ul>
            <div className="pt-6">
              <p className="text-sm font-medium text-slate-700 mb-3">Preferensi Komunikasi</p>
              <div className="flex flex-wrap gap-2 text-sm">
                <span className="px-3 py-1 rounded-full bg-primary.light text-primary font-medium">WhatsApp</span>
                <span className="px-3 py-1 rounded-full border border-slate-200 text-slate-600">Email</span>
                <span className="px-3 py-1 rounded-full border border-slate-200 text-slate-600">Google Meet</span>
              </div>
            </div>
            <div className="mt-6 p-4 rounded-2xl bg-primary.light text-sm text-slate-700">
              <p className="font-semibold text-slate-900 mb-1">Langkah Berikutnya</p>
              <p>Tim kami akan menghubungi dalam 1x24 jam. Fokus kami pada pembuatan website mahasiswa, jadi siapkan rubrik atau struktur tugasmu ya.</p>
            </div>
            <div className="mt-4 flex flex-col gap-3">
              <Link to="/schedule" className={buttonClassName('outline', 'text-center')}>
                Jadwalkan Diskusi
              </Link>
              <a href="#form" className={buttonClassName('primary', 'text-center')}>
                Minta Draft Penawaran
              </a>
            </div>
          </motion.div>
        </motion.div>
      </div>
    </AnimatedSection>

    <AnimatedSection className="bg-white py-16">
      <div className="max-w-6xl mx-auto px-4">
        <motion.div className="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-10" {...fadeInUp(0)}>
          <div>
            <h2 className="text-2xl font-semibold text-slate-900">Paket Website Mahasiswa</h2>
            <p className="text-sm text-slate-600">Gunakan paket berikut sebagai acuan. Semuanya bisa disesuaikan dengan rubrik dan kebutuhan revisi websitemu.</p>
          </div>
          <a href="#form" className={buttonClassName('subtle')}>
            Lihat Paket Lain
          </a>
        </motion.div>
        <div className="grid md:grid-cols-3 gap-6">
          {[
            {
              title: 'Paket Tugas Mata Kuliah',
              description: 'Landing page + halaman fitur sesuai rubrik penilaian.',
              price: 'Rp300000',
              href: '#form',
              cta: 'Ajukan Paket Tugas',
              variant: 'light',
            },
            {
              title: 'Paket Modifikasi Website',
              description: 'Optimasi performa, perbaikan bug, dan tambahan fitur ringan.',
              price: 'Rp500000',
              href: '#form',
              cta: 'Estimasi Modifikasi & Custom Untuk Skripsi/Tugas Akhir',
              variant: 'primary',
            },
            {
              title: 'Paket Proyek Skripsi/Tugas Akhir',
              description: 'Sesuaikan Dengan Kebutuhanmu dan Full Revisi',
              price: 'Rp2.500.000',
              href: '#form',
              cta: 'Booking Paket Proyek',
              variant: 'light',
            },
          ].map((card, index) => (
            <motion.div
              key={card.title}
              className={`rounded-3xl border border-slate-100 p-6 ${card.variant === 'light' ? 'bg-primary.light/50' : 'bg-white shadow-soft'}`}
              {...scaleUp(0.05 * index)}
            >
              <p className="text-sm font-semibold text-primary mb-3">{card.title}</p>
              <p className="text-sm text-slate-600 mb-4">{card.description}</p>
              <p className="text-xs text-slate-500 mb-2">Estimasi Mulai Dari</p>
              <p className="text-lg font-semibold text-slate-900">{card.price}</p>
              <a href={card.href} className={buttonClassName('primary', 'mt-6')}>
                {card.cta}
              </a>
            </motion.div>
          ))}
        </div>
      </div>
    </AnimatedSection>

    <AnimatedSection className="py-16">
      <motion.div className={`${sectionVariants.hero} bg-primary.light text-center`} {...scaleUp(0)}>
        <h2 className="text-2xl font-semibold text-slate-900 mb-3">Tidak yakin anggarannya?</h2>
        <p className="text-sm text-slate-600 mb-6">Kirim brief websitemu dan kami rekomendasikan skop optimal sesuai budget-mu.</p>
        <div className="flex flex-wrap justify-center gap-3">
          <a href="#form" className={buttonClassName('outline')}>
            Unggah Brief Website
          </a>
          <Link to="/schedule" className={buttonClassName('primary')}>
            Rekomendasi Layanan
          </Link>
        </div>
      </motion.div>
    </AnimatedSection>
  </main>
);

export default PricingPage;
