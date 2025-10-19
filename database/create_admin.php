<?php
/**
 * Profile Syntaxtrust - Admin User Setup Script
 * Creates the initial admin user for the system
 */

// Include configuration
require_once '../config.php';
require_once '../app/core/Database.php';

echo "Setting up initial admin user...\n";

try {
    $db = Database::getInstance();

    // Check if admin table exists
    $tables = $db->fetchAll("SHOW TABLES LIKE 'admins'");
    if (empty($tables)) {
        echo "❌ Error: Admin table doesn't exist. Please run database setup first.\n";
        exit(1);
    }

    // Check if admin already exists
    $existingAdmin = $db->fetch('SELECT id FROM admins WHERE email = ? LIMIT 1', ['admin@syntaxtrust.com']);

    if ($existingAdmin) {
        echo "ℹ️  Admin user already exists. Updating password...\n";

        // Update existing admin password
        $newPassword = 'admin123'; // Default password
        $passwordHash = password_hash($newPassword, PASSWORD_DEFAULT);

        $db->update('admins', [
            'password_hash' => $passwordHash,
            'updated_at' => date('Y-m-d H:i:s')
        ], 'id = ?', [$existingAdmin['id']]);

        echo "✅ Admin password updated successfully!\n";

    } else {
        echo "📝 Creating new admin user...\n";

        // Create new admin user
        $adminData = [
            'name' => 'Administrator',
            'email' => 'admin@syntaxtrust.com',
            'password_hash' => password_hash('admin123', PASSWORD_DEFAULT),
            'phone' => '+6281234567890',
            'role' => 'super_admin',
            'is_active' => true,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $adminId = $db->insert('admins', $adminData);

        echo "✅ Admin user created successfully!\n";
        echo "   ID: {$adminId}\n";
    }

    echo "\n🔑 Admin Login Credentials:\n";
    echo "   Email: admin@syntaxtrust.com\n";
    echo "   Password: admin123\n";
    echo "   URL: http://localhost/profile_syntaxtrust/admin/login\n";
    echo "\n⚠️  IMPORTANT: Change the default password after first login!\n";

} catch (Exception $e) {
    echo "❌ Error setting up admin user: " . $e->getMessage() . "\n";
    exit(1);
}
?>
