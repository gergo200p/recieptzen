<?php
/**
 * ReceiptZen Configuration
 * 
 * Modern PHP configuration with environment detection
 * and security best practices
 */

// ==============================================
// Environment Detection
// ==============================================
define('ENVIRONMENT', getenv('APP_ENV') ?: 'production');

// ==============================================
// Security Settings
// ==============================================
header_remove('X-Powered-By');
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_samesite', 'Strict');
ini_set('session.use_strict_mode', 1);

if (ENVIRONMENT === 'production') {
    ini_set('session.cookie_secure', 1);
    ini_set('expose_php', 'Off');
}

// ==============================================
// Path Configuration
// ==============================================
define('ROOT_PATH', realpath(__DIR__));
define('UPLOAD_PATH', ROOT_PATH . '/users');
define('RECEIPTS_PATH', ROOT_PATH . '/receipts');
define('AUTH_FILE', ROOT_PATH . '/passes.txt');

// ==============================================
// Error Reporting
// ==============================================
if (ENVIRONMENT === 'development') {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
} else {
    error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT);
    ini_set('display_errors', 0);
    ini_set('log_errors', 1);
    ini_set('error_log', ROOT_PATH . '/logs/error.log');
}

// ==============================================
// Application Constants
// ==============================================
define('APP_NAME', 'ReceiptZen');
define('APP_VERSION', '1.0.0');
define('MAX_UPLOAD_SIZE', 5 * 1024 * 1024); // 5MB
define('ALLOWED_MIME_TYPES', [
    'image/jpeg',
    'image/png',
    'image/webp'
]);

// ==============================================
// Database Configuration (if future expansion)
// ==============================================
define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
define('DB_NAME', getenv('DB_NAME') ?: 'receiptzen');
define('DB_USER', getenv('DB_USER') ?: '');
define('DB_PASS', getenv('DB_PASS') ?: '');

// ==============================================
// Initialization Checks
// ==============================================
if (!file_exists(AUTH_FILE)) {
    file_put_contents(AUTH_FILE, '');
    chmod(AUTH_FILE, 0600);
}

if (!is_dir(UPLOAD_PATH)) {
    mkdir(UPLOAD_PATH, 0755, true);
}

if (!is_dir(RECEIPTS_PATH)) {
    mkdir(RECEIPTS_PATH, 0755, true);
}

// ==============================================
// Modern Helper Functions
// ==============================================
function config_asset(string $path): string {
    return '/assets/' . ltrim($path, '/');
}

function config_require_auth() {
    require_once __DIR__ . '/auth/auth_check.php';
}

function config_get_upload_dir(string $username): string {
    $path = UPLOAD_PATH . '/' . $username;
    if (!is_dir($path)) mkdir($path, 0755, true);
    return $path;
}