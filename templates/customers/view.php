<?php include BASE_PATH . 'templates/base.php'; ?>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h2><i class="fas fa-user"></i> <?php echo htmlspecialchars($customer['name']); ?></h2>
            <a href="?action=customers" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px; margin-bottom: 30px;">
            <div>
                <h3 style="color: #3498db; margin-bottom: 15px;"><i class="fas fa-info-circle"></i> Contact Information</h3>
                <div style="background: #f8f9fa; padding: 15px; border-radius: 5px;">
                    <?php if ($customer['email']): ?>
                        <p><strong>Email:</strong> <a href="mailto:<?php echo htmlspecialchars($customer['email']); ?>"><?php echo htmlspecialchars($customer['email']); ?></a></p>
                    <?php endif; ?>
                    <?php if ($customer['phone']): ?>
                        <p><strong>Phone:</strong> <?php echo htmlspecialchars($customer['phone']); ?></p>
                    <?php endif; ?>
                    <?php if ($customer['address']): ?>
                        <p><strong>Address:</strong> <?php echo htmlspecialchars($customer['address']); ?></p>
                    <?php endif; ?>
                    <?php if ($customer['city']): ?>
                        <p><strong>City:</strong> <?php echo htmlspecialchars($customer['city']); ?></p>
                    <?php endif; ?>
                    <?php if ($customer['state']): ?>
                        <p><strong>State:</strong> <?php echo htmlspecialchars($customer['state']); ?></p>
                    <?php endif; ?>
                    <?php if ($customer['zip_code']): ?>
                        <p><strong>ZIP Code:</strong> <?php echo htmlspecialchars($customer['zip_code']); ?></p>
                    <?php endif; ?>
                    <?php if ($customer['country']): ?>
                        <p><strong>Country:</strong> <?php echo htmlspecialchars($customer['country']); ?></p>
                    <?php endif; ?>
                </div>
            </div>

            <div>
                <h3 style="color: #3498db; margin-bottom: 15px;"><i class="fas fa-bolt"></i> Quick Actions</h3>
                <a href="?action=create_invoice" class="btn btn-primary" style="width: 100%; text-align: center;"><i class="fas fa-plus"></i> Create Invoice</a>
            </div>
        </div>

        <h3 style="color: #3498db; margin-bottom: 15px;"><i class="fas fa-list"></i> Invoices</h3>
        
        <?php if (count($customerInvoices) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Invoice #</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Issue Date</th>
                        <th>Due Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($customerInvoices as $inv): 
                        $statusClass = 'badge-' . $inv['status'];
                    ?>
                        <tr>
                            <td><strong><?php echo htmlspecialchars($inv['invoice_number']); ?></strong></td>
                            <td>$<?php echo number_format($inv['total'], 2); ?></td>
                            <td><span class="badge <?php echo $statusClass; ?>"><?php echo ucfirst($inv['status']); ?></span></td>
                            <td><?php echo date('M d, Y', strtotime($inv['issue_date'])); ?></td>
                            <td><?php echo date('M d, Y', strtotime($inv['due_date'])); ?></td>
                            <td>
                                <div class="actions">
                                    <a href="?action=view_invoice&id=<?php echo $inv['id']; ?>" class="btn btn-primary btn-small"><i class="fas fa-eye"></i> View</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="empty-state">
                <p>No invoices for this customer yet</p>
            </div>
        <?php endif; ?>

        <div style="margin-top: 30px;">
            <form method="POST" onsubmit="return confirm('Are you sure you want to delete this customer?');">
                <input type="hidden" name="delete_customer" value="1">
                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Delete Customer</button>
            </form>
        </div>
    </div>
</div>
