<?php
/**
 * Invoice Making App - Quick Start Guide
 * 
 * This file provides instructions for running the application.
 */

echo "<!DOCTYPE html>
<html>
<head>
    <title>Invoice App - Quick Start</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 900px; margin: 50px auto; padding: 20px; }
        h1 { color: #667eea; }
        code { background: #f4f4f4; padding: 2px 6px; border-radius: 3px; }
        .command { background: #f4f4f4; padding: 15px; border-left: 4px solid #667eea; margin: 15px 0; font-family: monospace; }
        .success { color: #28a745; }
    </style>
</head>
<body>
    <h1>📄 Invoice Making App</h1>
    
    <h2>Quick Start</h2>
    <p>The application is ready to use! To start the PHP built-in server:</p>
    
    <div class='command'>
        cd /workspaces/tc<br>
        php -S localhost:8000 -t public
    </div>
    
    <p>Then open <strong>http://localhost:8000</strong> in your browser.</p>
    
    <h2>What's Included</h2>
    <ul>
        <li>✅ Customer management system</li>
        <li>✅ Invoice creation with multiple line items</li>
        <li>✅ Professional invoice printing/PDF</li>
        <li>✅ Dashboard with statistics</li>
        <li>✅ Search functionality</li>
        <li>✅ Status tracking (Pending, Paid, Overdue)</li>
        <li>✅ Responsive design</li>
        <li>✅ SQLite database (auto-created)</li>
    </ul>
    
    <h2>Features</h2>
    <ul>
        <li><strong>Customers:</strong> Add, view, and manage customer profiles</li>
        <li><strong>Invoices:</strong> Create invoices with auto-calculated totals</li>
        <li><strong>Print:</strong> Professional invoice layout with print optimization</li>
        <li><strong>Search:</strong> Find invoices and customers quickly</li>
        <li><strong>Dashboard:</strong> Overview of business metrics</li>
    </ul>
    
    <h2>First Steps</h2>
    <ol>
        <li>Start the server (command above)</li>
        <li>Open http://localhost:8000 in your browser</li>
        <li>Click 'Add Customer' to create your first customer</li>
        <li>Click 'Create Invoice' to create an invoice</li>
        <li>Click 'Print' to view/print the invoice</li>
    </ol>
    
    <p><strong class='success'>✓ Application is ready to use!</strong></p>
</body>
</html>";
?>
