<?php
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

function isLoggedIn() {
    return isset($_SESSION['user']);
}

if (!isLoggedIn() && !in_array(basename($_SERVER['PHP_SELF']), ['login.php', 'register.php'])) {
    header('Location: login.php');
    exit();
}