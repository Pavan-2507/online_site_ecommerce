<?php
include 'includes/db.php';

// New admin details
$name = "NewAdmin";
$email = "newadmin@example.com";
$password = password_hash("admin456", PASSWORD_DEFAULT); // Securely hash password
$role = "admin";

// Check if admin already exists
$stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
$stmt->execute([$email]);

if ($stmt->rowCount() > 0) {
    echo "⚠ Admin already exists!";
} else {
    // Insert new admin into database
    $stmt = $pdo->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
    if ($stmt->execute([$name, $email, $password, $role])) {
        echo "✅ New admin created successfully!";
    } else {
        echo "❌ Failed to create admin!";
    }
}
?>
