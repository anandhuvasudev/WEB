<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = new mysqli('localhost', 'root', '', 'StudentDB');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $dob = $_POST['year'] . '-' . $_POST['month'] . '-' . $_POST['day'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $gender = $_POST['gender'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO students (first_name, last_name, dob, email, mobile, gender, password) 
            VALUES ('$firstName', '$lastName', '$dob', '$email', '$mobile', '$gender', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head><title>Register</title></head>
<body>
    <form method="post">
        First Name: <input type="text" name="firstName" required><br>
        Last Name: <input type="text" name="lastName" required><br>
        DOB: 
        <select name="day"><?php for ($i = 1; $i <= 31; $i++) echo "<option>$i</option>"; ?></select>
        <select name="month"><?php foreach (['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $month) echo "<option>$month</option>"; ?></select>
        <select name="year"><?php for ($i = 2000; $i <= 2024; $i++) echo "<option>$i</option>"; ?></select><br>
        Email: <input type="email" name="email" required><br>
        Mobile: <input type="text" name="mobile" required><br>
        Gender: 
        Male <input type="radio" name="gender" value="Male">
        Female <input type="radio" name="gender" value="Female"><br>
        Password: <input type="password" name="password" required><br>
        <button type="submit">Register</button>
    </form>
</body>
</html>
