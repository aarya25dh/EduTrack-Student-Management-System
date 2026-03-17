<?php
require_once 'auth_check.php';
require_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_id = trim($_POST['student_id'] ?? '');
    $name = trim($_POST['name'] ?? '');
    $age = (int) ($_POST['age'] ?? 0);
    $gender = trim($_POST['gender'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $course = trim($_POST['course'] ?? '');
    $semester = trim($_POST['semester'] ?? '');

    if (empty($student_id) || empty($name) || $age <= 0 || empty($gender) || empty($course) || empty($semester)) {
        header("Location: add_student.php?error=Required fields are missing");
        exit;
    }

    if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
        header("Location: add_student.php?error=Only letters and white space allowed in name");
        exit;
    }

    if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: add_student.php?error=Invalid email format");
        exit;
    }

    if (!empty($phone) && !preg_match('/^9(7|8)[0-9]{8}$/', $phone)) {
        header("Location: add_student.php?error=Phone must be 10 digits and start with 97 or 98");
        exit;
    }

    // Check duplicate student_id (roll number must be unique)
    $student_id_safe = mysqli_real_escape_string($conn, $student_id);
    $sql_check = "SELECT id FROM students WHERE student_id = '$student_id_safe'";
    $check_result = mysqli_query($conn, $sql_check);

    if (mysqli_num_rows($check_result) > 0) {
        header("Location: add_student.php?error=" . urlencode("Student ID already exists"));
        exit;
    }

    $student_id_safe = mysqli_real_escape_string($conn, $student_id);
    $name_safe = mysqli_real_escape_string($conn, $name);
    $gender_safe = mysqli_real_escape_string($conn, $gender);
    $address_safe = mysqli_real_escape_string($conn, $address);
    $email_safe = mysqli_real_escape_string($conn, $email);
    $phone_safe = mysqli_real_escape_string($conn, $phone);
    $course_safe = mysqli_real_escape_string($conn, $course);
    $semester_safe = mysqli_real_escape_string($conn, $semester);

    $sql = "INSERT INTO students (student_id, name, age, gender, address, email, phone, course, semester) VALUES ('$student_id_safe', '$name_safe', $age, '$gender_safe', '$address_safe', '$email_safe', '$phone_safe', '$course_safe', '$semester_safe')";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['message'] = "Student added successfully";
        header("Location: students.php");
    } else {
        header("Location: add_student.php?error=Student add failed");
    }
    exit;
} else {
    header("Location: add_student.php");
    exit;
}
?>