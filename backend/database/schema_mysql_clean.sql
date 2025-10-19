-- Create database
CREATE DATABASE IF NOT EXISTS profile_syntaxtrust CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Use database
USE profile_syntaxtrust;

-- =====================================================
-- TABLE: service_categories
-- =====================================================

CREATE TABLE service_categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    slug VARCHAR(100) UNIQUE NOT NULL,
    sort_order INT DEFAULT 0,
    is_active BOOLEAN DEFAULT true,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- =====================================================
-- TABLE: services
-- =====================================================

CREATE TABLE services (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT NOT NULL,
    name VARCHAR(200) NOT NULL,
    description TEXT,
    features JSON,
    icon VARCHAR(255),
    slug VARCHAR(100) UNIQUE NOT NULL,
    sort_order INT DEFAULT 0,
    is_featured BOOLEAN DEFAULT false,
    is_active BOOLEAN DEFAULT true,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES service_categories(id) ON DELETE CASCADE
);

-- =====================================================
-- TABLE: pricing_packages
-- =====================================================

CREATE TABLE pricing_packages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    service_id INT NOT NULL,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    price_min DECIMAL(10,2) NOT NULL,
    price_max DECIMAL(10,2) NOT NULL,
    features JSON,
    duration VARCHAR(50),
    package_type ENUM('basic', 'standard', 'premium', 'enterprise') DEFAULT 'standard',
    sort_order INT DEFAULT 0,
    is_popular BOOLEAN DEFAULT false,
    is_active BOOLEAN DEFAULT true,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (service_id) REFERENCES services(id) ON DELETE CASCADE
);

-- =====================================================
-- TABLE: users
-- =====================================================

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    phone VARCHAR(20),
    foto VARCHAR(255),
    password_hash VARCHAR(255),
    is_active BOOLEAN DEFAULT true,
    email_verified_at TIMESTAMP NULL,
    phone_verified_at TIMESTAMP NULL,
    last_login_at TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- =====================================================
-- TABLE: portfolio_items
-- =====================================================

CREATE TABLE portfolio_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    service_id INT NOT NULL,
    title VARCHAR(200) NOT NULL,
    description TEXT,
    challenge TEXT,
    solution TEXT,
    results TEXT,
    client_name VARCHAR(255),
    project_type VARCHAR(100),
    project_date DATE,
    project_url VARCHAR(255),
    status ENUM('planning', 'in_progress', 'review', 'completed', 'delivered') DEFAULT 'completed',
    slug VARCHAR(100) UNIQUE NOT NULL,
    sort_order INT DEFAULT 0,
    is_featured BOOLEAN DEFAULT false,
    is_active BOOLEAN DEFAULT true,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (service_id) REFERENCES services(id) ON DELETE CASCADE
);

-- =====================================================
-- TABLE: service_images
-- =====================================================

CREATE TABLE service_images (
    id INT AUTO_INCREMENT PRIMARY KEY,
    portfolio_item_id INT NOT NULL,
    image_path VARCHAR(255) NOT NULL,
    alt_text VARCHAR(255),
    image_type ENUM('screenshot', 'mockup', 'diagram', 'photo', 'logo') DEFAULT 'screenshot',
    sort_order INT DEFAULT 0,
    is_primary BOOLEAN DEFAULT false,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (portfolio_item_id) REFERENCES portfolio_items(id) ON DELETE CASCADE
);

-- =====================================================
-- TABLE: testimonials
-- =====================================================

CREATE TABLE testimonials (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    portfolio_item_id INT,
    service_id INT,
    client_name VARCHAR(100) NOT NULL,
    client_company VARCHAR(100),
    testimonial TEXT NOT NULL,
    rating INT CHECK (rating >= 1 AND rating <= 5),
    project_type VARCHAR(100),
    is_featured BOOLEAN DEFAULT false,
    is_active BOOLEAN DEFAULT true,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL,
    FOREIGN KEY (portfolio_item_id) REFERENCES portfolio_items(id) ON DELETE SET NULL,
    FOREIGN KEY (service_id) REFERENCES services(id) ON DELETE SET NULL
);

-- =====================================================
-- TABLE: contact_messages
-- =====================================================

CREATE TABLE contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20),
    message TEXT NOT NULL,
    status ENUM('new', 'read', 'responded', 'closed') DEFAULT 'new',
    response TEXT,
    responded_by INT,
    responded_at TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL,
    FOREIGN KEY (responded_by) REFERENCES users(id) ON DELETE SET NULL
);

-- =====================================================
-- TABLE: bookings
-- =====================================================

CREATE TABLE bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    service_id INT NOT NULL,
    pricing_package_id INT,
    client_name VARCHAR(100) NOT NULL,
    client_email VARCHAR(100) NOT NULL,
    client_phone VARCHAR(20),
    booking_date DATE NOT NULL,
    booking_time TIME NOT NULL,
    status ENUM('pending', 'confirmed', 'completed', 'cancelled', 'no_show') DEFAULT 'pending',
    notes TEXT,
    requirements TEXT,
    meeting_type ENUM('video_call', 'phone_call', 'in_person', 'chat') DEFAULT 'video_call',
    meeting_link VARCHAR(255),
    meeting_password VARCHAR(100),
    reminder_sent_at TIMESTAMP NULL,
    completed_at TIMESTAMP NULL,
    cancelled_at TIMESTAMP NULL,
    cancellation_reason TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL,
    FOREIGN KEY (service_id) REFERENCES services(id) ON DELETE CASCADE,
    FOREIGN KEY (pricing_package_id) REFERENCES pricing_packages(id) ON DELETE SET NULL
);

-- =====================================================
-- TABLE: faqs
-- =====================================================

CREATE TABLE faqs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT,
    question VARCHAR(255) NOT NULL,
    answer TEXT NOT NULL,
    sort_order INT DEFAULT 0,
    is_active BOOLEAN DEFAULT true,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES service_categories(id) ON DELETE CASCADE
);

-- =====================================================
-- INDEXES FOR PERFORMANCE
-- =====================================================

-- Users table indexes
CREATE INDEX idx_users_email ON users(email);
CREATE INDEX idx_users_is_active ON users(is_active);

-- Services table indexes
CREATE INDEX idx_services_category_id ON services(category_id);
CREATE INDEX idx_services_slug ON services(slug);
CREATE INDEX idx_services_is_active ON services(is_active);
CREATE INDEX idx_services_is_featured ON services(is_featured);

-- Portfolio items indexes
CREATE INDEX idx_portfolio_items_service_id ON portfolio_items(service_id);
CREATE INDEX idx_portfolio_items_slug ON portfolio_items(slug);
CREATE INDEX idx_portfolio_items_is_active ON portfolio_items(is_active);
CREATE INDEX idx_portfolio_items_is_featured ON portfolio_items(is_featured);

-- Bookings indexes
CREATE INDEX idx_bookings_user_id ON bookings(user_id);
CREATE INDEX idx_bookings_service_id ON bookings(service_id);
CREATE INDEX idx_bookings_status ON bookings(status);
CREATE INDEX idx_bookings_booking_date ON bookings(booking_date);
CREATE INDEX idx_bookings_booking_datetime ON bookings(booking_date, booking_time);

-- Contact messages indexes
CREATE INDEX idx_contact_messages_status ON contact_messages(status);
CREATE INDEX idx_contact_messages_created_at ON contact_messages(created_at);

-- Testimonials indexes
CREATE INDEX idx_testimonials_is_featured ON testimonials(is_featured);
CREATE INDEX idx_testimonials_is_active ON testimonials(is_active);

-- =====================================================
-- SAMPLE DATA INSERTION
-- =====================================================

-- Insert sample service categories
INSERT INTO service_categories (name, description, slug, sort_order) VALUES
('Website Tugas Mata Kuliah', 'Pembuatan website untuk tugas mata kuliah sesuai rubrik dosen', 'website-tugas', 1),
('Modifikasi Website', 'Perbaikan dan pengembangan website yang sudah ada', 'modifikasi-website', 2),
('Website Skripsi/Tugas Akhir', 'Pembuatan website untuk presentasi skripsi atau tugas akhir', 'website-skripsi', 3);

-- Insert sample services
INSERT INTO services (category_id, name, description, features, icon, slug, sort_order, is_featured) VALUES
(1, 'Website Tugas Mata Kuliah', 'Bangun landing page dan halaman fitur sesuai rubrik dosen',
 '["Mapping rubrik dosen", "UI responsif", "Form integrasi", "Dokumentasi lengkap"]', 'code', 'website-tugas-kuliah', 1, true),
(2, 'Modifikasi Website Mahasiswa', 'Optimasi proyek berjalan atau bangun website custom untuk Skripsi/Tugas Akhir',
 '["Audit kode", "Perbaikan bug", "Fitur tambahan", "Optimasi performa"]', 'wrench', 'modifikasi-website', 2, true),
(3, 'Website Skripsi/Tugas Akhir', 'Buat portal presentasi untuk Skripsi/Tugas Akhir',
 '["Portal presentasi", "Fitur sesuai rubrik", "Demo siap", "Handover lengkap"]', 'graduation-cap', 'website-skripsi', 3, true);

-- Insert sample pricing packages
INSERT INTO pricing_packages (service_id, name, description, price_min, price_max, features, duration, package_type, is_popular) VALUES
(1, 'Paket Basic Tugas', 'Website sederhana sesuai rubrik dasar', 300000, 500000,
 '["3 halaman inti", "Responsive layout", "Form kontak", "Dokumentasi"]', '3-5 hari', 'basic', false),
(1, 'Paket Standard Tugas', 'Website lengkap dengan fitur sesuai rubrik', 500000, 800000,
 '["5+ halaman", "UI/UX design", "Database integration", "Demo session"]', '1 minggu', 'standard', true),
(2, 'Paket Modifikasi', 'Perbaikan dan pengembangan website existing', 500000, 1200000,
 '["Code audit", "Bug fixes", "Feature addition", "Performance optimization"]', '1-2 minggu', 'standard', false),
(3, 'Paket Skripsi Premium', 'Website lengkap untuk presentasi skripsi', 2500000, 5000000,
 '["Portal presentasi", "Admin dashboard", "API integration", "Full documentation"]', '2-4 minggu', 'premium', true);

-- =====================================================
-- VIEWS FOR COMMON QUERIES
-- =====================================================

-- Active services with categories
CREATE VIEW v_active_services AS
SELECT
    s.*,
    sc.name as category_name,
    sc.slug as category_slug
FROM services s
JOIN service_categories sc ON s.category_id = sc.id
WHERE s.is_active = true AND sc.is_active = true
ORDER BY sc.sort_order, s.sort_order;

-- Portfolio with service information
CREATE VIEW v_portfolio_with_services AS
SELECT
    p.*,
    s.name as service_name,
    s.slug as service_slug,
    sc.name as category_name
FROM portfolio_items p
JOIN services s ON p.service_id = s.id
JOIN service_categories sc ON s.category_id = sc.id
WHERE p.is_active = true AND s.is_active = true;

-- Booking statistics
CREATE VIEW v_booking_stats AS
SELECT
    b.service_id,
    s.name as service_name,
    COUNT(*) as total_bookings,
    COUNT(CASE WHEN b.status = 'completed' THEN 1 END) as completed_bookings,
    COUNT(CASE WHEN b.status = 'cancelled' THEN 1 END) as cancelled_bookings,
    AVG(TIMESTAMPDIFF(DAY, b.created_at, b.completed_at)) as avg_completion_days
FROM bookings b
JOIN services s ON b.service_id = s.id
GROUP BY b.service_id, s.name;

-- =====================================================
-- STORED PROCEDURES/FUNCTIONS
-- =====================================================

DELIMITER //

-- Function to get available booking slots
CREATE FUNCTION get_available_slots(
    p_service_id INT,
    p_booking_date DATE,
    p_start_time TIME,
    p_end_time TIME
)
RETURNS TEXT
READS SQL DATA
DETERMINISTIC
BEGIN
    DECLARE result TEXT DEFAULT '';
    DECLARE slot_time TIME DEFAULT p_start_time;
    DECLARE is_available BOOLEAN DEFAULT true;

    WHILE slot_time <= p_end_time DO
        -- Check if slot is booked
        SELECT COUNT(*) > 0 INTO is_available
        FROM bookings
        WHERE service_id = p_service_id
        AND booking_date = p_booking_date
        AND booking_time = slot_time
        AND status NOT IN ('cancelled', 'no_show');

        IF is_available = false THEN
            SET result = CONCAT(result, '"', slot_time, '": false, ');
        ELSE
            SET result = CONCAT(result, '"', slot_time, '": true, ');
        END IF;

        SET slot_time = ADDTIME(slot_time, '00:30:00');
    END WHILE;

    -- Remove trailing comma and space
    SET result = TRIM(TRAILING ', ' FROM result);

    RETURN CONCAT('{', result, '}');
END //

-- Function to create booking with validation
CREATE FUNCTION create_booking(
    p_user_id INT,
    p_service_id INT,
    p_pricing_package_id INT,
    p_client_name VARCHAR(100),
    p_client_email VARCHAR(100),
    p_client_phone VARCHAR(20),
    p_booking_date DATE,
    p_booking_time TIME,
    p_requirements TEXT
)
RETURNS INT
MODIFIES SQL DATA
DETERMINISTIC
BEGIN
    DECLARE v_booking_id INT DEFAULT 0;
    DECLARE slot_count INT DEFAULT 0;

    -- Check if slot is available
    SELECT COUNT(*) INTO slot_count
    FROM bookings
    WHERE service_id = p_service_id
    AND booking_date = p_booking_date
    AND booking_time = p_booking_time
    AND status NOT IN ('cancelled', 'no_show');

    IF slot_count > 0 THEN
        RETURN 0; -- Slot not available
    END IF;

    -- Create booking
    INSERT INTO bookings (
        user_id, service_id, pricing_package_id, client_name,
        client_email, client_phone, booking_date, booking_time,
        requirements
    ) VALUES (
        p_user_id, p_service_id, p_pricing_package_id, p_client_name,
        p_client_email, p_client_phone, p_booking_date, p_booking_time,
        p_requirements
    );

    SET v_booking_id = LAST_INSERT_ID();

    RETURN v_booking_id;
END //

DELIMITER ;

-- Table comments (these work in MySQL)
ALTER TABLE users COMMENT = 'User accounts for clients with profile photos and authentication';
ALTER TABLE services COMMENT = 'Available services offered by Syntaxtrust';
ALTER TABLE pricing_packages COMMENT = 'Pricing tiers for each service';
ALTER TABLE portfolio_items COMMENT = 'Showcase of completed projects';
ALTER TABLE bookings COMMENT = 'Consultation and appointment bookings';
ALTER TABLE contact_messages COMMENT = 'Client inquiries and messages';
ALTER TABLE testimonials COMMENT = 'Client reviews and testimonials';

SELECT 'MySQL database schema created successfully!' as status;
