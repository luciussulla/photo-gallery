<?php require_once('database.php'); // will get skipped 
// if loaded already

class User {

  public static function find_all() {
    // global $database; 
    // $result_set = $database->query("SELECT * FROM users"); 
    $sql = "SELECT * FROM users"; 
    $result_set = self::find_by_sql($sql); 
    return $result_set; 
  }

  public static function find_by_id($id=0) {
    global $database; 
    // $result_set = $database->query("SELECT * FROM users WHERE id={$id}"); 
    $sql = "SELECT * FROM users WHERE id={$id}"; 
    $found = self::find_by_sql($sql); 
    $found = $database->fetch_array($found); 
    return $found; 
  }

  public static function find_by_sql($sql="") {
    global $database; 
    $result_set = $database->query($sql); 
    return $result_set; 
  }

  
}

?>