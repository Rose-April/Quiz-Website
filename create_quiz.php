<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    die("Access denied. Admins only.");
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Create Quiz</title>
<link rel="stylesheet" href="styles.css">
<script>
    let questionIndex = 0;
 
    function addQuestion() {
        const questionsContainer = document.getElementById('questionsContainer');
        questionIndex++;
 
        const questionDiv = document.createElement('div');
        questionDiv.classList.add('form-group');
        questionDiv.innerHTML = `
<label for="question_${questionIndex}">Question ${questionIndex}:</label>
<input type="text" class="form-control" id="question_${questionIndex}" name="questions[${questionIndex}][question]" required>
<label for="is_true_${questionIndex}">Is True:</label>
<input type="checkbox" id="is_true_${questionIndex}" name="questions[${questionIndex}][is_true]">
        `;
 
        questionsContainer.appendChild(questionDiv);
    }
</script>
</head>
<body>
<div class="container">
<h2>Create Quiz</h2>
<form action="create_quiz_process.php" method="POST">
<div class="form-group">
<label for="title">Quiz Title:</label>
<input type="text" class="form-control" id="title" name="title" required>
</div>
<div id="questionsContainer">
<button type="button" class="btn btn-secondary" onclick="addQuestion()">Add Question</button>
</div>
<button type="submit" class="btn btn-primary">Create Quiz</button>
</form>
</div>
</body>
</html>
