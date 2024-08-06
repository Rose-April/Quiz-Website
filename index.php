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
$quizzes = $conn->query("SELECT * FROM quizzes");
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Home Page</title>
<link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="navbar">
<a href="index.php">Home</a>
<?php if (isset($_SESSION['role'])): ?>
<?php if ($_SESSION['role'] == 'admin'): ?>
<a href="admin_dashboard.php">Admin Dashboard</a>
<?php elseif ($_SESSION['role'] == 'user'): ?>
<a href="user_dashboard.php">User Dashboard</a>
<?php endif; ?>
<a href="logout.php">Logout</a>
<?php else: ?>
<a href="login.php">Login</a>
<a href="register.php">Register</a>
<?php endif; ?>
</div>
<div class="container">
<h1>Welcome to Quizz</h1>
<h2>Available Quizzes</h2>
<div class="list-group">
<?php while ($quiz = $quizzes->fetch_assoc()): ?>
<a href="take_quiz.php?id=<?php echo $quiz['id']; ?>" class="list-group-item list-group-item-action">
<?php echo htmlspecialchars($quiz['title']); ?>
</a>
<?php endwhile; ?>
</div>
</div>
</body>
</html>
