<?php
session_start();
 
$servername = "localhost";
$username = "root";
$password = "442001R@M";
$dbname = "quizz";
 
$conn = new mysqli($servername, $username, $password, $dbname);
 
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
 
$email = $_POST['email'];
$pass = $_POST['password'];
 
$stmt = $conn->prepare("SELECT id, password, role FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();
 
if ($stmt->num_rows === 0) {
    die("No user found with that email.");
}
 
$stmt->bind_result($user_id, $hashed_pass, $role);
$stmt->fetch();
 
// Verify password
if (password_verify($pass, $hashed_pass)) {
    $_SESSION['user_id'] = $user_id;
    $_SESSION['email'] = $email;
    $_SESSION['role'] = $role;
    if ($role === 'admin') {
        header("Location: admin_dashboard.php");
    } else {
        header("Location: user_dashboard.php");
    }
} else {
    die("Invalid password.");
}
 
$stmt->close();
$conn->close();
?>

