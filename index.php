<?php
// index.php
require_once 'functions.php';

if (!is_logged_in()) {
    // not logged in? send to login form
    header('Location: login.php');
    exit;
}

// logged in → send to the right dashboard
if (is_admin()) {
    header('Location: admin_home.php');
} else {
    header('Location: level.php');
}
exit;
