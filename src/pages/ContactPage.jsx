import { Link } from 'react-router-dom';
import { motion } from 'framer-motion';
import AnimatedSection from '../components/AnimatedSection';
import { fadeInUp, fadeIn, scaleUp } from '../utils/animations';
import { buttonClassName, sectionVariants } from '../utils/styles';

const contactChannels = [
  {
    label: 'Email',
    value: 'hello@syntaxtrus.com',
  },
  {
    label: 'WhatsApp',
    value: '+62 812-3456-7890',
  },
  {
    label: 'Jam Operasional',
    value: 'Senin–Jumat, 09.00-18.00 WIB',
  },
];

const ContactPage = () => (
  <main>
    <AnimatedSection className="py-16">
      <div className="max-w-5xl mx-auto px-4">
        <motion.div className={`${sectionVariants.hero} text-center space-y-6`} {...fadeInUp(0)}>
          <motion.h1 className="text-3xl sm:text-4xl font-semibold text-slate-900" {...fadeInUp(0.02)}>
            Hubungi Syntaxtrus
          </motion.h1>
          <motion.p className="text-base sm:text-lg text-slate-600" {...fadeInUp(0.04)}>
            Kami fokus pada pembuatan website mahasiswa: tugas mata kuliah, modifikasi & website custom, serta Skripsi/Tugas Akhir. Kirim pesan cepat atau pilih kanal yang paling nyaman untukmu. (Tidak termasuk jasa penulisan dokumen akademik.)
          </motion.p>
          <motion.div className="flex flex-wrap justify-center gap-3" {...fadeInUp(0.08)}>
            <a href="#form" className={buttonClassName('primary')}>
              Kirim Pesan
            </a>
            <Link to="/schedule" className={buttonClassName('subtle')}>
              Jadwalkan Konsultasi
            </Link>
          </motion.div>
        </motion.div>
      </div>
    </AnimatedSection>

    <AnimatedSection id="form" className="pb-16">
      <div className="max-w-6xl mx-auto px-4 grid lg:grid-cols-[1.15fr_0.85fr] gap-8">
        <motion.div className="bg-white rounded-3xl p-6 sm:p-8 shadow-soft" {...fadeInUp(0)}>
          <h2 className="text-2xl font-semibold text-slate-900 mb-6">Formulir Kontak</h2>
          <form className="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <motion.input type="text" placeholder="Nama lengkap" className="px-4 py-3 rounded-xl border border-slate-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none" {...fadeInUp(0.05)} />
            <motion.input type="email" placeholder="Email" className="px-4 py-3 rounded-xl border border-slate-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none" {...fadeInUp(0.08)} />
            <motion.input type="text" placeholder="Nomor WhatsApp" className="px-4 py-3 rounded-xl border border-slate-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none" {...fadeInUp(0.11)} />
            <motion.input type="text" placeholder="Topik (Website Tugas, Modifikasi, Proyek Kampus, Custom)" className="px-4 py-3 rounded-xl border border-slate-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none" {...fadeInUp(0.14)} />
            <motion.textarea rows="4" placeholder="Tulis pesanmu di sini: kebutuhan website, deadline, dan referensi" className="sm:col-span-2 px-4 py-3 rounded-xl border border-slate-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none" {...fadeInUp(0.17)} />
            <motion.div className="sm:col-span-2 flex flex-wrap gap-3" {...fadeInUp(0.2)}>
              <button type="button" className={buttonClassName('subtle')}>
                Lampirkan Brief
              </button>
              <button type="submit" className={buttonClassName('primary')}>
                Kirim Pesan
              </button>
            </motion.div>
          </form>
        </motion.div>
        <div className="space-y-6">
          <motion.div className="bg-white rounded-3xl p-6 sm:p-8 border border-slate-100" {...fadeInUp(0.05)}>
            <h3 className="text-lg font-semibold text-slate-900 mb-4">Kontak Langsung</h3>
            <ul className="space-y-3 text-sm text-slate-600">
              {contactChannels.map((channel) => (
                <li key={channel.label}>
                  <span className="text-slate-500">{channel.label}</span>
                  <br />
                  <strong className="text-slate-900">{channel.value}</strong>
                </li>
              ))}
              <li className="text-xs text-slate-500">Diskon Mahasiswa Aktif • Balasan cepat via WhatsApp</li>
            </ul>
            <a
              href="https://wa.me/6281234567890"
              className="mt-6 inline-flex items-center justify-center px-4 py-2 text-sm font-semibold text-white bg-primary rounded-full shadow-soft"
              target="_blank"
              rel="noopener noreferrer"
            >
              Chat Sekarang
            </a>
          </motion.div>
          <motion.div className="bg-white rounded-3xl p-6 sm:p-8 border border-slate-100" {...fadeInUp(0.08)}>
            <h3 className="text-lg font-semibold text-slate-900 mb-4">Kantor &amp; Lokasi</h3>
            <div className="grid sm:grid-cols-3 gap-4 text-sm text-slate-600">
              <div>
                <p className="text-slate-500">Alamat</p>
                <p className="font-medium text-slate-900">Jl. Rekomendasi No. 12, Bandung, Jawa Barat</p>
                <p className="text-xs text-slate-500 mt-2">Janji temu sesuai jadwal</p>
              </div>
              <div>
                <p className="text-slate-500">Email &amp; Dukungan</p>
                <p className="font-medium text-slate-900">support@syntaxtrus.com</p>
                <p className="text-xs text-slate-500 mt-2">Respons 24 jam kerja</p>
              </div>
              <div>
                <p className="text-slate-500">Media Sosial</p>
                <p className="font-medium text-slate-900">Instagram, LinkedIn, GitHub</p>
                <a href="#" className="mt-2 inline-flex items-center text-primary text-sm font-semibold">
                  Kunjungi Profil
                </a>
              </div>
            </div>
            <div className="mt-6 bg-primary.light rounded-2xl overflow-hidden">
              <img
                src="https://maps.googleapis.com/maps/api/staticmap?center=Bandung&zoom=13&size=640x320&maptype=roadmap&markers=color:blue%7CBandung"
                alt="Peta lokasi Bandung"
                className="w-full h-48 object-cover"
                loading="lazy"
              />
            </div>
          </motion.div>
        </div>
      </div>
    </AnimatedSection>

    <AnimatedSection className="py-16">
      <motion.div className="max-w-5xl mx-auto px-4 text-center bg-white rounded-3xl p-6 sm:p-10 shadow-soft" {...scaleUp(0)}>
        <p className="text-sm font-semibold text-primary mb-2">Butuh jawaban cepat?</p>
        <h2 className="text-2xl font-semibold text-slate-900 mb-4">
          Kirim pesan singkat atau chat WhatsApp. Kami bantu pilih paket website tugas, modifikasi/custom, atau proyek kampus.
        </h2>
        <div className="flex flex-wrap justify-center gap-3">
          <a href="https://wa.me/6281234567890" target="_blank" rel="noopener noreferrer" className={buttonClassName('outline')}>
            Chat Sekarang
          </a>
          <Link to="/schedule" className={buttonClassName('primary')}>
            Jadwalkan Pengajuan
          </Link>
        </div>
      </motion.div>
    </AnimatedSection>
  </main>
);

export default ContactPage;
