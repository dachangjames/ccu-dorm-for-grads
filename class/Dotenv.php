<?php
  class Dotenv {
    public static function load($key) {
      $env = parse_ini_file($_SERVER["DOCUMENT_ROOT"] . "\.env");
      return $env[$key];
    }
  }
?>