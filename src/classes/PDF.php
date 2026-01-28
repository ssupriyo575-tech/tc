<?php

class PDF {
    private $invoice;
    private $customer;
    private $items;

    public function __construct($invoiceData) {
        $this->invoice = $invoiceData;
        $this->customer = $invoiceData['customer'];
        $this->items = $invoiceData['items'];
    }

    public function generate() {
        ob_start();
        ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Invoice <?php echo htmlspecialchars($this->invoice['invoice_number']); ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
        }
        .invoice-container {
            border: 1px solid #ddd;
            padding: 30px;
            background-color: #fff;
        }
        .header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            border-bottom: 2px solid #007bff;
            padding-bottom: 20px;
        }
        .company-info h1 {
            margin: 0 0 10px 0;
            color: #007bff;
        }
        .invoice-details {
            text-align: right;
        }
        .invoice-details h2 {
            margin: 0;
            color: #007bff;
            font-size: 32px;
        }
        .invoice-meta {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-bottom: 30px;
        }
        .section-title {
            font-weight: bold;
            margin-bottom: 10px;
            color: #007bff;
        }
        .section {
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 30px 0;
        }
        th {
            background-color: #007bff;
            color: white;
            padding: 12px;
            text-align: left;
            border: 1px solid #0056b3;
        }
        td {
            padding: 12px;
            border: 1px solid #ddd;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .text-right {
            text-align: right;
        }
        .summary {
            width: 50%;
            margin-left: auto;
            margin-top: 20px;
        }
        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
        }
        .summary-row.total {
            font-weight: bold;
            font-size: 18px;
            color: #007bff;
            border-top: 2px solid #007bff;
            border-bottom: 2px solid #007bff;
            margin-top: 10px;
            padding: 15px 0;
        }
        .notes {
            margin-top: 30px;
            padding: 15px;
            background-color: #f8f9fa;
            border-left: 4px solid #007bff;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            color: #666;
            font-size: 12px;
            border-top: 1px solid #ddd;
            padding-top: 20px;
        }
        @media print {
            body {
                margin: 0;
                padding: 0;
            }
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <div class="header">
            <div class="company-info">
                <h1>Invoice</h1>
                <p>Your Company Name</p>
                <p>123 Business Street</p>
                <p>City, State 12345</p>
            </div>
            <div class="invoice-details">
                <h2><?php echo htmlspecialchars($this->invoice['invoice_number']); ?></h2>
            </div>
        </div>

        <div class="invoice-meta">
            <div>
                <div class="section-title">Bill To</div>
                <div class="section">
                    <strong><?php echo htmlspecialchars($this->customer['name']); ?></strong><br>
                    <?php if ($this->customer['address']): ?>
                        <?php echo htmlspecialchars($this->customer['address']); ?><br>
                    <?php endif; ?>
                    <?php if ($this->customer['city']): ?>
                        <?php echo htmlspecialchars($this->customer['city']); ?>, 
                        <?php echo htmlspecialchars($this->customer['state']); ?> 
                        <?php echo htmlspecialchars($this->customer['zip_code']); ?><br>
                    <?php endif; ?>
                    <?php if ($this->customer['email']): ?>
                        <?php echo htmlspecialchars($this->customer['email']); ?><br>
                    <?php endif; ?>
                    <?php if ($this->customer['phone']): ?>
                        <?php echo htmlspecialchars($this->customer['phone']); ?>
                    <?php endif; ?>
                </div>
            </div>
            <div>
                <div class="section-title">Invoice Details</div>
                <div class="section">
                    <strong>Issue Date:</strong> <?php echo date('M d, Y', strtotime($this->invoice['issue_date'])); ?><br>
                    <strong>Due Date:</strong> <?php echo date('M d, Y', strtotime($this->invoice['due_date'])); ?><br>
                    <strong>Status:</strong> <span style="text-transform: capitalize;"><?php echo htmlspecialchars($this->invoice['status']); ?></span>
                </div>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Description</th>
                    <th class="text-right">Quantity</th>
                    <th class="text-right">Unit Price</th>
                    <th class="text-right">Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($this->items as $item): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['description']); ?></td>
                        <td class="text-right"><?php echo $item['quantity']; ?></td>
                        <td class="text-right">$<?php echo number_format($item['unit_price'], 2); ?></td>
                        <td class="text-right">$<?php echo number_format($item['amount'], 2); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="summary">
            <div class="summary-row">
                <span>Subtotal:</span>
                <span>$<?php echo number_format($this->invoice['subtotal'], 2); ?></span>
            </div>
            <div class="summary-row">
                <span>Tax (10%):</span>
                <span>$<?php echo number_format($this->invoice['tax'], 2); ?></span>
            </div>
            <div class="summary-row total">
                <span>Total:</span>
                <span>$<?php echo number_format($this->invoice['total'], 2); ?></span>
            </div>
        </div>

        <?php if ($this->invoice['notes']): ?>
            <div class="notes">
                <strong>Notes:</strong><br>
                <?php echo nl2br(htmlspecialchars($this->invoice['notes'])); ?>
            </div>
        <?php endif; ?>

        <div class="footer">
            <p>Thank you for your business!</p>
            <p>Generated on <?php echo date('M d, Y'); ?></p>
        </div>
    </div>
</body>
</html>
        <?php
        return ob_get_clean();
    }
}
