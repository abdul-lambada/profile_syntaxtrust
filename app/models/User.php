<?php
/**
 * Profile Syntaxtrust - User Model
 * Handles user-related database operations
 */

class User extends Model {
    protected $table = 'users';

    public function findByEmail($email) {
        return $this->db->fetch('SELECT * FROM ' . $this->table . ' WHERE email = ? AND is_active = 1', [$email]);
    }

    public function findByPhone($phone) {
        return $this->db->fetch('SELECT * FROM ' . $this->table . ' WHERE phone = ? AND is_active = 1', [$phone]);
    }

    public function create($data) {
        $data['password_hash'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');

        $id = $this->db->insert($this->table, $data);

        // Update last login
        $this->updateLastLogin($id);

        return $id;
    }

    public function updateProfile($userId, $data) {
        unset($data['password']); // Don't update password here
        $data['updated_at'] = date('Y-m-d H:i:s');

        return $this->db->update($this->table, $data, 'id = ?', [$userId]);
    }

    public function updatePassword($userId, $newPassword) {
        $passwordHash = password_hash($newPassword, PASSWORD_DEFAULT);
        return $this->db->update($this->table, [
            'password_hash' => $passwordHash,
            'updated_at' => date('Y-m-d H:i:s')
        ], 'id = ?', [$userId]);
    }

    public function verifyPassword($password, $hash) {
        return password_verify($password, $hash);
    }

    public function updateLastLogin($userId) {
        return $this->db->update($this->table, [
            'last_login_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ], 'id = ?', [$userId]);
    }

    public function getProfile($userId) {
        return $this->db->fetch('SELECT * FROM ' . $this->table . ' WHERE id = ? AND is_active = 1', [$userId]);
    }

    public function deactivate($userId) {
        return $this->db->update($this->table, [
            'is_active' => false,
            'updated_at' => date('Y-m-d H:i:s')
        ], 'id = ?', [$userId]);
    }

    public function activate($userId) {
        return $this->db->update($this->table, [
            'is_active' => true,
            'updated_at' => date('Y-m-d H:i:s')
        ], 'id = ?', [$userId]);
    }
}
