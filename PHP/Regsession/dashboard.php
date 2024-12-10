<?php
session_start(); // Start session

// Check if the user is logged in
if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head><title>Dashboard</title></head>
<body>
    <h1>Welcome, <?php echo $_SESSION['student_name']; ?>!</h1>
    <a href="logout.php">Logout</a>
</body>
</html>
