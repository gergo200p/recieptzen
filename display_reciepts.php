<?php
$userDir = "users/{$_SESSION['user']}";
echo '<div class="receipt-grid">';
foreach (glob("$userDir/*.{jpg,jpeg,png,gif}", GLOB_BRACE) as $receipt) {
    $date = date('M d, Y', filemtime($receipt));
    echo <<<HTML
    <div class="receipt-card">
        <img src="$receipt" class="receipt-image" loading="lazy">
        <div class="receipt-meta">
            <span>$date</span>
            <button class="icon-btn" onclick="deleteReceipt('$receipt')">
                <i class="fas fa-trash"></i>
            </button>
        </div>
    </div>
    HTML;
}
echo '</div>';