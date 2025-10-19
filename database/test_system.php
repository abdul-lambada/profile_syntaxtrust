<?php
/**
 * Profile Syntaxtrust - System Test Script
 * Tests all major functionality of the PHP backend
 */

// Include configuration
require_once '../config.php';
require_once '../app/core/Database.php';

echo "🧪 Testing Profile Syntaxtrust Backend...\n\n";

$tests = [];
$errors = [];

try {
    $db = Database::getInstance();

    // Test 1: Database Connection
    echo "1. Testing database connection...\n";
    try {
        $db->query('SELECT 1');
        $tests[] = "✅ Database connection successful";
        echo "   ✅ Database connection successful\n";
    } catch (Exception $e) {
        $errors[] = "❌ Database connection failed: " . $e->getMessage();
        echo "   ❌ Database connection failed: " . $e->getMessage() . "\n";
    }

    // Test 2: Tables Existence
    echo "2. Testing database tables...\n";
    $requiredTables = [
        'admins', 'bookings', 'contact_messages', 'faqs',
        'portfolio_items', 'pricing_packages', 'service_categories',
        'service_images', 'services', 'testimonials', 'users'
    ];

    foreach ($requiredTables as $table) {
        try {
            $exists = $db->fetchColumn("SHOW TABLES LIKE '{$table}'");
            if ($exists) {
                $tests[] = "✅ Table {$table} exists";
                echo "   ✅ Table {$table} exists\n";
            } else {
                $errors[] = "❌ Table {$table} missing";
                echo "   ❌ Table {$table} missing\n";
            }
        } catch (Exception $e) {
            $errors[] = "❌ Error checking table {$table}: " . $e->getMessage();
            echo "   ❌ Error checking table {$table}: " . $e->getMessage() . "\n";
        }
    }

    // Test 3: Sample Data
    echo "3. Testing sample data...\n";

    // Check service categories
    $categoryCount = $db->count('service_categories');
    if ($categoryCount >= 3) {
        $tests[] = "✅ Service categories created ({$categoryCount})";
        echo "   ✅ Service categories created ({$categoryCount})\n";
    } else {
        $errors[] = "❌ Service categories not created properly";
        echo "   ❌ Service categories not created properly\n";
    }

    // Check services
    $serviceCount = $db->count('services');
    if ($serviceCount >= 3) {
        $tests[] = "✅ Services created ({$serviceCount})";
        echo "   ✅ Services created ({$serviceCount})\n";
    } else {
        $errors[] = "❌ Services not created properly";
        echo "   ❌ Services not created properly\n";
    }

    // Test 4: Models
    echo "4. Testing model classes...\n";
    try {
        $serviceModel = new Service();
        $userModel = new User();
        $bookingModel = new Booking();

        $tests[] = "✅ Model classes loaded successfully";
        echo "   ✅ Model classes loaded successfully\n";
    } catch (Exception $e) {
        $errors[] = "❌ Model classes failed to load: " . $e->getMessage();
        echo "   ❌ Model classes failed to load: " . $e->getMessage() . "\n";
    }

    // Test 5: Controllers
    echo "5. Testing controller classes...\n";
    try {
        $homeController = new HomeController();
        $authController = new AuthController();

        $tests[] = "✅ Controller classes loaded successfully";
        echo "   ✅ Controller classes loaded successfully\n";
    } catch (Exception $e) {
        $errors[] = "❌ Controller classes failed to load: " . $e->getMessage();
        echo "   ❌ Controller classes failed to load: " . $e->getMessage() . "\n";
    }

    // Test 6: File Structure
    echo "6. Testing file structure...\n";
    $requiredFiles = [
        'config.php',
        'index.php',
        '.htaccess',
        'composer.json',
        'app/core/Database.php',
        'app/core/Router.php',
        'app/core/Controller.php'
    ];

    foreach ($requiredFiles as $file) {
        if (file_exists($file)) {
            $tests[] = "✅ File {$file} exists";
            echo "   ✅ File {$file} exists\n";
        } else {
            $errors[] = "❌ File {$file} missing";
            echo "   ❌ File {$file} missing\n";
        }
    }

    // Test 7: Directory Structure
    echo "7. Testing directory structure...\n";
    $requiredDirs = [
        'app/controllers',
        'app/models',
        'app/views',
        'app/core',
        'assets/css',
        'assets/js',
        'database',
        'uploads'
    ];

    foreach ($requiredDirs as $dir) {
        if (is_dir($dir)) {
            $tests[] = "✅ Directory {$dir} exists";
            echo "   ✅ Directory {$dir} exists\n";
        } else {
            $errors[] = "❌ Directory {$dir} missing";
            echo "   ❌ Directory {$dir} missing\n";
        }
    }

    // Test 8: Configuration
    echo "8. Testing configuration...\n";
    try {
        if (defined('BASE_URL') && defined('DB_HOST') && defined('APP_NAME')) {
            $tests[] = "✅ Configuration constants defined";
            echo "   ✅ Configuration constants defined\n";
        } else {
            $errors[] = "❌ Configuration constants missing";
            echo "   ❌ Configuration constants missing\n";
        }
    } catch (Exception $e) {
        $errors[] = "❌ Configuration test failed: " . $e->getMessage();
        echo "   ❌ Configuration test failed: " . $e->getMessage() . "\n";
    }

    // Summary
    echo "\n📊 Test Summary:\n";
    echo "✅ Passed: " . count($tests) . "\n";
    echo "❌ Failed: " . count($errors) . "\n";

    if (empty($errors)) {
        echo "\n🎉 All tests passed! The backend is ready for use.\n";
        echo "\n🚀 Next Steps:\n";
        echo "1. Access admin panel: http://localhost/profile_syntaxtrust/admin/login\n";
        echo "2. Login with: admin@syntaxtrust.com / admin123\n";
        echo "3. Start managing your website content\n";
        echo "4. Configure email settings for notifications\n";
    } else {
        echo "\n⚠️  Some tests failed. Please fix the issues above.\n";
        echo "\n🔧 Common fixes:\n";
        echo "- Run: php database/setup.php\n";
        echo "- Run: php database/create_admin.php\n";
        echo "- Check database connection in config.php\n";
        echo "- Install Composer dependencies: composer install\n";
    }

} catch (Exception $e) {
    echo "💥 Critical error during testing: " . $e->getMessage() . "\n";
    exit(1);
}
?>
