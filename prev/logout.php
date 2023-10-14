<?php
// clear cookie
setcookie("sso", "", time(), "/");

// redirect to home page
header("location: index.php");
exit;
?>
