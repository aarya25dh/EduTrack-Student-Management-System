<?php
session_start();
require_once 'auth_check.php';
require_once 'db_connect.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($id <= 0) {
    header("Location: students.php");
    exit;
}

$sql = "DELETE FROM students WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
if (!$stmt) {
    $_SESSION['message'] = "Delete failed. Please try again.";
    header("Location: students.php");
    exit;
}
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

if (mysqli_stmt_affected_rows($stmt) > 0) {
    header("Location: delete_success.php");
} else {
    $_SESSION['message'] = "Student not found or already deleted.";
    header("Location: students.php");
}
exit;
?>