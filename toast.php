<?php if (isset($_SESSION['error'])): ?>
<div class="toast error animate-slide-in">
    <i class="fas fa-exclamation-circle"></i>
    <?= $_SESSION['error'] ?>
</div>
<?php unset($_SESSION['error']); endif; ?>

<?php if (isset($_SESSION['success'])): ?>
<div class="toast success animate-slide-in">
    <i class="fas fa-check-circle"></i>
    <?= $_SESSION['success'] ?>
</div>
<?php unset($_SESSION['success']); endif; ?>