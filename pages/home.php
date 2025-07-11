<?php
require_once HANDLERS_PATH . '/mongodbChecker.handler.php';
require_once HANDLERS_PATH . '/postgreChecker.handler.php';
?>
<h1>Welcome<?= isset($_SESSION['user']) ? ', ' . htmlspecialchars($_SESSION['user']['fName']) : '' ?>!</h1>