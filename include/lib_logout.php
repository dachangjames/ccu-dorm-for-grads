<?php
// clear cookie
setcookie("jwt", "", time(), "/");

// clear session
unset($_SESSION["account"]);
unset($_SESSION["perm"]);

// redirect to home page
header("location: /");
exit;
?>
