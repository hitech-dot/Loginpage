<?php
session_start();

$file = "users.txt";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (file_exists($file)) {
        $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            list($u, $p) = explode("|", $line);
            if ($u == $username && $p == $password) {
                $_SESSION['user'] = $username;
                header("Location: home.php");
                exit();
            }
        }
    }
    $error = "Invalid username or password!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | My Stylish Site</title>
    <link rel="stylesheet" href="login.css">
</head>
<body class="dark-theme">
<div class="login-container">
    <div class="triangle-banner">
        <h2>Welcome Back, <span>Kashif Dar</span></h2>
    </div>

    <h2 class="login-title">Login</h2>
    <?php if ($error) echo "<p class='error'>$error</p>"; ?>

    <form method="POST" class="login-box">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" class="btn">Login</button>

        <p class="bottom-text">Don’t have an account?
            <a href="register.php">Register</a>
        </p>
    </form>
</div>
</body>
</html>