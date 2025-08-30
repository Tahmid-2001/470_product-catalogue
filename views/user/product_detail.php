<!DOCTYPE html>
<html>
<head>
    <title>Product Details</title>
    <link rel="stylesheet" href="../public/styles.css">
</head>
<body>
<header>
    <h1>Product Details</h1>
    <div>
        <a href="index.php?action=list_products">Back to Products</a>
        <a href="index.php?action=logout">Logout</a>
    </div>
</header>

<div class="detail">
    <div class="info">
        <h2><?= htmlspecialchars($product['product_name']) ?></h2>
        <p><strong>Type:</strong> <?= htmlspecialchars($product['product_type']) ?></p>
        <p><strong>Price:</strong> $<?= number_format($product['product_price'], 2) ?></p>
        <p><strong>Stock:</strong> <?= $product['stock_quantity'] ?> available</p>
        <p><strong>Description:</strong> <?= htmlspecialchars($product['description']) ?></p>
        <p><strong>Specifications:</strong> <?= htmlspecialchars($product['product_specification']) ?></p>
        <?php if ($product['expiration_date']): ?>
            <p><strong>Expires:</strong> <?= $product['expiration_date'] ?></p>
        <?php endif; ?>
    </div>
    
    <?php if ($product['stock_quantity'] > 0): ?>
        <a href="index.php?action=add_to_cart&product_id=<?= $product['product_id'] ?>" class="btn">Add to Cart</a>
    <?php else: ?>
        <button class="btn out" disabled>Out of Stock</button>
    <?php endif; ?>
</div>
</body>
</html>
