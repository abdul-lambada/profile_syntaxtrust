<?php
/**
 * Profile Syntaxtrust - Database Connection Class
 * Handles all database operations with PDO
 */

class Database {
    private static $instance = null;
    private $pdo;
    private $statement;

    private function __construct() {
        try {
            $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET;
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES " . DB_CHARSET . " COLLATE utf8mb4_unicode_ci"
            ];

            $this->pdo = new PDO($dsn, DB_USER, DB_PASS, $options);

            // Set MySQL session timezone
            $this->pdo->exec("SET time_zone = '+07:00'");

        } catch(PDOException $e) {
            $this->handleError($e);
        }
    }

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function query($sql, $params = []) {
        try {
            $this->statement = $this->pdo->prepare($sql);
            $this->statement->execute($params);
            return $this->statement;
        } catch(PDOException $e) {
            $this->handleError($e);
        }
    }

    public function fetch($sql, $params = []) {
        $statement = $this->query($sql, $params);
        return $statement->fetch();
    }

    public function fetchAll($sql, $params = []) {
        $statement = $this->query($sql, $params);
        return $statement->fetchAll();
    }

    public function fetchColumn($sql, $params = []) {
        $statement = $this->query($sql, $params);
        return $statement->fetchColumn();
    }

    public function insert($table, $data) {
        $keys = array_keys($data);
        $values = array_values($data);

        $placeholders = array_map(function($key) {
            return ':' . $key;
        }, $keys);

        $sql = 'INSERT INTO ' . $table . ' (' . implode(', ', $keys) . ')
                VALUES (' . implode(', ', $placeholders) . ')';

        $this->query($sql, array_combine($placeholders, $values));
        return $this->pdo->lastInsertId();
    }

    public function update($table, $data, $where, $whereParams = []) {
        $setParts = [];
        $params = [];

        foreach ($data as $key => $value) {
            $setParts[] = $key . ' = :' . $key;
            $params[':' . $key] = $value;
        }

        $params = array_merge($params, $whereParams);

        $sql = 'UPDATE ' . $table . ' SET ' . implode(', ', $setParts) .
               ' WHERE ' . $where;

        return $this->query($sql, $params)->rowCount();
    }

    public function delete($table, $where, $params = []) {
        $sql = 'DELETE FROM ' . $table . ' WHERE ' . $where;
        return $this->query($sql, $params)->rowCount();
    }

    public function select($table, $columns = '*', $where = '', $params = [], $orderBy = '', $limit = '') {
        $sql = 'SELECT ' . $columns . ' FROM ' . $table;

        if (!empty($where)) {
            $sql .= ' WHERE ' . $where;
        }

        if (!empty($orderBy)) {
            $sql .= ' ORDER BY ' . $orderBy;
        }

        if (!empty($limit)) {
            $sql .= ' LIMIT ' . $limit;
        }

        return $this->fetchAll($sql, $params);
    }

    public function count($table, $where = '', $params = []) {
        $sql = 'SELECT COUNT(*) as count FROM ' . $table;

        if (!empty($where)) {
            $sql .= ' WHERE ' . $where;
        }

        return $this->fetchColumn($sql, $params);
    }

    public function exists($table, $where, $params = []) {
        return $this->count($table, $where, $params) > 0;
    }

    public function beginTransaction() {
        return $this->pdo->beginTransaction();
    }

    public function commit() {
        return $this->pdo->commit();
    }

    public function rollBack() {
        return $this->pdo->rollBack();
    }

    public function getLastInsertId() {
        return $this->pdo->lastInsertId();
    }

    public function quote($string) {
        return $this->pdo->quote($string);
    }

    private function handleError(PDOException $e) {
        // Log error untuk production
        error_log('Database Error: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine());

        // Untuk development, tampilkan error
        if (defined('DEBUG_MODE') && DEBUG_MODE) {
            die('Database Error: ' . $e->getMessage());
        } else {
            die('Terjadi kesalahan database. Silakan coba lagi nanti.');
        }
    }

    // Utility methods for common operations
    public function getServices($activeOnly = true) {
        $where = $activeOnly ? 'is_active = 1' : '1=1';
        return $this->select('services', '*', $where, [], 'sort_order ASC');
    }

    public function getServiceCategories($activeOnly = true) {
        $where = $activeOnly ? 'is_active = 1' : '1=1';
        return $this->select('service_categories', '*', $where, [], 'sort_order ASC');
    }

    public function getPricingPackages($serviceId = null, $activeOnly = true) {
        $where = '1=1';
        $params = [];

        if ($serviceId) {
            $where .= ' AND service_id = :service_id';
            $params[':service_id'] = $serviceId;
        }

        if ($activeOnly) {
            $where .= ' AND is_active = 1';
        }

        return $this->select('pricing_packages', '*', $where, $params, 'sort_order ASC');
    }

    public function getPortfolioItems($serviceId = null, $limit = null) {
        $where = 'is_active = 1';
        $params = [];

        if ($serviceId) {
            $where .= ' AND service_id = :service_id';
            $params[':service_id'] = $serviceId;
        }

        $orderBy = 'is_featured DESC, sort_order ASC, created_at DESC';

        if ($limit) {
            return $this->select('portfolio_items', '*', $where, $params, $orderBy, $limit);
        }

        return $this->select('portfolio_items', '*', $where, $params, $orderBy);
    }

    public function getTestimonials($limit = null) {
        $where = 'is_active = 1';
        $orderBy = 'is_featured DESC, created_at DESC';

        if ($limit) {
            return $this->select('testimonials', '*', $where, [], $orderBy, $limit);
        }

        return $this->select('testimonials', '*', $where, [], $orderBy);
    }

    public function getFaqs($categoryId = null) {
        $where = 'is_active = 1';
        $params = [];

        if ($categoryId) {
            $where .= ' AND category_id = :category_id';
            $params[':category_id'] = $categoryId;
        }

        return $this->select('faqs', '*', $where, $params, 'sort_order ASC');
    }

    public function createBooking($data) {
        return $this->insert('bookings', $data);
    }

    public function createContactMessage($data) {
        return $this->insert('contact_messages', $data);
    }

    public function getBookings($userId = null, $status = null) {
        $where = '1=1';
        $params = [];

        if ($userId) {
            $where .= ' AND user_id = :user_id';
            $params[':user_id'] = $userId;
        }

        if ($status) {
            $where .= ' AND status = :status';
            $params[':status'] = $status;
        }

        return $this->select('bookings', '*', $where, $params, 'created_at DESC');
    }
}
