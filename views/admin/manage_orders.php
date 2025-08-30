<!DOCTYPE html>
<html>
<head>
    <title>Manage Orders</title>
    <link rel="stylesheet" href="../public/styles.css">
    <style>
        table { width: 100%; border-collapse: collapse; margin-top: 1rem; }
        th, td { border: 1px solid #ddd; padding: .75rem; text-align: left; }
        th { background: #f0f0f0; }
        select { padding: .25rem; }
        .status { text-transform: capitalize; }
    </style>
</head>
<body>
<header>
    <h1>User Order Status Update</h1>
    <div>
        <a href="index.php?action=admin_dashboard">Back to Dashboard</a>
        <a href="index.php?action=logout">Logout</a>
    </div>
</header>

<?php if (!empty($_SESSION['message'])): ?>
    <p class="success"><?= htmlspecialchars($_SESSION['message']) ?></p>
    <?php unset($_SESSION['message']); ?>
<?php endif; ?>

<?php if (empty($orders)): ?>
    <p>No orders found.</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer</th>
                <th>Product</th>
                <th>Qty</th>
                <th>Total ($)</th>
                <th>Current Status</th>
                <th>Update Status</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?>
            <tr>
                <td><?= $order['order_id'] ?></td>
                <td><?= htmlspecialchars($order['full_name']) ?></td>
                <td><?= htmlspecialchars($order['product_name']) ?></td>
                <td><?= $order['quantity'] ?></td>
                <td><?= number_format($order['total_price'], 2) ?></td>
                <td class="status"><?= htmlspecialchars($order['order_status']) ?></td>
                <td>
                    <form action="index.php?action=admin_update_order_status" method="POST" style="display: inline;">
                        <input type="hidden" name="order_id" value="<?= $order['order_id'] ?>">
                        <select name="status" onchange="this.form.submit()">
                            <option value="">-- Update --</option>
                            <option value="pending">Pending</option>
                            <option value="delivered">Delivered</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </form>
                </td>
                <td><?= $order['order_date'] ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
</body>
</html>
