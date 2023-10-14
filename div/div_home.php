<?php
// conditional rendering
if (isset($valid) && $valid) {
  // redirect to index.php if logged out
  echo "<a href=\"./logout.php\">logout</a>";
} else {
  // redirect to current page if login success
  echo "<a href=\"index.php?inner=login\">login</a>";
}
?>