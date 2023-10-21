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

$perms = ["adm", "dep", "qry", "sto", "std", "sww", "swn", "swo", "swd", "swa", "swd", "swa", "spo", "stq", "stn"];
$inners = ["adm", "dep", "qry", "stu"];

if (isset($_GET["inner"])) {
  // everyone can access
  switch ($_GET["inner"]) {
    // switch through pages everyone can access
    case "login":
      include "page/pg_login.html";
      break;
    case "rule":
      include "page/pg_rule.html";
      break;
    case "rule_a":
      include "page/pg_rule_a.html";
      break;
    case "rule_b":
      include "page/pg_rule_b.html";
      break;
    case "rule_c":
      include "page/pg_rule_c.html";
      break;
    case "rule_d":
      include "page/pg_rule_d.html";
      break;
    case "rule_e":
      include "page/pg_rule_e.html";
      break;
    case "applyfor":
      include "page/pg_applyfor.html";
      break;
    case "guide":
      include "page/pg_guide.html";
      break;
    case "member":
      include "page/pg_member.html";
      break;
    case "applynote":
      include "page/pg_applynote.html";
      break;
    case "faq":
      include "page/pg_faq.html";
      break;
    case "listpay";
      include "page/pg_listpay.html";
      break;
    default:
      // check if the user is logged in
      if (isset($_SESSION["account"])) {
        // check if the file exist
        $filepath = substr($_GET["inner"], 0, 3) . "/" . $_GET["inner"] . ".php";
        if (file_exists($filepath)) {
          // check if the user has the right permission
          if (is_allowed($_SESSION["perm"], $_GET["inner"])) {
            include $filepath;
          } else {
            // 403 Forbidden
            include "page/403.html";
          }
        } else {
          // 404 Not Found
          include "page/404.html";
        }
      } else if (isset($_GET["inner"]) && in_array($_GET["inner"], $inners)) {
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
    if ($_SESSION["perm"][0] !== "s") {
      include $_SESSION["perm"] . "/" . $_SESSION["perm"] . "index.php";
    } else {
      include "stu/stuindex.php";
    }
  } else {
    include "div/div_home.php";
  }
}

function is_allowed($perm, $inner) {
  if ($inner[0] !== "s") {
    return substr($inner, 0, 3) === $perm;
  } else {
    return substr($inner, 0, 3) === "stu";
  }
}
