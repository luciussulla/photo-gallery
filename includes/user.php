<?php require_once(LIB_PATH.DS.'database.php'); // will get skipped 
// if loaded already
// Once we're ready its possibl to 
// class User extends DatabaseObject 

class User extends DatabaseObject { 
  protected static $table_name = 'users';  
  protected static $db_fields = array('id', 'username', 'first_name', 'last_name', 'password'); 
  // all of the attributes below that have db entry will be recoded and written to a new assoc array; 
  public $id; 
  public $username; 
  public $password; 
  public $first_name; 
  public $last_name; 

  // Unique user model methods 
  static public function authenticate($username, $password) {
    global $database; 
    $username = $database->escape_value($username); 
    $password = $database->escape_value($password); 

    $sql  = "SELECT * FROM users "; 
    $sql .= "WHERE username = '{$username}' "; 
    $sql .= "AND password   = '{$password}' "; 
    $sql .= "LIMIT 1"; 

    $result_array = self::find_by_sql($sql); 
    return !empty($result_array) ? array_shift($result_array) : false; 
  }
 
  public function full_name() {
    if(isset($this->first_name) && isset($this->last_name)) {
      return $this->first_name . " " . $this->last_name; 
    } else {
      return ""; 
    }
  }

  // protected function attributes() {
  //   return get_object_vars($this); 
  // }

// Universal methods
/*
  public static function find_all() {
    // global $database; 
    // $result_set = $database->query("SELECT * FROM users"); 
    $sql = "SELECT * FROM ".self::$table_name; 
    $result_set = self::find_by_sql($sql); 
    return $result_set; 
  }

  public static function find_by_id($id=0) {
    global $database; 
    // $result_set = $database->query("SELECT * FROM users WHERE id={$id}"); 
    $sql = "SELECT * FROM " . self::$table_name . " WHERE id={$id}"; 
    $result_array = self::find_by_sql($sql); 
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
    $object = new self; 
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

  public function save() {
    return isset($this->id) ? $this->update() :  $this->create(); 
  }

  public function create(){
    global $database; 
    $username   =  $database->escape_value($this->username); 
    $first_name =  $database->escape_value($this->first_name); 
    $last_name  =  $database->escape_value($this->last_name); 
    $password   =  $database->escape_value($this->password); 

    $sql =  "INSERT INTO ".self::$table_name." ("; 
    $sql .= "username, first_name, last_name, password";
    $sql .= ") VALUES ("; 
    $sql .= "'{$username}', '{$first_name}', '{$last_name}', '{$password}'"; 
    $sql .= ")"; 

    if($database->query($sql)) {
      $this->id = $database->insert_id(); 
      return true; 
    } else {
      return false; 
    }
  }

  public function update() {
    global $database; 
    $sql  = "UPDATE ".self::$table_name."  SET ";
    $sql .= "username='"   . $database->escape_value($this->username)   . "', "; 
    $sql .= "first_name='" . $database->escape_value($this->first_name) . "', "; 
    $sql .= "last_name='"  . $database->escape_value($this->last_name)  . "', "; 
    $sql .= "password='"   . $database->escape_value($this->password)   . "'"; 
    $sql .= " WHERE id="  . $database->escape_value($this->id); 

    $database->query($sql); 
    return ($database->affected_rows()==1) ? true : false; 
  }

  public function delete() {
    global $database; 
    $sql  = "DELETE FROM ".self::$table_name."  "; 
    $sql .= "WHERE id=" . $database->escape_value($this->id); 
    $sql .= " LIMIT 1"; 
    $database->query($sql); 
    return ($database->affected_rows()==1) ? "true" : "false"; 
  }
  */
}
?>