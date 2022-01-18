<?php 

require_once(LIB_PATH.DS.'database.php'); 

class DatabaseObject {


  public static function find_all() {
    // global $database; 
    // $result_set = $database->query("SELECT * FROM users"); 
    $sql = "SELECT * FROM users"; 
    $result_set = static::find_by_sql($sql); 
    return $result_set; 
  }

  public static function find_by_id($id=0) {
    global $database; 
    // $result_set = $database->query("SELECT * FROM users WHERE id={$id}"); 
    $sql = "SELECT * FROM users WHERE id={$id}"; 
    $result_array = static::find_by_sql($sql); 
    $user_obj = !empty($result_array) ? array_shift($result_array) : false; 
    return $user_obj; 
    // we return false because later we can say "if we got smthg back" do this ...
  }

  public static function find_by_sql($sql="") {
    global $database; 
    $result_set = $database->query($sql); 
    $object_array = array(); 
    while($row = $database->fetch_array($result_set)) {
      // mysqli_fetch_array returns either [{...}, {...}] or [{...}] depending if you get all users or just one user
      $object_array[] = self::instantiate($row); 
    }
    // returning an array of instantated objects
    return $object_array; 
  }

  public static function instantiate($record) {
    $class_name = get_called_class(); 
    $object  = new $class_name; 
    // $object->id =         $record["id"]; 
    // $object->username =   "Jack"; 
    // $object->password =   $record["password"]; 
    // $object->first_name = $record["first_name"]; 
    // $object->last_name =  $record["last_name"];
    foreach($record as $attribute=>$value) {
      if($object->has_attribute($attribute)) {
        $object->$attribute = $value; 
      }
    }
    return $object; 
  }
  
    private function has_attribute($attribute) {
      $object_vars = get_object_vars($this); 
      return array_key_exists($attribute, $object_vars); 
    }   
}

?> 