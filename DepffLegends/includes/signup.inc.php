<?php
// Checks if form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    function post_captcha($user_response) {
        $fields_string = '';
        $fields = array(
            'secret' => '6Lf-YHUUAAAAAIeiUQF30nQfg8mg44C-iBnd11GL',
            'response' => $user_response
        );
        foreach($fields as $key=>$value)
        $fields_string .= $key . '=' . $value . '&';
        $fields_string = rtrim($fields_string, '&');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, True);

        $result = curl_exec($ch);
        curl_close($ch);

        return json_decode($result, true);
    }

    // Call the function post_captcha
    $res = post_captcha($_POST['g-recaptcha-response']);

    if (!$res['success']) {
      header("Location: ../signup.php?error=reCAPTCHAfail");
      exit();
    } else {


//checking if user has pressed the submit button to access this script
if (isset($_POST['signup-submit'])) {

  //database connection
  require 'dbh.inc.php';

  //grabbing data from form
  $username = $_POST['uid'];
  $email = $_POST['mail'];
  $password = $_POST['pwd'];
  $passwordRepeat = $_POST['pwd-repeat'];

  //checking for empty inputs
  if (empty($username) || empty($email) || empty($password) || empty($passwordRepeat)) {
    header("Location: ../signup.php?error=emptyfields&uid=".$username."&mail=".$email);
    exit();
  }

  //check for an invalid username and e-mail
  else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/",$username)) {
      header("Location: ../signup.php?error=invalidmailuid");
      exit();
  }

  //checking for an invalid e-mail.
  else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      header("Location: ../signup.php?error=invalidmail&uid=".$username);
      exit();
  }

  //check for invalid username
  else if (!preg_match("/^[a-zA-Z0-9]*$/",$username)) {
      header("Location: ../signup.php?error=invaliduid&mail=".$email);
      exit();
  }

  //check if the repeated password does not match the password
  else if ($password !== $passwordRepeat) {
    header("Location: ../signup.php?error=passwordcheck&uid=".$username."&mail=".$email);
    exit();
  }
  //end of basic error handlers

  //error handler that checks if the username is already taken using prepared statements because it is safer

  // First we create the statement that searches our database table to check for any identical usernames.
  else {
    $sql = "SELECT uidUsers FROM users WHERE uidUsers=?";
    //creating a prepared statement
    $stmt = mysqli_stmt_init($conn);
    //prepare the SQL statement and check if there are any errors with it
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      //If there is an error we send the user back to the signup page
      header("Location: ../signup.php?error=sqlerror");
      exit();
    }

    else {
      // binding the type of parameters we expect to pass into the statement, and bind the data from the user.
      // "s" means "string", "i" means "integer", "b" means "blob", "d" means "double".
      mysqli_stmt_bind_param($stmt, "s", $username);
      //executing the prepared statement and sending it to the database
      mysqli_stmt_execute($stmt);
      //storing the result from the statement
      mysqli_stmt_store_result($stmt);
      //recieving a number from the statement execution that was stored
      $resultCheck = mysqli_stmt_num_rows($stmt);
      //check if the username exists, if it does an error message is displayed for the user, informing that the username has already been taken
      if ($resultCheck > 0) {
        header("Location: ../signup.php?error=usertaken&mail=".$email);
        exit();
      }

    //selecting emails from the table
    else {
      $sql = "SELECT emailUsers FROM users WHERE emailUsers=?";
      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../signup.php?error=sqlerror");
        exit();
      }

    else {
      //checking if the emails have the same name
      mysqli_stmt_bind_param($stmt, "s", $email);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_store_result($stmt);
      $resultCheck = mysqli_stmt_num_rows($stmt);
      if ($resultCheck > 0) {
        header("Location: ../signup.php?error=emailtaken&uid=".$username);
        exit();
      }

      //if there are no errors, start to prepare the SQL statement that will insert the user's info into the database. We HAVE to do this using prepared statements to make this process more secure. DON'T JUST SEND THE RAW DATA FROM THE USER DIRECTLY INTO THE DATABASE!
      else {
      //prepared statements work by sending SQL to the database with placeholders(?), which will then be filled out later
      //inserting into the databse
      $sql ="INSERT INTO users (uidUsers, emailUsers, pwdUsers) VALUES (?, ?, ?)";
      //initialise a new statement using the connection file
      $stmt = mysqli_stmt_init($conn);
      //prepare SQL statement and check if there are any errors
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../signup.php?error=sqlerror");
        exit();
      }

      //if there are no errors, proceed with the rest of the script
      else {
        //hashing the password
        // The hashing method used here is the LATEST version and will always be, since it updates automatically. DON'T use md5 or sha256 to hash, these are old and outdated!
        $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

        //binding the type of parameters we expect to pass into the statement, and binding the data from the user
        mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedPwd);
        //executing the statement and sending it to the database
        //user has now been registered to the databse
        mysqli_stmt_execute($stmt);
        //sending the user back to the same page with a signup page successful message
        header("Location: ../signup.php?signup=successful");
        exit();
      }
    }
  }
}
}
}
  //closing the prepared statement and database connection
  mysqli_stmt_close($stmt);
  mysqli_close($conn);

//closing if statement from the top
}

  else {
    //If the user tries to access this page through the url, they are redirected back to the signup page
    header("Location: ../signup.php");
    exit();
  }
}
}
