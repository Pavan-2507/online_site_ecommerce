<?php
session_start();
include 'includes/db.php';

// Ensure admin is logged in
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

// Fetch all orders
$stmt = $pdo->query("SELECT orders.id, users.name, orders.total_price, orders.order_status, orders.order_date 
                      FROM orders 
                      JOIN users ON orders.user_id = users.id 
                      ORDER BY orders.order_date DESC");
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Handle order status update
if (isset($_POST['update_status'])) {
    $order_id = $_POST['order_id'];
    $new_status = $_POST['status'];
    $pdo->prepare("UPDATE orders SET order_status = ? WHERE id = ?")->execute([$new_status, $order_id]);
    header("Location: admin_orders.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders</title>
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
        <h1>📋 Manage Orders</h1>
        <table border="1">
            <tr>
                <th>Order ID</th>
                <th>User</th>
                <th>Total Price</th>
                <th>Status</th>
                <th>Order Date</th>
                <th>Action</th>
            </tr>
            <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?= $order['id'] ?></td>
                    <td><?= htmlspecialchars($order['name']) ?></td>
                    <td>$<?= number_format($order['total_price'], 2) ?></td>
                    <td><?= htmlspecialchars($order['order_status']) ?></td>
                    <td><?= $order['order_date'] ?></td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                            <select name="status">
                                <option value="Pending" <?= $order['order_status'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
                                <option value="Shipped" <?= $order['order_status'] == 'Shipped' ? 'selected' : '' ?>>Shipped</option>
                                <option value="Delivered" <?= $order['order_status'] == 'Delivered' ? 'selected' : '' ?>>Delivered</option>
                            </select>
                            <button type="submit" name="update_status">Update</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

</body>
</html>
