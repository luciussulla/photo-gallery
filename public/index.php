<?php 
  require_once("../includes/database.php"); 
  require_once("../includes/user.php"); 

  if(isset($database)) {echo "true"; } else { echo "false"; }
  echo "\n its working"; 

  $sql = "INSERT INTO users ("; 
  $sql .= "username, password, first_name, last_name"; 
  $sql .= ") VALUES ("; 
  $sql .= "'kskoglund', 'secretpwd', 'Kevin', 'Skoglund'"; 
  $sql .= ")"; 

  $result = $database->query($sql); 

  // query number 2 
  $sql = "SELECT * FROM users "; 
  $sql .= "WHERE id=1"; 

  $result = $database->query($sql); 
  $user = $database->fetch_array($result); 
  echo $user["username"]; 
  // query number 3 
  echo "<br/>"; 

  $user = User::find_by_id(1); 
  echo $user["username"]; 

  $user_set = User::find_all(); 
  while($user = $database->fetch_array($user_set)) {
    echo "User: " . $user["username"] . "<br/>"; 
  }

  

?>