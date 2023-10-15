<aside id="left">
  <?php
  // check if user is logged in
  if (isset($_SESSION["account"])) {
    // check user
    switch($_SESSION["perm"]) {
      case "adm":
        // admin
        include "menu/menu_adm.php";
        break;
      case "qry":
        // query
        include "menu/menu_qry.php";
        break;
      case "dep":
        // department
        include "menu/menu_dep.php";
        break;
      default:
      // student
        include "menu/menu_stu.php";
        break;
    }
  } else {
    include "menu/menu.php";
  }
  ?>
</aside>
