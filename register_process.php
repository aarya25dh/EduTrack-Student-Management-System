<?php
session_start();
require_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = trim($_POST['fullname'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    $phone = trim($_POST['phone'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $gender = $_POST['gender'] ?? '';
    $dob = $_POST['dob'] ?? '';

    // Strengthened server-side validation (major change)
    $errors = [];

    // Full name
    if (empty($fullname)) {
        $errors[] = "Full name is required";
    }

    // Username: required, cannot start with number
    if (empty($username)) {
        $errors[] = "Username is required";
    } elseif (preg_match('/^[0-9]/', $username)) {
        $errors[] = "Username cannot start with a number";
    }

    // Email
    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }

    // Password rules
    if (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters";
    }
    if (!preg_match('/[A-Za-z]/', $password) || !preg_match('/[0-9]/', $password)) {
        $errors[] = "Password must contain letters and numbers";
    }

    // Confirm password
    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match";
    }

    // Phone: 10 digits, starting with 97 or 98
    if (empty($phone)) {
        $errors[] = "Phone is required";
    } elseif (!preg_match('/^9(7|8)[0-9]{8}$/', $phone)) {
        $errors[] = "Phone must be 10 digits and start with 97 or 98";
    }

    // Address / gender / dob
    if (empty($address))
        $errors[] = "Address is required";
    if (empty($gender))
        $errors[] = "Gender is required";
    if (empty($dob))
        $errors[] = "Date of birth is required";

    if (!empty($errors)) {
        header("Location: register.php?error=" . urlencode(implode(". ", $errors)));
        exit;
    }

    $check = mysqli_prepare($conn, "SELECT id FROM users WHERE username = ? OR email = ?");
    mysqli_stmt_bind_param($check, "ss", $username, $email);
    mysqli_stmt_execute($check);
    $result = mysqli_stmt_get_result($check);

    if (mysqli_num_rows($result) > 0) {
        header("Location: register.php?error=Username or email already exists");
        exit;
    }

    $hashed = password_hash($password, PASSWORD_DEFAULT);
    $stmt = mysqli_prepare($conn, "INSERT INTO users (username, email, password, fullname, phone, address, gender, dob) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "ssssssss", $username, $email, $hashed, $fullname, $phone, $address, $gender, $dob);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: login.php?success=Registration successful. Please login.");
        exit;
    } else {
        header("Location: register.php?error=Registration failed. Try again.");
        exit;
    }
} else {
    header("Location: register.php");
    exit;
}
?>