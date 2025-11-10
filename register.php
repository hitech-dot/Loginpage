<?php
session_start();

$file = "users.txt";
$msg = "";

// When form submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $email = trim($_POST['email']);
    $mobile = trim($_POST['mobile']);
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];

    // Read existing users
    $users = [];
    if (file_exists($file)) {
        $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            list($u, $p, $e, $m, $g, $d) = explode("|", $line);
            $users[$u] = [
                "password" => $p,
                "email" => $e,
                "mobile" => $m,
                "gender" => $g,
                "dob" => $d
            ];
        }
    }

    if (isset($users[$username])) {
        $msg = "Username already exists!";
    } else {
        $data = "$username|$password|$email|$mobile|$gender|$dob\n";
        file_put_contents($file, $data, FILE_APPEND);
        $msg = "Registration successful! <a href='index.php'>Login now</a>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register | Kashif Dar’s Website</title>
  <link rel="stylesheet" href="style.css">
  <style>
    body.dark-theme {
      height: 100vh;
      background: radial-gradient(circle at top left, #000000, #1b1b1b 70%);
      display: flex;
      justify-content: center;
      align-items: center;
      color: white;
      overflow: hidden;
    }

    .login-container {
      position: relative;
      background: rgba(255, 255, 255, 0.05);
      border: 2px solid #ff3c00;
      border-radius: 12px;
      width: 340px; /* 💡 Compact size same as login */
      padding: 35px 25px;
      box-shadow: 0 0 25px rgba(255, 60, 0, 0.6);
      animation: fadeIn 1s ease-in;
      text-align: center;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: scale(0.95); }
      to { opacity: 1; transform: scale(1); }
    }

    .triangle-banner {
      position: absolute;
      top: -70px;
      left: 0;
      width: 100%;
      height: 70px;
      background: linear-gradient(90deg, #ff3c00, #b30000);
      clip-path: polygon(0 0, 100% 0, 0 100%);
      display: flex;
      align-items: flex-end;
      padding-left: 15px;
      box-shadow: 0 0 15px rgba(255, 60, 0, 0.7);
    }

    .triangle-banner h2 {
      font-size: 1rem;
      margin-bottom: 6px;
      color: white;
      font-weight: 500;
    }

    .triangle-banner span {
      color: #ffce00;
    }

    .login-title {
      margin-top: 50px;
      margin-bottom: 15px;
      font-size: 1.4em;
      color: #ffce00;
      text-shadow: 0 0 8px #ff3c00;
    }

    .login-box input {
      width: 100%;
      padding: 8px;
      margin-bottom: 15px;
      border: none;
      border-bottom: 2px solid #ff3c00;
      background: transparent;
      color: white;
      outline: none;
      font-size: 0.9em;
      transition: 0.3s;
    }

    .login-box input::placeholder {
      color: #bbb;
    }

    .login-box input:focus {
      border-bottom-color: #ffce00;
    }

    .btn {
      width: 100%;
      background: linear-gradient(90deg, #ff3c00, #b30000);
      border: none;
      padding: 8px;
      border-radius: 25px;
      color: white;
      cursor: pointer;
      font-size: 0.95em;
      transition: 0.3s;
      box-shadow: 0 0 10px rgba(255, 60, 0, 0.4);
    }

    .btn:hover {
      background: linear-gradient(90deg, #ffce00, #ff3c00);
      color: black;
      box-shadow: 0 0 20px rgba(255, 200, 0, 0.6);
    }

    .bottom-text {
      margin-top: 10px;
      font-size: 0.85em;
    }

    .bottom-text a {
      color: #ffce00;
      text-decoration: none;
    }

    .error {
      color: #ff9999;
      font-size: 0.9em;
      margin-bottom: 8px;
    }

    .gender-box {
      text-align: left;
      margin-bottom: 10px;
      font-size: 0.9em;
    }

  </style>
</head>
<body class="dark-theme">
  <div class="login-container">
    <div class="triangle-banner">
      <h2>Kashif Dar’s <span>Website</span></h2>
    </div>

    <h2 class="login-title">Register</h2>
    <?php if ($msg) echo "<p class='error'>$msg</p>"; ?>

    <form method="POST" class="login-box">
      <input type="text" name="username" placeholder="Username" required>
      <input type="password" name="password" placeholder="Password" required>
      <input type="email" name="email" placeholder="Email" required>
      <input type="tel" name="mobile" placeholder="Mobile Number" required>

      <div class="gender-box">
        <label>Gender:</label><br>
        <label><input type="radio" name="gender" value="Male" required> Male</label>
        <label><input type="radio" name="gender" value="Female"> Female</label>
        <label><input type="radio" name="gender" value="Other"> Other</label>
      </div>

      <input type="date" name="dob" required>

      <button type="submit" class="btn">Register</button>

      <p class="bottom-text">Already have an account?
        <a href="login.php">Login</a>
      </p>
    </form>
  </div>
</body>
</html>