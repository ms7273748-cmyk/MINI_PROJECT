<?php
session_start();
require 'db_connect.php';

$admin_username = "MITESH";
$admin_password = "MITESH123";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Admin login
    if ($email === $admin_username && $password === $admin_password) {
        $_SESSION['role'] = 'admin';
        $_SESSION['username'] = $admin_username;
        header("Location: admin-dashboard.php");
        exit();
    }

    // User login (DB)
    $stmt = $conn->prepare("SELECT name, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($name, $db_password);
        $stmt->fetch();

        if ($password === $db_password) {
            $_SESSION['role'] = 'user';
            $_SESSION['username'] = $name;
            header("Location: user-dashboard.php");
            exit();
        }
    }

    echo "<script>alert('Invalid credentials!'); window.history.back();</script>";
}
?>
