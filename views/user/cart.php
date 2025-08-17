<!DOCTYPE html>
<html>
<head>
    <title>Your Cart</title>
    <link rel="stylesheet" href="../public/styles.css">
</head>
<body>
<header>
    <h1>Product Catalogue System – Your Cart</h1>
    <div>
        <a href="index.php?action=list_products">Back to Products</a>
        <a href="index.php?action=logout">Logout</a>
    </div>
</header>

<?php if (!empty($_SESSION['message'])): ?>
    <p class="success"><?= htmlspecialchars($_SESSION['message']) ?></p>
    <?php unset($_SESSION['message']); ?>
<?php endif; ?>

<?php if (empty($items)): ?>
    <p>Your cart is empty.</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $it): ?>
            <tr>
                <td>
                    <img src="../assets/<?= htmlspecialchars($it['product_image']) ?>" width="50" alt="">
                    <?= htmlspecialchars($it['product_name']) ?>
                </td>
                <td><?= $it['quantity'] ?></td>
                <td>$<?= number_format($it['product_price'] * $it['quantity'], 2) ?></td>
                <td>
                    <a class="btn out" href="index.php?action=remove_from_cart&cart_id=<?= $it['cart_id'] ?>">
                        Remove
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <button onclick="location.href='index.php?action=checkout'">Proceed to Checkout</button>
<?php endif; ?>
</body>
</html>
