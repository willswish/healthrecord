<?php
session_start();

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $dbname = "mhr";

    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, username, password, role FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            // Redirect based on role
            switch ($user['role']) {
                case 'admin': header("Location: admin/dashboard.php"); exit();
                case 'nurse': header("Location: nurse/medical_records.php"); exit();
                case 'clerk': header("Location: clerk/register_student.php"); exit();
                case 'dean': header("Location: dean/monitor_health.php"); exit();
                case 'coordinator': header("Location: coordinator/health_records.php"); exit();
                default: $error_message = "Invalid role specified for user.";
            }
        } else {
            $error_message = "Invalid username or password.";
        }
    } else {
        $error_message = "Invalid username or password.";
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Hospital Login</title>

<link rel="stylesheet" href="css/index.css">

</head>

<body>

<div class="card">

<form method="POST" action="index.php">
    <h1>Student Health Medical Records</h1>

    <?php if (!empty($error_message)): ?>
        <div class="error-message" style="background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; padding: .75rem 1.25rem; border-radius: .25rem; margin-bottom: 1rem;">
            <?php echo htmlspecialchars($error_message); ?>
        </div>
    <?php endif; ?>

    <div class="input-group">
    <label for="username">Username</label>
    <input type="text" id="username" name="username" required>
    </div>

    <div class="input-group">
    <label for="password">Password</label>
    <input type="password" id="password" name="password" required>
    </div>

    <div class="options">

    <label>
    <input type="checkbox" name="remember"> Remember me
    </label>

    <a href="#">Forgot Password?</a>

    </div>

    <button type="submit">Login</button>
</form>

</div>

</body>
</html>