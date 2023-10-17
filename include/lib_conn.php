<?php
require_once "class/DB.php";

try {
    // connect db
    DB::get_connection();
} catch (PDOException $e) {
    print_r($e);
    die();
}

// phpinfo();
?>