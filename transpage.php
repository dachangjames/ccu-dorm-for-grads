<main id="main">
  <?php
  require_once "class/Token.php";

  // redirected from login page
  if (isset($_GET["token"])) {
    // access token
    $_SESSION["token"] = $_GET["token"];
  }

  // verify the access token and the refresh token from cookie
  if (isset($_COOKIE["jwt"]) && isset($_SESSION["token"])) {
    $access_token = $_SESSION["token"];
    [$valid, $access_token] = Token::verify($access_token, $_COOKIE["jwt"]);
  } else {
    // user is not logged in
    $_SESSION = [];
    clear_session();
  }

  // check if user has tokens
  if (isset($valid)) {
    // check if user has valid tokens
    if ($valid) {
      $_SESSION["account"] = $valid;
      $_SESSION["perm"] = $valid["perm"];
    } else {
      // invalid tokens
      $_SESSION = [];
      clear_session();
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