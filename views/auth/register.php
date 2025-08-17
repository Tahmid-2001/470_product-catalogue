<!DOCTYPE html>
<html>
<head>
    <title>Register – Product Catalog</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Register for Product Catalog Management</h1>

    <?php if (!empty($error)): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="POST" action="index.php?action=register_post">
        <input type="text"    name="full_name"      placeholder="Full Name"      required><br>
        <input type="email"   name="email"          placeholder="Email"          required><br>
        <input type="password"name="password"       placeholder="Password"       required><br>
        <input type="text"    name="contact_number" placeholder="Contact Number" required><br>
        <input type="number"  name="age"            placeholder="Age"            required><br>
        <select name="account_type" required>
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select><br>
        <button type="submit">Register</button>
    </form>

    <p>Already have an account? <a href="index.php?action=login">Login</a></p>
</body>
</html>
