<?php
require_once 'functions.php';
require_login();
$prog = get_team_progress($pdo, $_SESSION['team_id']);
if (!$prog['completed']) {
    header('Location: level.php');
    exit;
}
?>
<!doctype html>
<html>
<head><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"></head>
<body class="container text-center mt-5">
  <h1>🎉 Congratulations! 🎉</h1>
  <p class="lead">You have successfully completed the competition!</p>
  <a href="logout.php" class="btn btn-primary">Logout</a>
</body>
</html>
