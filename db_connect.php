<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "club_system"; // your DB name

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
?>
