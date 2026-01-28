<?php include BASE_PATH . 'templates/base.php'; ?>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h2><i class="fas fa-file-lines"></i> Invoices</h2>
        </div>
        
        <div class="search-box">
            <form method="GET" style="display: flex; gap: 10px; width: 100%;">
                <input type="hidden" name="action" value="invoices">
                <input type="text" name="search" placeholder="Search by invoice number or customer name..." 
                       value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Search</button>
                <a href="?action=invoices" class="btn btn-secondary"><i class="fas fa-times"></i> Clear</a>
            </form>
        </div>

        <?php if (isset($invoices) && count($invoices) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Invoice #</th>
                        <th>Customer</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Issue Date</th>
                        <th>Due Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($invoices as $invoice): 
                        $customer = $db->fetch('customers', 'id = ?', [$invoice['customer_id']]);
                        $statusClass = 'badge-' . $invoice['status'];
                    ?>
                        <tr>
                            <td><strong><?php echo htmlspecialchars($invoice['invoice_number']); ?></strong></td>
                            <td><?php echo htmlspecialchars($customer['name']); ?></td>
                            <td>$<?php echo number_format($invoice['total'], 2); ?></td>
                            <td><span class="badge <?php echo $statusClass; ?>"><?php echo ucfirst($invoice['status']); ?></span></td>
                            <td><?php echo date('M d, Y', strtotime($invoice['issue_date'])); ?></td>
                            <td><?php echo date('M d, Y', strtotime($invoice['due_date'])); ?></td>
                            <td>
                                <div class="actions">
                                    <a href="?action=view_invoice&id=<?php echo $invoice['id']; ?>" class="btn btn-primary btn-small"><i class="fas fa-eye"></i> View</a>
                                    <a href="?action=print_invoice&id=<?php echo $invoice['id']; ?>" class="btn btn-secondary btn-small" target="_blank"><i class="fas fa-print"></i> Print</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="empty-state">
                <i class="fas fa-inbox"></i>
                <h3>No invoices found</h3>
                <p>Create your first invoice to get started</p>
                <a href="?action=create_invoice" class="btn btn-primary"><i class="fas fa-plus"></i> Create Invoice</a>
            </div>
        <?php endif; ?>
    </div>
</div>
