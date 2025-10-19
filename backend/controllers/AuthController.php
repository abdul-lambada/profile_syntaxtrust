<?php
/**
 * Profile Syntaxtrust - Admin Authentication Controller
 * Handles admin login, logout, and session management
 */

class AuthController extends Controller {
    public function login() {
        // If already logged in as admin, redirect to dashboard
        if ($this->isAdmin()) {
            $this->redirect('admin/dashboard');
        }

        $this->set('page_title', 'Admin Login - ' . APP_NAME);
        $this->render('auth/login', 'auth');
    }

    public function authenticate() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('admin/login');
        }

        $email = $this->sanitize($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        // Validate input
        if (empty($email) || empty($password)) {
            $this->setError('Email dan password harus diisi');
            return $this->login();
        }

        if (!$this->isValidEmail($email)) {
            $this->setError('Format email tidak valid');
            return $this->login();
        }

        $adminModel = new Admin();
        $admin = $adminModel->findByEmail($email);

        if (!$admin || !$adminModel->verifyPassword($password, $admin['password_hash'])) {
            $this->setError('Email atau password salah');
            return $this->login();
        }

        if (!$admin['is_active']) {
            $this->setError('Akun admin tidak aktif');
            return $this->login();
        }

        // Set admin session
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_name'] = $admin['name'];
        $_SESSION['admin_email'] = $admin['email'];
        $_SESSION['admin_role'] = $admin['role'];
        $_SESSION['is_admin'] = true;

        // Update last login
        $adminModel->updateLastLogin($admin['id']);

        $this->setFlash('success', 'Login berhasil! Selamat datang, ' . $admin['name']);
        $this->redirect('admin/dashboard');
    }

    public function logout() {
        // Clear admin session
        unset($_SESSION['admin_id']);
        unset($_SESSION['admin_name']);
        unset($_SESSION['admin_email']);
        unset($_SESSION['admin_role']);
        unset($_SESSION['is_admin']);

        $this->setFlash('success', 'Logout berhasil');
        $this->redirect('admin/login');
    }

    public function forgotPassword() {
        $this->set('page_title', 'Lupa Password - ' . APP_NAME);
        $this->render('auth/forgot-password', 'auth');
    }

    public function resetPassword() {
        // Implementation for password reset
        $this->set('page_title', 'Reset Password - ' . APP_NAME);
        $this->render('auth/reset-password', 'auth');
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
}
