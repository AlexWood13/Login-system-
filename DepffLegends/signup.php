<?php
  require "header.php";
 ?>

 <main>
   <div class="wrapper">
     <section class="section-default">
       <h1>Signup</h1>
       <?php
          if (isset($_GET['error'])) {
            if ($_GET['error'] == "emptyfields") {
              echo '<p class="signuperror"> Fill in all fields! </p>';
            }
            else if ($_GET['error'] == "invaliduidmail"){
              echo '<p class="signuperror">Invalid username and e-mail!</p>';
            }
            else if ($_GET['error'] == "invaliduid"){
              echo '<p class="signuperror">Invalid username!</p>';
            }
            else if ($_GET['error'] == "invalidmail"){
              echo '<p class="signuperror">Invalid e-mail!</p>';
            }
            else if ($_GET['error'] == "passwordcheck"){
              echo '<p class="signuperror">Your passwords do not match up!</p>';
            }
            else if ($_GET['error'] == "usertaken"){
              echo '<p class="signuperror">Username is already taken!</p>';
            }
            else if ($_GET['error'] == "emailtaken"){
              echo '<p class="signuperror">Email is already taken!</p>';
            }
            else if ($_GET['error'] == "reCAPTCHAfail"){
              echo '<p class="signuperror">You have not validated the reCAPTCHA. Please try again!</p>';
            }
          }
          // create a success message if the new user was created.
            else if (isset($_GET["signup"])) {
              if ($_GET["signup"] == "successful") {
                echo '<p class="signupsuccess">Signup successful!</p>';
            }
          }
        ?>
        <form class="form-signup" action="includes/signup.inc.php" method="post">
          <?php
          // Here we check if the user already tried submitting data.

          // checking username.
          if (!empty($_GET["uid"])) {
            echo '<input type="text" name="uid" placeholder="Username" value="'.$_GET["uid"].'">';
          }
          else {
            echo '<input type="text" name="uid" placeholder="Username">';
          }

          // checking e-mail.
          if (!empty($_GET["mail"])) {
            echo '<input type="text" name="mail" placeholder="E-mail" value="'.$_GET["mail"].'">';
          }
          else {
            echo '<input type="text" name="mail" placeholder="E-mail">';
          }
          ?>
          <input type="password" name="pwd" placeholder="Password">
          <input type="password" name="pwd-repeat" placeholder="Repeat password">
          <div class="g-recaptcha" data-sitekey="6Lf-YHUUAAAAADJOgQFyUZCrXGqKKxuVGrwg3uMT" data-theme="dark" style="transform:scale(0.77);-webkit-transform:scale(0.77);transform-origin:0 0;-webkit-transform-origin:0 0;"></style></div>
          <div class="clr"> </div>
          <button type="submit" name="signup-submit">Signup</button>
        </form>
       </section>
     </div>
   </main>

 <?php
 require "footer.php";
 ?>
