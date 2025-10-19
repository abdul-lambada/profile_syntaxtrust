<?php
/**
 * Profile Syntaxtrust - Main Entry Point
 * PHP Backend with Sneat UI Framework
 */

// Include configuration
require_once 'config.php';

// Include core classes
require_once 'app/core/Database.php';
require_once 'app/core/Router.php';
require_once 'app/core/Controller.php';
require_once 'app/models/Model.php';

// Include models
require_once 'app/models/User.php';
require_once 'app/models/Admin.php';
require_once 'app/models/Service.php';
require_once 'app/models/Booking.php';
require_once 'app/models/ContactMessage.php';
require_once 'app/models/Testimonial.php';
require_once 'app/models/Portfolio.php';

// Include controllers
require_once 'app/controllers/AuthController.php';
require_once 'app/controllers/AdminController.php';
require_once 'app/controllers/HomeController.php';

// Initialize router
$router = new Router();

// API routes
$router->get('/api/available-slots', 'HomeController', 'getAvailableSlots');

// Authentication routes
$router->get('/admin/login', 'AuthController', 'login');
$router->post('/admin/authenticate', 'AuthController', 'authenticate');
$router->get('/admin/logout', 'AuthController', 'logout');
$router->get('/admin/forgot-password', 'AuthController', 'forgotPassword');
$router->post('/admin/reset-password', 'AuthController', 'resetPassword');

// Define routes
// Default route langsung ke halaman login dari folder auth
$router->get('/', 'AuthController', 'login');
// Admin routes (protected)
$router->get('/admin/dashboard', 'AdminController', 'dashboard');
$router->get('/admin/services', 'AdminController', 'services');
$router->post('/admin/services', 'AdminController', 'createService');
$router->get('/admin/services/edit/{id}', 'AdminController', 'editService');
$router->post('/admin/services/edit/{id}', 'AdminController', 'editService');
$router->get('/admin/services/delete/{id}', 'AdminController', 'deleteService');

$router->get('/admin/categories', 'AdminController', 'categories');
$router->post('/admin/categories', 'AdminController', 'createCategory');
$router->get('/admin/categories/edit/{id}', 'AdminController', 'editCategory');
$router->post('/admin/categories/edit/{id}', 'AdminController', 'editCategory');
$router->get('/admin/categories/delete/{id}', 'AdminController', 'deleteCategory');

$router->get('/admin/packages', 'AdminController', 'packages');
$router->post('/admin/packages', 'AdminController', 'createPackage');
$router->get('/admin/packages/edit/{id}', 'AdminController', 'editPackage');
$router->post('/admin/packages/edit/{id}', 'AdminController', 'editPackage');
$router->get('/admin/packages/delete/{id}', 'AdminController', 'deletePackage');

$router->get('/admin/portfolio', 'AdminController', 'portfolio');
$router->post('/admin/portfolio', 'AdminController', 'createPortfolio');
$router->get('/admin/portfolio/edit/{id}', 'AdminController', 'editPortfolio');
$router->post('/admin/portfolio/edit/{id}', 'AdminController', 'editPortfolio');
$router->get('/admin/portfolio/delete/{id}', 'AdminController', 'deletePortfolio');

$router->get('/admin/bookings', 'AdminController', 'bookings');
$router->get('/admin/bookings/edit/{id}', 'AdminController', 'editBooking');
$router->post('/admin/bookings/edit/{id}', 'AdminController', 'editBooking');
$router->get('/admin/bookings/confirm/{id}', 'AdminController', 'confirmBooking');
$router->get('/admin/bookings/complete/{id}', 'AdminController', 'completeBooking');
$router->post('/admin/bookings/cancel/{id}', 'AdminController', 'cancelBooking');

$router->get('/admin/messages', 'AdminController', 'messages');
$router->post('/admin/messages/respond/{id}', 'AdminController', 'respondMessage');
$router->get('/admin/messages/close/{id}', 'AdminController', 'closeMessage');

$router->get('/admin/testimonials', 'AdminController', 'testimonials');
$router->post('/admin/testimonials', 'AdminController', 'createTestimonial');
$router->get('/admin/testimonials/edit/{id}', 'AdminController', 'editTestimonial');
$router->post('/admin/testimonials/edit/{id}', 'AdminController', 'editTestimonial');
$router->get('/admin/testimonials/delete/{id}', 'AdminController', 'deleteTestimonial');

$router->get('/admin/faqs', 'AdminController', 'faqs');
$router->post('/admin/faqs', 'AdminController', 'createFaq');
$router->get('/admin/faqs/edit/{id}', 'AdminController', 'editFaq');
$router->post('/admin/faqs/edit/{id}', 'AdminController', 'editFaq');
$router->get('/admin/faqs/delete/{id}', 'AdminController', 'deleteFaq');

$router->get('/admin/settings', 'AdminController', 'settings');
$router->add('GET', '404', function() {
    http_response_code(404);
    echo '<h1>404 - Page Not Found</h1>';
    echo '<p>The page you are looking for does not exist.</p>';
    echo '<a href="' . BASE_URL . '">Go back to homepage</a>';
});

// Dispatch the request
$router->dispatch();
?>
