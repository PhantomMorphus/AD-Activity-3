<?php
declare(strict_types=1);

require_once 'vendor/autoload.php';
require_once 'bootstrap.php';
require_once UTILS_PATH . '/envSetter.util.php';

// Connect to PostgreSQL
$host = $typeConfig['pgHost'];
$port = $typeConfig['pgPort'];
$username = $typeConfig['pgUser'];
$password = $typeConfig['pgPass'];
$dbname = $typeConfig['pgDB'];

$dsn = "pgsql:host={$host};port={$port};dbname={$dbname}";
try {
    $pdo = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
    echo "✅ Connected to PostgreSQL successfully.\n";
} catch (PDOException $e) {
    die("❌ Connection failed: " . $e->getMessage() . "\n");
}

// Load dummy users
$users = require_once BASE_PATH . '/staticDatas/dummies/users.staticData.php';

// Seeding logic
echo "Seeding users…\n";
$stmt = $pdo->prepare('
    INSERT INTO "user" ("Username", "role", "fName", "lName", "Password")
    VALUES (:username, :role, :fn, :ln, :pw)
');

foreach ($users as $u) {
    $stmt->execute([
        ':username' => $u['Username'],
        ':role'     => $u['role'],
        ':fn'       => $u['fName'],
        ':ln'       => $u['lName'],
        ':pw'       => password_hash($u['Password'], PASSWORD_DEFAULT),
    ]);
}
echo "✅ PostgreSQL seeding complete!\n";
