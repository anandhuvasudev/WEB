<?php
session_start(); // Start session
session_destroy(); // Destroy all session variables
header("Location: login.php"); // Redirect to login page
exit;
?>
