<?php
// Establish connection to MySQL database
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "gajadevi"; 

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$username = $_POST['username'];
$password = $_POST['password'];

// Trim the passwords
$username = trim($username);
$password = trim($password);

// Retrieve password from database
$sql = "SELECT password FROM users WHERE username='$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // User found, verify password
    $row = $result->fetch_assoc();
    $stored_password = $row['password'];
    if ($password === $stored_password) {
        echo "Login successful!";
	 session_start();
    $_SESSION['username'] = $username;
	 header("Location: index.html");
        exit();
    } else {
        echo "Incorrect password!";
    }
} else {
    echo "User not found!";
}

$conn->close();
?>
