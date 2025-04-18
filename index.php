<?php
session_start();
require_once 'auth_check.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReceiptZen</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'toast.php'; ?>
    
    <?php if(!isset($_SESSION['user'])): ?>
    <div class="auth-container">
        <h2>Welcome to ReceiptZen 📁</h2>
        <form class="auth-form" action="login.php" method="POST">
            <div class="input-group">
                <input type="text" name="username" placeholder="Enter your username" required>
            </div>
            <div class="input-group">
                <input type="password" name="password" placeholder="Enter your password" required>
            </div>
            <button type="submit" class="btn">Sign In</button>
            <p class="text-center mt-4">Don't have an account? <a href="register.php" class="text-primary">Sign Up</a></p>
        </form>
    </div>
    <?php else: ?>
    <div class="app-container">
        <nav class="nav-bar">
            <h1 class="user-greeting">👋 Hello, <?= htmlspecialchars($_SESSION['user']) ?></h1>
            <div class="nav-buttons">
                <button onclick="location.href='logout.php'" class="btn">Logout</button>
            </div>
        </nav>

        <div class="stats-container">
            <div class="stat-card">
                <h3>This Month</h3>
                <p>$<?= getMonthlyTotal() ?></p>
            </div>
            <div class="stat-card">
                <h3>Total Receipts</h3>
                <p><?= countUserReceipts() ?></p>
            </div>
        </div>

        <div class="upload-container">
            <form id="uploadForm" action="upload.php" method="POST" enctype="multipart/form-data">
                <input type="file" id="receiptUpload" name="receipt" class="upload-input" accept="image/*" required>
                <input type="date" name="receipt_date" required>
                <label for="receiptUpload" class="upload-label">
                    <div class="spinner hidden"></div>
                    <i class="fas fa-cloud-upload-alt fa-2x"></i>
                    <p>Click to upload or take a photo</p>
                </label>
            </form>
        </div>

        <div class="receipt-grid">
            <?php include 'display_receipts.php'; ?>
        </div>
    </div>
    <?php endif; ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
    <script src="app.js"></script>
</body>
</html>