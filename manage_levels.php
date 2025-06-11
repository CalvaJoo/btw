<?php
// manage_levels.php
require_once 'functions.php';
require_admin();

// handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add'])) {
        $num = (int)$_POST['number'];
        $ans = trim($_POST['answer']);
        $pdo->prepare("INSERT INTO levels(number, answer) VALUES(?,?)")
            ->execute([$num, $ans]);
    }
    if (isset($_POST['delete_id'])) {
        $pdo->prepare("DELETE FROM levels WHERE id = ?")
            ->execute([$_POST['delete_id']]);
    }
    if (isset($_POST['edit_id'])) {
        $pdo->prepare("UPDATE levels SET number=?, answer=? WHERE id=?")
            ->execute([
              (int)$_POST['number'],
              trim($_POST['answer']),
              (int)$_POST['edit_id']
            ]);
    }
    header('Location: manage_levels.php');
    exit;
}

// fetch data
$levels = $pdo->query("SELECT * FROM levels ORDER BY number")->fetchAll();
$edit = null;
if (isset($_GET['edit'])) {
    $stmt = $pdo->prepare("SELECT * FROM levels WHERE id=?");
    $stmt->execute([$_GET['edit']]);
    $edit = $stmt->fetch();
}

$content = 'manage_levels_content.php';
include 'admin_base.php';
