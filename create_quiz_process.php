<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    die("Access denied. Admins only.");
}
$servername = "localhost";
$username = "root";
$password = "442001R@M";
$dbname = "quizz";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$title = $_POST['title'];
$questions = $_POST['questions'];
$stmt = $conn->prepare("INSERT INTO quizzes (title) VALUES (?)");
$stmt->bind_param("s", $title);
$stmt->execute();
$quiz_id = $stmt->insert_id;
$stmt->close();
$stmt = $conn->prepare("INSERT INTO questions (quiz_id, question, is_true) VALUES (?, ?, ?)");
foreach ($questions as $question) {
    $question_text = $question['question'];
    $is_true = isset($question['is_true']) ? 1 : 0;
    $stmt->bind_param("isi", $quiz_id, $question_text, $is_true);
    $stmt->execute();
}
$stmt->close();
$conn->close();

header("Location: admin_dashboard.php");
?>