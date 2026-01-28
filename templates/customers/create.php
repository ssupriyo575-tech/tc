<?php include BASE_PATH . 'templates/base.php'; ?>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h2><i class="fas fa-user-plus"></i> Add New Customer</h2>
        </div>

        <form method="POST">
            <input type="hidden" name="create_customer" value="1">

            <div class="form-row">
                <div class="form-group">
                    <label for="name">Full Name *</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="tel" id="phone" name="phone">
                </div>
                <div class="form-group">
                    <label for="country">Country</label>
                    <input type="text" id="country" name="country">
                </div>
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" id="address" name="address">
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="city">City</label>
                    <input type="text" id="city" name="city">
                </div>
                <div class="form-group">
                    <label for="state">State/Province</label>
                    <input type="text" id="state" name="state">
                </div>
                <div class="form-group">
                    <label for="zip_code">ZIP/Postal Code</label>
                    <input type="text" id="zip_code" name="zip_code">
                </div>
            </div>

            <div class="form-group form-row full">
                <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Create Customer</button>
                <a href="?action=customers" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Cancel</a>
            </div>
        </form>
    </div>
</div>
