<!DOCTYPE html>
<html>
<head>
    <title>Your Orders</title>
    <link rel="stylesheet" href="../public/styles.css">
    <style>
        table { width: 100%; border-collapse: collapse; margin-top: 1rem; }
        th, td { border: 1px solid #ddd; padding: .75rem; text-align: left; }
        th { background: #f0f0f0; }
        .status { text-transform: capitalize; }
    </style>
</head>
<body>
<header>
    <h1>Product Catalogue System – Order Status</h1>
    <div>
        <a href="index.php?action=user_dashboard">Back to Dashboard</a>
        <a href="index.php?action=logout">Logout</a>
    </div>
</header>

<?php if (!empty($_SESSION['message'])): ?>
    <p class="success"><?= htmlspecialchars($_SESSION['message']) ?></p>
    <?php unset($_SESSION['message']); ?>
<?php endif; ?>

<?php if (empty($orders)): ?>
    <p>You have no orders yet.</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Product</th>
                <th>Qty</th>
                <th>Total ($)</th>
                <th>Status</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $o): ?>
            <tr>
                <td><?= $o['order_id'] ?></td>
                <td><?= htmlspecialchars($o['product_name']) ?></td>
                <td><?= $o['quantity'] ?></td>
                <td><?= number_format($o['total_price'], 2) ?></td>
                <td class="status"><?= htmlspecialchars($o['order_status']) ?></td>
                <td><?= $o['order_date'] ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
</body>
</html>
