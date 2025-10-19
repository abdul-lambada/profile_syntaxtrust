<?php
/**
 * Profile Syntaxtrust - Database Setup Script
 * Run this script to initialize the database with sample data
 */

// Include configuration
require_once '../config.php';
require_once '../app/core/Database.php';

echo "Setting up Profile Syntaxtrust database...\n";

try {
    $db = Database::getInstance();

    // Create sample service categories
    echo "Creating service categories...\n";
    $categories = [
        ['Website Tugas Mata Kuliah', 'Pembuatan website untuk tugas mata kuliah sesuai rubrik dosen', 'website-tugas', 1],
        ['Modifikasi Website', 'Perbaikan dan pengembangan website yang sudah ada', 'modifikasi-website', 2],
        ['Website Skripsi/Tugas Akhir', 'Pembuatan website untuk presentasi skripsi atau tugas akhir', 'website-skripsi', 3]
    ];

    foreach ($categories as $category) {
        $db->insert('service_categories', [
            'name' => $category[0],
            'description' => $category[1],
            'slug' => $category[2],
            'sort_order' => $category[3]
        ]);
    }

    // Create sample services
    echo "Creating services...\n";
    $services = [
        [1, 'Website Tugas Mata Kuliah', 'Bangun landing page dan halaman fitur sesuai rubrik dosen',
         '["Mapping rubrik dosen", "UI responsif", "Form integrasi", "Dokumentasi lengkap"]', 'code', 'website-tugas-kuliah', 1, true],
        [2, 'Modifikasi Website Mahasiswa', 'Optimasi proyek berjalan atau bangun website custom untuk Skripsi/Tugas Akhir',
         '["Audit kode", "Perbaikan bug", "Fitur tambahan", "Optimasi performa"]', 'wrench', 'modifikasi-website', 2, true],
        [3, 'Website Skripsi/Tugas Akhir', 'Buat portal presentasi untuk Skripsi/Tugas Akhir',
         '["Portal presentasi", "Fitur sesuai rubrik", "Demo siap", "Handover lengkap"]', 'graduation-cap', 'website-skripsi', 3, true]
    ];

    foreach ($services as $service) {
        $db->insert('services', [
            'category_id' => $service[0],
            'name' => $service[1],
            'description' => $service[2],
            'features' => $service[3],
            'icon' => $service[4],
            'slug' => $service[5],
            'sort_order' => $service[6],
            'is_featured' => $service[7]
        ]);
    }

    // Create sample pricing packages
    echo "Creating pricing packages...\n";
    $packages = [
        [1, 'Paket Basic Tugas', 'Website sederhana sesuai rubrik dasar', 300000, 500000,
         '["3 halaman inti", "Responsive layout", "Form kontak", "Dokumentasi"]', '3-5 hari', 'basic', false],
        [1, 'Paket Standard Tugas', 'Website lengkap dengan fitur sesuai rubrik', 500000, 800000,
         '["5+ halaman", "UI/UX design", "Database integration", "Demo session"]', '1 minggu', 'standard', true],
        [2, 'Paket Modifikasi', 'Perbaikan dan pengembangan website existing', 500000, 1200000,
         '["Code audit", "Bug fixes", "Feature addition", "Performance optimization"]', '1-2 minggu', 'standard', false],
        [3, 'Paket Skripsi Premium', 'Website lengkap untuk presentasi skripsi', 2500000, 5000000,
         '["Portal presentasi", "Admin dashboard", "API integration", "Full documentation"]', '2-4 minggu', 'premium', true]
    ];

    foreach ($packages as $package) {
        $db->insert('pricing_packages', [
            'service_id' => $package[0],
            'name' => $package[1],
            'description' => $package[2],
            'price_min' => $package[3],
            'price_max' => $package[4],
            'features' => $package[5],
            'duration' => $package[6],
            'package_type' => $package[7],
            'is_popular' => $package[8]
        ]);
    }

    // Create sample portfolio items
    echo "Creating portfolio items...\n";
    $portfolio = [
        [1, 'Platform Evaluasi Mata Kuliah', 'Mengubah rubrik penilaian dosen menjadi halaman informasi, form, dan dokumentasi tugas mingguan.',
         'Kompleksitas dalam mapping rubrik', 'UI yang sesuai dengan ekspektasi dosen', 'Presentasi berhasil dengan nilai excellent',
         'Rizky Ananta', 'Tugas Mata Kuliah', '2024-01-15', null, 'completed', 'platform-evaluasi-kuliah', 1, true],
        [2, 'Modifikasi Website Skripsi Informatika', 'Refactor project eksisting: perbaikan bug, integrasi API jadwal, dan optimasi performa sebelum demo.',
         'Kode lama yang perlu dioptimasi', 'Refactor menyeluruh dengan best practices', 'Demo berjalan smooth tanpa lag',
         'Bangun Aditya', 'Skripsi Informatika', '2024-02-20', null, 'completed', 'modifikasi-website-skripsi', 2, true]
    ];

    foreach ($portfolio as $item) {
        $db->insert('portfolio_items', [
            'service_id' => $item[0],
            'title' => $item[1],
            'description' => $item[2],
            'challenge' => $item[3],
            'solution' => $item[4],
            'results' => $item[5],
            'client_name' => $item[6],
            'project_type' => $item[7],
            'project_date' => $item[8],
            'project_url' => $item[9],
            'status' => $item[10],
            'slug' => $item[11],
            'sort_order' => $item[12],
            'is_featured' => $item[13]
        ]);
    }

    // Create sample testimonials
    echo "Creating testimonials...\n";
    $testimonials = [
        ['Rizky Ananta', 'S1 Informatika', 'Rubrik dosen diterjemahkan jadi fitur jelas. Presentasi jadi mulus karena website-nya gampang dipahami.', 5, 'Website Tugas', true],
        ['Bangun Aditya', 'S2 Manajemen', 'Timeline pengerjaan sesuai target. Slide dan handover lengkap, jadi tinggal fokus ke sidang.', 5, 'Website Skripsi', true],
        ['Salsa Putri', 'Portofolio UI Designer', 'Case study-nya ditata rapi, recruiter langsung bisa lihat proses dan hasilnya.', 5, 'Portfolio Website', true]
    ];

    foreach ($testimonials as $testimonial) {
        $db->insert('testimonials', [
            'client_name' => $testimonial[0],
            'client_company' => $testimonial[1],
            'testimonial' => $testimonial[2],
            'rating' => $testimonial[3],
            'project_type' => $testimonial[4],
            'is_featured' => $testimonial[5]
        ]);
    }

    // Create sample FAQs
    echo "Creating FAQs...\n";
    $faqs = [
        [1, 'Bisakah reschedule jadwal?', 'Bisa. Hubungi kami maksimal 12 jam sebelumnya via WhatsApp agar slot baru dapat kami siapkan.', 1],
        [1, 'Apakah tersedia meeting offline?', 'Saat ini konsultasi dilakukan online via WhatsApp/Google Meet. Meeting tatap muka bisa diajukan untuk paket proyek.', 2],
        [1, 'Berapa lama sesi berjalan?', 'Durasi standar 15 menit. Jika butuh sesi lanjutan, akan kami jadwalkan kembali setelah review kebutuhan.', 3],
        [1, 'Apakah ada garansi revisi?', 'Ya, setiap paket memiliki garansi revisi sesuai dengan kesepakatan awal.', 4]
    ];

    foreach ($faqs as $faq) {
        $db->insert('faqs', [
            'category_id' => $faq[0],
            'question' => $faq[1],
            'answer' => $faq[2],
            'sort_order' => $faq[3]
        ]);
    }

    echo "✅ Database setup completed successfully!\n";
    echo "📊 Summary:\n";
    echo "   • Service Categories: " . $db->count('service_categories') . "\n";
    echo "   • Services: " . $db->count('services') . "\n";
    echo "   • Pricing Packages: " . $db->count('pricing_packages') . "\n";
    echo "   • Portfolio Items: " . $db->count('portfolio_items') . "\n";
    echo "   • Testimonials: " . $db->count('testimonials') . "\n";
    echo "   • FAQs: " . $db->count('faqs') . "\n";

} catch (Exception $e) {
    echo "❌ Error setting up database: " . $e->getMessage() . "\n";
    exit(1);
}
