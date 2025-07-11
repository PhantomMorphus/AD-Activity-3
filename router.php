<?php
require_once __DIR__ . '/bootstrap.php';
session_start();

$page = $_GET['page'] ?? 'index';
$allowed = ['index', 'home', 'login', 'logout', 'error'];
if (!in_array($page, $allowed)) $page = 'error';

// Handle login POST before any output
if ($page === 'login' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once HANDLERS_PATH . '/auth.handler.php';
    if (login($_POST['username'], $_POST['password'])) {
        header('Location: ?page=index');
        exit;
    } else {
        $error = 'Invalid credentials';
        $content = BASE_PATH . "/pages/login.php";
        include BASE_PATH . '/layouts/main.php';
        exit;
    }
}

if ($page === 'index') {
    include BASE_PATH . '/index.php';
} else {
    $content = BASE_PATH . "/pages/{$page}.php";
    include BASE_PATH . '/layouts/main.php';
}
