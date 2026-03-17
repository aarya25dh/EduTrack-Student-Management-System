<?php
require_once 'auth_check.php';
require_once 'db_connect.php';

$user_id = $_SESSION['user']['id'];
$result = mysqli_query($conn, "SELECT * FROM users WHERE id = $user_id");
$user = mysqli_fetch_assoc($result);

if (!$user) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - EduTrack</title>
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
            <h1 style="color: #1E3A8A; margin-bottom: 1.5rem;">Admin Profile</h1>

            <div class="card profile-info">
                <div class="profile-header">
                    <div class="profile-photo"><img src="profile.jpg" alt="Profile Photo" style="width: 100%; height: 100%; object-fit: cover;"></div>
                    <h2><?php echo htmlspecialchars($user['fullname']); ?></h2>
                </div>
                <div style="margin-top: 1.5rem;">
                    <p><strong>Full Name:</strong> <?php echo htmlspecialchars($user['fullname']); ?></p>
                    <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
                    <p><strong>Phone:</strong> <?php echo htmlspecialchars($user['phone'] ?? 'N/A'); ?></p>
                    <p><strong>Address:</strong> <?php echo htmlspecialchars($user['address'] ?? 'N/A'); ?></p>
                </div>
                <div style="margin-top: 1.5rem;">
                    <a href="logout.php" class="btn btn-danger">Logout</a>
                </div>
            </div>
        </main>
    </div>

    <footer>
        <div class="copyright">&copy; 2025 EduTrack. All rights reserved.</div>
    </footer>
</body>
</html>
