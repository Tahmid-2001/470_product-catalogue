<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../public/styles.css">
</head>
<body>
    <header>
        <h1>Product Catalogue System – Admin Dashboard</h1>
        <div>
            <span>Welcome Admin <?= htmlspecialchars($_SESSION['user']['full_name']) ?></span>
            <a href="index.php?action=logout">Logout</a>
        </div>
    </header>
    <main>
        <button onclick="location.href='index.php?action=admin_manage_users'">
            User Account Control
        </button>
        <button onclick="location.href='index.php?action=admin_manage_orders'">
            User Order Status Update
        </button>
        <button onclick="location.href='index.php?action=admin_manage_products'">
            Catalogue Update
        </button>
        <button onclick="location.href='index.php?action=admin_view_products'">
            View Product List
        </button>
    </main>
</body>
</html>
