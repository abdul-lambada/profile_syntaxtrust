<?php
/**
 * Profile Syntaxtrust - Base Model Class
 * Provides common database operations for all models
 */

class Model {
    protected $db;
    protected $table;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function find($id) {
        return $this->db->fetch('SELECT * FROM ' . $this->table . ' WHERE id = ? AND is_active = 1', [$id]);
    }

    public function findAll($conditions = [], $orderBy = '', $limit = '') {
        $where = 'is_active = 1';
        $params = [];

        if (!empty($conditions)) {
            $where .= ' AND ' . implode(' AND ', array_map(function($key) {
                return $key . ' = ?';
            }, array_keys($conditions)));
            $params = array_values($conditions);
        }

        return $this->db->select($this->table, '*', $where, $params, $orderBy, $limit);
    }

    public function findBy($field, $value) {
        return $this->db->fetch('SELECT * FROM ' . $this->table . ' WHERE ' . $field . ' = ? AND is_active = 1', [$value]);
    }

    public function create($data) {
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        return $this->db->insert($this->table, $data);
    }

    public function update($id, $data) {
        $data['updated_at'] = date('Y-m-d H:i:s');
        return $this->db->update($this->table, $data, 'id = ?', [$id]);
    }

    public function delete($id) {
        return $this->db->update($this->table, [
            'is_active' => false,
            'updated_at' => date('Y-m-d H:i:s')
        ], 'id = ?', [$id]);
    }

    public function count($conditions = []) {
        $where = 'is_active = 1';
        $params = [];

        if (!empty($conditions)) {
            $where .= ' AND ' . implode(' AND ', array_map(function($key) {
                return $key . ' = ?';
            }, array_keys($conditions)));
            $params = array_values($conditions);
        }

        return $this->db->count($this->table, $where, $params);
    }

    public function exists($conditions) {
        return $this->count($conditions) > 0;
    }
}
