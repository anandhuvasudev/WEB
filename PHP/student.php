<?php
$host = 'localhost';
$dbname = 'school'; 
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $email = $_POST['email'];


    try {
        $stmt = $pdo->prepare("INSERT INTO students (name, age, email) VALUES (:name, :age, :email)");
        $stmt->execute(['name' => $name, 'age' => $age, 'email' => $email]);
        echo "<div class='alert alert-success'>Student added successfully!</div>";
    } catch (PDOException $e) {
        echo "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>";
    }
}

try {
    $stmt = $pdo->query("SELECT * FROM students");
    $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Query failed: " . $e->getMessage();
}
?>

<html>
<head>
    <title>Student Management</title>
</head>
<body>
    <h2>Add Student</h2>
    <form method="POST" action="">
       	<table>
            <tr>
            	<th><label for="name">Name:</label></th>
            	<th><label for="age">Age:</label></th>
            	<th> <label for="email">Email:</label></th>
            </tr>
            <tr>
            <td><input type="text" class="form-control" id="name" name="name" required></td>       
            <td><input type="number" class="form-control" id="age" name="age" required></td>
            <td><input type="email" class="form-control" id="email" name="email" required></td>
            <td><button type="submit" class="btn btn-primary">Add Student</button></td>
            </tr>
 	</table>
        
    </form>

    <h2 class="mt-5">Student Details</h2>
    <table class="table table-bordered" border='1'>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Age</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($students as $student): ?>
                <tr>
                    <td><?php echo $student['id']; ?></td>
                    <td><?php echo $student['name']; ?></td>
                    <td><?php echo $student['age']; ?></td>
                    <td><?php echo $student['email']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
