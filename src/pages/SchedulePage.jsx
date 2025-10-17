import { Link } from 'react-router-dom';
import { motion } from 'framer-motion';
import ScheduleBooking from '../components/ScheduleBooking';
import AnimatedSection from '../components/AnimatedSection';
import { fadeInUp, scaleUp } from '../utils/animations';
import { buttonClassName, sectionVariants } from '../utils/styles';

const faqs = [
  {
    question: 'Bisakah reschedule jadwal?',
    answer: 'Bisa. Hubungi kami maksimal 12 jam sebelumnya via WhatsApp agar slot baru dapat kami siapkan.',
  },
  {
    question: 'Apakah tersedia meeting offline?',
    answer: 'Saat ini konsultasi dilakukan online via WhatsApp/Google Meet. Meeting tatap muka bisa diajukan untuk paket proyek.',
  },
  {
    question: 'Berapa lama sesi berjalan?',
    answer: 'Durasi standar 15 menit. Jika butuh sesi lanjutan, akan kami jadwalkan kembali setelah review kebutuhan.',
  },
];

const SchedulePage = () => (
  <main>
    <AnimatedSection className="py-16">
      <div className="max-w-5xl mx-auto text-center px-4">
        <motion.p className="text-sm font-semibold text-primary mb-3" {...fadeInUp(0)}>
          Konsultasi Gratis
        </motion.p>
        <motion.h1 className="text-3xl sm:text-4xl font-semibold text-slate-900 mb-4" {...fadeInUp(0.05)}>
          Jadwalkan Sesi 15 Menit
        </motion.h1>
        <motion.p className="text-base sm:text-lg text-slate-600 mb-8" {...fadeInUp(0.1)}>
          Pilih tanggal dan jam, lalu isi detail singkat website tugas, modifikasi/custom, atau Skripsi/Tugas Akhir. Kami akan menghubungi via WhatsApp atau email untuk konfirmasi.
        </motion.p>
        <motion.div className="flex flex-wrap justify-center gap-3" {...fadeInUp(0.15)}>
          <a href="#schedule" className={buttonClassName('primary')}>
            Pilih Jadwal
          </a>
          <a href="https://wa.me/6281234567890" target="_blank" rel="noopener noreferrer" className={buttonClassName('subtle')}>
            Chat Cepat WhatsApp
          </a>
        </motion.div>
      </div>
    </AnimatedSection>

    <AnimatedSection id="schedule" className="pb-16">
      <div className="max-w-6xl mx-auto px-4">
        <motion.div {...fadeInUp(0)}>
          <ScheduleBooking />
        </motion.div>
      </div>
    </AnimatedSection>

    <AnimatedSection className="py-16 bg-white">
      <div className="max-w-5xl mx-auto px-4">
        <motion.div className="mb-6" {...fadeInUp(0)}>
          <h2 className="text-2xl font-semibold text-slate-900">Apa yang Kamu Dapatkan</h2>
          <p className="text-sm text-slate-600">
            Setelah konfirmasi, kami kirim pengingat otomatis dan opsi meeting link. Catatan: seluruh layanan berfokus pada pembuatan website mahasiswa (tugas, modifikasi/custom, proyek kampus) tanpa penulisan dokumen akademik.
          </p>
        </motion.div>
        <motion.div className="bg-primary.light rounded-3xl p-6 sm:p-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between" {...scaleUp(0.05)}>
          <div>
            <p className="text-sm font-semibold text-primary">Reminder &amp; Ringkasan</p>
            <p className="text-sm text-slate-700">Notifikasi 1 jam sebelum sesi + ringkasan kebutuhanmu ke email/WhatsApp.</p>
          </div>
          <a href="mailto:hello@syntaxtrus.com" className="px-4 py-2 text-sm font-semibold text-white bg-primary rounded-full shadow-soft">
            Kirim ke Email
          </a>
        </motion.div>
      </div>
    </AnimatedSection>

    <AnimatedSection className="py-16">
      <motion.div className={`${sectionVariants.hero} text-center`} {...scaleUp(0)}>
        <p className="text-sm font-semibold text-primary mb-2">Butuh saran paket cepat?</p>
        <h2 className="text-2xl font-semibold text-slate-900 mb-4">Kirim dokumen tugasmu, kami estimasi waktu &amp; biaya secara gratis.</h2>
        <div className="flex flex-wrap justify-center gap-3">
          <Link to="/schedule" className={buttonClassName('outline')}>
            Unggah Brief
          </Link>
          <Link to="/pricing" className={buttonClassName('primary')}>
            Minta Rekomendasi
          </Link>
        </div>
      </motion.div>
    </AnimatedSection>

    <AnimatedSection className="py-12">
      <div className="max-w-5xl mx-auto px-4">
        <motion.div className="space-y-4" {...fadeInUp(0)}>
          <h2 className="text-2xl font-semibold text-slate-900">Pertanyaan yang Sering Diajukan</h2>
          <div className="divide-y divide-slate-200 rounded-3xl border border-slate-200 bg-white">
            {faqs.map((item, index) => (
              <motion.details key={item.question} className="group p-4 sm:p-6" {...fadeInUp(0.05 * index)}>
                <summary className="flex cursor-pointer items-center justify-between gap-4 text-sm font-semibold text-slate-900">
                  {item.question}
                  <span className="text-primary transition-transform duration-200 group-open:rotate-45">+</span>
                </summary>
                <p className="pt-3 text-sm text-slate-600">{item.answer}</p>
              </motion.details>
            ))}
          </div>
        </motion.div>
      </div>
    </AnimatedSection>
  </main>
);

export default SchedulePage;
