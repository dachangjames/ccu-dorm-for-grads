<?php
// clear cookie
setcookie("jwt", "", time(), "/");

// clear session
$_SESSION = [];
if (ini_get("session.use_cookies")) {
  $params = session_get_cookie_params();
  setcookie(session_name(), '', time(), $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
}
session_destroy();

// redirect to home page
header("location: /");
exit;
