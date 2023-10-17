<main id="main">
  <?php
  require_once "class/Token.php";

  // check if there's a key 
  if (isset($_COOKIE["jwt"])) {
    $token = $_COOKIE["jwt"];

    // verify the token
    $valid = Token::verify($token);
  }
  
    // check if user has a cookie
    if (isset($valid)) {
      // check if the cookie is valid
      if ($valid) {
        $_SESSION["account"] = $valid;
        // echo $_SESSION["account"]["pw"];
        $_SESSION["perm"] = $valid["perm"];
      } else {
        // invalid token
        header($_SERVER["SERVER_PROTOCOL"] . " 401 Unautorized");
      }
    }

  // menu component
  include "include/lib_transmenu.php";

  // main content
  echo "<section id=\"right\">";

  // conditional rendering content
  include "include/lib_transpage.php";

  echo "</section>";
  ?>
</main>
