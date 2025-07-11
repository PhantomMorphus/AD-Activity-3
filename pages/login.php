<?php

// Only output HTML after all header() calls and redirects
include BASE_PATH . '/components/error.php';
?>
<form method="post">
    <input name="username" placeholder="Username" required>
    <input name="password" type="password" placeholder="Password" required>
    <button type="submit">Login</button>
</form>