<?php
require "class/Token.php";

// check if there's a key 
if (isset($_COOKIE["jwt"])) {
  $token = $_COOKIE["jwt"];

  // verify the token
  $valid = Token::verify($token);
}

// conditional rendering
if (!isset($valid)) {
  echo "<h1>Please login first.</h1>";
} else if (!$valid) {
  echo "<h1>Login Failed</h1>";
} else {
  echo "<h1>Welcome {$valid["sid"]}!</h1>";
}
?>