<?php
require_once "../class/Token.php";

// submit action
if (isset($_POST["acc"])) {
  // create payload from user input
  $payload = [
    "acc" => $_POST["acc"],
    "pw" => $_POST["pw"]
  ];

  // sign up a token and set the cookie
  Token::auth($payload);
}

// redirect
header("location: /");
exit;
?>
