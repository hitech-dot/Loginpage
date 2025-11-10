<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home | My Stylish Site</title>
    <link rel="stylesheet" href="home.css">
</head>
<body class="dark-theme">
    <header>
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['user']); ?>!</h1>
        <nav>
            <ul>
                <li><a href="home.php">Home</a></li>
            <div class="gallery">
  <h2>Photo Gallery</h2>
  <div class="photos">
    <div class="photo-card">
      <img src="images\mypic1.jpg" alt="Photo 1">
      <p>me</p>
    </div>
    <div class="photo-card">
      <img src="https://www.gcwmaroad.edu.in/images/d2.jpg" alt="Photo 3">
      <p>campus</p>
    </div>
  </div>
</div>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="logout.php" class="logout">Logout</a></li>
            </ul>
        </nav>
    </header>
<section class="about-me">
    <h2>About Me</h2>
    <p>
        Hello! My name is <strong>Kashif</strong>. This is my personal website — 
        a project created for my college, <strong>Women's College M.A. Road, Srinagar</strong>, 
        as part of my <strong>MCA 1st Semester</strong>.
    </p>
    <p>
        I completed my graduation from <strong>Amar Singh College, Srinagar</strong>.
        I am passionate about web development, design, and programming.
        This website represents my creativity and learning journey.
    </p>
    <p>
        Thank you for visiting my site! 😊
    </p>
</section>
</body>
</html>