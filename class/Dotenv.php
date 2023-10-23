<?php
  class Dotenv {
    /**
     * ### Load the .env file
     * 
     * @param string $key
     * Specify what value to retrive.
     * 
     * @return string
     * Return the coresponding value from the .env file.
     */
    public static function load($key) {
      $env = parse_ini_file($_SERVER["DOCUMENT_ROOT"] . "\.env");
      return $env[$key];
    }
  }
?>