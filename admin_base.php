<!-- admin_base.php -->
<!doctype html>
<html>
<head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
  <div class="container">
    <a class="navbar-brand" href="admin_home.php">Admin Dashboard</a>
    <ul class="navbar-nav ms-auto">
      <li class="nav-item"><a class="nav-link" href="manage_levels.php">Manage Levels</a></li>
      <li class="nav-item"><a class="nav-link" href="manage_teams.php">Manage Teams</a></li>
      <li class="nav-item"><a class="nav-link" href="leaderboard.php">Leaderboard</a></li>
      <li class="nav-item"><a class="nav-link text-danger" href="logout.php">Logout</a></li>
    </ul>
  </div>
</nav>
<div class="container">
  <!-- Admin content goes here -->
   
  <?php include $content; ?>
</div>
</body>
</html>
