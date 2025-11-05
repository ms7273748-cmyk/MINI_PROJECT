<?php
session_start();

// Destroy all session data
$_SESSION = array();
session_destroy();

// Optional: clear any cookies (if you used "Remember Me" or similar)
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Redirect to login page
header("Location: login.php");
exit();
?>
