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
$users = $conn->query("SELECT id, email, username FROM users");
$quizzes = $conn->query("SELECT * FROM quizzes");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Dashboard</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="styles.css">
</head>
<style>
    /* styles.css */
body {
    background-color: #f8f9fa;
}

.container {
    background-color: #ffffff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h2, h3 {
    color: #343a40;
}

.list-group-item {
    background-color: #ffffff;
    border: 1px solid #dee2e6;
    margin-bottom: 10px;
}

.btn-primary {
    background-color: #007bff;
    border-color: #007bff;
}

.btn-primary:hover {
    background-color: #0056b3;
    border-color: #004085;
}

.btn-secondary {
    background-color: #6c757d;
    border-color: #6c757d;
}

.btn-secondary:hover {
    background-color: #5a6268;
    border-color: #545b62;
}

.btn-danger {
    background-color: #dc3545;
    border-color: #dc3545;
}

.btn-danger:hover {
    background-color: #c82333;
    border-color: #bd2130;
}

</style>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Admin Dashboard</h2>
    <h3 class="mb-3">Manage Users</h3>
    <div class="list-group mb-4">
        <?php while ($user = $users->fetch_assoc()): ?>
        <div class="list-group-item d-flex justify-content-between align-items-center">
            <div>
                <strong><?php echo htmlspecialchars($user['username']); ?>:</strong> <?php echo htmlspecialchars($user['email']); ?>
            </div>
            <div>
                <a href="edit_user.php?id=<?php echo $user['id']; ?>" class="btn btn-secondary btn-sm mr-2">Edit</a>
                <a href="delete_user.php?id=<?php echo $user['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
    <h3 class="mb-3">Manage Quizzes</h3>
    <div class="list-group mb-4">
        <?php while ($quiz = $quizzes->fetch_assoc()): ?>
        <div class="list-group-item d-flex justify-content-between align-items-center">
            <div><?php echo htmlspecialchars($quiz['title']); ?></div>
            <div>
                <a href="edit_quiz.php?id=<?php echo $quiz['id']; ?>" class="btn btn-secondary btn-sm mr-2">Edit</a>
                <a href="delete_quiz.php?id=<?php echo $quiz['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
    <a href="create_quiz.php" class="btn btn-primary">Create New Quiz</a>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
