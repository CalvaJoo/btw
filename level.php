
<?php
require_once 'functions.php';
require_login();
if (is_admin()) {
    header('Location: admin_home.php');
    exit;
}

$team_id = $_SESSION['team_id'];
$progress = get_team_progress($pdo, $team_id);

if ($progress['completed']) {
    header('Location: congratulations.php');
    exit;
}

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $answer = trim($_POST['answer'] ?? '');
    // increment attempts
    $upd = $pdo->prepare("UPDATE team_progress SET attempts = attempts + 1 WHERE team_id = ?");
    $upd->execute([$team_id]);

    // log attempt
    $ins = $pdo->prepare(
      "INSERT INTO attempt_log(team_id, level_id, correct) VALUES(?,?,0)"
    );
    $ins->execute([$team_id, $progress['current_level_id']]);

    if (strcasecmp($answer, $progress['answer']) === 0) {
        // mark last log as correct
        $pdo->prepare(
          "UPDATE attempt_log SET correct=1 WHERE team_id=? AND level_id=? ORDER BY attempt_time DESC LIMIT 1"
        )->execute([$team_id, $progress['current_level_id']]);

        // advance or finish
        $next = $pdo->prepare(
          "SELECT id FROM levels WHERE number > ? ORDER BY number LIMIT 1"
        );
        $next->execute([$progress['level_number']]);
        $row = $next->fetch();

        if ($row) {
            $pdo->prepare(
              "UPDATE team_progress SET current_level_id = ? WHERE team_id = ?"
            )->execute([$row['id'], $team_id]);
        } else {
            $pdo->prepare(
              "UPDATE team_progress SET completed=1, finish_time=NOW() WHERE team_id = ?"
            )->execute([$team_id]);
            header('Location: congratulations.php');
            exit;
        }
        header('Location: level.php');
        exit;
    } else {
        $message = 'Incorrect answer. Try again.';
    }
}
?>
<!doctype html>
<html>
<head><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"></head>
<body class="container mt-5">
  <h2>Level <?=$progress['level_number']?></h2>
  <?php if($message): ?>
    <div class="alert alert-danger"><?=htmlspecialchars($message)?></div>
  <?php endif; ?>
  <form method="post">
    <div class="mb-3">
      <label class="form-label">Your Answer</label>
      <input name="answer" class="form-control" required>
    </div>
    <button class="btn btn-success">Submit</button>
  </form>
  <a href="logout.php" class="btn btn-link mt-3">Logout</a>
</body>
</html>
