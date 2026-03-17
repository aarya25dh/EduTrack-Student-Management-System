<?php
session_start();
require_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        header("Location: login.php?error=Username and password are required");
        exit;
    }

    $username = mysqli_real_escape_string($conn, $username);
    $sql = "SELECT id, username, password, fullname FROM users WHERE username = '$username' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if ($row = mysqli_fetch_assoc($result)) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['user'] = [
                'id' => $row['id'],
                'username' => $row['username'],
                'fullname' => $row['fullname']
            ];
            header("Location: dashboard.php");
            exit;
        }
    }

    header("Location: login.php?error=Invalid username or password");
    exit;
} else {
    header("Location: login.php");
    exit;
}
?>
