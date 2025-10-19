<?php
/**
 * Profile Syntaxtrust - Portfolio Model
 * Handles portfolio item-related database operations
 */

class Portfolio extends Model {
    protected $table = 'portfolio_items';

    public function getFeatured($limit = 6) {
        return $this->findAll(['is_featured' => 1], 'sort_order ASC, created_at DESC', $limit);
    }

    public function getByService($serviceId) {
        return $this->findAll(['service_id' => $serviceId], 'sort_order ASC, created_at DESC');
    }

    public function getWithImages($portfolioId) {
        return $this->db->fetch('
            SELECT p.*, GROUP_CONCAT(pi.image_path) as images
            FROM portfolio_items p
            LEFT JOIN service_images pi ON p.id = pi.portfolio_item_id
            WHERE p.id = ? AND p.is_active = 1
            GROUP BY p.id
        ', [$portfolioId]);
    }

    public function getImages($portfolioId) {
        return $this->db->select('service_images', '*',
            'portfolio_item_id = ?', [$portfolioId],
            'sort_order ASC, is_primary DESC');
    }
}
