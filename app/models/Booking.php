<?php
/**
 * Profile Syntaxtrust - Booking Model
 * Handles booking-related database operations
 */

class Booking extends Model {
    protected $table = 'bookings';

    public function create($data) {
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');

        // Set default status if not provided
        if (!isset($data['status'])) {
            $data['status'] = 'pending';
        }

        return $this->db->insert($this->table, $data);
    }

    public function getAvailableSlots($serviceId, $date, $startTime = '09:00', $endTime = '17:00') {
        // This would use the stored function we created in the schema
        return $this->db->fetchAll("
            SELECT slot_time, is_available
            FROM get_available_slots(?, ?, ?, ?)
        ", [$serviceId, $date, $startTime, $endTime]);
    }

    public function getByUser($userId) {
        return $this->db->fetchAll('
            SELECT b.*, s.name as service_name, pp.name as package_name
            FROM bookings b
            JOIN services s ON b.service_id = s.id
            LEFT JOIN pricing_packages pp ON b.pricing_package_id = pp.id
            WHERE b.user_id = ?
            ORDER BY b.created_at DESC
        ', [$userId]);
    }

    public function confirm($bookingId, $meetingLink = null, $meetingPassword = null) {
        $data = [
            'status' => 'confirmed',
            'meeting_link' => $meetingLink,
            'meeting_password' => $meetingPassword,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        return $this->db->update($this->table, $data, 'id = ?', [$bookingId]);
    }

    public function complete($bookingId) {
        return $this->db->update($this->table, [
            'status' => 'completed',
            'completed_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ], 'id = ?', [$bookingId]);
    }

    public function cancel($bookingId, $reason = null) {
        return $this->db->update($this->table, [
            'status' => 'cancelled',
            'cancelled_at' => date('Y-m-d H:i:s'),
            'cancellation_reason' => $reason,
            'updated_at' => date('Y-m-d H:i:s')
        ], 'id = ?', [$bookingId]);
    }

    public function getUpcomingBookings() {
        return $this->db->fetchAll('
            SELECT b.*, s.name as service_name, u.name as client_name, u.email as client_email
            FROM bookings b
            JOIN services s ON b.service_id = s.id
            LEFT JOIN users u ON b.user_id = u.id
            WHERE b.status = "confirmed"
            AND b.booking_date >= CURDATE()
            ORDER BY b.booking_date, b.booking_time
        ');
    }

    public function update($id, $data) {
        $data['updated_at'] = date('Y-m-d H:i:s');
        return $this->db->update($this->table, $data, 'id = ?', [$id]);
    }

    public function getStats($serviceId = null) {
        $where = '';
        $params = [];

        if ($serviceId) {
            $where = ' WHERE service_id = ?';
            $params = [$serviceId];
        }

        return $this->db->fetch('
            SELECT
                COUNT(*) as total_bookings,
                COUNT(CASE WHEN status = "completed" THEN 1 END) as completed_bookings,
                COUNT(CASE WHEN status = "cancelled" THEN 1 END) as cancelled_bookings,
                COUNT(CASE WHEN status = "pending" THEN 1 END) as pending_bookings
            FROM bookings' . $where, $params);
    }
}
