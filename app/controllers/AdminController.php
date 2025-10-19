<?php
/**
 * Profile Syntaxtrust - Admin Dashboard Controller
 * Handles admin dashboard and CRUD operations
 */

class AdminController extends Controller {
    public function __construct() {
        parent::__construct();
        $this->requireAdmin();
    }

    public function dashboard() {
        $adminModel = new Admin();
        $serviceModel = new Service();
        $bookingModel = new Booking();
        $contactModel = new ContactMessage();

        // Get dashboard statistics
        $stats = $adminModel->getDashboardStats();

        // Get recent activity
        $recentActivity = $adminModel->getRecentActivity(8);

        // Get services summary
        $services = $serviceModel->findAll([], 'created_at DESC', 5);

        // Get pending bookings
        $pendingBookings = $bookingModel->findAll(['status' => 'pending'], 'created_at DESC', 5);

        // Get new messages
        $newMessages = $contactModel->getByStatus('new', 5);

        $this->set([
            'page_title' => 'Dashboard Admin - ' . APP_NAME,
            'stats' => $stats,
            'recent_activity' => $recentActivity,
            'services' => $services,
            'pending_bookings' => $pendingBookings,
            'new_messages' => $newMessages
        ]);

        $this->render('admin/dashboard', 'admin');
    }

    public function services() {
        $serviceModel = new Service();

        $services = $serviceModel->findAll([], 'created_at DESC');
        $categories = $this->db->getServiceCategories();

        $this->set([
            'page_title' => 'Kelola Layanan - ' . APP_NAME,
            'services' => $services,
            'categories' => $categories
        ]);

        $this->render('admin/services/index', 'admin');
    }

    public function createService() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('admin/services');
        }

        $serviceModel = new Service();

        // Validate required fields
        $requiredFields = ['name', 'category_id', 'description'];
        $errors = $this->validateRequired($_POST, $requiredFields);

        if (!empty($errors)) {
            $this->setError('Silakan lengkapi semua field yang wajib diisi');
            $this->set('errors', $errors);
            $this->set('form_data', $_POST);
            return $this->services();
        }

        $data = [
            'name' => $this->sanitize($_POST['name']),
            'category_id' => (int)$_POST['category_id'],
            'description' => $this->sanitize($_POST['description']),
            'features' => isset($_POST['features']) ? json_encode(explode("\n", $_POST['features'])) : '[]',
            'icon' => $this->sanitize($_POST['icon'] ?? ''),
            'slug' => $this->createSlug($_POST['name']),
            'is_featured' => isset($_POST['is_featured']) ? 1 : 0,
            'is_active' => isset($_POST['is_active']) ? 1 : 0
        ];

        try {
            $serviceModel->create($data);
            $this->setFlash('success', 'Layanan berhasil ditambahkan');
            $this->redirect('admin/services');
        } catch (Exception $e) {
            $this->setError('Gagal menambahkan layanan: ' . $e->getMessage());
            $this->set('form_data', $_POST);
            $this->services();
        }
    }

    public function editService($id) {
        $serviceModel = new Service();
        $service = $serviceModel->find($id);

        if (!$service) {
            $this->setError('Layanan tidak ditemukan');
            $this->redirect('admin/services');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validate required fields
            $requiredFields = ['name', 'category_id', 'description'];
            $errors = $this->validateRequired($_POST, $requiredFields);

            if (empty($errors)) {
                $data = [
                    'name' => $this->sanitize($_POST['name']),
                    'category_id' => (int)$_POST['category_id'],
                    'description' => $this->sanitize($_POST['description']),
                    'features' => isset($_POST['features']) ? json_encode(explode("\n", $_POST['features'])) : '[]',
                    'icon' => $this->sanitize($_POST['icon'] ?? ''),
                    'slug' => $this->createSlug($_POST['name']),
                    'is_featured' => isset($_POST['is_featured']) ? 1 : 0,
                    'is_active' => isset($_POST['is_active']) ? 1 : 0
                ];

                try {
                    $serviceModel->update($id, $data);
                    $this->setFlash('success', 'Layanan berhasil diperbarui');
                    $this->redirect('admin/services');
                } catch (Exception $e) {
                    $this->setError('Gagal memperbarui layanan: ' . $e->getMessage());
                }
            } else {
                $this->setError('Silakan lengkapi semua field yang wajib diisi');
            }
        }

        $categories = $this->db->getServiceCategories();

        $this->set([
            'page_title' => 'Edit Layanan - ' . APP_NAME,
            'service' => $service,
            'categories' => $categories
        ]);

        $this->render('admin/services/edit', 'admin');
    }

    public function deleteService($id) {
        $serviceModel = new Service();

        try {
            $serviceModel->delete($id);
            $this->setFlash('success', 'Layanan berhasil dihapus');
        } catch (Exception $e) {
            $this->setError('Gagal menghapus layanan: ' . $e->getMessage());
        }

        $this->redirect('admin/services');
    }

    public function portfolio() {
        $portfolioModel = new Portfolio();

        $portfolioItems = $portfolioModel->findAll([], 'created_at DESC');
        $services = $this->db->getServices();

        $this->set([
            'page_title' => 'Kelola Portfolio - ' . APP_NAME,
            'portfolio_items' => $portfolioItems,
            'services' => $services
        ]);

        $this->render('admin/portfolio/index', 'admin');
    }

    public function bookings() {
        $bookingModel = new Booking();

        $bookings = $bookingModel->findAll([], 'created_at DESC');
        $services = $this->db->getServices();

        $this->set([
            'page_title' => 'Kelola Booking - ' . APP_NAME,
            'bookings' => $bookings,
            'services' => $services
        ]);

        $this->render('admin/bookings/index', 'admin');
    }

    public function messages() {
        $contactModel = new ContactMessage();

        $messages = $contactModel->findAll([], 'created_at DESC');

        $this->set([
            'page_title' => 'Kelola Pesan - ' . APP_NAME,
            'messages' => $messages
        ]);

        $this->render('admin/messages/index', 'admin');
    }

    public function testimonials() {
        $testimonialModel = new Testimonial();

        $testimonials = $testimonialModel->findAll([], 'created_at DESC');

        $this->set([
            'page_title' => 'Kelola Testimonial - ' . APP_NAME,
            'testimonials' => $testimonials
        ]);

        $this->render('admin/testimonials/index', 'admin');
    }

    public function categories() {
        $categories = $this->db->select('service_categories', '*', '', [], 'sort_order ASC');

        $this->set([
            'page_title' => 'Kelola Kategori Layanan - ' . APP_NAME,
            'categories' => $categories
        ]);

        $this->render('admin/categories/index', 'admin');
    }

    public function createCategory() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('admin/categories');
        }

        // Validate required fields
        $requiredFields = ['name', 'slug'];
        $errors = $this->validateRequired($_POST, $requiredFields);

        if (!empty($errors)) {
            $this->setError('Silakan lengkapi semua field yang wajib diisi');
            $this->set('errors', $errors);
            $this->set('form_data', $_POST);
            return $this->categories();
        }

        $data = [
            'name' => $this->sanitize($_POST['name']),
            'description' => $this->sanitize($_POST['description'] ?? ''),
            'slug' => $this->sanitize($_POST['slug']),
            'sort_order' => (int)($_POST['sort_order'] ?? 0),
            'is_active' => isset($_POST['is_active']) ? 1 : 0
        ];

        try {
            $this->db->insert('service_categories', $data);
            $this->setFlash('success', 'Kategori berhasil ditambahkan');
            $this->redirect('admin/categories');
        } catch (Exception $e) {
            $this->setError('Gagal menambahkan kategori: ' . $e->getMessage());
            $this->set('form_data', $_POST);
            $this->categories();
        }
    }

    public function editCategory($id) {
        $category = $this->db->fetch('SELECT * FROM service_categories WHERE id = ?', [$id]);

        if (!$category) {
            $this->setError('Kategori tidak ditemukan');
            $this->redirect('admin/categories');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validate required fields
            $requiredFields = ['name', 'slug'];
            $errors = $this->validateRequired($_POST, $requiredFields);

            if (empty($errors)) {
                $data = [
                    'name' => $this->sanitize($_POST['name']),
                    'description' => $this->sanitize($_POST['description'] ?? ''),
                    'slug' => $this->sanitize($_POST['slug']),
                    'sort_order' => (int)($_POST['sort_order'] ?? 0),
                    'is_active' => isset($_POST['is_active']) ? 1 : 0
                ];

                try {
                    $this->db->update('service_categories', $data, 'id = ?', [$id]);
                    $this->setFlash('success', 'Kategori berhasil diperbarui');
                    $this->redirect('admin/categories');
                } catch (Exception $e) {
                    $this->setError('Gagal memperbarui kategori: ' . $e->getMessage());
                }
            }
        }

        $this->set([
            'page_title' => 'Edit Kategori - ' . APP_NAME,
            'category' => $category
        ]);

        $this->render('admin/categories/edit', 'admin');
    }

    public function deleteCategory($id) {
        try {
            // Check if category has services
            $serviceCount = $this->db->count('services', 'category_id = ?', [$id]);
            if ($serviceCount > 0) {
                $this->setError('Tidak dapat menghapus kategori yang masih memiliki layanan');
            } else {
                $this->db->update('service_categories', ['is_active' => 0], 'id = ?', [$id]);
                $this->setFlash('success', 'Kategori berhasil dihapus');
            }
        } catch (Exception $e) {
            $this->setError('Gagal menghapus kategori: ' . $e->getMessage());
        }

        $this->redirect('admin/categories');
    }

    public function packages() {
        $packages = $this->db->fetchAll('
            SELECT pp.*, s.name as service_name, s.slug as service_slug
            FROM pricing_packages pp
            JOIN services s ON pp.service_id = s.id
            ORDER BY s.name, pp.sort_order
        ');

        $services = $this->db->getServices();

        $this->set([
            'page_title' => 'Kelola Paket Harga - ' . APP_NAME,
            'packages' => $packages,
            'services' => $services
        ]);

        $this->render('admin/packages/index', 'admin');
    }

    public function createPackage() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('admin/packages');
        }

        // Validate required fields
        $requiredFields = ['name', 'service_id', 'price_min', 'price_max'];
        $errors = $this->validateRequired($_POST, $requiredFields);

        if (!empty($errors)) {
            $this->setError('Silakan lengkapi semua field yang wajib diisi');
            $this->set('errors', $errors);
            $this->set('form_data', $_POST);
            return $this->packages();
        }

        $data = [
            'name' => $this->sanitize($_POST['name']),
            'service_id' => (int)$_POST['service_id'],
            'description' => $this->sanitize($_POST['description'] ?? ''),
            'price_min' => (float)$_POST['price_min'],
            'price_max' => (float)$_POST['price_max'],
            'features' => isset($_POST['features']) ? json_encode(explode("\n", $_POST['features'])) : '[]',
            'duration' => $this->sanitize($_POST['duration'] ?? ''),
            'package_type' => $_POST['package_type'] ?? 'standard',
            'sort_order' => (int)($_POST['sort_order'] ?? 0),
            'is_popular' => isset($_POST['is_popular']) ? 1 : 0,
            'is_active' => isset($_POST['is_active']) ? 1 : 0
        ];

        try {
            $this->db->insert('pricing_packages', $data);
            $this->setFlash('success', 'Paket harga berhasil ditambahkan');
            $this->redirect('admin/packages');
        } catch (Exception $e) {
            $this->setError('Gagal menambahkan paket: ' . $e->getMessage());
            $this->set('form_data', $_POST);
            $this->packages();
        }
    }

    public function editPackage($id) {
        $package = $this->db->fetch('SELECT * FROM pricing_packages WHERE id = ?', [$id]);

        if (!$package) {
            $this->setError('Paket tidak ditemukan');
            $this->redirect('admin/packages');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validate required fields
            $requiredFields = ['name', 'service_id', 'price_min', 'price_max'];
            $errors = $this->validateRequired($_POST, $requiredFields);

            if (empty($errors)) {
                $data = [
                    'name' => $this->sanitize($_POST['name']),
                    'service_id' => (int)$_POST['service_id'],
                    'description' => $this->sanitize($_POST['description'] ?? ''),
                    'price_min' => (float)$_POST['price_min'],
                    'price_max' => (float)$_POST['price_max'],
                    'features' => isset($_POST['features']) ? json_encode(explode("\n", $_POST['features'])) : '[]',
                    'duration' => $this->sanitize($_POST['duration'] ?? ''),
                    'package_type' => $_POST['package_type'] ?? 'standard',
                    'sort_order' => (int)($_POST['sort_order'] ?? 0),
                    'is_popular' => isset($_POST['is_popular']) ? 1 : 0,
                    'is_active' => isset($_POST['is_active']) ? 1 : 0
                ];

                try {
                    $this->db->update('pricing_packages', $data, 'id = ?', [$id]);
                    $this->setFlash('success', 'Paket berhasil diperbarui');
                    $this->redirect('admin/packages');
                } catch (Exception $e) {
                    $this->setError('Gagal memperbarui paket: ' . $e->getMessage());
                }
            }
        }

        $services = $this->db->getServices();

        $this->set([
            'page_title' => 'Edit Paket - ' . APP_NAME,
            'package' => $package,
            'services' => $services
        ]);

        $this->render('admin/packages/edit', 'admin');
    }

    public function deletePackage($id) {
        try {
            $this->db->update('pricing_packages', ['is_active' => 0], 'id = ?', [$id]);
            $this->setFlash('success', 'Paket berhasil dihapus');
        } catch (Exception $e) {
            $this->setError('Gagal menghapus paket: ' . $e->getMessage());
        }

        $this->redirect('admin/messages');
    }

    public function editBooking($id) {
        $bookingModel = new Booking();
        $booking = $bookingModel->find($id);

        if (!$booking) {
            $this->setError('Booking tidak ditemukan');
            $this->redirect('admin/bookings');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validate required fields
            $requiredFields = ['client_name', 'client_email', 'booking_date', 'booking_time'];
            $errors = $this->validateRequired($_POST, $requiredFields);

            // Validate email format
            if (!empty($_POST['client_email']) && !filter_var($_POST['client_email'], FILTER_VALIDATE_EMAIL)) {
                $errors['client_email'] = 'Format email tidak valid';
            }

            // Validate date is not in the past (for new bookings)
            if (!empty($_POST['booking_date'])) {
                $bookingDate = strtotime($_POST['booking_date']);
                $today = strtotime(date('Y-m-d'));
                if ($bookingDate < $today) {
                    $errors['booking_date'] = 'Tanggal booking tidak boleh di masa lalu';
                }
            }

            if (empty($errors)) {
                $data = [
                    'client_name' => $this->sanitize($_POST['client_name']),
                    'client_email' => $this->sanitize($_POST['client_email']),
                    'client_phone' => $this->sanitize($_POST['client_phone'] ?? ''),
                    'service_id' => (int)$_POST['service_id'],
                    'booking_date' => $_POST['booking_date'],
                    'booking_time' => $_POST['booking_time'],
                    'meeting_type' => $_POST['meeting_type'] ?? 'online',
                    'requirements' => $this->sanitize($_POST['requirements'] ?? ''),
                    'updated_at' => date('Y-m-d H:i:s')
                ];

                try {
                    $bookingModel->update($id, $data);
                    $this->setFlash('success', 'Booking berhasil diperbarui');
                    $this->redirect('admin/bookings');
                } catch (Exception $e) {
                    $this->setError('Gagal memperbarui booking: ' . $e->getMessage());
                }
            }
        }

        $services = $this->db->getServices();

        $this->set([
            'page_title' => 'Edit Booking - ' . APP_NAME,
            'booking' => $booking,
            'services' => $services
        ]);

        $this->render('admin/bookings/edit', 'admin');
    }

    public function settings() {
        $this->set('page_title', 'Pengaturan - ' . APP_NAME);
        $this->render('admin/settings/index', 'admin');
    }

    public function createPortfolio() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('admin/portfolio');
        }

        $portfolioModel = new Portfolio();

        // Validate required fields
        $requiredFields = ['title', 'service_id', 'description'];
        $errors = $this->validateRequired($_POST, $requiredFields);

        if (!empty($errors)) {
            $this->setError('Silakan lengkapi semua field yang wajib diisi');
            $this->set('errors', $errors);
            $this->set('form_data', $_POST);
            return $this->portfolio();
        }

        $data = [
            'title' => $this->sanitize($_POST['title']),
            'service_id' => (int)$_POST['service_id'],
            'description' => $this->sanitize($_POST['description']),
            'challenge' => $this->sanitize($_POST['challenge'] ?? ''),
            'solution' => $this->sanitize($_POST['solution'] ?? ''),
            'results' => $this->sanitize($_POST['results'] ?? ''),
            'client_name' => $this->sanitize($_POST['client_name'] ?? ''),
            'project_type' => $this->sanitize($_POST['project_type'] ?? ''),
            'project_date' => $_POST['project_date'] ?? null,
            'project_url' => $this->sanitize($_POST['project_url'] ?? ''),
            'slug' => $this->createSlug($_POST['title']),
            'status' => $_POST['status'] ?? 'completed',
            'is_featured' => isset($_POST['is_featured']) ? 1 : 0,
            'is_active' => isset($_POST['is_active']) ? 1 : 0
        ];

        try {
            $portfolioModel->create($data);
            $this->setFlash('success', 'Portfolio berhasil ditambahkan');
            $this->redirect('admin/portfolio');
        } catch (Exception $e) {
            $this->setError('Gagal menambahkan portfolio: ' . $e->getMessage());
            $this->set('form_data', $_POST);
            $this->portfolio();
        }
    }

    public function editPortfolio($id) {
        $portfolioModel = new Portfolio();
        $portfolio = $portfolioModel->find($id);

        if (!$portfolio) {
            $this->setError('Portfolio tidak ditemukan');
            $this->redirect('admin/portfolio');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validate required fields
            $requiredFields = ['title', 'service_id', 'description'];
            $errors = $this->validateRequired($_POST, $requiredFields);

            if (empty($errors)) {
                $data = [
                    'title' => $this->sanitize($_POST['title']),
                    'service_id' => (int)$_POST['service_id'],
                    'description' => $this->sanitize($_POST['description']),
                    'challenge' => $this->sanitize($_POST['challenge'] ?? ''),
                    'solution' => $this->sanitize($_POST['solution'] ?? ''),
                    'results' => $this->sanitize($_POST['results'] ?? ''),
                    'client_name' => $this->sanitize($_POST['client_name'] ?? ''),
                    'project_type' => $this->sanitize($_POST['project_type'] ?? ''),
                    'project_date' => $_POST['project_date'] ?? null,
                    'project_url' => $this->sanitize($_POST['project_url'] ?? ''),
                    'slug' => $this->createSlug($_POST['title']),
                    'status' => $_POST['status'] ?? 'completed',
                    'is_featured' => isset($_POST['is_featured']) ? 1 : 0,
                    'is_active' => isset($_POST['is_active']) ? 1 : 0
                ];

                try {
                    $portfolioModel->update($id, $data);
                    $this->setFlash('success', 'Portfolio berhasil diperbarui');
                    $this->redirect('admin/portfolio');
                } catch (Exception $e) {
                    $this->setError('Gagal memperbarui portfolio: ' . $e->getMessage());
                }
            }
        }

        $services = $this->db->getServices();

        $this->set([
            'page_title' => 'Edit Portfolio - ' . APP_NAME,
            'portfolio' => $portfolio,
            'services' => $services
        ]);

        $this->render('admin/portfolio/edit', 'admin');
    }

    public function deletePortfolio($id) {
        $portfolioModel = new Portfolio();

        try {
            $portfolioModel->delete($id);
            $this->setFlash('success', 'Portfolio berhasil dihapus');
        } catch (Exception $e) {
            $this->setError('Gagal menghapus portfolio: ' . $e->getMessage());
        }

        $this->redirect('admin/portfolio');
    }

    public function confirmBooking($id) {
        $bookingModel = new Booking();
        $booking = $bookingModel->find($id);

        if (!$booking) {
            $this->setError('Booking tidak ditemukan');
            $this->redirect('admin/bookings');
        }

        try {
            $meetingLink = 'https://meet.google.com/abc-def-ghi'; // Generate unique meeting link
            $bookingModel->confirm($id, $meetingLink);

            // Send confirmation email
            $emailData = [
                'client_name' => $booking['client_name'],
                'client_email' => $booking['client_email'],
                'service_name' => $booking['service_name'] ?? 'Konsultasi',
                'booking_date' => $booking['booking_date'],
                'booking_time' => $booking['booking_time'],
                'meeting_type' => $booking['meeting_type'],
                'requirements' => $booking['requirements'],
                'meeting_link' => $meetingLink
            ];

            // Uncomment when email system is ready
            // sendBookingConfirmation($emailData);

            $this->setFlash('success', 'Booking berhasil dikonfirmasi dan email dikirim');
        } catch (Exception $e) {
            $this->setError('Gagal mengkonfirmasi booking: ' . $e->getMessage());
        }

        $this->redirect('admin/bookings');
    }

    public function completeBooking($id) {
        $bookingModel = new Booking();

        try {
            $bookingModel->complete($id);
            $this->setFlash('success', 'Booking berhasil diselesaikan');
        } catch (Exception $e) {
            $this->setError('Gagal menyelesaikan booking: ' . $e->getMessage());
        }

        $this->redirect('admin/bookings');
    }

    public function cancelBooking($id) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->setError('Invalid request');
            $this->redirect('admin/bookings');
        }

        $bookingModel = new Booking();
        $reason = $this->sanitize($_POST['cancellation_reason'] ?? '');

        try {
            $bookingModel->cancel($id, $reason);
            $this->setFlash('success', 'Booking berhasil dibatalkan');
        } catch (Exception $e) {
            $this->setError('Gagal membatalkan booking: ' . $e->getMessage());
        }

        $this->redirect('admin/bookings');
    }

    public function respondMessage($id) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('admin/messages');
        }

        $contactModel = new ContactMessage();
        $message = $contactModel->find($id);

        if (!$message) {
            $this->setError('Pesan tidak ditemukan');
            $this->redirect('admin/messages');
        }

        $response = $this->sanitize($_POST['response']);

        if (empty($response)) {
            $this->setError('Balasan tidak boleh kosong');
            $this->set('message', $message);
            return $this->messages();
        }

        try {
            $adminId = $_SESSION['admin_id'];
            $contactModel->respond($id, $response, $adminId);

            // Send response email
            $emailData = $message;
            // Uncomment when email system is ready
            // sendContactResponse($emailData, $response);

            $this->setFlash('success', 'Balasan berhasil dikirim');
        } catch (Exception $e) {
            $this->setError('Gagal mengirim balasan: ' . $e->getMessage());
        }

        $this->redirect('admin/messages');
    }

    public function closeMessage($id) {
        $contactModel = new ContactMessage();

        try {
            $contactModel->close($id);
            $this->setFlash('success', 'Pesan berhasil ditutup');
        } catch (Exception $e) {
            $this->setError('Gagal menutup pesan: ' . $e->getMessage());
        }

        $this->redirect('admin/messages');
    }

    public function faqs() {
        $faqs = $this->db->fetchAll('
            SELECT f.*, sc.name as category_name
            FROM faqs f
            LEFT JOIN service_categories sc ON f.category_id = sc.id
            ORDER BY f.sort_order, f.created_at DESC
        ');

        $categories = $this->db->getServiceCategories();

        $this->set([
            'page_title' => 'Kelola FAQ - ' . APP_NAME,
            'faqs' => $faqs,
            'categories' => $categories
        ]);

        $this->render('admin/faqs/index', 'admin');
    }

    public function createFaq() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('admin/faqs');
        }

        // Validate required fields
        $requiredFields = ['question', 'answer'];
        $errors = $this->validateRequired($_POST, $requiredFields);

        if (!empty($errors)) {
            $this->setError('Silakan lengkapi semua field yang wajib diisi');
            $this->set('errors', $errors);
            $this->set('form_data', $_POST);
            return $this->faqs();
        }

        $data = [
            'question' => $this->sanitize($_POST['question']),
            'answer' => $this->sanitize($_POST['answer']),
            'category_id' => !empty($_POST['category_id']) ? (int)$_POST['category_id'] : null,
            'sort_order' => (int)($_POST['sort_order'] ?? 0),
            'is_active' => isset($_POST['is_active']) ? 1 : 0
        ];

        try {
            $this->db->insert('faqs', $data);
            $this->setFlash('success', 'FAQ berhasil ditambahkan');
            $this->redirect('admin/faqs');
        } catch (Exception $e) {
            $this->setError('Gagal menambahkan FAQ: ' . $e->getMessage());
            $this->set('form_data', $_POST);
            $this->faqs();
        }
    }

    public function editFaq($id) {
        $faq = $this->db->fetch('SELECT * FROM faqs WHERE id = ?', [$id]);

        if (!$faq) {
            $this->setError('FAQ tidak ditemukan');
            $this->redirect('admin/faqs');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validate required fields
            $requiredFields = ['question', 'answer'];
            $errors = $this->validateRequired($_POST, $requiredFields);

            if (empty($errors)) {
                $data = [
                    'question' => $this->sanitize($_POST['question']),
                    'answer' => $this->sanitize($_POST['answer']),
                    'category_id' => !empty($_POST['category_id']) ? (int)$_POST['category_id'] : null,
                    'sort_order' => (int)($_POST['sort_order'] ?? 0),
                    'is_active' => isset($_POST['is_active']) ? 1 : 0
                ];

                try {
                    $this->db->update('faqs', $data, 'id = ?', [$id]);
                    $this->setFlash('success', 'FAQ berhasil diperbarui');
                    $this->redirect('admin/faqs');
                } catch (Exception $e) {
                    $this->setError('Gagal memperbarui FAQ: ' . $e->getMessage());
                }
            }
        }

        $categories = $this->db->getServiceCategories();

        $this->set([
            'page_title' => 'Edit FAQ - ' . APP_NAME,
            'faq' => $faq,
            'categories' => $categories
        ]);

        $this->render('admin/faqs/edit', 'admin');
    }

    public function deleteFaq($id) {
        try {
            $this->db->update('faqs', ['is_active' => 0], 'id = ?', [$id]);
            $this->setFlash('success', 'FAQ berhasil dihapus');
        } catch (Exception $e) {
            $this->setError('Gagal menghapus FAQ: ' . $e->getMessage());
        }

        $this->redirect('admin/faqs');
    }

    public function createTestimonial() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('admin/testimonials');
        }

        $testimonialModel = new Testimonial();

        // Validate required fields
        $requiredFields = ['client_name', 'testimonial', 'rating'];
        $errors = $this->validateRequired($_POST, $requiredFields);

        if (!empty($errors)) {
            $this->setError('Silakan lengkapi semua field yang wajib diisi');
            $this->set('errors', $errors);
            $this->set('form_data', $_POST);
            return $this->testimonials();
        }

        // Validate rating
        $rating = (int)$_POST['rating'];
        if ($rating < 1 || $rating > 5) {
            $errors['rating'] = 'Rating harus antara 1-5';
        }

        if (!empty($errors)) {
            $this->setError('Silakan perbaiki kesalahan berikut:');
            $this->set('errors', $errors);
            $this->set('form_data', $_POST);
            return $this->testimonials();
        }

        $data = [
            'client_name' => $this->sanitize($_POST['client_name']),
            'client_company' => $this->sanitize($_POST['client_company'] ?? ''),
            'testimonial' => $this->sanitize($_POST['testimonial']),
            'rating' => $rating,
            'project_type' => $this->sanitize($_POST['project_type'] ?? ''),
            'is_featured' => isset($_POST['is_featured']) ? 1 : 0,
            'is_active' => isset($_POST['is_active']) ? 1 : 0
        ];

        // Add portfolio and service IDs if provided
        if (!empty($_POST['portfolio_item_id'])) {
            $data['portfolio_item_id'] = (int)$_POST['portfolio_item_id'];
        }
        if (!empty($_POST['service_id'])) {
            $data['service_id'] = (int)$_POST['service_id'];
        }

        try {
            $testimonialModel->create($data);
            $this->setFlash('success', 'Testimonial berhasil ditambahkan');
            $this->redirect('admin/testimonials');
        } catch (Exception $e) {
            $this->setError('Gagal menambahkan testimonial: ' . $e->getMessage());
            $this->set('form_data', $_POST);
            $this->testimonials();
        }
    }

    public function editTestimonial($id) {
        $testimonialModel = new Testimonial();
        $testimonial = $testimonialModel->find($id);

        if (!$testimonial) {
            $this->setError('Testimonial tidak ditemukan');
            $this->redirect('admin/testimonials');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validate required fields
            $requiredFields = ['client_name', 'testimonial', 'rating'];
            $errors = $this->validateRequired($_POST, $requiredFields);

            // Validate rating
            $rating = (int)$_POST['rating'];
            if ($rating < 1 || $rating > 5) {
                $errors['rating'] = 'Rating harus antara 1-5';
            }

            if (empty($errors)) {
                $data = [
                    'client_name' => $this->sanitize($_POST['client_name']),
                    'client_company' => $this->sanitize($_POST['client_company'] ?? ''),
                    'testimonial' => $this->sanitize($_POST['testimonial']),
                    'rating' => $rating,
                    'project_type' => $this->sanitize($_POST['project_type'] ?? ''),
                    'is_featured' => isset($_POST['is_featured']) ? 1 : 0,
                    'is_active' => isset($_POST['is_active']) ? 1 : 0
                ];

                // Add portfolio and service IDs if provided
                if (!empty($_POST['portfolio_item_id'])) {
                    $data['portfolio_item_id'] = (int)$_POST['portfolio_item_id'];
                }
                if (!empty($_POST['service_id'])) {
                    $data['service_id'] = (int)$_POST['service_id'];
                }

                try {
                    $testimonialModel->update($id, $data);
                    $this->setFlash('success', 'Testimonial berhasil diperbarui');
                    $this->redirect('admin/testimonials');
                } catch (Exception $e) {
                    $this->setError('Gagal memperbarui testimonial: ' . $e->getMessage());
                }
            }
        }

        $portfolioItems = $this->db->select('portfolio_items', 'id, title', 'is_active = 1', [], 'title ASC');
        $services = $this->db->getServices();

        $this->set([
            'page_title' => 'Edit Testimonial - ' . APP_NAME,
            'testimonial' => $testimonial,
            'portfolio_items' => $portfolioItems,
            'services' => $services
        ]);

        $this->render('admin/testimonials/edit', 'admin');
    }

    public function deleteTestimonial($id) {
        $testimonialModel = new Testimonial();

        try {
            $testimonialModel->delete($id);
            $this->setFlash('success', 'Testimonial berhasil dihapus');
        } catch (Exception $e) {
            $this->setError('Gagal menghapus testimonial: ' . $e->getMessage());
        }

        $this->redirect('admin/testimonials');
    }
}
