<?php
session_start();

// Redirect if user is not logged in
function checkLogin() {
    if(!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }
}

// Redirect if user is admin
function isAdmin() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

// Get logged-in user info
function getUserInfo($conn) {
    if(isset($_SESSION['user_id'])) {
        $id = $_SESSION['user_id'];
        $sql = "SELECT * FROM users WHERE id='$id'";
        $result = $conn->query($sql);
        if($result && $result->num_rows > 0){
            return $result->fetch_assoc();
        }
    }
    return null;
}
?>
