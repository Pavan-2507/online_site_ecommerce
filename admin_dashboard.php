<?php
session_start();
include 'includes/db.php';

// Check if admin is logged in
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

// Fetch all products
$stmt = $pdo->query("SELECT * FROM products ORDER BY created_at DESC");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="assests/css/style.css">
</head>
<body>

    <!-- Sidebar Navigation -->
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <ul>
            <li><a href="admin_dashboard.php">📦 Manage Products</a></li>
            <li><a href="admin_orders.php">📋 Manage Orders</a></li>
            <li><a href="admin_users.php">👤 Manage Users</a></li>
            <li><a href="admin_logout.php" class="logout-btn">🚪 Logout</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="admin-container">

        <div class="admin-header">
            <h1>🛠️ Admin Dashboard</h1>
            <a href="admin_logout.php" class="logout-btn">🚪 Logout</a>
        </div>

        <div class="admin-form">
            <h2>➕ Add Product</h2>
            <form method="POST" action="admin_add_product.php">
                <input type="text" name="name" placeholder="Product Name" required><br>
                <input type="text" name="description" placeholder="Description" required><br>
                <input type="number" name="price" placeholder="Price" step="0.01" required><br>
                <input type="text" name="category" placeholder="Category" required><br>
                <input type="text" name="image" placeholder="Image Filename (e.g., product.jpg)" required><br>
                <button type="submit">Add Product</button>
            </form>
        </div>

        <h2>📋 Product List</h2>
        <div class="product-container">
            <?php foreach ($products as $product): ?>
                <div class="product-card">
                    <img src="/ecommerceproject/assests/images/<?= htmlspecialchars($product['image']); ?>" alt="<?= htmlspecialchars($product['name']); ?>">
                    <h2><?= htmlspecialchars($product['name']); ?></h2>
                    <p>$<?= number_format($product['price'], 2); ?></p>
                    <p>Category: <?= htmlspecialchars($product['category']); ?></p>
                </div>
            <?php endforeach; ?>
        </div>

    </div>

</body>
</html>

