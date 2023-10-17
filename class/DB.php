<?php
class DB {
  protected static $db = null;

  /**
   * ### Check the connection to the database;
   * 
   * If there's no current connetion or the previous connetion has been timed out, reconnet.
   * 
   * @return void
   */
  public static function get_connection() {
    // initialize $db
    if (self::$db === null) {
      self::connect();
    }

    // check if connected
    try {
      self::$db->query("SELECT 1");
    } catch (PDOException $e) {
      // reconnect
      self::connect();
    }
  }

  /**
   * ### Connect to ccu-dorm-for-grads.database.windows.net:1433.CDFG_SQL
   * 
   * @return true | PDOException
   * Return true if the connection is success, return PDOException if it failed.
   */
  private static function connect() {
    // PHP Data Objects(PDO) Sample Code:
    try {
      self::$db = new PDO("sqlsrv:server = tcp:ccu-dorm-for-grads.database.windows.net,1433; Database = CDFG_SQL", "dev", "{112-c-d-f-g}");
      self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $_SESSION["db_status"] = true;
    } catch (PDOException $e) {
      throw $e;
    }

    return true;
  }

  /**
   * ### Disconnect to the database.
   * Technically this is unnecessary, because it will auto disconnect.
   * 
   * @return void
   */
  public static function disconnect() {
    unset($_SESSION["db_status"]);

    self::$db = null;
  }

  /**
   * ### Fetch a row from the database by key.
   * 
   * @param string $table
   * Specify the table to fetch from.
   * 
   * @param string $col
   * Specify which column to be checked on.
   * 
   * @param string | int $key
   * Specify the key of the row to fetch from.
   * 
   * @return array | false
   * Returns the row you fetched as an array, return false if the row does not exist
   */
  public static function fetch_row($table, $col, $key) {
    self::get_connection();
    $query = "SELECT * FROM $table WHERE $col = '$key'";
    $stmt = self::$db->query($query);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    return $row;
  }
}
?>