<?php
require_once 'auth_check.php';
require_once 'db_connect.php';

$total_students = 0;
$result = mysqli_query($conn, "SELECT COUNT(*) as cnt FROM students");
if ($row = mysqli_fetch_assoc($result)) {
    $total_students = $row['cnt'];
}

$total_courses = 40;
$total_teachers = 25;
$total_semesters = 8;
$total_faculties = 6;
$pass_rate = 85;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - EduTrack</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <nav class="navbar">
            <div class="logo">
                <a href="index.html">
                    <img src="logos.png" alt="EduTrack Logo" style="height:30px; margin: auto;">
                </a>
            </div>
            <ul class="nav-links">
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <div class="dashboard-layout">
        <aside class="sidebar">
            <ul class="sidebar-nav">
                <li><a href="dashboard.php">Home</a></li>
                <li><a href="students.php">Student Details</a></li>
                <li><a href="notifications.php">Notifications</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </aside>

        <main class="main-content">
            <h1 style="color: #1E3A8A; margin-bottom: 1.5rem;">Dashboard</h1>

            <?php if (isset($_SESSION['message'])): ?>
                <div class="success-msg"><?php echo htmlspecialchars($_SESSION['message']);
                unset($_SESSION['message']); ?>
                </div>
            <?php endif; ?>

            <div class="dashboard-cards">
                <div class="card dash-card">
                    <h3><?php echo $total_faculties; ?></h3>
                    <p>Total Faculties</p>
                </div>
                <div class="card dash-card">
                    <h3><?php echo $total_teachers; ?></h3>
                    <p>Total Teachers</p>
                </div>
            </div>
            <div class="dashboard-cards">
                <div class="card dash-card">
                    <h3><?php echo $total_semesters; ?></h3>
                    <p>Total Semesters</p>
                </div>
                <div class="card dash-card">
                    <h3><?php echo $total_courses; ?></h3>
                    <p>Total Courses</p>
                </div>
                <div class="card dash-card">
                    <h3><?php echo $total_students; ?></h3>
                    <p>Total Students</p>
                </div>
                <div class="card dash-card">
                    <h3><?php echo $pass_rate; ?>%</h3>
                    <p>Overall Pass Rate</p>
                </div>
            </div>

            <div class="action-buttons">
                <a href="add_student.php" class="btn btn-primary">Add Student</a>
                <a href="students.php" class="btn btn-secondary">View Students</a>
                <a href="students.php" class="btn btn-secondary">Update Student</a>
                <a href="students.php" class="btn btn-danger">Delete Student</a>
            </div>
        </main>
    </div>

    <footer>
        <div class="copyright">&copy; 2025 EduTrack. All rights reserved.</div>
    </footer>
</body>

</html>