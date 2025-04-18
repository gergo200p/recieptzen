<?php
require_once 'auth/auth_check.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userDir = "users/{$_SESSION['user']}";
    $ext = pathinfo($_FILES['receipt']['name'], PATHINFO_EXTENSION);
    $filename = date('Ymd-His').'-'.bin2hex(random_bytes(4)).".$ext";
    
    if (move_uploaded_file($_FILES['receipt']['tmp_name'], "$userDir/$filename")) {
        $_SESSION['success'] = 'Receipt uploaded successfully!';
    } else {
        $_SESSION['error'] = 'Error uploading file';
    }
}
header('Location: index.php');