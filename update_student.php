<?php
require_once 'auth_check.php';
require_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int) ($_POST['id'] ?? 0);
    $student_id = trim($_POST['student_id'] ?? '');
    $name = trim($_POST['name'] ?? '');
    $age = (int) ($_POST['age'] ?? 0);
    $gender = trim($_POST['gender'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $course = trim($_POST['course'] ?? '');
    $semester = trim($_POST['semester'] ?? '');

    if ($id <= 0 || empty($student_id) || empty($name) || $age <= 0 || empty($gender) || empty($course) || empty($semester)) {
        header("Location: edit_student.php?id=$id&error=Required fields are missing");
        exit;
    }

    if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
        header("Location: edit_student.php?id=$id&error=Only letters and white space allowed in name");
        exit;
    }

    if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: edit_student.php?id=$id&error=Invalid email format");
        exit;
    }

    if (!empty($phone) && !preg_match('/^9(7|8)[0-9]{8}$/', $phone)) {
        header("Location: edit_student.php?id=$id&error=Phone must be 10 digits and start with 97 or 98");
        exit;
    }

    // Check duplicate student_id excluding current record
    $check_id = mysqli_prepare($conn, "SELECT id FROM students WHERE student_id = ? AND id <> ?");
    mysqli_stmt_bind_param($check_id, "si", $student_id, $id);
    mysqli_stmt_execute($check_id);
    $check_result = mysqli_stmt_get_result($check_id);

    if (mysqli_num_rows($check_result) > 0) {
        header("Location: edit_student.php?id={$id}&error=" . urlencode("Student ID already exists"));
        exit;
    }

    $stmt = mysqli_prepare($conn, "UPDATE students SET student_id=?, name=?, age=?, gender=?, address=?, email=?, phone=?, course=?, semester=? WHERE id=?");
    mysqli_stmt_bind_param($stmt, "ssissssssi", $student_id, $name, $age, $gender, $address, $email, $phone, $course, $semester, $id);

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['message'] = "Student record updated";
        header("Location: students.php");
    } else {
        header("Location: edit_student.php?id=$id&error=Update failed");
    }
    exit;
} else {
    header("Location: students.php");
    exit;
}
?>