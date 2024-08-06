<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register</title>
<link rel="stylesheet" href="styles.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script>
    function validateForm() {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirm_password').value;
        if (password !== confirmPassword) {
            alert("Passwords do not match.");
            return false;
        }
        return true;
    }
</script>
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

h2 {
    color: #343a40;
}

.form-group label {
    color: #495057;
}

.btn-primary {
    background-color: #007bff;
    border-color: #007bff;
}

.btn-primary:hover {
    background-color: #0056b3;
    border-color: #004085;
}

</style>
</head>
<body>
<div class="container">
<h2>Register</h2>
<form action="register_process.php" method="POST" onsubmit="return validateForm()">
<div class="form-group">
<label for="email">Email:</label>
<input type="email" class="form-control" id="email" name="email" required>
</div>
<div class="form-group">
<label for="username">Username:</label>
<input type="text" class="form-control" id="username" name="username" required>
</div>
<div class="form-group">
<label for="password">Password:</label>
<input type="password" class="form-control" id="password" name="password" required>
</div>
<div class="form-group">
<label for="confirm_password">Confirm Password:</label>
<input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
</div>
<div class="form-group">
<label>Account Type:</label><br>
<input type="radio" id="user" name="account_type" value="user" checked>
<label for="user">User</label><br>
<input type="radio" id="admin" name="account_type" value="admin">
<label for="admin">Admin</label>
</div>
<button type="submit" class="btn btn-primary">Register</button>
</form>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>