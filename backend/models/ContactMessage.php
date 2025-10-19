<?php
/**
 * Profile Syntaxtrust - ContactMessage Model
 * Handles contact message-related database operations
 */

class ContactMessage extends Model {
    protected $table = 'contact_messages';

    public function create($data) {
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');

        // Set default status if not provided
        if (!isset($data['status'])) {
            $data['status'] = 'new';
        }

        return $this->db->insert($this->table, $data);
    }

    public function markAsRead($messageId, $userId) {
        return $this->db->update($this->table, [
            'status' => 'read',
            'updated_at' => date('Y-m-d H:i:s')
        ], 'id = ?', [$messageId]);
    }

    public function respond($messageId, $response, $userId) {
        return $this->db->update($this->table, [
            'status' => 'responded',
            'response' => $response,
            'responded_by' => $userId,
            'responded_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ], 'id = ?', [$messageId]);
    }

    public function close($messageId) {
        return $this->db->update($this->table, [
            'status' => 'closed',
            'updated_at' => date('Y-m-d H:i:s')
        ], 'id = ?', [$messageId]);
    }

    public function getByStatus($status, $limit = null) {
        $orderBy = 'created_at DESC';

        if ($limit) {
            return $this->db->select($this->table, '*', 'status = ?', [$status], $orderBy, $limit);
        }

        return $this->db->select($this->table, '*', 'status = ?', [$status], $orderBy);
    }

    public function getUnreadCount() {
        return $this->db->count($this->table, 'status = ?', ['new']);
    }

    public function getStats() {
        return $this->db->fetch('
            SELECT
                COUNT(*) as total_messages,
                COUNT(CASE WHEN status = "new" THEN 1 END) as new_messages,
                COUNT(CASE WHEN status = "read" THEN 1 END) as read_messages,
                COUNT(CASE WHEN status = "responded" THEN 1 END) as responded_messages,
                COUNT(CASE WHEN status = "closed" THEN 1 END) as closed_messages
            FROM contact_messages
        ');
    }

    public function getRecent($limit = 10) {
        return $this->db->select($this->table, '*', '', [], 'created_at DESC', $limit);
    }
}
