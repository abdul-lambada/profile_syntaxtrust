<?php
/**
 * Profile Syntaxtrust - PHP Backend
 * Main Application Configuration
 */

// Error reporting untuk development
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Timezone
date_default_timezone_set('Asia/Jakarta');

// Base URL (sesuaikan dengan environment)
define('BASE_URL', 'http://localhost/profile_syntaxtrust/');
define('ASSETS_URL', BASE_URL . 'assets/');

// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'profile_syntaxtrust');
define('DB_CHARSET', 'utf8mb4');

// Session configuration
define('SESSION_NAME', 'syntaxtrust_session');
define('SESSION_LIFETIME', 3600); // 1 jam

// Security settings
define('CSRF_TOKEN_NAME', 'csrf_token');
define('ENCRYPTION_KEY', 'your-secret-key-change-this-in-production');

// Pagination
define('ITEMS_PER_PAGE', 10);

// File upload settings
define('MAX_FILE_SIZE', 5 * 1024 * 1024); // 5MB
define('ALLOWED_EXTENSIONS', ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'doc', 'docx']);

// Application settings
define('APP_NAME', 'Profile Syntaxtrust');
define('APP_VERSION', '1.0.0');
define('COMPANY_NAME', 'Syntaxtrust');
define('COMPANY_EMAIL', 'hello@syntaxtrust.com');
define('COMPANY_PHONE', '+62 812-3456-7890');

// Social media links
define('SOCIAL_LINKS', [
    'whatsapp' => 'https://wa.me/6281234567890',
    'email' => 'mailto:hello@syntaxtrust.com',
    'instagram' => '#',
    'linkedin' => '#',
    'github' => '#'
]);

// Business hours
define('BUSINESS_HOURS', [
    'monday' => ['09:00', '18:00'],
    'tuesday' => ['09:00', '18:00'],
    'wednesday' => ['09:00', '18:00'],
    'thursday' => ['09:00', '18:00'],
    'friday' => ['09:00', '18:00'],
    'saturday' => null,
    'sunday' => null
]);

// Service categories
define('SERVICE_CATEGORIES', [
    'website-tugas' => 'Website Tugas Mata Kuliah',
    'modifikasi-website' => 'Modifikasi Website',
    'website-skripsi' => 'Website Skripsi/Tugas Akhir'
]);

// Project statuses
define('PROJECT_STATUSES', [
    'planning' => 'Perencanaan',
    'in_progress' => 'Dalam Pengerjaan',
    'review' => 'Review',
    'completed' => 'Selesai',
    'delivered' => 'Diserahkan'
]);

// Booking statuses
define('BOOKING_STATUSES', [
    'pending' => 'Menunggu Konfirmasi',
    'confirmed' => 'Dikonfirmasi',
    'completed' => 'Selesai',
    'cancelled' => 'Dibatalkan',
    'no_show' => 'Tidak Hadir'
]);

// Contact message statuses
define('MESSAGE_STATUSES', [
    'new' => 'Baru',
    'read' => 'Dibaca',
    'responded' => 'Direspons',
    'closed' => 'Ditutup'
]);

// Package types
define('PACKAGE_TYPES', [
    'basic' => 'Basic',
    'standard' => 'Standard',
    'premium' => 'Premium',
    'enterprise' => 'Enterprise'
]);

// Auto-load classes
spl_autoload_register(function($className) {
    $file = __DIR__ . '/../app/core/' . $className . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_name(SESSION_NAME);
    session_start([
        'cookie_lifetime' => SESSION_LIFETIME,
        'cookie_httponly' => true,
        'cookie_secure' => false, // Set to true in production with HTTPS
        'use_strict_mode' => true
    ]);
}
