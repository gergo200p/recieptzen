<?php
function registerUser($username, $password) {
    if (!file_exists('passes.txt')) file_put_contents('passes.txt', '');
    
    $users = file('passes.txt', FILE_IGNORE_NEW_LINES);
    foreach ($users as $user) {
        if (strpos($user, $username.':') === 0) return false;
    }

    $hashed = password_hash($password, PASSWORD_BCRYPT);
    file_put_contents('passes.txt', "$username:$hashed\n", FILE_APPEND);
    mkdir("users/$username", 0755, true);
    return true;
}

function authenticateUser($username, $password) {
    if (!file_exists('passes.txt')) return false;

    foreach (file('passes.txt', FILE_IGNORE_NEW_LINES) as $user) {
        [$storedUser, $storedPass] = explode(':', $user, 2);
        if ($storedUser === $username && password_verify($password, $storedPass)) {
            return true;
        }
    }
    return false;
}