# Profile Syntaxtrust - Production Deployment Guide

## 🚀 Deployment Overview

This guide covers deploying the Profile Syntaxtrust PHP backend to a production environment with proper security, performance, and maintenance considerations.

## 📋 Prerequisites

- **Web Server**: Apache/Nginx with PHP 7.4+
- **Database**: MySQL 8.0+ or MariaDB 10.5+
- **SSL Certificate**: For HTTPS (recommended)
- **Domain Name**: Pointing to your server
- **Composer**: For dependency management

## 🛠️ Step 1: Server Setup

### **Install Required Software**
```bash
# Ubuntu/Debian
sudo apt update
sudo apt install apache2 mysql-server php7.4 php7.4-mysql php7.4-curl php7.4-zip php7.4-gd php7.4-mbstring php7.4-xml php7.4-bcmath

# Enable Apache modules
sudo a2enmod rewrite headers ssl

# Restart Apache
sudo systemctl restart apache2
```

### **Database Setup**
```bash
# Create database
mysql -u root -p
CREATE DATABASE profile_syntaxtrust CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
EXIT;

# Import schema
mysql -u root -p profile_syntaxtrust < database/schema_mysql.sql

# Create admin user
php database/create_admin.php
```

### **File Permissions**
```bash
# Set proper permissions
sudo chown -R www-data:www-data /var/www/profile_syntaxtrust
sudo chmod -R 755 /var/www/profile_syntaxtrust
sudo chmod -R 775 uploads/
sudo chmod -R 775 database/
```

## 🔒 Step 2: Security Configuration

### **Update Configuration**
Edit `config.php`:
```php
// Production settings
define('DEBUG_MODE', false);           // Disable error display
define('BASE_URL', 'https://yourdomain.com/');

// Database credentials (use environment variables in production)
define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
define('DB_USER', getenv('DB_USER') ?: 'your_db_user');
define('DB_PASS', getenv('DB_PASS') ?: 'your_secure_password');
define('DB_NAME', getenv('DB_NAME') ?: 'profile_syntaxtrust');

// Security
define('SESSION_COOKIE_SECURE', true);   // HTTPS only
define('SESSION_COOKIE_HTTPONLY', true);
define('CSRF_PROTECTION', true);

// Email settings
define('SMTP_HOST', 'your-smtp-server.com');
define('SMTP_USERNAME', 'your-email@domain.com');
define('SMTP_PASSWORD', 'your-app-password');
```

### **Environment Variables** (Recommended)
Create `.env` file:
```env
DB_HOST=localhost
DB_USER=syntaxtrust_user
DB_PASS=your_secure_password
DB_NAME=profile_syntaxtrust

SMTP_HOST=smtp.gmail.com
SMTP_USERNAME=your-email@gmail.com
SMTP_PASSWORD=your-app-password

ENCRYPTION_KEY=your-32-char-encryption-key
```

## 🌐 Step 3: Web Server Configuration

### **Apache Virtual Host**
```apache
<VirtualHost *:80>
    ServerName yourdomain.com
    DocumentRoot /var/www/profile_syntaxtrust

    # Enable URL rewriting
    <Directory /var/www/profile_syntaxtrust>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>

    # Security headers
    Header always set X-Content-Type-Options nosniff
    Header always set X-Frame-Options DENY
    Header always set X-XSS-Protection "1; mode=block"

    ErrorLog ${APACHE_LOG_DIR}/syntaxtrust_error.log
    CustomLog ${APACHE_LOG_DIR}/syntaxtrust_access.log combined
</VirtualHost>

# HTTPS redirect (if using SSL)
<VirtualHost *:443>
    ServerName yourdomain.com
    DocumentRoot /var/www/profile_syntaxtrust

    SSLEngine on
    SSLCertificateFile /path/to/certificate.crt
    SSLCertificateKeyFile /path/to/private.key

    # Same configuration as HTTP
</VirtualHost>
```

### **Nginx Configuration** (Alternative)
```nginx
server {
    listen 80;
    server_name yourdomain.com;
    root /var/www/profile_syntaxtrust;

    # Security headers
    add_header X-Content-Type-Options nosniff;
    add_header X-Frame-Options DENY;
    add_header X-XSS-Protection "1; mode=block";

    # Handle PHP files
    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/var/run/php/php7.4-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }

    # Handle static files
    location ~* \.(js|css|png|jpg|jpeg|gif|ico|svg)$ {
        expires 1y;
        add_header Cache-Control "public, immutable";
    }

    # Main application
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
}
```

## 📧 Step 4: Email Configuration

### **Gmail SMTP Setup**
1. Enable 2-factor authentication on Gmail
2. Generate App Password: https://myaccount.google.com/apppasswords
3. Update `app/core/Email.php`:
```php
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_USERNAME', 'your-email@gmail.com');
define('SMTP_PASSWORD', 'your-16-char-app-password');
```

### **Alternative SMTP Services**
- **SendGrid**: Professional email service
- **Amazon SES**: Cost-effective for high volume
- **Mailgun**: Developer-friendly API

## 🔧 Step 5: Performance Optimization

### **PHP Configuration**
Edit `/etc/php/7.4/apache2/php.ini`:
```ini
memory_limit = 256M
upload_max_filesize = 10M
post_max_size = 10M
max_execution_time = 300
opcache.enable = 1
opcache.memory_consumption = 128
opcache.max_accelerated_files = 10000
```

### **Database Optimization**
```sql
-- Create indexes for better performance
CREATE INDEX idx_services_active ON services(is_active);
CREATE INDEX idx_portfolio_featured ON portfolio_items(is_featured);
CREATE INDEX idx_bookings_status_date ON bookings(status, booking_date);

-- Enable query cache
SET GLOBAL query_cache_size = 268435456; -- 256MB
SET GLOBAL query_cache_type = 1;
```

### **Caching Strategy**
- **Browser caching**: Static assets (CSS, JS, images)
- **Database query caching**: Frequently accessed data
- **Session storage**: Redis or Memcached for scalability

## 📊 Step 6: Monitoring & Maintenance

### **Log Files**
```bash
# Apache logs
tail -f /var/log/apache2/syntaxtrust_error.log
tail -f /var/log/apache2/syntaxtrust_access.log

# PHP errors (if enabled)
tail -f /var/log/php7.4-fpm.log
```

### **Database Backup**
```bash
# Daily backup script
#!/bin/bash
mysqldump -u root -p profile_syntaxtrust > /backup/profile_syntaxtrust_$(date +%Y%m%d_%H%M%S).sql
find /backup -name "profile_syntaxtrust_*.sql" -mtime +7 -delete
```

### **Health Check**
Create `health.php`:
```php
<?php
// Simple health check endpoint
require_once 'config.php';
require_once 'app/core/Database.php';

try {
    $db = Database::getInstance();
    $db->query('SELECT 1');

    http_response_code(200);
    echo json_encode([
        'status' => 'healthy',
        'timestamp' => date('Y-m-d H:i:s'),
        'database' => 'connected'
    ]);

} catch (Exception $e) {
    http_response_code(503);
    echo json_encode([
        'status' => 'unhealthy',
        'error' => $e->getMessage()
    ]);
}
?>
```

## 🚨 Step 7: Security Hardening

### **Firewall Rules**
```bash
# Allow only necessary ports
sudo ufw allow 80
sudo ufw allow 443
sudo ufw allow 22  # SSH (restrict to your IP)

# Enable firewall
sudo ufw enable
```

### **File Security**
```bash
# Hide sensitive files
<FilesMatch "\.(env|log|sql)$">
    Order Allow,Deny
    Deny from all
</FilesMatch>

# Protect uploads directory
<Directory "uploads/">
    Options -Indexes
    AllowOverride None
</Directory>
```

### **PHP Security**
```php
// In php.ini
disable_functions = exec,passthru,shell_exec,system
expose_php = Off
```

## 🔄 Step 8: Deployment Workflow

### **Automated Deployment**
```bash
#!/bin/bash
# deployment.sh

echo "Deploying Profile Syntaxtrust..."

# Backup database
mysqldump -u root -p profile_syntaxtrust > backup_pre_deploy.sql

# Pull latest code
git pull origin main

# Install dependencies
composer install --no-dev --optimize-autoloader

# Run migrations (if any)
php database/migrate.php

# Clear caches
php artisan cache:clear  # If using Laravel
rm -rf var/cache/*

# Set permissions
sudo chown -R www-data:www-data /var/www/profile_syntaxtrust
sudo chmod -R 755 /var/www/profile_syntaxtrust

echo "Deployment completed successfully!"
```

### **Rollback Plan**
```bash
# Restore from backup
mysql -u root -p profile_syntaxtrust < backup_pre_deploy.sql

# Rollback git
git reset --hard HEAD~1
git push -f origin main
```

## 📈 Step 9: Scaling Considerations

### **For High Traffic**
- **Load Balancer**: Distribute traffic across multiple servers
- **Database Replication**: Read replicas for better performance
- **CDN**: For static assets (CloudFlare, AWS CloudFront)
- **Caching Layer**: Redis/Memcached for session storage

### **Database Scaling**
```sql
# Partition large tables
ALTER TABLE bookings PARTITION BY RANGE (YEAR(booking_date)) (
    PARTITION p2023 VALUES LESS THAN (2024),
    PARTITION p2024 VALUES LESS THAN (2025),
    PARTITION pmax VALUES LESS THAN MAXVALUE
);
```

## 🔍 Step 10: Testing & Verification

### **Pre-Launch Checklist**
- [ ] Database connectivity test
- [ ] Admin login functionality
- [ ] All CRUD operations working
- [ ] Email notifications working
- [ ] File upload functionality
- [ ] SSL certificate installed
- [ ] Domain DNS configured
- [ ] Backup system tested
- [ ] Security scan completed

### **Performance Testing**
```bash
# Install Apache benchmark
sudo apt install apache2-utils

# Test homepage performance
ab -n 100 -c 10 http://yourdomain.com/

# Test admin panel
ab -n 50 -c 5 http://yourdomain.com/admin/dashboard
```

## 📞 Support & Maintenance

### **Regular Tasks**
- **Daily**: Check logs for errors
- **Weekly**: Database backup verification
- **Monthly**: Security updates and patches
- **Quarterly**: Performance review and optimization

### **Emergency Contacts**
- **Development Team**: Your contact information
- **Hosting Provider**: Support contact
- **Domain Registrar**: DNS management

---

## ✅ Deployment Complete!

Your **Profile Syntaxtrust** PHP backend is now **production-ready** with:

- 🔒 **Enterprise-grade security**
- 🚀 **Optimized performance**
- 📊 **Comprehensive monitoring**
- 🔧 **Easy maintenance**
- 📈 **Scalability options**

**Launch your website and start managing your academic web development services!** 🎉
