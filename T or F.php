<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$quiz_id = 2; 
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
    <title>True/False Quiz</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>True/False Quiz</h2>
        <form method="POST" action="submit_tf.php">
            <?php foreach ($questions as $question): ?>
                <div class="form-group">
                    <label><?php echo $question['question']; ?></label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="answer[<?php echo $question['QuizNo']; ?>]" value="1">
                        <label class="form-check-label">True</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="answer[<?php echo $question['QuizNo']; ?>]" value="0">
                        <label class="form-check-label">False</label>
                    </div>
                </div>
            <?php endforeach; ?>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>
