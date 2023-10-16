<?php
// transpage logic


/**
 *         //\\         ||                  |||||||||||||\\     ||              ||         //\\
 *        //  \\        ||                  ||           \\\    ||              ||        //  \\
 *       //    \\       ||                  ||             ||   ||              ||       //    \\
 *      //      \\      ||                  ||           ///    ||              ||      //      \\
 *     //||||||||\\     ||                  |||||||||||||//     ||||||||||||||||||     //||||||||\\
 *    //          \\    ||                  ||                  ||              ||    //          \\
 *   //            \\   ||                  ||                  ||              ||   //            \\
 *  //              \\  ||||||||||||||||||  ||                  ||              ||  //              \\
 */

// EDIT WITH CATION!!!

$perms = ["adm", "qry", "dep", "stu"];

if (isset($_GET["inner"])) {
  // everyone can access
  switch ($_GET["inner"]) {
    // switch through pages everyone can access
    case "login":
      include "page/login.html";
      break;
    default:
      // check if the user is logged in
      if (isset($_SESSION["account"])) {
        // check if the file exist
        $filepath = substr($_GET["inner"], 0, 3) . "/" . $_GET["inner"] . ".php";
        if (file_exists($filepath)) {
          // check if the user has the right permission
          if ($_SESSION["perm"] === substr($_GET["inner"], 0, 3)) {
            include $filepath;
          } else {
            // 403 Forbidden
            include "page/403.html";
          }
        } else {
          // 404 Not Found
          include "page/404.html";
        }
      } else if (isset($_GET["inner"]) && in_array(substr($_GET["inner"], 0, 3), $perms)) {
        // logged out user try to access perms pages
        // 401 Unauthorized
        include "page/401.html";
      } else {
        // 404 Not Found
        include "page/404.html";
      }
  }
} else {
  // entry pages
  if (isset($_SESSION["account"])) {
    // {perm}/{perm}_index.php
    include $_SESSION["perm"] . "/" . $_SESSION["perm"] . "_index.php";
  } else {
    include "div/div_home.php";
  }
}

?>
