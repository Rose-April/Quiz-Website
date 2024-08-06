<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   
}

$quiz_id = 1; 
$query = "SELECT * FROM MultipleChoice WHERE Quiz_Id = $quiz_id";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MCQ Quiz</title>
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>MCQ Quiz</h2>
        <form action="mcq.php" method="post">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="form-group">
                    <label><?php echo $row['MCQ']; ?></label>
                    <input type="radio" name="answer[<?php echo $row['MCQNo']; ?>]" value="1"> Option 1
                    <input type="radio" name="answer[<?php echo $row['MCQNo']; ?>]" value="2"> Option 2
                </div>
            <?php endwhile; ?>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>
