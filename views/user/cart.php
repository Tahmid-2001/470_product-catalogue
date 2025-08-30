<!DOCTYPE html>
<html>
<head>
    <title>Your Cart</title>
    <link rel="stylesheet" href="../public/styles.css">
    <style>
        table { width: 100%; border-collapse: collapse; margin-top: 1rem; }
        th, td { border: 1px solid #ddd; padding: .75rem; text-align: left; }
        th { background: #f0f0f0; }
    </style>
</head>
<body>
<header>
    <h1>Product Catalogue System – Your Cart</h1>
    <div>
        <a href="index.php?action=user_dashboard">Back to Dashboard</a>
        <a href="index.php?action=logout">Logout</a>
    </div>
</header>

<?php if (!empty($_SESSION['message'])): ?>
    <p class="success"><?= htmlspecialchars($_SESSION['message']) ?></p>
    <?php unset($_SESSION['message']); ?>
<?php endif; ?>

<?php if (empty($items)): ?>
    <p>Your cart is empty.</p>
    <a href="index.php?action=list_products" class="btn">Shop Now</a>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price ($)</th>
                <th>Total ($)</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $grandTotal = 0; ?>
            <?php foreach ($items as $item): ?>
                <?php $itemTotal = $item['quantity'] * $item['product_price']; ?>
                <?php $grandTotal += $itemTotal; ?>
            <tr>
                <td><?= htmlspecialchars($item['product_name']) ?></td>
                <td><?= $item['quantity'] ?></td>
                <td><?= number_format($item['product_price'], 2) ?></td>
                <td><?= number_format($itemTotal, 2) ?></td>
                <td>
                    <a href="index.php?action=remove_from_cart&cart_id=<?= $item['cart_id'] ?>" 
                       class="btn out" onclick="return confirm('Remove this item?')">Remove</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3">Grand Total:</th>
                <th>$<?= number_format($grandTotal, 2) ?></th>
                <th></th>
            </tr>
        </tfoot>
    </table>
    
    <a href="index.php?action=checkout" class="btn" 
       onclick="return confirm('Proceed to checkout?')">Proceed to Checkout</a>
<?php endif; ?>
</body>
</html>
