<?php
/**
 * Profile Syntaxtrust - Email Configuration
 * Settings for sending notification emails
 */

// Email configuration
define('SMTP_HOST', 'smtp.gmail.com');           // SMTP server
define('SMTP_PORT', 587);                         // SMTP port (587 for TLS, 465 for SSL)
define('SMTP_USERNAME', 'your-email@gmail.com');  // Your email address
define('SMTP_PASSWORD', 'your-app-password');    // App password (not regular password)
define('SMTP_ENCRYPTION', 'tls');                 // tls or ssl

// Email settings
define('FROM_EMAIL', 'noreply@syntaxtrust.com');
define('FROM_NAME', 'Syntaxtrust');
define('REPLY_TO_EMAIL', 'hello@syntaxtrust.com');
define('REPLY_TO_NAME', 'Syntaxtrust Support');

// Admin notification emails
define('ADMIN_EMAIL', 'admin@syntaxtrust.com');

// Email templates directory
define('EMAIL_TEMPLATES_DIR', __DIR__ . '/../app/views/emails/');

// Enable/disable email notifications
define('ENABLE_EMAIL_NOTIFICATIONS', true);

// Email types that can be sent
define('EMAIL_TYPES', [
    'booking_confirmation' => [
        'subject' => 'Konfirmasi Booking Konsultasi - Syntaxtrust',
        'template' => 'booking-confirmation'
    ],
    'booking_reminder' => [
        'subject' => 'Pengingat Konsultasi - Syntaxtrust',
        'template' => 'booking-reminder'
    ],
    'contact_response' => [
        'subject' => 'Balasan dari Syntaxtrust',
        'template' => 'contact-response'
    ],
    'welcome_admin' => [
        'subject' => 'Selamat Bergabung - Admin Panel Syntaxtrust',
        'template' => 'welcome-admin'
    ]
]);

/**
 * Email sending function using PHPMailer
 * Requires PHPMailer to be installed via Composer
 */
function sendEmail($to, $subject, $templateName, $data = [], $attachments = []) {
    if (!ENABLE_EMAIL_NOTIFICATIONS) {
        return ['success' => true, 'message' => 'Email notifications disabled'];
    }

    try {
        require_once '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
        require_once '../vendor/phpmailer/phpmailer/src/SMTP.php';
        require_once '../vendor/phpmailer/phpmailer/src/Exception.php';

        $mail = new PHPMailer\PHPMailer\PHPMailer(true);

        // Server settings
        $mail->isSMTP();
        $mail->Host = SMTP_HOST;
        $mail->SMTPAuth = true;
        $mail->Username = SMTP_USERNAME;
        $mail->Password = SMTP_PASSWORD;
        $mail->SMTPSecure = SMTP_ENCRYPTION;
        $mail->Port = SMTP_PORT;

        // Recipients
        $mail->setFrom(FROM_EMAIL, FROM_NAME);
        $mail->addAddress($to);
        $mail->addReplyTo(REPLY_TO_EMAIL, REPLY_TO_NAME);

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->CharSet = 'UTF-8';

        // Load email template
        $templateFile = EMAIL_TEMPLATES_DIR . $templateName . '.php';
        if (file_exists($templateFile)) {
            ob_start();
            extract($data);
            include $templateFile;
            $body = ob_get_clean();
            $mail->Body = $body;
        } else {
            $mail->Body = "Email template not found: {$templateName}";
        }

        // Plain text version
        $mail->AltBody = strip_tags($mail->Body);

        // Attachments
        foreach ($attachments as $attachment) {
            if (isset($attachment['path']) && file_exists($attachment['path'])) {
                $mail->addAttachment($attachment['path'], $attachment['name'] ?? '');
            }
        }

        $mail->send();
        return ['success' => true, 'message' => 'Email sent successfully'];

    } catch (Exception $e) {
        error_log('Email Error: ' . $mail->ErrorInfo);
        return ['success' => false, 'message' => 'Email could not be sent: ' . $mail->ErrorInfo];
    }
}

/**
 * Send booking confirmation email
 */
function sendBookingConfirmation($bookingData) {
    $subject = EMAIL_TYPES['booking_confirmation']['subject'];
    $template = EMAIL_TYPES['booking_confirmation']['template'];

    $data = [
        'client_name' => $bookingData['client_name'],
        'service_name' => $bookingData['service_name'] ?? 'Konsultasi',
        'booking_date' => date('d F Y', strtotime($bookingData['booking_date'])),
        'booking_time' => date('H:i', strtotime($bookingData['booking_time'])),
        'meeting_type' => $bookingData['meeting_type'],
        'requirements' => $bookingData['requirements'] ?? '',
        'company_name' => COMPANY_NAME,
        'company_email' => COMPANY_EMAIL,
        'company_phone' => COMPANY_PHONE
    ];

    return sendEmail($bookingData['client_email'], $subject, $template, $data);
}

/**
 * Send booking reminder email (24 hours before)
 */
function sendBookingReminder($bookingData) {
    $subject = EMAIL_TYPES['booking_reminder']['subject'];
    $template = EMAIL_TYPES['booking_reminder']['template'];

    $data = [
        'client_name' => $bookingData['client_name'],
        'service_name' => $bookingData['service_name'] ?? 'Konsultasi',
        'booking_date' => date('d F Y', strtotime($bookingData['booking_date'])),
        'booking_time' => date('H:i', strtotime($bookingData['booking_time'])),
        'meeting_type' => $bookingData['meeting_type'],
        'meeting_link' => $bookingData['meeting_link'] ?? '',
        'company_name' => COMPANY_NAME
    ];

    return sendEmail($bookingData['client_email'], $subject, $template, $data);
}

/**
 * Send contact form response
 */
function sendContactResponse($messageData, $response) {
    $subject = EMAIL_TYPES['contact_response']['subject'];
    $template = EMAIL_TYPES['contact_response']['template'];

    $data = [
        'client_name' => $messageData['name'],
        'response' => $response,
        'original_message' => $messageData['message'],
        'company_name' => COMPANY_NAME
    ];

    return sendEmail($messageData['email'], $subject, $template, $data);
}

/**
 * Send welcome email to new admin
 */
function sendAdminWelcome($adminData) {
    $subject = EMAIL_TYPES['welcome_admin']['subject'];
    $template = EMAIL_TYPES['welcome_admin']['template'];

    $data = [
        'admin_name' => $adminData['name'],
        'login_url' => BASE_URL . 'admin/login',
        'company_name' => COMPANY_NAME
    ];

    return sendEmail($adminData['email'], $subject, $template, $data);
}

/**
 * Send notification to admin about new booking
 */
function notifyAdminNewBooking($bookingData) {
    $subject = 'Booking Baru - Syntaxtrust';
    $template = 'admin-booking-notification';

    $data = [
        'client_name' => $bookingData['client_name'],
        'client_email' => $bookingData['client_email'],
        'service_name' => $bookingData['service_name'] ?? 'Konsultasi',
        'booking_date' => date('d F Y', strtotime($bookingData['booking_date'])),
        'booking_time' => date('H:i', strtotime($bookingData['booking_time'])),
        'requirements' => $bookingData['requirements'] ?? '',
        'admin_panel_url' => BASE_URL . 'admin/bookings'
    ];

    return sendEmail(ADMIN_EMAIL, $subject, $template, $data);
}

/**
 * Send notification to admin about new contact message
 */
function notifyAdminNewMessage($messageData) {
    $subject = 'Pesan Kontak Baru - Syntaxtrust';
    $template = 'admin-message-notification';

    $data = [
        'client_name' => $messageData['name'],
        'client_email' => $messageData['email'],
        'message_preview' => substr($messageData['message'], 0, 100) . '...',
        'admin_panel_url' => BASE_URL . 'admin/messages'
    ];

    return sendEmail(ADMIN_EMAIL, $subject, $template, $data);
}
