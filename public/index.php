<?php 
  require_once("../includes/database.php"); 
  // require_once("../includes/user.php"); 
  require_once("../includes/functions.php"); 

  if(isset($database)) {echo "true"; } else { echo "false"; }
  echo "\n its working"; 

  $user = User::find_by_id(1); 
  echo $user->full_name(); 
  echo "<hr/>"; 
  $users = User::find_all(); 
  var_dump($users);
  foreach($users as $user) {
    echo "User: " . $user->username . "<br/>"; 
    echo "first Name " . $user->first_name . "<br/>"; 
  } 

?>