<?php
session_start();
if ($_SESSION['role'] !== 'user') {
    die("Access denied. Users only.");
} 
$servername = "localhost";
$username = "root";
$password = "442001R@M";
$dbname = "quizz";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT quizzes.title, user_scores.score FROM user_scores JOIN quizzes ON user_scores.quiz_id = quizzes.id WHERE user_scores.user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$scores = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Dashboard</title>
<link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
<h2>User Dashboard</h2>
<h3>Your Scores</h3>
<div class="list-group">
<?php while ($score = $scores->fetch_assoc()): ?>
<div class="list-group-item">
<strong><?php echo htmlspecialchars($score['title']); ?>:</strong> <?php echo htmlspecialchars($score['score']); ?>
</div>
<?php endwhile; ?>
</div>
<h3>Available Quizzes</h3>
<div class="list-group">
<?php
        $quizzes = $conn->query("SELECT * FROM quizzes");
        while ($quiz = $quizzes->fetch_assoc()): ?>
<a href="take_quiz.php?id=<?php echo $quiz['id']; ?>" class="list-group-item list-group-item-action">
<?php echo htmlspecialchars($quiz['title']); ?>
</a>
<?php endwhile; ?>
</div>
</div>
</body>
</html>

