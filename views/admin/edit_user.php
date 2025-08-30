<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
    <link rel="stylesheet" href="../public/styles.css">
    <style>
        form { max-width: 400px; margin: 2rem auto; }
        input, select { width: 100%; padding: .5rem; margin: .5rem 0; border: 1px solid #ddd; }
    </style>
</head>
<body>
<header>
    <h1>Edit User Profile</h1>
    <div>
        <a href="index.php?action=admin_manage_users">Back to Users</a>
        <a href="index.php?action=logout">Logout</a>
    </div>
</header>

<form action="index.php?action=admin_update_user" method="POST">
    <input type="hidden" name="user_id" value="<?= $user['user_id'] ?>">
    
    <label>Full Name:</label>
    <input type="text" name="full_name" value="<?= htmlspecialchars($user['full_name']) ?>" required>
    
    <label>Email:</label>
    <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
    
    <label>Password:</label>
    <input type="text" name="password" value="<?= htmlspecialchars($user['password']) ?>" required>
    
    <label>Contact Number:</label>
    <input type="text" name="contact_number" value="<?= htmlspecialchars($user['contact_number']) ?>" required>
    
    <label>Age:</label>
    <input type="number" name="age" value="<?= $user['age'] ?>" required>
    
    <button type="submit">Update User</button>
</form>
</body>
</html>
