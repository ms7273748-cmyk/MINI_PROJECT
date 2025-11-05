<?php
require "db.php";
session_start();

if ($_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$club = $_POST['club'];

$stmt = $conn->prepare("INSERT INTO users (username, email, password, club) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $username, $email, $password, $club);
$stmt->execute();

header("Location: admin.php");
exit;
?>
