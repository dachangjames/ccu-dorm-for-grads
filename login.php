<?php
require 'class/Token.php';

// submit action
if (isset($_POST["sid"])) {
  // create payload from user input
  $payload = [
    "sid" => $_POST["sid"],
    "pw" => $_POST["pw"]
  ];

  // sign up a token and set the cookie
  Token::auth($payload);

  // redirect
  header("location: index.php");
  exit;
}
?>
