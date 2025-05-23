<nav>
  <ul>
    <?php if (isset($_SESSION['id_utilisateur'])): ?>
      <li><a href="assets/scripts/logout.php">Logout</a></li>
    <?php else: ?>
      <li><a href="assets/scripts/login.php">Login</a></li>
    <?php endif; ?>
    <li><a href="assets/scripts/test.php">Test</a></li>
  </ul>
</nav>
