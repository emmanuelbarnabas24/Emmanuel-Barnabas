<?php
$dbHost = 'localhost';
$dbName = 'smartmarket_db';
$dbUser = 'root';
$dbPass = '';

try {
    $pdo = new PDO(
        "mysql:host=$dbHost;charset=utf8mb4",
        $dbUser,
        $dbPass,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );

    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbName` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    $pdo->exec("USE `$dbName`");
} catch (PDOException $error) {
    die('Database connection failed: ' . htmlspecialchars($error->getMessage(), ENT_QUOTES, 'UTF-8'));
}

$pdo->exec(
    "CREATE TABLE IF NOT EXISTS livestock_records (
        id INT AUTO_INCREMENT PRIMARY KEY,
        created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
        cows INT NOT NULL DEFAULT 0,
        goats INT NOT NULL DEFAULT 0,
        chickens INT NOT NULL DEFAULT 0,
        milk_rate INT NOT NULL DEFAULT 0,
        egg_rate INT NOT NULL DEFAULT 0,
        kid_rate INT NOT NULL DEFAULT 0
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4"
);
