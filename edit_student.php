<?php
require_once 'auth_check.php';
require_once 'db_connect.php';

$id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
if ($id <= 0) {
    header("Location: students.php");
    exit;
}

$result = mysqli_query($conn, "SELECT * FROM students WHERE id = $id");
$student = mysqli_fetch_assoc($result);

if (!$student) {
    header("Location: students.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student - EduTrack</title>
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
                <li><a href="profile.php">Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </aside>

        <main class="main-content">
            <h1 style="color: #1E3A8A; margin-bottom: 1.5rem;">Edit Student</h1>

            <?php if (isset($_GET['error'])): ?>
                <div class="error-msg"><?php echo htmlspecialchars($_GET['error']); ?></div>
            <?php endif; ?>

            <div class="card" style="max-width: 600px;">
                <form action="update_student.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $student['id']; ?>">
                    <div class="form-group">
                        <label for="student_id">Student ID</label>
                        <input type="text" id="student_id" name="student_id" value="<?php echo htmlspecialchars($student['student_id']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($student['name']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="age">Age</label>
                        <input type="number" id="age" name="age" value="<?php echo htmlspecialchars($student['age']); ?>" required min="1" max="100">
                    </div>
                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select id="gender" name="gender" required>
                            <option value="Male" <?php echo $student['gender'] === 'Male' ? 'selected' : ''; ?>>Male</option>
                            <option value="Female" <?php echo $student['gender'] === 'Female' ? 'selected' : ''; ?>>Female</option>
                            <option value="Other" <?php echo $student['gender'] === 'Other' ? 'selected' : ''; ?>>Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea id="address" name="address" rows="3"><?php echo htmlspecialchars($student['address'] ?? ''); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($student['email'] ?? ''); ?>">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="tel" id="phone" name="phone" value="<?php echo htmlspecialchars($student['phone'] ?? ''); ?>">
                    </div>
                    <div class="form-group">
                        <label for="course">Course</label>
                        <input type="text" id="course" name="course" value="<?php echo htmlspecialchars($student['course']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="semester">Semester</label>
                        <input type="text" id="semester" name="semester" value="<?php echo htmlspecialchars($student['semester']); ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Student</button>
                    <a href="students.php" class="btn btn-outline" style="margin-left: 1rem;">Cancel</a>
                </form>
            </div>
        </main>
    </div>

    <footer>
        <div class="copyright">&copy; 2025 EduTrack. All rights reserved.</div>
    </footer>
</body>
</html>
