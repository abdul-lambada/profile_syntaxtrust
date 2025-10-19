<?php
/**
 * Profile Syntaxtrust - Testimonial Model
 * Handles testimonial-related database operations
 */

class Testimonial extends Model {
    protected $table = 'testimonials';

    public function getFeatured($limit = 6) {
        return $this->findAll(['is_featured' => 1], 'created_at DESC', $limit);
    }

    public function getByService($serviceId) {
        return $this->db->select($this->table, '*',
            'service_id = ? AND is_active = 1', [$serviceId],
            'created_at DESC');
    }

    public function getByPortfolio($portfolioId) {
        return $this->db->select($this->table, '*',
            'portfolio_item_id = ? AND is_active = 1', [$portfolioId],
            'created_at DESC');
    }
}
