<?php
require_once "class/DB.php";

// phpinfo();

try {
    // connect db
    DB::get_connection();
} catch (PDOException $e) {
    print_r($e);
    die();
}


// DB::disconnect();
?>