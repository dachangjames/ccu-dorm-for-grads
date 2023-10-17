<a href="/?inner=login">login</a>
<?php
// if login failed, redirect to login page
if (http_response_code() === 401) {
  header("location: /?inner=login");
}
?>
