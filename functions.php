<?php
// functions.php
require_once 'config.php';

function is_logged_in() {
    return !empty($_SESSION['team_id']);
}

function is_admin() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 0;
}

function require_login() {
    if (!is_logged_in()) {
        header('Location: login.php');
        exit;
    }
}

function require_admin() {
    require_login();
    if (!is_admin()) {
        header('Location: level.php');
        exit;
    }
}

function get_team_progress($pdo, $team_id) {
    $stmt = $pdo->prepare(
      "SELECT tp.*, l.number AS level_number, l.answer
         FROM team_progress tp
    LEFT JOIN levels l ON tp.current_level_id = l.id
        WHERE tp.team_id = ?"
    );
    $stmt->execute([$team_id]);
    return $stmt->fetch();
}
