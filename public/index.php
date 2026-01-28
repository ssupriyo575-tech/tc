<?php
// Start session
session_start();

// Include autoloader and classes
require_once __DIR__ . '/../src/config/Database.php';
require_once __DIR__ . '/../src/classes/Invoice.php';
require_once __DIR__ . '/../src/classes/Customer.php';
require_once __DIR__ . '/../src/classes/PDF.php';

// Initialize database
$db = new Database();
$invoiceClass = new Invoice($db);
$customerClass = new Customer($db);

// Set base path for includes
define('BASE_PATH', __DIR__ . '/../');

// Route handling
$action = isset($_GET['action']) ? $_GET['action'] : 'dashboard';
$id = isset($_GET['id']) ? (int)$_GET['id'] : null;

// Handle POST requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['create_customer'])) {
        $customerClass->create([
            'name' => $_POST['name'],
            'email' => $_POST['email'] ?? '',
            'phone' => $_POST['phone'] ?? '',
            'address' => $_POST['address'] ?? '',
            'city' => $_POST['city'] ?? '',
            'state' => $_POST['state'] ?? '',
            'zip_code' => $_POST['zip_code'] ?? '',
            'country' => $_POST['country'] ?? ''
        ]);
        $_SESSION['message'] = 'Customer created successfully!';
        header('Location: ?action=customers');
        exit;
    }

    if (isset($_POST['create_invoice'])) {
        $customerId = (int)$_POST['customer_id'];
        $items = [];
        
        // Process invoice items
        if (isset($_POST['items'])) {
            foreach ($_POST['items'] as $item) {
                if (!empty($item['description']) && !empty($item['quantity']) && !empty($item['unit_price'])) {
                    $items[] = [
                        'description' => $item['description'],
                        'quantity' => (float)$item['quantity'],
                        'unit_price' => (float)$item['unit_price'],
                        'amount' => (float)$item['quantity'] * (float)$item['unit_price']
                    ];
                }
            }
        }

        if (!empty($items)) {
            $invoiceId = $invoiceClass->create(
                $customerId,
                $_POST['issue_date'],
                $_POST['due_date'],
                $items,
                $_POST['notes'] ?? ''
            );
            $_SESSION['message'] = 'Invoice created successfully!';
            header('Location: ?action=view_invoice&id=' . $invoiceId);
            exit;
        } else {
            $_SESSION['error'] = 'Please add at least one item to the invoice.';
        }
    }

    if (isset($_POST['update_status'])) {
        $invoiceClass->updateStatus($id, $_POST['status']);
        $_SESSION['message'] = 'Invoice status updated!';
        header('Location: ?action=view_invoice&id=' . $id);
        exit;
    }

    if (isset($_POST['delete_invoice'])) {
        $invoiceClass->deleteInvoice($id);
        $_SESSION['message'] = 'Invoice deleted successfully!';
        header('Location: ?action=dashboard');
        exit;
    }

    if (isset($_POST['delete_customer'])) {
        $customerClass->deleteCustomer($id);
        $_SESSION['message'] = 'Customer deleted successfully!';
        header('Location: ?action=customers');
        exit;
    }
}

// Handle search
if (isset($_GET['search'])) {
    if ($action === 'invoices') {
        $invoices = $invoiceClass->searchInvoices($_GET['search']);
    } elseif ($action === 'customers') {
        $customers = $customerClass->searchCustomers($_GET['search']);
    }
}

// Load appropriate template
switch ($action) {
    case 'dashboard':
        include BASE_PATH . 'templates/dashboard.php';
        break;
    case 'invoices':
        if (!isset($invoices)) {
            $invoices = $invoiceClass->getAllInvoices();
        }
        include BASE_PATH . 'templates/invoices/list.php';
        break;
    case 'create_invoice':
        $customers = $customerClass->getAllCustomers();
        include BASE_PATH . 'templates/invoices/create.php';
        break;
    case 'view_invoice':
        if ($id) {
            $invoice = $invoiceClass->getInvoice($id);
            if ($invoice) {
                include BASE_PATH . 'templates/invoices/view.php';
            } else {
                echo "Invoice not found.";
            }
        }
        break;
    case 'print_invoice':
        if ($id) {
            $invoice = $invoiceClass->getInvoice($id);
            if ($invoice) {
                $pdf = new PDF($invoice);
                echo $pdf->generate();
            }
        }
        break;
    case 'customers':
        if (!isset($customers)) {
            $customers = $customerClass->getAllCustomers();
        }
        include BASE_PATH . 'templates/customers/list.php';
        break;
    case 'create_customer':
        include BASE_PATH . 'templates/customers/create.php';
        break;
    case 'view_customer':
        if ($id) {
            $customer = $customerClass->getCustomer($id);
            if ($customer) {
                $customerInvoices = $customerClass->getCustomerInvoices($id);
                include BASE_PATH . 'templates/customers/view.php';
            } else {
                echo "Customer not found.";
            }
        }
        break;
    default:
        include BASE_PATH . 'templates/dashboard.php';
}
?>
