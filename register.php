<?php
session_start();
require_once 'auth_functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    if (registerUser($username, $password)) {
        $_SESSION['success'] = 'Registration successful! Please login';
        header('Location: index.php');
        exit();
    } else {
        $_SESSION['error'] = 'Username already exists';
        header('Location: register.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="auth-container">
        <h2>Create Account</h2>
        <form class="auth-form" action="register.php" method="POST">
            <div class="input-group">
                <input type="text" name="username" placeholder="Username" required>
            </div>
            <div class="input-group">
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <button type="submit" class="btn">Register</button>
            <p class="text-center mt-4">Already have an account? <a href="index.php" class="text-primary">Login</a></p>
        </form>
    </div>
</body>
</html>