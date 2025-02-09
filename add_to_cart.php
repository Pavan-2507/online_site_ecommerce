<?php
session_start();
include 'includes/db.php';

// Check if product_id is received
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];

    // Debugging - Print product ID
    echo "Product ID received: " . $product_id . "<br>";

    // Fetch product details
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$product_id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($product) {
        echo "Product Found: " . $product['name'] . "<br>";

        // Initialize cart session
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        // Check if product is already in cart
        $found = false;
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['id'] == $product_id) {
                $item['quantity'] += 1;
                $found = true;
                break;
            }
        }

        // If not found, add new item
        if (!$found) {
            $_SESSION['cart'][] = [
                'id' => $product['id'],
                'name' => $product['name'],
                'price' => $product['price'],
                'image' => $product['image'],
                'quantity' => 1
            ];
        }

        // Debugging - Print updated cart
        echo "<pre>";
        print_r($_SESSION['cart']);
        echo "</pre>";

        // Redirect to index page
        header("Location: index.php");
        exit();
    } else {
        echo "❌ Product Not Found!";
    }
} else {
    echo "❌ Invalid Request!";
}
?>
