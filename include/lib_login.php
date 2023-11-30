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
  $access_token = Token::auth($payload);
}


// redirect
if (isset($access_token)) {
  if ($access_token === 401) {
    // invalid account
    header("location: /?inner=login&auth=401");
  } else if ($access_token === 403) {
    // invalid password
    header("location: /?inner=login&auth=403");
  } else {
    // send back the access token if there's one
    header("location: /?token=" . $access_token);
  }
} else {
  header("location: /?inner=login&auth=401");
}
exit;
