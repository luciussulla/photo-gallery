<?php 
  require_once("../../includes/initialize.php"); 
  // require_once("../../includes/session.php");
  // require_once("../../includes/database.php");
  // require_once("../../includes/user.php");
?>

<?php 
  if($session->is_logged_in()) {
    redirect_to("index.php"); 
  }
?>

<?php 
if(isset($_POST["submit"])){
  $username = trim($_POST["username"]); 
  $password = trim($_POST["password"]);
  // check in db if user exists 
  $found_user = User::authenticate($username, $password); 

  if($found_user) {
    $session->log_in($found_user); 
    log_message("Login", $username); 
    redirect_to('index.php'); 
  } else {
    $message = "User/password combination incorrect."; 
  }

} else { // form has not been submitted
  $username = ""; 
  $password = ""; 
}
?>
<!-- HTML --> 

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photo Gallery</title>
    <link href="../stylesheets/main.css" rel="stylesheet" />
  </head>

  <body>
    <div id="header">
      <h1>Photo Gallery</h1>
    </div>
    <div id="main" class="container">
      <h2>Staff Login</h2>
      <?php 
        global $message; 
        echo output_message($message); 
      ?>
      
      <form action="login.php" method="post">

      <div class="form-control">
        <label name="username">Username</label>
        <input type="text" name="username" value="<?php echo htmlentities($username) ?>" />
      </div>

      <div class="form-control">
        <label name="password">Password</label>
        <input type="password" name="password" value="<?php echo htmlentities($password) ?>" />
      </div>

      <input class="button form-button" name="submit" type="submit" value="Submit" />

      </form>
    </div>
    <div id="footer">Copyright <?php echo date("Y", time()) ?> Jakub S</div>
  </body>
</html>