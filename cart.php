<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="assests/css/style.css">
</head>
<body>

    <h1>🛒 Your Shopping Cart</h1>
    <a href="index.php" class="btn">⬅ Continue Shopping</a>
    <?php if (!empty($_SESSION['cart'])): ?>
    <a href="checkout.php" class="btn">🛍️ Proceed to Checkout</a>
<?php endif; ?>


    <div class="product-container">
        <?php if (!empty($_SESSION['cart'])): ?>
            <?php foreach ($_SESSION['cart'] as $item): ?>
                <div class="product-card">
                    <img src="/ecommerceproject/assests/images/<?= htmlspecialchars($item['image']); ?>" alt="<?= htmlspecialchars($item['name']); ?>">
                    <h2><?= htmlspecialchars($item['name']); ?></h2>
                    <p>$<?= number_format($item['price'], 2); ?></p>
                    <p>Quantity: <?= $item['quantity']; ?></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Your cart is empty.</p>
        <?php endif; ?>
    </div>

</body>
</html>
