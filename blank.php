<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$quiz_id = 4; 
$query = "SELECT * FROM QuestionBank WHERE Quiz_Id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $quiz_id);
$stmt->execute();
$result = $stmt->get_result();
$questions = $result->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Blank Quiz</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Blank Quiz</h2>
        <form method="POST" action="submit_blank.php">
            <?php foreach ($questions as $question): ?>
                <div class="form-group">
                    <label><?php echo $question['question']; ?></label>
                    <input type="text" name="answer[<?php echo $question['QuizNo']; ?>]" class="form-control" required>
                </div>
            <?php endforeach; ?>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>
