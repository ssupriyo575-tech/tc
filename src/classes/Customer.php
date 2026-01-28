<?php

class Customer {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    public function create($data) {
        return $this->db->insert('customers', $data);
    }

    public function getCustomer($id) {
        return $this->db->fetch('customers', 'id = ?', [$id]);
    }

    public function getAllCustomers() {
        return $this->db->fetchAll('customers', '', [], 'name ASC');
    }

    public function updateCustomer($id, $data) {
        return $this->db->update('customers', $data, 'id = ?', [$id]);
    }

    public function deleteCustomer($id) {
        return $this->db->delete('customers', 'id = ?', [$id]);
    }

    public function searchCustomers($query) {
        $where = "name LIKE ? OR email LIKE ? OR phone LIKE ?";
        $searchTerm = "%$query%";
        return $this->db->fetchAll('customers', $where, [$searchTerm, $searchTerm, $searchTerm], 'name ASC');
    }

    public function getCustomerInvoices($customerId) {
        return $this->db->fetchAll('invoices', 'customer_id = ?', [$customerId], 'created_at DESC');
    }
}
