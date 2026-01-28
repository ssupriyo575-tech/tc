<?php include BASE_PATH . 'templates/base.php'; ?>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h2><i class="fas fa-users"></i> Customers</h2>
        </div>

        <div class="search-box">
            <form method="GET" style="display: flex; gap: 10px; width: 100%;">
                <input type="hidden" name="action" value="customers">
                <input type="text" name="search" placeholder="Search by name, email, or phone..." 
                       value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Search</button>
                <a href="?action=customers" class="btn btn-secondary"><i class="fas fa-times"></i> Clear</a>
            </form>
        </div>

        <?php if (isset($customers) && count($customers) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>City</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($customers as $customer): ?>
                        <tr>
                            <td><strong><?php echo htmlspecialchars($customer['name']); ?></strong></td>
                            <td><?php echo htmlspecialchars($customer['email']); ?></td>
                            <td><?php echo htmlspecialchars($customer['phone']); ?></td>
                            <td><?php echo htmlspecialchars($customer['city']); ?></td>
                            <td>
                                <div class="actions">
                                    <a href="?action=view_customer&id=<?php echo $customer['id']; ?>" class="btn btn-primary btn-small"><i class="fas fa-eye"></i> View</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="empty-state">
                <i class="fas fa-users"></i>
                <h3>No customers found</h3>
                <p>Add your first customer to get started</p>
                <a href="?action=create_customer" class="btn btn-primary"><i class="fas fa-plus"></i> Add Customer</a>
            </div>
        <?php endif; ?>
    </div>
</div>
