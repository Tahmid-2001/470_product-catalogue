<!DOCTYPE html>
<html>
<head>
    <title><?= htmlspecialchars($product['product_name']) ?></title>
    <link rel="stylesheet" href="../public/styles.css">
</head>
<body>
<header>
    <h1>Product Catalogue System – User Dashboard</h1>
    <div>
        <a href="index.php?action=list_products">Back</a>
        <a href="index.php?action=logout">Logout</a>
    </div>
</header>

<div class="detail">
    <img src="../assets/<?= htmlspecialchars($product['product_image']) ?>" alt="">
    <h2><?= htmlspecialchars($product['product_name']) ?></h2>
    <div class="info">
        <p><strong>Type:</strong> <?= htmlspecialchars($product['product_type']) ?></p>
        <p><strong>Description:</strong> <?= htmlspecialchars($product['description']) ?></p>
        <p><strong>Specification:</strong> <?= htmlspecialchars($product['product_specification']) ?></p>
        <p><strong>Price:</strong> $<?= number_format($product['product_price'], 2) ?></p>
        <p><strong>Stock Quantity:</strong> <?= $product['stock_quantity'] ?></p>
        <p><strong>Expiration Date:</strong> <?= $product['expiration_date'] ?? 'N/A' ?></p>
    </div>
    <?php if ($product['stock_quantity'] > 0): ?>
        <a class="btn" href="index.php?action=add_to_cart&product_id=<?= $product['product_id'] ?>">Order</a>
    <?php else: ?>
        <span class="btn out">Out of stock. Please check later.</span>
    <?php endif; ?>
</div>
</body>
</html>
