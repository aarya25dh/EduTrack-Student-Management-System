<?php
session_start();
require_once 'auth_check.php';
require_once 'db_connect.php';

$id = isset($_POST['id']) ? (int) $_POST['id'] : 0;

if ($id <= 0) {
    header("Location: students.php");
    exit;
}

$sql = "DELETE FROM students WHERE id = $id";
if (mysqli_query($conn, $sql) && mysqli_affected_rows($conn) > 0) {
    header("Location: delete_success.php");
} else {
    $_SESSION['message'] = "Student not found or already deleted.";
    header("Location: students.php");
}
exit;
?>