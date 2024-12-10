<?php
$servername = "localhost";  
$username = "root";         
$password = "";             
$dbname = "school";     

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Fetch user from the database
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verify password
        if ($row['password'] === $password) { // In a real application, use password_hash() and password_verify()
            session_start();
            $_SESSION['email'] = $email; // Store user session data
            header("Location: welcome.php");
            exit();
        } else {
            echo "<script>alert('Invalid password.');</script>";
        }
    } else {
        echo "<script>alert('No user found with that email.');</script>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
</head>
<body>

<h2>Login</h2>
<form method="POST" action="">
    <table>
        <tr>
            <td>Email: <input type="email" name="email" required></td>
            <td>Password: <input type="password" name="password" required></td>
        </tr>
        <tr>
            <td><input type="submit" name="login" value="Login"></td>
        </tr>
    </table>
</form>

</body>
</html>
