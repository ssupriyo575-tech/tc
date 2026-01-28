<?php include BASE_PATH . 'templates/base.php'; ?>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h2><i class="fas fa-file-invoice"></i> <?php echo htmlspecialchars($invoice['invoice_number']); ?></h2>
            <div class="actions">
                <a href="?action=print_invoice&id=<?php echo $invoice['id']; ?>" class="btn btn-primary" target="_blank"><i class="fas fa-print"></i> Print/PDF</a>
                <a href="?action=invoices" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
            <div>
                <h3 style="color: #667eea; margin-bottom: 10px;">Bill To</h3>
                <p><strong><?php echo htmlspecialchars($invoice['customer']['name']); ?></strong></p>
                <?php if ($invoice['customer']['address']): ?>
                    <p><?php echo htmlspecialchars($invoice['customer']['address']); ?></p>
                <?php endif; ?>
                <?php if ($invoice['customer']['city']): ?>
                    <p><?php echo htmlspecialchars($invoice['customer']['city']); ?>, 
                       <?php echo htmlspecialchars($invoice['customer']['state']); ?> 
                       <?php echo htmlspecialchars($invoice['customer']['zip_code']); ?></p>
                <?php endif; ?>
                <?php if ($invoice['customer']['email']): ?>
                    <p><?php echo htmlspecialchars($invoice['customer']['email']); ?></p>
                <?php endif; ?>
                <?php if ($invoice['customer']['phone']): ?>
                    <p><?php echo htmlspecialchars($invoice['customer']['phone']); ?></p>
                <?php endif; ?>
            </div>

            <div>
                <h3 style="color: #667eea; margin-bottom: 10px;">Invoice Details</h3>
                <p><strong>Issue Date:</strong> <?php echo date('M d, Y', strtotime($invoice['issue_date'])); ?></p>
                <p><strong>Due Date:</strong> <?php echo date('M d, Y', strtotime($invoice['due_date'])); ?></p>
                <p><strong>Status:</strong> 
                    <span class="badge badge-<?php echo $invoice['status']; ?>">
                        <?php echo ucfirst($invoice['status']); ?>
                    </span>
                </p>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Description</th>
                    <th style="text-align: right;">Quantity</th>
                    <th style="text-align: right;">Unit Price</th>
                    <th style="text-align: right;">Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($invoice['items'] as $item): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['description']); ?></td>
                        <td style="text-align: right;"><?php echo $item['quantity']; ?></td>
                        <td style="text-align: right;">$<?php echo number_format($item['unit_price'], 2); ?></td>
                        <td style="text-align: right;">$<?php echo number_format($item['amount'], 2); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div style="width: 50%; margin-left: auto; margin-top: 20px;">
            <div style="display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #ddd;">
                <span>Subtotal:</span>
                <span>$<?php echo number_format($invoice['subtotal'], 2); ?></span>
            </div>
            <div style="display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #ddd;">
                <span>Tax (10%):</span>
                <span>$<?php echo number_format($invoice['tax'], 2); ?></span>
            </div>
            <div style="display: flex; justify-content: space-between; padding: 15px 0; font-weight: bold; font-size: 18px; color: #667eea; border-top: 2px solid #667eea;">
                <span>Total:</span>
                <span>$<?php echo number_format($invoice['total'], 2); ?></span>
            </div>
        </div>

        <?php if ($invoice['notes']): ?>
            <div style="background: #f8f9fa; padding: 15px; border-radius: 5px; margin-top: 20px; border-left: 4px solid #667eea;">
                <h4 style="margin-top: 0;">Notes</h4>
                <p><?php echo nl2br(htmlspecialchars($invoice['notes'])); ?></p>
            </div>
        <?php endif; ?>

        <div style="margin-top: 30px; display: flex; gap: 10px;">
            <form method="POST" style="flex: 1;">
                <input type="hidden" name="update_status" value="1">
                <select name="status" onchange="this.form.submit()" style="padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                    <option value="pending" <?php echo $invoice['status'] === 'pending' ? 'selected' : ''; ?>>Mark as Pending</option>
                    <option value="paid" <?php echo $invoice['status'] === 'paid' ? 'selected' : ''; ?>>Mark as Paid</option>
                    <option value="overdue" <?php echo $invoice['status'] === 'overdue' ? 'selected' : ''; ?>>Mark as Overdue</option>
                </select>
            </form>

            <form method="POST" style="flex: 1;">
                <input type="hidden" name="delete_invoice" value="1">
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this invoice?');" style="width: 100%;"><i class="fas fa-trash"></i> Delete Invoice</button>
            </form>
        </div>
    </div>
</div>
