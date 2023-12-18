<?php
class DB {
  protected static $db = null;

  /**
   * ### Format the key value pairs into columns array and values array, both are array of strings.
   * 
   * @param array $arr
   * Associative array of columns and their corresponding values.
   * 
   * @return array
   * Returns an array contains an array of columns and an array of values.
   */
  private static function array2query($arr) {
    $values = [];
    $cols = [];
    foreach ($arr as $key => $value) {
      // add quotation to string values
      if (is_string($value)) {
        // may not work with "''" , try "[]" locally
        $values[] = "'" . $value . "'";
      } else {
        $values[] = $value;
      }
      $cols[] = $key;
    }

    return [$cols, $values];
  }

  /**
   * ### Check the connection to the database.
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
   * @return true|PDOException
   * Return true if the connection is success, return PDOException if it failed.
   */
  private static function connect() {
    // PHP Data Objects(PDO) Sample Code:
    try {
      self::$db = new PDO("sqlsrv:server = tcp:ccu-dorm-for-grads.database.windows.net,1433; Database = CDFG_SQL", "dev", "{112-c-d-f-g}");
      self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
   * @param string|int $key
   * Specify the key of the row to fetch from.
   * 
   * @return array|false
   * Returns the row you fetched as an array, return false if the row does not exist
   */
  public static function fetch_row($table, $col, $key) {
    self::get_connection();
    $query = "SELECT * FROM $table WHERE $col = '$key'";
    $stmt = self::$db->query($query);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    return $row;
  }

  /**
   * ### Fetch a row from the database by 2 keys.
   * 
   * @param string $table
   * Specify the table to fetch from.
   * 
   * @param string $col1, $col2
   * Specify which two columns to be checked on.
   * 
   * @param string|int $key1, $key2
   * Specify the respective key of the two rows to fetch from.
   * 
   * @return array|false
   * Returns the row you fetched as an array, return false if the row does not exist
   */
  public static function advanced_fetch_row($table, $col1, $key1, $col2, $key2) {
    self::get_connection();
    $query = "SELECT * FROM $table WHERE $col1 = '$key1' AND $col2 = '$key2'";
    $stmt = self::$db->query($query);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    return $row;
  }

  /**
   * ### Fetch all matching rows from the database by key.
   * 
   * @param string $table
   * Specify the table to fetch from.
   * 
   * @param string $col
   * Specify which column to be checked on.
   * 
   * @param string|int $key
   * Specify the key of the row to fetch from.
   * 
   * @param int $limit
   * Specify the number of rows you disire, defalt to 1000.
   * 
   * @return array|false
   * Returns the rows you fetched as an array, return false if the row does not exist
   */
  public static function fetchAll_rows($table, $col, $key, $limit = 1000) {
    self::get_connection();
    $query = "SELECT TOP $limit * FROM $table WHERE $col = '$key'";
    $stmt = self::$db->query($query);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $rows;
  }

  /**
   * ### Fetch all data from the table.
   * 
   * @param string $table
   * Specify the table to fetch from.
   * 
   * @return array|false
   * Returns the table you fetched as an array, return false if the table doesn't exist.
   */
  public static function fetch_table($table)
  {
    self::get_connection();
    $query = "SELECT * FROM $table";
    $stmt = self::$db->query($query);
    $table = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $table;
  }

  /**
   * ### Create a row of data in the database.
   * 
   * @param string $table
   * Specify the table to add data to.
   * 
   * @param array $values
   * Specify the key value pairs to add to the table.
   * 
   * @return bool
   * If data added successfully, return true, if not, return false.
   */
  public static function create_row($table, $values) {
    // data formatting
    [$cols, $data] = self::array2query($values);
    $colstr = implode(", ", $cols);
    $datastr = implode(", ", $data);

    self::get_connection();
    $query = "INSERT INTO $table ($colstr) VALUES($datastr);";
    $stmt = self::$db->query($query);

    return $stmt ? true : false;
  }

  /**
   * ### Update the data of the specified row.
   * 
   * @param string $table
   * Specify the table to update data from.
   * 
   * @param array $cond
   * Specify which row to update.
   * 
   * @param array $values
   * Specify the key value pairs to update.
   * 
   * @return bool
   * If data updated successfully, return true, if not, return false.
   */
  public static function update_row($table, $cond, $values) {
    // data formatting
    [$cols, $data] = self::array2query($values);
    [$condkey, $condvalue] = self::array2query($cond);

    // pairing
    $pairs = [];
    foreach (array_combine($cols, $data) as $key => $value) {
      $pairs[] = "$key = $value";
    }

    // concat paired strings
    $update_str = implode(", ", $pairs);

    self::get_connection();
    $query = "UPDATE $table SET $update_str WHERE $condkey[0] = $condvalue[0];";
    $stmt = self::$db->query($query);

    return $stmt ? true : false;
  }

  /**
   * ### Delete the data of the specified row.
   * 
   * @param string $table
   * Specify the table to delete data from.
   * 
   * @param array $cond
   * Specify which row to delete.
   * 
   * @return bool
   * If data deleted successfully, return true, if not, return false.
   */
  public static function delete_row($table, $cond) {
    // data formatting
    [$condkey, $condvalue] = self::array2query($cond);

    self::get_connection();
    $query = "DELETE FROM $table WHERE $condkey[0] = $condvalue[0];";
    $stmt = self::$db->query($query);

    return $stmt ? true : false;
  }
}
