<?php
// start the user session
session_start();

function clear_session() {
  if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time(), $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
  }
  session_destroy();
}

$year = "111";

require "class/DB.php";

// site configs
include "div/div_head.php";

// connect to db if not connected
include "include/lib_conn.php";

// header component
include "menu/menu_top.php";

// conditional rendering according to user condition
include "transpage.php";

// footer component
include "div/div_footer.php";
?>
