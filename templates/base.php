<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Management System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #ecf0f1 100%);
            color: #2c3e50;
            min-height: 100vh;
        }
        
        .navbar {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            color: white;
            padding: 20px 0;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
            position: sticky;
            top: 0;
            z-index: 100;
        }
        
        .navbar-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .navbar h1 {
            font-size: 28px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 0;
            letter-spacing: 0.5px;
        }
        
        .navbar h1 i {
            font-size: 32px;
            color: #3498db;
        }
        
        .nav-links {
            display: flex;
            gap: 8px;
            list-style: none;
            flex-wrap: wrap;
        }
        
        .nav-links a {
            color: white;
            text-decoration: none;
            padding: 10px 18px;
            border-radius: 6px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            font-weight: 500;
        }
        
        .nav-links a:hover {
            background: rgba(52, 152, 219, 0.3);
            box-shadow: 0 2px 8px rgba(0,0,0,0.2);
            transform: translateY(-2px);
        }
        
        .nav-links i {
            font-size: 16px;
        }
        
        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px;
        }
        
        .alert {
            padding: 16px 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-left: 4px solid;
            animation: slideDown 0.3s ease;
        }
        
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            padding: 25px;
            margin-bottom: 25px;
            transition: box-shadow 0.3s ease;
        }
        
        .card:hover {
            box-shadow: 0 6px 25px rgba(0,0,0,0.12);
        }
        
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 18px;
            border-bottom: 2px solid #ecf0f1;
        }
        
        .card-header h2 {
            margin: 0;
            color: #2c3e50;
            font-size: 26px;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .card-header h2 i {
            color: #3498db
        .alert-error i {
            color: #dc3545;
            font-size: 18px;
        }
        
        .card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            padding: 20px;
            margin-bottom: 20px;
        }
        
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2flex;
            align-items: center;
            gap: 8px;
            padding: 11px 22px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
            transition: all 0.3s ease;
            font-weight: 500;
            letter-spacing: 0.3px;
        }
        
        .btn i {
            font-size: 15px;
        }
        
        .btn-primary {
            background-color: #3498db;
            color: white;
        }
        
        .btn-primary:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(52, 152, 219, 0.4);
        }
        
        .btn-secondary {
            background-color: #95a5a6;
            color: white;
        }
        
        .btn-secondary:hover {
            background-color: #7f8c8d;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(127, 140, 141, 0.3);
        }
        
        .btn-success {
            background-color: #27ae60;
            color: white;
        }
        
        .btn-success:hover {
            background-color: #229954;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(39, 174, 96, 0.4);
        }
        
        .btn-danger {
            background-color: #e74c3c;
            color: white;
        }
        
        .btn-danger:hover {
            background-color: #c0392b;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(231, 76, 60, 0.4);
        }
        
        .btn-small {
            padding: 7px 14
        
        .btn-danger {
            background-color: #dc3545;
            color: white;
        }
        
        .btn-danger:hover {
            background-color: #c82333;
        }ecf0f1;
            border-bottom: 2px solid #bdc3c7;
        }
        
        table th {
            padding: 16px;
            text-align: left;
            font-weight: 600;
            color: #2c3e50;
            text-transform: uppercase;
            font-size: 13px;
            letter-spacing: 0.5px;
        }
        
        table td {
            padding: 16px;
            border-bottom: 1px solid #ecf0f1
            border-bottom: 2px solid #dee2e6;
        }
        
        table th {
            padding: 15px;2px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #2c3e50;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }
        
        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #ecf0f1;
            border-radius: 6px;
            font-size: 14px;
            font-family: inherit;
            transition: all 0.3s ease;
        }
        
        .form-group textarea {
            resize: vertical;
            min-height: 120px;
        }
        
        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 0 4px rgba(52, 152, 219, 0.1);
            background-color: #f8fbff;
        }
        
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25 textarea {
            resize: vertical;
            min-height: 100px;
        }
        
        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }
        
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }8px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5pxlumns: 1fr;
        }
        
        .badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }
        
        .badge-pending {
            background-color: #fff3cd;
            color: #856404;
        }
        
        .badge-paid {
            background-color: #d4edda;
            color: #155724;
        }
        
        .badge-overdue {
            background-color5px;
        }
        
        .search-box input {
            flex: 1;
            padding: 12px 15px;
            border: 2px solid #ecf0f1;
            border-radius: 6px;
            font-size: 14px;
            transition: all 0.3s ease;
        }
        
        .search-box input:focus {
            border-color: #3498db;
            box-shadow: 0 0 0 4px rgba(52, 152, 219, 0.1)x;
        }
        
        .search-box input {60px, 1fr));
            gap: 25px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #3498db, #9b59b6);
        }
        
        .stat-card:hover {
            box-shad2px solid #ecf0f1;
            border-radius: 8px;
            padding: 18px;
            margin-bottom: 15px;
            background: white;
            transition: all 0.3s ease;
        }
        
        .item-row:hover {
            border-color: #3498db;
            box-shadow: 0 4px 12px rgba(52, 152, 219, 0.15);
        }
        
        .item-row.template {
            display: none;
        }
        
        .item-header {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr auto;
            gap: 12px;
            align-items: center;
        }
        
        .item-header input {
            padding: 10px;
            border: 1px solid #ecf0f1;
            border-radius: 4px;
            font-size: 13px;
            transition: all 0.3s ease;
        }
        
        .item-header input:focus {
            border-color: #3498db;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
        }
        
        .remove-item {
            background: #e74c3c;
            color: white;
            border: none;
            padding: 8px 12px;
            border-ra80px 20px;
            color: #7f8c8d;
        }
        
        .empty-state h3 {
            margin-bottom: 12px;
            color: #2c3e50;
            font-size: 24px;
        }
        
        .empty-state p {
            margin-bottom: 20px;
            font-size: 15px;
        }
        
        .empty-state i {
            font-size: 64px;
            color: #bdc3c7;
            margin-bottom: 20px;
            display: block;
        }<i class="fas fa-file-invoice-dollar"></i> Invoice Manager</h1>
            <ul class="nav-links">
                <li><a href="?action=dashboard"><i class="fas fa-home"></i>Dashboard</a></li>
                <li><a href="?action=invoices"><i class="fas fa-file-lines"></i>Invoices</a></li>
                <li><a href="?action=create_invoice"><i class="fas fa-plus-circle"></i>Create</a></li>
                <li><a href="?action=customers"><i class="fas fa-users"></i>Customers</a></li>
                <li><a href="?action=create_customer"><i class="fas fa-user-plus"></i>Add</a></li>
            </ul>
        </div>
    </div>

    <div class="container">
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                <span><?php echo htmlspecialchars($_SESSION['message']); unset($_SESSION['message']); ?></span>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-error">
                <i class="fas fa-exclamation-circle"></i>
                <span><?php echo htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?></span
                grid-template-columns: 1fr;
            } center;
            gap: 6px;
        }
        
        .remove-item:hover {
            background: #c0392b;
            transform: scale(1.05);
        }
        
        .remove-item i {
            font-size: 13px
            font-size: 32px;
            font-weight: 700;
            color: #333;
        }
        
        .item-row {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 15px;
            background: white;
        }
        
        .item-row.template {
            display: none;
        }
        
        .item-header {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr auto;
            gap: 10px;
            align-items: center;
        }
        
        .item-header input {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        
        .remove-item {
            background: #dc3545;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
        }
        
        .actions {
            display: flex;
            gap: 10px;
        }
        
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #666;
        }
        
        .empty-state h3 {
            margin-bottom: 15px;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <div class="navbar-container">
            <h1>📄 Invoice Manager</h1>
            <ul class="nav-links">
                <li><a href="?action=dashboard">Dashboard</a></li>
                <li><a href="?action=invoices">Invoices</a></li>
                <li><a href="?action=create_invoice">Create Invoice</a></li>
                <li><a href="?action=customers">Customers</a></li>
                <li><a href="?action=create_customer">Add Customer</a></li>
            </ul>
        </div>
    </div>

    <div class="container">
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-success">
                <?php echo htmlspecialchars($_SESSION['message']); unset($_SESSION['message']); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-error">
                <?php echo htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
