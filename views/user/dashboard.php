<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
    <link rel="stylesheet" href="../public/styles.css">
</head>
<body>
    <header>
        <h1>Product Catalogue System – User Dashboard</h1>
        <div>
            <span>Welcome <?= htmlspecialchars($_SESSION['user']['full_name']) ?></span>
            <a href="index.php?action=logout">Logout</a>
        </div>
    </header>
    <main>
        <button onclick="location.href='index.php?action=list_products'">
            List All Products
        </button>
        <button onclick="location.href='index.php?action=view_cart'">
            View Cart
        </button>
        <button onclick="location.href='index.php?action=order_status'">
            Order Status
        </button>
    </main>
</body>
</html>
