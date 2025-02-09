<?php
session_start();
include 'includes/db.php';

// Ensure admin is logged in
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

// Fetch all users
$stmt = $pdo->query("SELECT * FROM users ORDER BY created_at DESC");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Handle delete user
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $pdo->prepare("DELETE FROM users WHERE id = ?")->execute([$id]);
    header("Location: admin_users.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <div class="sidebar">
        <h2>Admin Panel</h2>
        <ul>
            <li><a href="admin_dashboard.php">📦 Manage Products</a></li>
            <li><a href="admin_orders.php">📋 Manage Orders</a></li>
            <li><a href="admin_users.php">👤 Manage Users</a></li>
            <li><a href="admin_logout.php" class="logout-btn">🚪 Logout</a></li>
        </ul>
    </div>

    <div class="admin-container">
        <h1>👤 Manage Users</h1>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= $user['id'] ?></td>
                    <td><?= htmlspecialchars($user['name']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td><?= htmlspecialchars($user['role']) ?></td>
                    <td>
                        <a href="admin_users.php?delete=<?= $user['id'] ?>" onclick="return confirm('Are you sure?')">🗑 Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

</body>
</html>
