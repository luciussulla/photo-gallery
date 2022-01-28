<?php 
  require_once("../../includes/initialize.php"); 
  // if(!$session->is_logged_in()) {redirect_to("login.php"); }
  // log_action('action', 'message'); 
?>

<?php include_layout_template("admin_header.php") ?>
  <div class="container.php">
    <?php 
      // CREATE 
      $user = new User(); 
      $user->username   = "username2"; 
      $user->first_name = "OJOJ"; 
      $user->last_name  = "DSLKSD"; 
      $user->password   = "secretpwd"; 
      $user->create(); 
      
      // UPDATE
      // $user = User::find_by_id(20); 
      // $user->last_name = "gundum2"; 
      // var_dump($user);  
      // $user->save(); 

      // // DELETE 
      // $user = User::find_by_id(20); 
      // $user->delete(); 
      
    ?>
<?php include_layout_template("admin_footer.php") ?>