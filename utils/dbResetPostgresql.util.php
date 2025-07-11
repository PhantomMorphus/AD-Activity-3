<?php
declare(strict_types=1);

// 1) Composer autoload
require_once 'vendor/autoload.php';

// 2) Composer bootstrap
require_once 'bootstrap.php';

// 3) envSetter
require_once UTILS_PATH . '/envSetter.util.php';

// 4) Get DB connection settings from environment
$host = $typeConfig['pgHost'];
$port = $typeConfig['pgPort'];
$username = $typeConfig['pgUser'];
$password = $typeConfig['pgPass'];
$dbname = $typeConfig['pgDB'];

// ——— Connect to PostgreSQL ———
$dsn = "pgsql:host={$host};port={$port};dbname={$dbname}";

try {
    $pdo = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
    echo "✅ Connected to PostgreSQL successfully.\n";
} catch (PDOException $e) {
    die("❌ Connection failed: " . $e->getMessage() . "\n");
}

// ——— Apply Schema Files ———
$modelFiles = [
    'Users',
    'Projects',
    'Projects_Users',
    'Tasks'
];

foreach ($modelFiles as $model) {
    echo "📄 Applying schema from database/{$model}.Model.sql…\n";
    $sql = file_get_contents("database/{$model}.Model.sql");

    if ($sql === false) {
        echo "❌ Could not read database/{$model}.Model.sql\n";
        continue;
    }

    try {
        $pdo->exec($sql);
        echo "✅ Successfully applied {$model} schema.\n";
    } catch (PDOException $e) {
        echo "❌ Error applying {$model} schema: " . $e->getMessage() . "\n";
    }
}

// ——— Clean Tables ———
echo "🧹 Truncating tables…\n";

// Important: Truncate in order that avoids foreign key violations
$tables = ['"project_users"', '"tasks"', '"projects"', '"user"'];

foreach ($tables as $table) {
    try {
        $pdo->exec("TRUNCATE TABLE {$table} RESTART IDENTITY CASCADE;");
        echo "✅ Truncated {$table}\n";
    } catch (PDOException $e) {
        echo "❌ Failed to truncate {$table}: " . $e->getMessage() . "\n";
    }
}

echo "🎉 PostgreSQL reset complete!\n";
