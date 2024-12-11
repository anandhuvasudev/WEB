<?php
session_start();
require 'config.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = clean_input($_POST['first_name']);
    $last_name = clean_input($_POST['last_name']);
    $email = clean_input($_POST['email']);
    $mobile = clean_input($_POST['mobile']);
    $password = $_POST['password']; // Get the raw password for validation
    $dob = clean_input($_POST['dob']);

    // Validate inputs
    if (empty($first_name)) $errors[] = "First Name is required";
    if (empty($last_name)) $errors[] = "Last Name is required";
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "A valid Email is required";
    }
    if (empty($mobile)) $errors[] = "Mobile is required";
    if (empty($password)) $errors[] = "Password is required";
    if (strlen($password) < 6) $errors[] = "Password must be at least 6 characters long"; // Example password strength check
    if (empty($dob)) $errors[] = "Date of Birth is required";

    // Check if email already exists
    $stmt = $conn->prepare("SELECT * FROM students WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $errors[] = "Email already exists";
    }
    $stmt->close();

    // If no errors, proceed with registration
    if (empty($errors)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO students (first_name, last_name, email, mobile, password, dob) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $first_name, $last_name, $email, $mobile, $hashed_password, $dob);
        
        if ($stmt->execute()) {
            header("Location: login.php");
            exit();
        } else {
            $errors[] = "Registration failed: " . $stmt->error;
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html>
<body>
    <h2>Student Registration</h2>
    <?php 
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
    }
    ?>
    <form method="post">
        <input type="text" name="first_name" placeholder="First Name" required><br>
        <input type="text" name="last_name" placeholder="Last Name" required><br>
        <input type="date" name="dob" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="tel" name="mobile" placeholder="Mobile" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="submit" value="Register">
    </form>
    <p>Already have an account? <a href="login.php">Login</a></p>
</body>
</html>
