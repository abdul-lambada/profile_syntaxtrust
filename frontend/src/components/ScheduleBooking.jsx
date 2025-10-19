import { useMemo, useState } from 'react';

const dayLabels = ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'];
const monthLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

const generateUpcomingDateLabels = (length = 7) => {
  const today = new Date();
  return Array.from({ length }, (_, index) => {
    const current = new Date(today);
    current.setDate(today.getDate() + index);
    const day = dayLabels[current.getDay()];
    const date = current.getDate().toString().padStart(2, '0');
    const month = monthLabels[current.getMonth()];
    return `${day} ${date} ${month}`;
  });
};

const defaultDates = generateUpcomingDateLabels();
const defaultTimes = ['09:00', '10:30', '13:00', '13:30', '15:30', '16:00', '16:30', '17:00', '17:30', '18:00', '18:30', '19:00'];

const ScheduleBooking = ({ dates, times }) => {
  const dateOptions = useMemo(() => (Array.isArray(dates) && dates.length ? dates : defaultDates), [dates]);
  const timeOptions = useMemo(() => (Array.isArray(times) && times.length ? times : defaultTimes), [times]);

  const [selectedDate, setSelectedDate] = useState(dateOptions[0] || '');
  const [selectedTime, setSelectedTime] = useState(timeOptions[0] || '');

  const baseDateClasses = 'px-4 py-2 rounded-full text-sm font-semibold border transition';
  const baseTimeClasses = 'px-4 py-3 rounded-xl text-sm font-semibold border transition';

  return (
    <div className="max-w-6xl mx-auto px-4 grid lg:grid-cols-[1.15fr_0.85fr] gap-8">
      <div data-animate data-animate-delay="0" className="bg-white rounded-3xl p-6 sm:p-8 shadow-soft space-y-6">
        <div>
          <h2 className="text-2xl font-semibold text-slate-900 mb-2">Langkah 1: Pilih Tanggal &amp; Jam</h2>
          <p className="text-sm text-slate-600">Slot tersedia minggu ini. Semua waktu dalam WIB.</p>
        </div>
        <div className="space-y-4">
          <div className="flex flex-wrap gap-2">
            {dateOptions.map((date) => {
              const isActive = date === selectedDate;
              const activeClasses = 'bg-primary text-white border-transparent shadow-md';
              const inactiveClasses = 'bg-white text-slate-600 border-slate-200 shadow-none';
              return (
                <button
                  key={date}
                  type="button"
                  className={`${baseDateClasses} ${isActive ? activeClasses : inactiveClasses}`}
                  aria-pressed={isActive}
                  onClick={() => setSelectedDate(date)}
                >
                  {date}
                </button>
              );
            })}
          </div>
          <div className="grid gap-2 sm:grid-cols-2 lg:grid-cols-3">
            {timeOptions.map((time) => {
              const isActive = time === selectedTime;
              const activeClasses = 'border-primary text-primary bg-primary.light shadow-sm';
              const inactiveClasses = 'border-slate-200 text-slate-600 bg-white shadow-none';
              return (
                <button
                  key={time}
                  type="button"
                  className={`${baseTimeClasses} ${isActive ? activeClasses : inactiveClasses}`}
                  aria-pressed={isActive}
                  onClick={() => setSelectedTime(time)}
                >
                  {time}
                </button>
              );
            })}
          </div>
          <div className="grid sm:grid-cols-2 gap-4">
            <div className="p-4 rounded-2xl bg-primary.light/70">
              <p className="text-xs text-primary font-semibold mb-1">Catatan Slot</p>
              <p className="text-sm text-slate-700">Konfirmasi dikirim maksimal 2 jam setelah kamu pilih waktu.</p>
            </div>
            <div className="p-4 rounded-2xl border border-slate-100">
              <p className="text-xs text-primary font-semibold mb-1">Preferensi Lain?</p>
              <p className="text-sm text-slate-700">Cantumkan di form jika kamu butuh timing khusus atau meeting malam.</p>
            </div>
          </div>
        </div>
      </div>
      <div className="space-y-6">
        <div data-animate data-animate-delay="150" className="bg-white rounded-3xl p-6 sm:p-8 border border-slate-100">
          <h3 className="text-lg font-semibold text-slate-900 mb-4">Ringkasan</h3>
          <ul className="space-y-3 text-sm text-slate-600 mb-6">
            <li className="flex justify-between"><span>Tipe Sesi</span><span className="font-medium text-slate-800">Konsultasi Gratis (15m)</span></li>
            <li className="flex justify-between"><span>Platform</span><span className="font-medium text-slate-800">WhatsApp / Google Meet</span></li>
            <li className="flex justify-between"><span>Tanggal Pilihan</span><span className="font-medium text-slate-800">{selectedDate}</span></li>
            <li className="flex justify-between"><span>Jam Pilihan</span><span className="font-medium text-slate-800">{selectedTime}</span></li>
            <li className="flex justify-between"><span>Zona Waktu</span><span className="font-medium text-slate-800">WIB (GMT+7)</span></li>
            <li className="flex justify-between"><span>Biaya</span><span className="font-medium text-primary">Rp0</span></li>
          </ul>
          <h4 className="text-sm font-semibold text-slate-800 mb-3">Data Kontak</h4>
          <form className="space-y-3">
            <input type="hidden" name="selected_date" value={selectedDate} />
            <input type="hidden" name="selected_time" value={selectedTime} />
            <input
              type="text"
              placeholder="Nama lengkap"
              className="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-primary focus:ring-2 focus:ring-primary/15 outline-none"
            />
            <input
              type="email"
              placeholder="Email"
              className="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-primary focus:ring-2 focus:ring-primary/15 outline-none"
            />
            <input
              type="text"
              placeholder="Nomor WhatsApp"
              className="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-primary focus:ring-2 focus:ring-primary/15 outline-none"
            />
            <textarea
              rows="3"
              placeholder="Tujuan konsultasi: website tugas, modifikasi/custom, atau proyek kampus; sertakan deadline & referensi"
              className="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-primary focus:ring-2 focus:ring-primary/15 outline-none"
            />
            <div className="flex flex-wrap gap-3 pt-2">
              <button type="button" className="px-4 py-2 text-sm font-semibold text-primary bg-primary.light rounded-full">
                Lampirkan Brief
              </button>
              <button type="submit" className="px-5 py-3 text-sm font-semibold text-white bg-primary rounded-full shadow-soft">
                Konfirmasi Jadwal
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  );
};

export default ScheduleBooking;
