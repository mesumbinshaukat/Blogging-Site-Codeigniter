<?php
// verify_db.php - list tables in blog_site database
try {
    $pdo = new PDO('mysql:host=localhost;dbname=blog_site', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo->query('SHOW TABLES');
    foreach ($stmt as $row) {
        echo $row[0] . PHP_EOL;
    }
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
