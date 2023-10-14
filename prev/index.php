<?php
require "token.php";

$token = "";

// check if there's a key 
if (isset($_COOKIE["sso"])) {
  $token = $_COOKIE["sso"];

  // verify the token
  $valid = Token::verify($token);
}

// conditional rendering
if (isset($valid) && $valid) {
  // redirect to index.php if logged out
  echo "<a href=\"./logout.php\">logout</a>";
  echo "<h1>Welcome {$valid["sid"]}!</h1>";
} else {
  // redirect to current page if login success
  echo "<a href=\"./login.php?redirect={$_SERVER["REQUEST_URI"]}\">login</a>";
  echo "<h1>Please login first.</h1>";
}
?>
