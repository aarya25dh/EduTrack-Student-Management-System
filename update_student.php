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
    $student_id_safe = mysqli_real_escape_string($conn, $student_id);
    $sql_check = "SELECT id FROM students WHERE student_id = '$student_id_safe' AND id <> $id";
    $check_result = mysqli_query($conn, $sql_check);

    if (mysqli_num_rows($check_result) > 0) {
        header("Location: edit_student.php?id={$id}&error=" . urlencode("Student ID already exists"));
        exit;
    }

    $name_safe = mysqli_real_escape_string($conn, $name);
    $gender_safe = mysqli_real_escape_string($conn, $gender);
    $address_safe = mysqli_real_escape_string($conn, $address);
    $email_safe = mysqli_real_escape_string($conn, $email);
    $phone_safe = mysqli_real_escape_string($conn, $phone);
    $course_safe = mysqli_real_escape_string($conn, $course);
    $semester_safe = mysqli_real_escape_string($conn, $semester);

    $sql = "UPDATE students SET student_id='$student_id_safe', name='$name_safe', age=$age, gender='$gender_safe', address='$address_safe', email='$email_safe', phone='$phone_safe', course='$course_safe', semester='$semester_safe' WHERE id=$id";

    if (mysqli_query($conn, $sql)) {
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