<?php
require_once 'functions.php';
//echo password_hash('adminpass', PASSWORD_DEFAULT), "\n";

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['team_name'] ?? '');
    $pass = $_POST['password'] ?? '';
    $stmt = $pdo->prepare("SELECT * FROM teams WHERE team_name = ?");
    $stmt->execute([$name]);
    $team = $stmt->fetch();

    if ($team && password_verify($pass, $team['password'])) {
        // Login success
        session_regenerate_id();
        $_SESSION['team_id']   = $team['id'];
        $_SESSION['team_name'] = $team['team_name'];
        $_SESSION['role']      = (int)$team['role'];

        // Ensure progress exists
        $stmt = $pdo->prepare("SELECT 1 FROM team_progress WHERE team_id = ?");
        $stmt->execute([$team['id']]);
        if (!$stmt->fetch()) {
            $first = $pdo->query("SELECT id FROM levels ORDER BY number LIMIT 1")->fetch();
            $init_level = $first ? $first['id'] : null;
            $ins = $pdo->prepare("INSERT INTO team_progress(team_id, current_level_id) VALUES(?, ?)");
            $ins->execute([$team['id'], $init_level]);
        }

        if (is_admin()) {
            header('Location: admin_home.php');
        } else {
            header('Location: level.php');
        }
        exit;
    } else {
        $error = 'Invalid credentials';
    }
}
?>
<!doctype html>
<html>
<head><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"></head>
<body class="container mt-5">
  <h2>Login</h2>
  <?php if($error): ?>
    <div class="alert alert-danger"><?=htmlspecialchars($error)?></div>
  <?php endif; ?>
  <form method="post">
    <div class="mb-3">
      <label class="form-label">Team Name</label>
      <input name="team_name" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Password</label>
      <input type="password" name="password" class="form-control" required>
    </div>
    <button class="btn btn-primary">Login</button>
  </form>
</body>
</html>
