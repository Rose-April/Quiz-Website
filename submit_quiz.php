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
 
$quiz_id = $_POST['quiz_id'];
$user_id = $_SESSION['user_id'];
$questions = $_POST['questions'];
$score = 0;
 
$stmt = $conn->prepare("SELECT is_true FROM questions WHERE id = ?");
foreach ($questions as $question) {
    $question_id = $question['id'];
    $answer = $question['answer'];
 
    $stmt->bind_param("i", $question_id);
    $stmt->execute();
    $stmt->bind_result($is_true);
    $stmt->fetch();
 
    if ($answer == $is_true) {
        $score++;
    }
}
$stmt->close();
 
$stmt = $conn->prepare("INSERT INTO user_scores (user_id, quiz_id, score) VALUES (?, ?, ?)");
$stmt->bind_param("iii", $user_id, $quiz_id, $score);
$stmt->execute();
$stmt->close();
$conn->close();
 
header("Location: user_dashboard.php");
?>