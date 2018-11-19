<?php
  session_start();
 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name=viewport content="width=device-width, initial-scale=1.0">
    <title>DepffLegends</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Crimson+Text:400,400i" rel="stylesheet">
    <link rel="stylesheet" href="style.css" type="text/css">
    <script src='https://www.google.com/recaptcha/api.js'></script>
  </head>
  <body>

    <!-- Here is the header where I decided to include the login form for this tutorial. -->
  <header>

      <?php
         if (isset($_SESSION['userId'])) {
          echo '<nav class="nav-header-main">
                <a class="header-logo" href="index.php">
                  <img src="assets/pyke.png" alt="Depff logo">
                </a>
                <ul class="flex-container">
                  <li><a href="index.php">Home</a></li>
                  <li><a href="#">Champions</a></li>
                  <li><a href="#">Blog</a></li>
                  <li><a href="#">My Profile</a></li>
                </ul>
              </nav><div class="header-login"><form action="includes/logout.inc.php" method="post">
             <button type="submit" name="logout-submit">Logout</button>
           </form></div>';
         }
         else {
           echo '<nav class="nav-header-main">
                 <a class="header-logo" href="index.php">
                   <img src="assets/logo.png" alt="Depff logo">
                 </a>
                 <ul class="flex-container">
                   <li><a href="index.php">Home</a></li>
                   <li><a href="#">Champions</a></li>
                 </ul>
               </nav><div class="header-login">
             <form action="includes/login.inc.php" method="post">
             <input type="text" name="mailuid" placeholder="E-mail/Username">
             <input type="password" name="pwd" placeholder="Password">
             <button type="submit" name="login-submit">Login</button>
           </form>
           <a href="signup.php" class="header-signup">Signup</a></div>';
         }
       ?>
  </header>
