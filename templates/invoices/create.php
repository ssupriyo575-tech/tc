<?php include BASE_PATH . 'templates/base.php'; ?>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h2><i class="fas fa-file-invoice"></i> Create Invoice</h2>
        </div>
        
        <form method="POST">
            <input type="hidden" name="create_invoice" value="1">
            
            <div class="form-row">
                <div class="form-group">
                    <label for="customer_id">Customer *</label>
                    <select id="customer_id" name="customer_id" required>
                        <option value="">Select a customer</option>
                        <?php foreach ($customers as $customer): ?>
                            <option value="<?php echo $customer['id']; ?>">
                                <?php echo htmlspecialchars($customer['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <p style="margin-top: 32px;"><a href="?action=create_customer" class="btn btn-secondary btn-small"><i class="fas fa-plus"></i> Add Customer</a></p>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="issue_date">Issue Date *</label>
                    <input type="date" id="issue_date" name="issue_date" value="<?php echo date('Y-m-d'); ?>" required>
                </div>
                <div class="form-group">
                    <label for="due_date">Due Date *</label>
                    <input type="date" id="due_date" name="due_date" value="<?php echo date('Y-m-d', strtotime('+30 days')); ?>" required>
                </div>
            </div>

            <div class="form-group form-row full">
                <h3>Invoice Items</h3>
            </div>

            <div id="items-container">
                <div class="item-row">
                    <div class="item-header">
                        <input type="text" name="items[0][description]" placeholder="Item description" required>
                        <input type="number" name="items[0][quantity]" placeholder="Qty" step="0.01" required>
                        <input type="number" name="items[0][unit_price]" placeholder="Unit Price" step="0.01" required>
                        <input type="text" readonly placeholder="Amount" style="background: #f0f0f0;">
                        <button type="button" class="remove-item" onclick="removeItem(this)"><i class="fas fa-times"></i> Remove</button>
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-secondary" onclick="addItem()"><i class="fas fa-plus"></i> Add Item</button>

            <div class="form-group form-row full" style="margin-top: 30px;">
                <div class="form-group">
                    <label for="notes">Notes</label>
                    <textarea id="notes" name="notes" placeholder="Invoice notes, payment terms, etc."></textarea>
                </div>
            </div>

            <div class="form-group form-row full">
                <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Create Invoice</button>
                <a href="?action=invoices" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Cancel</a>
            </div>
        </form>
    </div>
</div>

<script>
let itemCount = 1;

function addItem() {
    const container = document.getElementById('items-container');
    const newItem = container.querySelector('.item-row').cloneNode(true);
    
    // Update field names
    const inputs = newItem.querySelectorAll('input[type="text"], input[type="number"]');
    inputs[0].name = `items[${itemCount}][description]`;
    inputs[1].name = `items[${itemCount}][quantity]`;
    inputs[2].name = `items[${itemCount}][unit_price]`;
    
    // Clear values
    inputs.forEach(input => input.value = '');
    
    // Add event listeners for amount calculation
    inputs[1].addEventListener('change', calculateAmount);
    inputs[2].addEventListener('change', calculateAmount);
    
    container.appendChild(newItem);
    itemCount++;
}

function removeItem(btn) {
    const items = document.querySelectorAll('.item-row');
    if (items.length > 1) {
        btn.closest('.item-row').remove();
    } else {
        alert('At least one item is required');
    }
}

function calculateAmount() {
    const itemRows = document.querySelectorAll('.item-row');
    itemRows.forEach(row => {
        const inputs = row.querySelectorAll('input[type="number"]');
        const amountInput = row.querySelector('input[readonly]');
        if (inputs[0].value && inputs[1].value) {
            const amount = parseFloat(inputs[0].value) * parseFloat(inputs[1].value);
            amountInput.value = amount.toFixed(2);
        }
    });
}

// Add event listeners to initial item
document.addEventListener('DOMContentLoaded', () => {
    const inputs = document.querySelectorAll('.item-row input[type="number"]');
    inputs.forEach(input => {
        input.addEventListener('change', calculateAmount);
    });
});
</script>
