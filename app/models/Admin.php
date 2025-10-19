<?php
/**
 * Profile Syntaxtrust - Admin Model
 * Handles admin user management and authentication
 */

class Admin extends User {
    protected $table = 'admins';

    public function findByEmail($email) {
        return $this->db->fetch('SELECT * FROM ' . $this->table . ' WHERE email = ? AND is_active = 1', [$email]);
    }

    public function create($data) {
        $data['password_hash'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $data['role'] = $data['role'] ?? 'admin';
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');

        return $this->db->insert($this->table, $data);
    }

    public function updateProfile($adminId, $data) {
        unset($data['password']); // Don't update password here
        $data['updated_at'] = date('Y-m-d H:i:s');

        return $this->db->update($this->table, $data, 'id = ?', [$adminId]);
    }

    public function updatePassword($adminId, $newPassword) {
        $passwordHash = password_hash($newPassword, PASSWORD_DEFAULT);
        return $this->db->update($this->table, [
            'password_hash' => $passwordHash,
            'updated_at' => date('Y-m-d H:i:s')
        ], 'id = ?', [$adminId]);
    }

    public function getDashboardStats() {
        return $this->db->fetch('
            SELECT
                (SELECT COUNT(*) FROM services WHERE is_active = 1) as total_services,
                (SELECT COUNT(*) FROM portfolio_items WHERE is_active = 1) as total_portfolio,
                (SELECT COUNT(*) FROM bookings WHERE status = "pending") as pending_bookings,
                (SELECT COUNT(*) FROM contact_messages WHERE status = "new") as new_messages,
                (SELECT COUNT(*) FROM testimonials WHERE is_active = 1) as total_testimonials
        ');
    }

    public function getRecentActivity($limit = 10) {
        return $this->db->fetchAll('
            (SELECT "booking" as type, b.created_at as date, b.client_name as title, b.status as status
             FROM bookings b ORDER BY b.created_at DESC LIMIT ?)
            UNION ALL
            (SELECT "message" as type, cm.created_at as date, cm.name as title, cm.status as status
             FROM contact_messages cm ORDER BY cm.created_at DESC LIMIT ?)
            ORDER BY date DESC LIMIT ?
        ', [$limit/2, $limit/2, $limit]);
    }
}
