<?php
/**
 * Profile Syntaxtrust - Home Controller
 * Handles homepage and main site functionality
 */

class HomeController extends Controller {
    public function index() {
        $serviceModel = new Service();
        $testimonialModel = new Testimonial();
        $portfolioModel = new Portfolio();

        // Get featured services
        $featuredServices = $serviceModel->getFeatured();

        // Get testimonials for homepage
        $testimonials = $testimonialModel->findAll(['is_featured' => 1], 'created_at DESC', 6);

        // Get recent portfolio items
        $portfolioItems = $portfolioModel->findAll([], 'is_featured DESC, created_at DESC', 6);

        // Get service categories for navigation
        $categories = $this->db->getServiceCategories();

        $this->set([
            'page_title' => 'Beranda - ' . APP_NAME,
            'featured_services' => $featuredServices,
            'testimonials' => $testimonials,
            'portfolio_items' => $portfolioItems,
            'categories' => $categories
        ]);

        $this->render('home/index', 'main');
    }

    public function services() {
        $serviceModel = new Service();

        $services = $serviceModel->getWithCategory();
        $categories = $this->db->getServiceCategories();

        $this->set([
            'page_title' => 'Layanan - ' . APP_NAME,
            'services' => $services,
            'categories' => $categories
        ]);

        $this->render('services/index', 'main');
    }

    public function pricing() {
        $serviceModel = new Service();

        $services = $serviceModel->getWithCategory();
        $packages = [];

        foreach ($services as $service) {
            $packages[$service['id']] = $serviceModel->getPricingPackages($service['id']);
        }

        $this->set([
            'page_title' => 'Harga - ' . APP_NAME,
            'services' => $services,
            'packages' => $packages
        ]);

        $this->render('pricing/index', 'main');
    }

    public function portfolio() {
        $serviceModel = new Service();

        $portfolioItems = $serviceModel->getPortfolioItems(null, 12);
        $services = $serviceModel->getWithCategory();

        $this->set([
            'page_title' => 'Portfolio - ' . APP_NAME,
            'portfolio_items' => $portfolioItems,
            'services' => $services
        ]);

        $this->render('portfolio/index', 'main');
    }

    public function contact() {
        $this->set([
            'page_title' => 'Kontak - ' . APP_NAME
        ]);

        $this->render('contact/index', 'main');
    }

    public function schedule() {
        $serviceModel = new Service();

        $services = $serviceModel->getWithCategory();

        $this->set([
            'page_title' => 'Jadwal Konsultasi - ' . APP_NAME,
            'services' => $services
        ]);

        $this->render('schedule/index', 'main');
    }

    public function submitContact() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('contact');
        }

        $contactModel = new ContactMessage();

        // Validate required fields
        $requiredFields = ['name', 'email', 'message'];
        $errors = $this->validateRequired($_POST, $requiredFields);

        // Validate email
        if (isset($_POST['email']) && !empty($_POST['email'])) {
            $emailError = $this->validateEmail($_POST['email']);
            if ($emailError) {
                $errors['email'] = $emailError;
            }
        }

        // Validate phone if provided
        if (isset($_POST['phone']) && !empty($_POST['phone'])) {
            $phoneError = $this->validatePhone($_POST['phone']);
            if ($phoneError) {
                $errors['phone'] = $phoneError;
            }
        }

        if (!empty($errors)) {
            $this->setError('Silakan perbaiki kesalahan berikut:');
            $this->set('errors', $errors);
            $this->set('form_data', $_POST);
            return $this->contact();
        }

        // Sanitize input
        $data = [
            'name' => $this->sanitize($_POST['name']),
            'email' => $this->sanitize($_POST['email']),
            'phone' => isset($_POST['phone']) ? $this->sanitize($_POST['phone']) : null,
            'message' => $this->sanitize($_POST['message']),
            'status' => 'new'
        ];

        try {
            $contactModel->create($data);

            $this->setFlash('success', 'Pesan berhasil dikirim! Kami akan segera merespons.');
            $this->redirect('contact');

        } catch (Exception $e) {
            $this->setError('Gagal mengirim pesan. Silakan coba lagi.');
            $this->set('form_data', $_POST);
            $this->contact();
        }
    }

    public function submitBooking() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('schedule');
        }

        $bookingModel = new Booking();

        // Validate required fields
        $requiredFields = ['client_name', 'client_email', 'service_id', 'booking_date', 'booking_time'];
        $errors = $this->validateRequired($_POST, $requiredFields);

        // Validate email
        if (isset($_POST['client_email'])) {
            $emailError = $this->validateEmail($_POST['client_email']);
            if ($emailError) {
                $errors['client_email'] = $emailError;
            }
        }

        // Validate phone if provided
        if (isset($_POST['client_phone']) && !empty($_POST['client_phone'])) {
            $phoneError = $this->validatePhone($_POST['client_phone']);
            if ($phoneError) {
                $errors['client_phone'] = $phoneError;
            }
        }

        if (!empty($errors)) {
            $this->setError('Silakan perbaiki kesalahan berikut:');
            $this->set('errors', $errors);
            $this->set('form_data', $_POST);
            return $this->schedule();
        }

        // Sanitize input
        $data = [
            'client_name' => $this->sanitize($_POST['client_name']),
            'client_email' => $this->sanitize($_POST['client_email']),
            'client_phone' => isset($_POST['client_phone']) ? $this->sanitize($_POST['client_phone']) : null,
            'service_id' => (int)$_POST['service_id'],
            'booking_date' => $_POST['booking_date'],
            'booking_time' => $_POST['booking_time'],
            'requirements' => isset($_POST['requirements']) ? $this->sanitize($_POST['requirements']) : null,
            'meeting_type' => isset($_POST['meeting_type']) ? $_POST['meeting_type'] : 'video_call'
        ];

        // Add pricing package if provided
        if (isset($_POST['pricing_package_id']) && !empty($_POST['pricing_package_id'])) {
            $data['pricing_package_id'] = (int)$_POST['pricing_package_id'];
        }

        try {
            $bookingModel->create($data);

            $this->setFlash('success', 'Booking berhasil dibuat! Kami akan mengkonfirmasi melalui email/WhatsApp.');
            $this->redirect('schedule');

        } catch (Exception $e) {
            $this->setError('Gagal membuat booking. Silakan coba lagi.');
            $this->set('form_data', $_POST);
            $this->schedule();
        }
    }

    public function getAvailableSlots() {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            http_response_code(405);
            exit('Method not allowed');
        }

        $serviceId = isset($_GET['service_id']) ? (int)$_GET['service_id'] : 0;
        $date = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');

        if (!$serviceId) {
            http_response_code(400);
            exit('Service ID required');
        }

        $bookingModel = new Booking();
        $slots = $bookingModel->getAvailableSlots($serviceId, $date);

        header('Content-Type: application/json');
        echo json_encode($slots);
    }
}
