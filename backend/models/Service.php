<?php
/**
 * Profile Syntaxtrust - Service Model
 * Handles service-related database operations
 */

class Service extends Model {
    protected $table = 'services';

    public function getWithCategory() {
        return $this->db->fetchAll('
            SELECT s.*, sc.name as category_name, sc.slug as category_slug
            FROM services s
            JOIN service_categories sc ON s.category_id = sc.id
            WHERE s.is_active = 1 AND sc.is_active = 1
            ORDER BY sc.sort_order, s.sort_order
        ');
    }

    public function getFeatured() {
        return $this->findAll(['is_featured' => 1], 'sort_order ASC');
    }

    public function getByCategory($categoryId) {
        return $this->findAll(['category_id' => $categoryId], 'sort_order ASC');
    }

    public function getPricingPackages($serviceId) {
        return $this->db->fetchAll('
            SELECT * FROM pricing_packages
            WHERE service_id = ? AND is_active = 1
            ORDER BY sort_order
        ', [$serviceId]);
    }

    public function getPortfolioItems($serviceId = null, $limit = null) {
        $where = 'is_active = 1';
        $params = [];

        if ($serviceId) {
            $where .= ' AND service_id = ?';
            $params[] = $serviceId;
        }

        $orderBy = 'is_featured DESC, sort_order ASC, created_at DESC';

        if ($limit) {
            return $this->db->select('portfolio_items', '*', $where, $params, $orderBy, $limit);
        }

        return $this->db->select('portfolio_items', '*', $where, $params, $orderBy);
    }
}
