<!DOCTYPE html>
<html>
<head>
    <title>View Products</title>
    <link rel="stylesheet" href="../public/styles.css">
    <style>
        table { width: 100%; border-collapse: collapse; margin-top: 1rem; }
        th, td { border: 1px solid #ddd; padding: .75rem; text-align: left; }
        th { background: #f0f0f0; }
        .description { max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
    </style>
</head>
<body>
<header>
    <h1>View Product List</h1>
    <div>
        <a href="index.php?action=admin_dashboard">Back to Dashboard</a>
        <a href="index.php?action=logout">Logout</a>
    </div>
</header>

<?php if (empty($products)): ?>
    <p>No products found.</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Type</th>
                <th>Description</th>
                <th>Price ($)</th>
                <th>Stock</th>
                <th>Created</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
            <tr>
                <td><?= $product['product_id'] ?></td>
                <td><?= htmlspecialchars($product['product_name']) ?></td>
                <td><?= htmlspecialchars($product['product_type']) ?></td>
                <td class="description" title="<?= htmlspecialchars($product['description']) ?>">
                    <?= htmlspecialchars($product['description']) ?>
                </td>
                <td><?= number_format($product['product_price'], 2) ?></td>
                <td><?= $product['stock_quantity'] ?></td>
                <td><?= $product['created_at'] ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
</body>
</html>
