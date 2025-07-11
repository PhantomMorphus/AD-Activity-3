<?php
declare(strict_types=1);

require_once 'vendor/autoload.php';
require_once 'bootstrap.php';
require_once UTILS_PATH . '/envSetter.util.php';

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

// --- Drop all tables ---
echo "Dropping old tables…\n";
foreach (['"project_users"', '"tasks"', '"projects"', '"user"'] as $table) {
    $pdo->exec("DROP TABLE IF EXISTS {$table} CASCADE;");
}

// --- Apply all schema files ---
$modelFiles = [
    'Users',
    'Projects',
    'Projects_Users',
    'Tasks'
];

foreach ($modelFiles as $model) {
    echo "Applying schema from database/{$model}.Model.sql…\n";
    $sql = file_get_contents("database/{$model}.Model.sql");
    if ($sql === false) {
        throw new RuntimeException("❌ Could not read database/{$model}.Model.sql");
    } else {
        echo "Creation Success from the database/{$model}.Model.sql\n";
    }
    $pdo->exec($sql);
}

echo "🎉 PostgreSQL migration complete!\n";