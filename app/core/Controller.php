<?php
/**
 * Profile Syntaxtrust - Base Controller Class
 * Provides common functionality for all controllers
 */

class Controller {
    protected $db;
    protected $data = [];
    protected $errors = [];
    protected $success = [];

    public function __construct() {
        $this->db = Database::getInstance();
    }

    // Set data for views
    protected function set($key, $value = null) {
        if (is_array($key)) {
            $this->data = array_merge($this->data, $key);
        } else {
            $this->data[$key] = $value;
        }
    }

    // Get data for views
    protected function get($key = null) {
        if ($key === null) {
            return $this->data;
        }
        return isset($this->data[$key]) ? $this->data[$key] : null;
    }

    // Set error message
    protected function setError($message, $field = null) {
        if ($field) {
            $this->errors[$field] = $message;
        } else {
            $this->errors[] = $message;
        }
    }

    // Set success message
    protected function setSuccess($message) {
        $this->success[] = $message;
    }

    // Get errors
    protected function getErrors() {
        return $this->errors;
    }

    // Get success messages
    protected function getSuccess() {
        return $this->success;
    }

    // Check if has errors
    protected function hasErrors() {
        return !empty($this->errors);
    }

    // Check if has success messages
    protected function hasSuccess() {
        return !empty($this->success);
    }

    // Redirect to URL
    protected function redirect($url) {
        header('Location: ' . BASE_URL . $url);
        exit;
    }

    // Back to previous page
    protected function back() {
        if (isset($_SERVER['HTTP_REFERER'])) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        } else {
            header('Location: ' . BASE_URL);
        }
        exit;
    }

    // Render view
    protected function render($view, $layout = 'main') {
        // Extract data for use in view
        extract($this->data);

        // Add common data
        $this->setCommonData();

        // Include view file
        $viewFile = 'app/views/' . $view . '.php';
        if (file_exists($viewFile)) {
            ob_start();
            include $viewFile;
            $content = ob_get_clean();
        } else {
            $content = '<p>View not found: ' . $view . '</p>';
        }

        // Include layout if specified
        if ($layout && $layout !== 'none') {
            $layoutFile = 'app/views/layouts/' . $layout . '.php';
            if (file_exists($layoutFile)) {
                include $layoutFile;
            } else {
                echo $content;
            }
        } else {
            echo $content;
        }
    }

    // Set common data for all views
    private function setCommonData() {
        $this->set('base_url', BASE_URL);
        $this->set('assets_url', ASSETS_URL);
        $this->set('app_name', APP_NAME);
        $this->set('company_name', COMPANY_NAME);
        $this->set('company_email', COMPANY_EMAIL);
        $this->set('company_phone', COMPANY_PHONE);
        $this->set('social_links', SOCIAL_LINKS);
        $this->set('business_hours', BUSINESS_HOURS);

        // Navigation data
        $this->set('services', $this->db->getServices());
        $this->set('service_categories', $this->db->getServiceCategories());

        // User data if logged in
        if (isset($_SESSION['user_id'])) {
            $this->set('user', $this->getCurrentUser());
        }

        // CSRF token
        $this->set('csrf_token', Router::generateCSRFToken());

        // Flash messages
        if (isset($_SESSION['flash_errors'])) {
            $this->set('flash_errors', $_SESSION['flash_errors']);
            unset($_SESSION['flash_errors']);
        }

        if (isset($_SESSION['flash_success'])) {
            $this->set('flash_success', $_SESSION['flash_success']);
            unset($_SESSION['flash_success']);
        }
    }

    // Get current user data
    protected function getCurrentUser() {
        if (isset($_SESSION['user_id'])) {
            return $this->db->fetch('SELECT * FROM users WHERE id = ? AND is_active = 1', [$_SESSION['user_id']]);
        }
        return null;
    }

    // Check if current user is admin
    protected function isAdmin() {
        return isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true;
    }

    // Require admin authentication
    protected function requireAdmin() {
        if (!$this->isAdmin()) {
            $this->redirect('admin/login');
        }
    }

    // Validate email format
    protected function isValidEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    // Validate phone number (Indonesian format)
    protected function isValidPhone($phone) {
        return preg_match('/^(\+62|62|0)8[1-9][0-9]{6,11}$/', $phone);
    }

    // Sanitize input
    protected function sanitize($input) {
        if (is_array($input)) {
            return array_map([$this, 'sanitize'], $input);
        }
        return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
    }

    // Validate required fields
    protected function validateRequired($data, $fields) {
        $errors = [];
        foreach ($fields as $field) {
            if (empty($data[$field])) {
                $errors[$field] = ucfirst(str_replace('_', ' ', $field)) . ' harus diisi';
            }
        }
        return $errors;
    }

    // Validate email field
    protected function validateEmail($email, $fieldName = 'Email') {
        if (!$this->isValidEmail($email)) {
            return $fieldName . ' tidak valid';
        }
        return null;
    }

    // Validate phone field
    protected function validatePhone($phone, $fieldName = 'Nomor telepon') {
        if (!$this->isValidPhone($phone)) {
            return $fieldName . ' tidak valid (format: 08xxxxxxxxxx)';
        }
        return null;
    }

    // Upload file with validation
    protected function uploadFile($file, $destination, $allowedTypes = [], $maxSize = MAX_FILE_SIZE) {
        if (!isset($file['tmp_name']) || empty($file['tmp_name'])) {
            return ['error' => 'File tidak ditemukan'];
        }

        if ($file['error'] !== UPLOAD_ERR_OK) {
            return ['error' => 'Error saat upload file'];
        }

        if ($file['size'] > $maxSize) {
            return ['error' => 'File terlalu besar (maksimal ' . ($maxSize / 1024 / 1024) . 'MB)'];
        }

        $fileExt = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        if (!empty($allowedTypes) && !in_array($fileExt, $allowedTypes)) {
            return ['error' => 'Tipe file tidak diizinkan'];
        }

        $fileName = uniqid() . '.' . $fileExt;
        $filePath = $destination . '/' . $fileName;

        if (!move_uploaded_file($file['tmp_name'], $filePath)) {
            return ['error' => 'Gagal menyimpan file'];
        }

        return ['success' => true, 'filename' => $fileName, 'path' => $filePath];
    }

    // Set flash messages for redirect
    protected function setFlash($type, $message) {
        $_SESSION['flash_' . $type][] = $message;
    }

    // Format currency (Indonesian Rupiah)
    protected function formatCurrency($amount) {
        return 'Rp ' . number_format($amount, 0, ',', '.');
    }

    // Format date (Indonesian format)
    protected function formatDate($date, $format = 'd M Y') {
        return date($format, strtotime($date));
    }

    // Generate slug from string
    protected function createSlug($string) {
        $string = strtolower(trim($string));
        $string = preg_replace('/[^a-z0-9-]/', '-', $string);
        $string = preg_replace('/-+/', '-', $string);
        return trim($string, '-');
    }
}
