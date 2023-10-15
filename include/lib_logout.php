<?php
// clear cookie
setcookie("jwt", "", time(), "/");

// redirect to home page
header("location: /");
exit;
?>
