<?php

class Invoice {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    public function create($customerId, $issueDate, $dueDate, $items, $notes = '') {
        $invoiceNumber = $this->generateInvoiceNumber();
        
        // Calculate totals
        $subtotal = 0;
        foreach ($items as $item) {
            $subtotal += $item['amount'];
        }
        $tax = round($subtotal * 0.1, 2); // 10% tax
        $total = round($subtotal + $tax, 2);

        // Insert invoice
        $invoiceData = [
            'invoice_number' => $invoiceNumber,
            'customer_id' => $customerId,
            'issue_date' => $issueDate,
            'due_date' => $dueDate,
            'subtotal' => $subtotal,
            'tax' => $tax,
            'total' => $total,
            'notes' => $notes
        ];

        $this->db->insert('invoices', $invoiceData);
        $invoiceId = $this->db->getLastInsertId();

        // Insert items
        foreach ($items as $item) {
            $itemData = [
                'invoice_id' => $invoiceId,
                'description' => $item['description'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['unit_price'],
                'amount' => $item['amount']
            ];
            $this->db->insert('invoice_items', $itemData);
        }

        return $invoiceId;
    }

    public function getInvoice($id) {
        $invoice = $this->db->fetch('invoices', 'id = ?', [$id]);
        if ($invoice) {
            $invoice['items'] = $this->db->fetchAll('invoice_items', 'invoice_id = ?', [$id]);
            $invoice['customer'] = $this->db->fetch('customers', 'id = ?', [$invoice['customer_id']]);
        }
        return $invoice;
    }

    public function getAllInvoices($status = '') {
        $where = '';
        $params = [];
        if ($status) {
            $where = 'status = ?';
            $params = [$status];
        }
        return $this->db->fetchAll('invoices', $where, $params, 'created_at DESC');
    }

    public function updateInvoice($id, $data) {
        return $this->db->update('invoices', $data, 'id = ?', [$id]);
    }

    public function deleteInvoice($id) {
        return $this->db->delete('invoices', 'id = ?', [$id]);
    }

    public function updateStatus($id, $status) {
        return $this->updateInvoice($id, ['status' => $status]);
    }

    private function generateInvoiceNumber() {
        $count = $this->db->count('invoices') + 1;
        $date = date('Y');
        return 'INV-' . $date . '-' . str_pad($count, 4, '0', STR_PAD_LEFT);
    }

    public function searchInvoices($query) {
        $sql = "SELECT i.* FROM invoices i 
                JOIN customers c ON i.customer_id = c.id 
                WHERE i.invoice_number LIKE ? OR c.name LIKE ?
                ORDER BY i.created_at DESC";
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare($sql);
        $searchTerm = "%$query%";
        $stmt->execute([$searchTerm, $searchTerm]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
