<?php include BASE_PATH . 'templates/base.php'; ?>

<div class="container">
    <div class="stats">
        <?php 
        $allInvoices = $invoiceClass->getAllInvoices();
        $totalInvoices = count($allInvoices);
        $totalRevenue = 0;
        $pendingInvoices = 0;
        
        foreach ($allInvoices as $inv) {
            $totalRevenue += $inv['total'];
            if ($inv['status'] === 'pending') {
                $pendingInvoices++;
            }
        }
        
        $totalCustomers = $db->count('customers');
        ?>
        
        <div class="stat-card">
            <h3><i class="fas fa-file-invoice"></i> Total Invoices</h3>
            <div class="value"><?php echo $totalInvoices; ?></div>
        </div>
        
        <div class="stat-card">
            <h3><i class="fas fa-dollar-sign"></i> Total Revenue</h3>
            <div class="value">$<?php echo number_format($totalRevenue, 0); ?></div>
        </div>
        
        <div class="stat-card">
            <h3><i class="fas fa-clock"></i> Pending Invoices</h3>
            <div class="value"><?php echo $pendingInvoices; ?></div>
        </div>
        
        <div class="stat-card">
            <h3><i class="fas fa-users"></i> Total Customers</h3>
            <div class="value"><?php echo $totalCustomers; ?></div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h2><i class="fas fa-history"></i> Recent Invoices</h2>
            <a href="?action=create_invoice" class="btn btn-primary"><i class="fas fa-plus"></i> New Invoice</a>
        </div>
        
        <?php if (count($allInvoices) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Invoice #</th>
                        <th>Customer</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Due Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $recentInvoices = array_slice($allInvoices, 0, 10);
                    foreach ($recentInvoices as $invoice): 
                        $customer = $db->fetch('customers', 'id = ?', [$invoice['customer_id']]);
                        $statusClass = 'badge-' . $invoice['status'];
                    ?>
                        <tr>
                            <td><strong><?php echo htmlspecialchars($invoice['invoice_number']); ?></strong></td>
                            <td><?php echo htmlspecialchars($customer['name']); ?></td>
                            <td>$<?php echo number_format($invoice['total'], 2); ?></td>
                            <td><span class="badge <?php echo $statusClass; ?>"><?php echo ucfirst($invoice['status']); ?></span></td>
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
                <h3>No invoices yet</h3>
                <p>Create your first invoice to get started</p>
                <a href="?action=create_invoice" class="btn btn-primary"><i class="fas fa-plus"></i> Create Invoice</a>
            </div>
        <?php endif; ?>
    </div>

    <div class="card">
        <div class="card-header">
            <h2><i class="fas fa-address-book"></i> Recent Customers</h2>
            <a href="?action=create_customer" class="btn btn-primary"><i class="fas fa-plus"></i> Add Customer</a>
        </div>
        
        <?php 
        $recentCustomers = array_slice($customerClass->getAllCustomers(), 0, 5);
        if (count($recentCustomers) > 0): 
        ?>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recentCustomers as $customer): ?>
                        <tr>
                            <td><strong><?php echo htmlspecialchars($customer['name']); ?></strong></td>
                            <td><?php echo htmlspecialchars($customer['email']); ?></td>
                            <td><?php echo htmlspecialchars($customer['phone']); ?></td>
                            <td>
                                <a href="?action=view_customer&id=<?php echo $customer['id']; ?>" class="btn btn-primary btn-small"><i class="fas fa-eye"></i> View</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="empty-state">
                <i class="fas fa-users"></i>
                <h3>No customers yet</h3>
                <p>Add your first customer to start creating invoices</p>
                <a href="?action=create_customer" class="btn btn-primary"><i class="fas fa-plus"></i> Add Customer</a>
            </div>
        <?php endif; ?>
    </div>
</div>
