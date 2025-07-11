<?php
require_once __DIR__ . '/bootstrap.php';
require_once HANDLERS_PATH . '/mongodbChecker.handler.php';
require_once HANDLERS_PATH . '/postgreChecker.handler.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AD Activity 3</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <?php include BASE_PATH . '/components/navbar.php'; ?>
    <main>
        <?php if (isset($_SESSION['user'])): ?>
            <h1>
                Welcome, <?= htmlspecialchars($_SESSION['user']['fName']) ?>!
            </h1>
            <p>Your role: <strong><?= htmlspecialchars($_SESSION['user']['role']) ?></strong></p>
        <?php else: ?>
            <h1>Welcome!</h1>
            <p>Please <a href="?page=login">login</a> to continue.</p>
        <?php endif; ?>
    </main>
</body>
</html>
