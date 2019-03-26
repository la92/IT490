<?php

// First we check if the form was submitted.
if (isset($_POST['reset-request-submit'])) {

  $selector = bin2hex(random_bytes(8));
  $token = random_bytes(32);

  $url = "web.njit.edu~la92/IT490/create-new-password.php?selector=" . $selector . "&validator=" . bin2hex($token);
  $expires = date("U") + 1800;

  require 'dbh.inc.php';

  // Then we grab the e-mail the user submitted from the form.
  $userEmail = $_POST["email"];

  // Finally we delete any existing entries.
  $sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo "There was an error!";
    exit();
  } else {
    mysqli_stmt_bind_param($stmt, 's', $userEmail);
    mysqli_stmt_execute($stmt);
  }

  // Here we then insert the info we have regarding the token into the database. This means that we have something we can use to check if it is the correct user that tries to change their password.
  $sql = "INSERT INTO pwdReset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?, ?, ?, ?)";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo "There was an error!";
    exit();
  } else {
    // Here we also hash the token to make it unreadable, in case a hacker accessess our database.
    $hashedToken = password_hash($token, PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt, "ssss", $userEmail, $selector, $hashedToken, $expires);
    mysqli_stmt_execute($stmt);
  }

  // Here we close the statement and connection.
  mysqli_stmt_close($stmt);
  mysqli_close($conn);

  // The last thing we need to do is to format an e-mail and send it to the user, so they can click a link that allow them to reset their password.

  // Who are we sending it to.
  $to = '$userEmail';

  // Subject
  $subject = 'Reset your password for https://web.njit.edu/~la92/IT490';

  // Message
  $message = '<p>We recieved a password reset request. The link to reset your password is below. ';
  $message .= 'If you did not make this request, you can ignore this email</p>';
  $message .= '<p>Here is your password reset link: </br>';
  $message .= '<a href="' . $url . '">' . $url . '</a></p>';

  // Headers
  // Headers
  $headers = "From: teken4 <lionel.alliaj1@gmail.com>\r\n";
  $headers .= "Reply-To: lionel.alliaj1@gmail.com\r\n";
  $headers .= "Content-type: text/html\r\n";

  // Send e-mail
  mail($to, $subject, $message, $headers);

  // Finally we send them back to a page telling them to check their e-mail.
  header("Location: ../reset-password.php?reset=success");}
  else {

  	header("Location: ../signup.php");
  exit();}
