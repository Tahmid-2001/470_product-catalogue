<!DOCTYPE html>
<html>
<head>
    <title>Login – Product Catalog</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Welcome to Product Catalog Management System</h1>

    <?php if (!empty($error)): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php elseif (!empty($_GET['registered'])): ?>
        <p class="success">Registration successful. Please log in.</p>
    <?php endif; ?>

    <form method="POST" action="index.php?action=login_post">
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Login</button>
    </form>

    <p>Don't have an account? <a href="index.php?action=register">Get Started</a></p>
</body>
</html>
