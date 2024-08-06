<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$quiz_id = 3; 
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
    <title>Matching Quiz</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Matching Quiz</h2>
        <form method="POST" action="submit_matching.php">
            <?php foreach ($questions as $question): ?>
                <div class="form-group">
                    <label><?php echo $question['question']; ?></label>
                    <?php
                    $quiz_no = $question['QuizNo'];
                    $query = "SELECT * FROM Matching WHERE Quiz_Id = ? AND QuestionNo = ?";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param('ii', $quiz_id, $quiz_no);
                    $stmt->execute();
                    $matches = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                    ?>
                    <?php foreach ($matches as $match): ?>
                        <div class="form-row">
                            <div class="col">
                                <input type="text" class="form-control" name="col1[<?php echo $quiz_no; ?>][]" value="<?php echo $match['Col1']; ?>" readonly>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" name="col2[<?php echo $quiz_no; ?>][]">
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>
