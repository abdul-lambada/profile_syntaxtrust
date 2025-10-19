<?php
/**
 * Profile Syntaxtrust - API Controller
 * Provides API endpoints for frontend React application
 */

class ApiController extends Controller {
    public function services() {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            $this->jsonResponse(['error' => 'Method not allowed'], 405);
        }

        $serviceModel = new Service();
        $services = $serviceModel->getWithCategory();

        $this->jsonResponse($services);
    }

    public function service($id) {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            $this->jsonResponse(['error' => 'Method not allowed'], 405);
        }

        $serviceModel = new Service();
        $service = $serviceModel->find($id);

        if (!$service) {
            $this->jsonResponse(['error' => 'Service not found'], 404);
        }

        // Get pricing packages for this service
        $packages = $serviceModel->getPricingPackages($id);

        $this->jsonResponse([
            'service' => $service,
            'packages' => $packages
        ]);
    }

    public function portfolio() {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            $this->jsonResponse(['error' => 'Method not allowed'], 405);
        }

        $serviceModel = new Service();
        $portfolioItems = $serviceModel->getPortfolioItems(null, 12);

        $this->jsonResponse($portfolioItems);
    }

    public function testimonials() {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            $this->jsonResponse(['error' => 'Method not allowed'], 405);
        }

        $testimonialModel = new Testimonial();
        $testimonials = $testimonialModel->findAll(['is_featured' => 1], 'created_at DESC', 6);

        $this->jsonResponse($testimonials);
    }

    public function categories() {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            $this->jsonResponse(['error' => 'Method not allowed'], 405);
        }

        $categories = $this->db->getServiceCategories();
        $this->jsonResponse($categories);
    }

    public function contact() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->jsonResponse(['error' => 'Method not allowed'], 405);
        }

        // Get JSON input
        $input = json_decode(file_get_contents('php://input'), true);

        if (!$input) {
            $this->jsonResponse(['error' => 'Invalid JSON input'], 400);
        }

        $contactModel = new ContactMessage();

        // Validate required fields
        $requiredFields = ['name', 'email', 'message'];
        $errors = [];

        foreach ($requiredFields as $field) {
            if (!isset($input[$field]) || empty($input[$field])) {
                $errors[$field] = ucfirst($field) . ' is required';
            }
        }

        // Validate email
        if (isset($input['email']) && !empty($input['email'])) {
            if (!filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Invalid email format';
            }
        }

        if (!empty($errors)) {
            $this->jsonResponse(['error' => 'Validation failed', 'errors' => $errors], 400);
        }

        // Sanitize input
        $data = [
            'name' => htmlspecialchars($input['name']),
            'email' => htmlspecialchars($input['email']),
            'phone' => isset($input['phone']) ? htmlspecialchars($input['phone']) : null,
            'message' => htmlspecialchars($input['message']),
            'status' => 'new'
        ];

        try {
            $contactModel->create($data);
            $this->jsonResponse(['success' => true, 'message' => 'Message sent successfully']);
        } catch (Exception $e) {
            $this->jsonResponse(['error' => 'Failed to send message'], 500);
        }
    }

    public function booking() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->jsonResponse(['error' => 'Method not allowed'], 405);
        }

        // Get JSON input
        $input = json_decode(file_get_contents('php://input'), true);

        if (!$input) {
            $this->jsonResponse(['error' => 'Invalid JSON input'], 400);
        }

        $bookingModel = new Booking();

        // Validate required fields
        $requiredFields = ['client_name', 'client_email', 'service_id', 'booking_date', 'booking_time'];
        $errors = [];

        foreach ($requiredFields as $field) {
            if (!isset($input[$field]) || empty($input[$field])) {
                $errors[$field] = ucfirst(str_replace('_', ' ', $field)) . ' is required';
            }
        }

        // Validate email
        if (isset($input['client_email']) && !empty($input['client_email'])) {
            if (!filter_var($input['client_email'], FILTER_VALIDATE_EMAIL)) {
                $errors['client_email'] = 'Invalid email format';
            }
        }

        if (!empty($errors)) {
            $this->jsonResponse(['error' => 'Validation failed', 'errors' => $errors], 400);
        }

        // Sanitize input
        $data = [
            'client_name' => htmlspecialchars($input['client_name']),
            'client_email' => htmlspecialchars($input['client_email']),
            'client_phone' => isset($input['client_phone']) ? htmlspecialchars($input['client_phone']) : null,
            'service_id' => (int)$input['service_id'],
            'booking_date' => $input['booking_date'],
            'booking_time' => $input['booking_time'],
            'requirements' => isset($input['requirements']) ? htmlspecialchars($input['requirements']) : null,
            'meeting_type' => isset($input['meeting_type']) ? $input['meeting_type'] : 'video_call'
        ];

        // Add pricing package if provided
        if (isset($input['pricing_package_id']) && !empty($input['pricing_package_id'])) {
            $data['pricing_package_id'] = (int)$input['pricing_package_id'];
        }

        try {
            $bookingModel->create($data);
            $this->jsonResponse(['success' => true, 'message' => 'Booking created successfully']);
        } catch (Exception $e) {
            $this->jsonResponse(['error' => 'Failed to create booking'], 500);
        }
    }

    private function jsonResponse($data, $statusCode = 200) {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
}
