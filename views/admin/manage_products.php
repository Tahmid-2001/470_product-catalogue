<!DOCTYPE html>
<html>
<head>
    <title>Manage Products</title>
    <link rel="stylesheet" href="../public/styles.css">
    <style>
        .section { margin: 2rem 0; padding: 1rem; background: #fff; border: 1px solid #ddd; }
        form { max-width: 600px; }
        input, textarea, select { width: 100%; padding: .5rem; margin: .5rem 0; border: 1px solid #ddd; }
        textarea { height: 80px; }
        .remove-form { max-width: 300px; }
    </style>
</head>
<body>
<header>
    <h1>Catalogue Update</h1>
    <div>
        <a href="index.php?action=admin_dashboard">Back to Dashboard</a>
        <a href="index.php?action=logout">Logout</a>
    </div>
</header>

<?php if (!empty($_SESSION['message'])): ?>
    <p class="success"><?= htmlspecialchars($_SESSION['message']) ?></p>
    <?php unset($_SESSION['message']); ?>
<?php endif; ?>

<div class="section">
    <h2>Add New Product</h2>
    <form action="index.php?action=admin_add_product" method="POST">
        <label>Product Name:</label>
        <input type="text" name="product_name" required>
        
        <label>Product Type:</label>
        <input type="text" name="product_type" required>
        
        <label>Description:</label>
        <textarea name="description"></textarea>
        
        <label>Product Specification:</label>
        <textarea name="product_specification"></textarea>
        
        <label>Price ($):</label>
        <input type="number" step="0.01" name="product_price" required>
        
        <label>Stock Quantity:</label>
        <input type="number" name="stock_quantity" required>
        
        <label>Expiration Date (optional):</label>
        <input type="date" name="expiration_date">
        
        <button type="submit">Add Product</button>
    </form>
</div>

<div class="section">
    <h2>Remove Product</h2>
    <form action="index.php?action=admin_remove_product" method="POST" class="remove-form">
        <label>Product ID:</label>
        <input type="number" name="product_id" required>
        
        <button type="submit" class="btn out" onclick="return confirm('Are you sure you want to remove this product?')">Remove Product</button>
    </form>
</div>
</body>
</html>
