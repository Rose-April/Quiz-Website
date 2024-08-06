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
$quiz_id = $_GET['id'];
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT title FROM quizzes WHERE id = ?");
$stmt->bind_param("i", $quiz_id);
$stmt->execute();
$stmt->bind_result($quiz_title);
$stmt->fetch();
$stmt->close();
$stmt = $conn->prepare("SELECT * FROM questions WHERE quiz_id = ?");
$stmt->bind_param("i", $quiz_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo htmlspecialchars($quiz_title); ?></title>
<link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
<h2><?php echo htmlspecialchars($quiz_title); ?></h2>
<form action="submit_quiz.php" method="POST">
<input type="hidden" name="quiz_id" value="<?php echo $quiz_id; ?>">
<?php while ($question = $result->fetch_assoc()): ?>
<div class="form-group">
<label><?php echo htmlspecialchars($question['question']); ?></label>
<input type="hidden" name="questions[<?php echo $question['id']; ?>][id]" value="<?php echo $question['id']; ?>">
<input type="radio" name="questions[<?php echo $question['id']; ?>][answer]" value="1"> True
<input type="radio" name="questions[<?php echo $question['id']; ?>][answer]" value="0"> False
</div>
<?php endwhile; ?>
<button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
</body>
</html>