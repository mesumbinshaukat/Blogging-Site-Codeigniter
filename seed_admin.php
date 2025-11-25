<?php
// seed_admin.php - insert admin user with given credentials
require_once __DIR__ . '/vendor/autoload.php'; // Composer autoload (if using CI4, adjust path)

$pdo = new PDO('mysql:host=localhost;dbname=u308096205_blog', 'u308096205_blog', '8+Hd7EfGx$');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$username = 'hanzala';
$email = 'hanzala@example.com';
$passwordPlain = 'admin123';
$hash = password_hash($passwordPlain, PASSWORD_BCRYPT);

$stmt = $pdo->prepare('INSERT INTO users (username, email, password, created_at) VALUES (:username, :email, :password, NOW())');
$stmt->execute([
    ':username' => $username,
    ':email' => $email,
    ':password' => $hash,
]);

echo "Admin user seeded successfully.\n";
?>
