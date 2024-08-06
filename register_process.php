<?php
$servername = "localhost";
$username = "root";
$password = "442001R@M";
$dbname = "quizz";
 

$conn = new mysqli($servername, $username, $password, $dbname);
 

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
 
$email = $_POST['email'];
$user = $_POST['username'];
$pass = $_POST['password'];
$confirm_pass = $_POST['confirm_password'];
$role = $_POST['account_type']; 
 

if ($pass !== $confirm_pass) {
    die("Passwords do not match.");
}
 

$stmt = $conn->prepare("SELECT * FROM users WHERE email = ? OR username = ?");
$stmt->bind_param("ss", $email, $user);
$stmt->execute();
$result = $stmt->get_result();
 
if ($result->num_rows > 0) {
    die("Email or username already registered.");
}
 
$hashed_pass = password_hash($pass, PASSWORD_BCRYPT);
 
$stmt = $conn->prepare("INSERT INTO users (email, username, role, password) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $email, $user, $role, $hashed_pass);
 
if ($stmt->execute()) {
    echo "New record created successfully";
    header("Location: index.php");
    exit();
} else {
    echo "Error: " . $stmt->error;
}
 
$stmt->close();
$conn->close();
?>

