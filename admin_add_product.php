<?php
session_start();
include 'includes/db.php';

// Ensure admin is logged in
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $image = $_POST['image'];

    $stmt = $pdo->prepare("INSERT INTO products (name, description, price, image, category) VALUES (?, ?, ?, ?, ?)");
    if ($stmt->execute([$name, $description, $price, $image, $category])) {
        header("Location: admin_dashboard.php?success=Product added!");
        exit();
    } else {
        header("Location: admin_dashboard.php?error=Failed to add product.");
        exit();
    }
}
?>
