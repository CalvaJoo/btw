<?php
// leaderboard_data.php
require_once 'functions.php';
require_admin();

header('Content-Type: application/json; charset=utf-8');

// only pull in real teams (role = 1), exclude admins (role = 0)
$stmt = $pdo->query("
    SELECT 
      t.team_name,
      IFNULL(l.number, 'Completed') AS current_level,
      DATE_FORMAT(tp.finish_time, '%Y-%m-%d %H:%i:%s') AS finish_time,
      tp.attempts
    FROM team_progress tp
    JOIN teams t
      ON tp.team_id = t.id
    LEFT JOIN levels l
      ON tp.current_level_id = l.id
    WHERE t.role = 1
    ORDER BY 
      tp.completed   DESC,
      l.number       DESC,
      tp.finish_time ASC
");

$data = ['progress_list' => []];
while ($row = $stmt->fetch()) {
    $data['progress_list'][] = [
      'team_name'     => $row['team_name'],
      'current_level' => $row['current_level'],
      'finish_time'   => $row['finish_time']   ?: '',
      'attempts'      => (int)$row['attempts'],
    ];
}

echo json_encode($data, JSON_UNESCAPED_UNICODE|JSON_NUMERIC_CHECK);
