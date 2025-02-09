<?php
session_start();
include 'includes/db.php';

// Fetch products from the database
$stmt = $pdo->query("SELECT * FROM products ORDER BY created_at DESC");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Website</title>
    <link rel="stylesheet" href="assests/css/style.css">
</head>
<body>

    <h1>🛍️ Our Products</h1>
    <a href="cart.php" class="cart-link">🛒 View Cart (<?= isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0 ?>)</a>
    <?php if (isset($_SESSION['user'])): ?>
    <a href="logout.php" class="btn">🚪 Logout (<?= $_SESSION['user']; ?>)</a>
<?php else: ?>
    <a href="login.php" class="btn">🔐 Login</a>
    <a href="register.php" class="btn">📝 Register</a>
<?php endif; ?>

    <div class="product-container">
        <?php foreach ($products as $product): ?>
            <div class="product-card">
                <img src="/ecommerceproject/assests/images/<?= htmlspecialchars($product['image']); ?>" alt="<?= htmlspecialchars($product['name']); ?>">
                <h2><?= htmlspecialchars($product['name']); ?></h2>
                <p>$<?= number_format($product['price'], 2); ?></p>
                <form method="POST" action="add_to_cart.php">
                    <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
                    <button type="submit" class="btn">🛒 Add to Cart</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>

</body>
</html>
