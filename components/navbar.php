<nav>
    <a href="?page=index">Home</a>
    <?php if (isset($_SESSION['user'])): ?>
        <a href="?page=logout">Logout</a>
    <?php else: ?>
        <a href="?page=login">Login</a>
    <?php endif; ?>
</nav>
