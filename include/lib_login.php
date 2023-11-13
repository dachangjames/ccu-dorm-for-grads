<?php
require "../class/Token.php";

// redirect if the user already logged in
if (!isset($_SESSION["account"])) {
  // submit action
  if (isset($_POST["sid"])) {
    // create payload from user input
    $payload = [
      "sid" => $_POST["sid"],
      "pw" => $_POST["pw"]
    ];

    // sign up a token and set the cookie
    Token::auth($payload);
  }
}

  // redirect
  header("location: /");
  exit;

?>
