<?php
require 'token.php';

// submit action
if (isset($_POST["sid"])) {
  // create payload from user input
  $payload = [
    "sid" => $_POST["sid"],
    "pw" => $_POST["pw"]
  ];

  // sign up a token and set the cookie
  $token = Token::sign($payload);
  setcookie("sso", $token, time() + Token::EXP, "/", "", true, true);

  // {redirect_path}?sid={sid}
  $redirect = $_GET["redirect"];
  header("location: " . $redirect);
  exit;
}

// login.php?redirect={redirect_path}
$action = $_SERVER["PHP_SELF"] . "?redirect=" . $_GET["redirect"];

?>

<!-- user input form -->
<form method="post" action=<?php echo $action ?>>
  <label for="sid">Student Id: </label>
  <input type="text" name="sid" required>
  <br>
  <label for="pw">Password: </label>
  <input type="password" name="pw" required>
  <br>
  <button type="submit">submit</button>
</form>