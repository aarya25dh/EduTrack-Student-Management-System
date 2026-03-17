<?php
require_once 'auth_check.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications - EduTrack</title>
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
            <h1 style="color: #1E3A8A; margin-bottom: 1.5rem;">Notifications</h1>

            <div class="notification-list">
                <div class="card notification-card success">
                    <strong>Student added successfully</strong>
                    <p>Your student record has been added to the system.</p>
                </div>
                <div class="card notification-card">
                    <strong>Student record updated</strong>
                    <p>Student information has been successfully updated.</p>
                </div>
                <div class="card notification-card warning">
                    <strong>Student record deleted</strong>
                    <p>A student record has been removed from the system.</p>
                </div>
                <div class="card notification-card">
                    <strong>Welcome to EduTrack</strong>
                    <p>You have successfully logged in. Start managing your students.</p>
                </div>
                <div class="card notification-card">
                    <strong>System Update</strong>
                    <p>EduTrack is running smoothly. All features are available.</p>
                </div>
            </div>
        </main>
    </div>

    <footer>
        <div class="copyright">&copy; 2025 EduTrack. All rights reserved.</div>
    </footer>
</body>
</html>
