<?php
include "div/div_head.php";

include "menu/menu_top.php";

include "transpage.php";

if (isset($_GET["inner"])) {
  include "include/lib_transpage.php";
} else {
  // home page
  include "div/div_home.php";
}
?>
