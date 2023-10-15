<?php
// site configs
include "div/div_head.php";

// header component
include "menu/menu_top.php";

// conditional rendering according to user condition
include "transpage.php";

// conditional rendering content
if (isset($_GET["inner"])) {
  include "include/lib_transpage.php";
} else {
  // home page
  include "div/div_home.php";
}

include "div/div_footer.php";
?>
