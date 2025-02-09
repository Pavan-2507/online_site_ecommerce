<?php
session_start();
include 'includes/db.php';

// Ensure user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

// Fetch user details
$stmt = $pdo->prepare("SELECT * FROM users WHERE name = ?");
$stmt->execute([$_SESSION['user']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Initialize total price
$total_price = 0;

// Calculate total price if cart is not empty
if (!empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $total_price += $item['price'] * $item['quantity'];
    }
}

// Handle order submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_SESSION['cart'])) {
    // Insert order
    $stmt = $pdo->prepare("INSERT INTO orders (user_id, total_price) VALUES (?, ?)");
    $stmt->execute([$user['id'], $total_price]);
    $order_id = $pdo->lastInsertId();

    // Insert order items
    foreach ($_SESSION['cart'] as $item) {
        $stmt = $pdo->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
        $stmt->execute([$order_id, $item['id'], $item['quantity'], $item['price']]);
    }

    // Clear cart
    unset($_SESSION['cart']);

    // Redirect to success page
    header("Location: order_success.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="assests/css/style.css">
</head>
<body>

    <h1>🛍️ Checkout</h1>
    <div class="checkout-container">
        <h2>Your Order Summary</h2>

        <div class="product-container">
            <?php if (!empty($_SESSION['cart'])): ?>
                <?php foreach ($_SESSION['cart'] as $item): ?>
                    <div class="product-card">
                        <img src="/ecommerceproject/assests/images/<?= htmlspecialchars($item['image']); ?>" alt="<?= htmlspecialchars($item['name']); ?>">
                        <h2><?= htmlspecialchars($item['name']); ?></h2>
                        <p>Price: $<?= number_format($item['price'], 2); ?></p>
                        <p>Quantity: <?= $item['quantity']; ?></p>
                        <p><strong>Total: $<?= number_format($item['price'] * $item['quantity'], 2); ?></strong></p>
                    </div>
                <?php endforeach; ?>
                <h3>Grand Total: <span class="total-price">$<?= number_format($total_price, 2); ?></span></h3>
                <form method="POST">
                    <button type="submit" class="btn checkout-btn">✅ Confirm Order</button>
                </form>
            <?php else: ?>
                <p>Your cart is empty.</p>
            <?php endif; ?>
        </div>
    </div>

    <a href="cart.php" class="btn">⬅ Back to Cart</a>

</body>
</html>
