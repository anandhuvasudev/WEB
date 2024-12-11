<?php
if (!isset($_COOKIE['student_email'])) {
    header("Location: login.php");
    exit();
}

// Retrieve user information from cookies
$student_email = $_COOKIE['student_email'];
$student_first_name = $_COOKIE['student_first_name'];
$student_last_name = $_COOKIE['student_last_name'];
$student_mobile = $_COOKIE['student_mobile'];
$student_dob = $_COOKIE['student_dob'];
?>

<!DOCTYPE html>
<html>
<body>
    <h2>Welcome, <?php echo htmlspecialchars($student_first_name); ?></h2>
    <center>
    <h3>Your Profile</h3>
    <p>First Name: <?php echo htmlspecialchars($student_first_name); ?></p>
    <p>Last Name: <?php echo htmlspecialchars($student_last_name); ?></p>
    <p>Email: <?php echo htmlspecialchars($student_email); ?></p>
    <p>Date of Birth: <?php echo htmlspecialchars($student_dob); ?></p>
    <p>Mobile: <?php echo htmlspecialchars($student_mobile); ?></p>
    <center>
    <a href="login.php?logout=true">Logout</a>
</body>
</html>
