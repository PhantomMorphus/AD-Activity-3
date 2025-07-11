<?php
require_once UTILS_PATH . '/envSetter.util.php';
require_once UTILS_PATH . '/auth.util.php';

function login($username, $password) {
    global $typeConfig;
    $dsn = "pgsql:host={$typeConfig['pgHost']};port={$typeConfig['pgPort']};dbname={$typeConfig['pgDB']}";
    $pdo = new PDO($dsn, $typeConfig['pgUser'], $typeConfig['pgPass'], [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
    $stmt = $pdo->prepare('SELECT * FROM "user" WHERE "Username" = :username');
    $stmt->execute([':username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user && verifyPassword($password, $user['Password'])) {
        $_SESSION['user'] = $user;
        return true;
    }
    return false;
}