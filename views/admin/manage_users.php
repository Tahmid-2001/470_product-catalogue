<!DOCTYPE html>
<html>
<head>
    <title>Manage Users</title>
    <link rel="stylesheet" href="../public/styles.css">
    <style>
        table { width: 100%; border-collapse: collapse; margin-top: 1rem; }
        th, td { border: 1px solid #ddd; padding: .75rem; text-align: left; }
        th { background: #f0f0f0; }
        .btn-small { padding: .5rem 1rem; margin: 0 .25rem; }
    </style>
</head>
<body>
<header>
    <h1>User Account Control</h1>
    <div>
        <a href="index.php?action=admin_dashboard">Back to Dashboard</a>
        <a href="index.php?action=logout">Logout</a>
    </div>
</header>

<?php if (!empty($_SESSION['message'])): ?>
    <p class="success"><?= htmlspecialchars($_SESSION['message']) ?></p>
    <?php unset($_SESSION['message']); ?>
<?php endif; ?>

<?php if (empty($users)): ?>
    <p>No users found.</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Age</th>
                <th>Created</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user['user_id'] ?></td>
                <td><?= htmlspecialchars($user['full_name']) ?></td>
                <td><?= htmlspecialchars($user['email']) ?></td>
                <td><?= htmlspecialchars($user['contact_number']) ?></td>
                <td><?= $user['age'] ?></td>
                <td><?= $user['created_at'] ?></td>
                <td>
                    <a class="btn btn-small" href="index.php?action=admin_edit_user&user_id=<?= $user['user_id'] ?>">Edit</a>
                    <a class="btn btn-small out" href="index.php?action=admin_delete_user&user_id=<?= $user['user_id'] ?>" 
                       onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
</body>
</html>
