<?php
require_once 'auth_check.php';
require_once 'db_connect.php';

$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$where = "";
if (!empty($search)) {
    $safe_search = mysqli_real_escape_string($conn, $search);
    $where = " WHERE name LIKE '%$safe_search%' OR student_id LIKE '%$safe_search%' OR email LIKE '%$safe_search%' OR course LIKE '%$safe_search%'";
}

$query = "SELECT * FROM students" . $where . " ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students - EduTrack</title>
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
            <h1 style="color: #1E3A8A; margin-bottom: 1.5rem;">Student Details</h1>

            <?php if (isset($_SESSION['message'])): ?>
                <div class="success-msg"><?php echo htmlspecialchars($_SESSION['message']); unset($_SESSION['message']); ?></div>
            <?php endif; ?>

            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; margin-bottom: 1.5rem;">
                <a href="add_student.php" class="btn btn-primary">Add Student</a>
                <form action="students.php" method="GET" class="search-form">
                    <input type="text" name="search" placeholder="Search students..." value="<?php echo htmlspecialchars($search); ?>">
                    <button type="submit" class="btn btn-secondary">Search</button>
                </form>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Student ID</th>
                            <th>Full Name</th>
                            <th>Age</th>
                            <th>Gender</th>
                            <th>Address</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Course</th>
                            <th>Semester</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (mysqli_num_rows($result) > 0): ?>
                            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['student_id']); ?></td>
                                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                                    <td><?php echo htmlspecialchars($row['age']); ?></td>
                                    <td><?php echo htmlspecialchars($row['gender']); ?></td>
                                    <td><?php echo htmlspecialchars($row['address']); ?></td>
                                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                                    <td><?php echo htmlspecialchars($row['phone']); ?></td>
                                    <td><?php echo htmlspecialchars($row['course']); ?></td>
                                    <td><?php echo htmlspecialchars($row['semester']); ?></td>
                                    <td><a href="edit_student.php?id=<?php echo $row['id']; ?>" class="btn btn-secondary">Edit</a></td>
                                    <td><a href="delete_student.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a></td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="10" style="text-align: center;">No students found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <footer>
        <div class="copyright">&copy; 2025 EduTrack. All rights reserved.</div>
    </footer>
</body>
</html>
