<?php
require "db.php";
session_start();

if ($_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];
$conn->query("DELETE FROM users WHERE user_id=$id");
header("Location: admin.php");
exit;
?>
