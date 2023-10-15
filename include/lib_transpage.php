<?php
// transpage logic

// check if user is logged in
if (isset($_SESSION["account"])) {
  if (isset($_GET["inner"])) {
    // check user permission
    if ($_SESSION["perm"] === substr($_GET["inner"], 0, 3)) {
      // check if the page exist
      $filepath = $_SESSION["perm"] . "/" . $_GET["inner"] . ".php";
      if (file_exists($filepath)) {
        include $filepath;
      } else {
        include "page/404.html";
      }
    } else {
      include "page/403.html";
    }
  } else {
    // perm/perm_index.php
    include $_SESSION["perm"] . "/" . $_SESSION["perm"] . "_index.php";
  }
} else if (isset($_GET["inner"])) {
  // logged out
  switch ($_GET["inner"]) {
    case "login":
      include "page/login.html";
      break;
    default:
      include "page/404.html";
      break;
  }
} else {
  include "div/div_home.php";
}
?>
