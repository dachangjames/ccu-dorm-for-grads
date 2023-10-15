<?php
// transpage logic
switch ($_GET["inner"]) {
  case "login":
    include "page/login.html";
    break;
  default:
    include "page/404.html";
}
?>