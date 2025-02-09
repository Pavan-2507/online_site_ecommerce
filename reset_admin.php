<?php
include 'includes/db.php';

// New password
$new_password = "admin123";
$hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

// Update password in the database
$stmt = $pdo->prepare("UPDATE users SET password = ? WHERE email = 'admin@example.com' AND role = 'admin'");
if ($stmt->execute([$hashed_password])) {
    echo "✅ Admin password reset successfully! Try logging in with 'admin123'.";
} else {
    echo "❌ Failed to reset password.";
}
?>
