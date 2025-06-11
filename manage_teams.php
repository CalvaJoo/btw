<?php
// manage_teams.php
require_once 'functions.php';
require_admin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add'])) {
        $name = trim($_POST['team_name']);
        $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $pdo->prepare("INSERT INTO teams(team_name,password) VALUES(?,?)")
            ->execute([$name, $pass]);
    }
    if (isset($_POST['delete_id'])) {
        $pdo->prepare("DELETE FROM teams WHERE id = ?")
            ->execute([$_POST['delete_id']]);
    }
    header('Location: manage_teams.php');
    exit;
}

$teams = $pdo->query("SELECT * FROM teams ORDER BY team_name")->fetchAll();
$content = 'manage_teams_content.php';
include 'admin_base.php';
