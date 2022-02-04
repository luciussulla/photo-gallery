<?php 
require_once(LIB_PATH.DS.'database.php'); 

class DatabaseObject {

  public static function find_all() {
    // global $database; 
    // $result_set = $database->query("SELECT * FROM users"); 
    $sql = "SELECT * FROM ".static::$table_name; 
    $result_set = static::find_by_sql($sql); 
    return $result_set; 
  }

  public static function find_by_id($id=0) {
    global $database; 
    // $result_set = $database->query("SELECT * FROM users WHERE id={$id}"); 
    $sql = "SELECT * FROM ".static::$table_name." WHERE id={$id}"; 
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
      $object_array[] = static::instantiate($row); 
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

  protected function attributes() {
    // return get_object_vars($this); 
    // check if the attribute exists
    $attributes = array(); 
    foreach(static::$db_fields as $field) {
      if(property_exists($this, $field)) {
        $attributes[$field] = $this->$field; 
      }
    }
    // create an ampty array
    // add the existing attribute key and the value from the instance object
    return $attributes; 
  }

  protected function sanitized_attributes() {
    global $database; 
    $sanitized_attributes = array(); 
    foreach($this->attributes() as $key=>$value) {
      $sanitized_attributes[$key] =  $database->escape_value($value); 
    }
    return $sanitized_attributes; 
  }

  public function create(){
    global $database; 
    $sanitized_attributes = $this->sanitized_attributes(); 
    // $username   =  $database->escape_value($this->username); 
    // $first_name =  $database->escape_value($this->first_name); 
    // $last_name  =  $database->escape_value($this->last_name); 
    // $password   =  $database->escape_value($this->password); 

    // $sql =  "INSERT INTO ".static::$table_name." ("; 
    // $sql .= "username, first_name, last_name, password";
    // $sql .= ") VALUES ("; 
    // $sql .= "'{$username}', '{$first_name}', '{$last_name}', '{$password}'"; 
    // $sql .= ")"; 

    $sql  = "INSERT INTO ".static::$table_name." ("; 
    $sql .= join(", ", array_keys($sanitized_attributes)); 
    $sql .= ") VALUES ('"; 
    $sql .= join("', '", array_values($sanitized_attributes)); 
    $sql .= "')"; 

    if($database->query($sql)) {
      $this->id = $database->insert_id(); 
      return true; 
    } else {
      return false; 
    }
  }

  public function update() {
    global $database; 
    $attributes = $this->sanitize_attributes(); 
    $attribute_pairs = array(); 
    foreach($attributes as $key=>$value) {
      $attribute_pairs[] = "{$key}='{$value}'"; 
    }

    $sql  = "UPDATE ".static::$table_name."  SET ";
    $sql .= join(', ', $attribute_pairs); 
    $sql .= " WHERE id="   . $database->escape_value($this->id); 

    // $sql  = "UPDATE ".static::$table_name."  SET ";
    // $sql .= "username='"   . $database->escape_value($this->username)   . "', "; 
    // $sql .= "first_name='" . $database->escape_value($this->first_name) . "', "; 
    // $sql .= "last_name='"  . $database->escape_value($this->last_name)  . "', "; 
    // $sql .= "password='"   . $database->escape_value($this->password)   . "'"; 
    // $sql .= " WHERE id="  . $database->escape_value($this->id); 

    $database->query($sql); 
    return ($database->affected_rows()==1) ? true : false; 
  }

  public function delete() {
    global $database; 
    $sql  = "DELETE FROM ".static::$table_name."  "; 
    $sql .= "WHERE id=" . $database->escape_value($this->id); 
    $sql .= " LIMIT 1"; 
    $database->query($sql); 
    return ($database->affected_rows()==1) ? "true" : "false"; 
  }
}

?> 