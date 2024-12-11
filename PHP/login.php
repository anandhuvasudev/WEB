<?php
require 'config.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = clean_input($_POST['email']);
    $password = $_POST['password'];

    $query = "SELECT * FROM students WHERE email='$email'";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {
        // Set a cookie for 1 hour
        setcookie("student_email", $user['email'], time() + 3600, "/");
        setcookie("student_first_name", $user['first_name'], time() + 3600, "/");
        setcookie("student_last_name", $user['last_name'], time() + 3600, "/");
        setcookie("student_mobile", $user['mobile'], time() + 3600, "/");
        setcookie("student_dob", $user['dob'], time() + 3600, "/");
        
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid email or password";
    }
    if (isset($_GET['logout'])) {
    // Clear cookies
    setcookie("student_email", "", time() - 3600, "/");
    setcookie("student_first_name", "", time() - 3600, "/");
    setcookie("student_last_name", "", time() - 3600, "/");
    setcookie("student_mobile", "", time() - 3600, "/");
    setcookie("student_dob", "", time() - 3600, "/");
    
    header("Location: login.php");
    exit();
}
}
?>

<!DOCTYPE html>
<html>
<body>
    <h2>Student Login</h2>
    <?php if ($error) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="post">
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="submit" value="Login">
    </form>
    <p>Need an account? <a href="register.php">Register</a></p>
</body>
</html>
