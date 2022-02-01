<?php 
  require_once("../../includes/initialize.php"); 
  // if(!$session->is_logged_in()) {redirect_to("login.php"); }
  log_action("visiting delete_photo", "Visit delete_photo with id of: ".$_GET["id"]); 
?>

<?php echo output_message($message) ;?>
<?php 
  if(!isset($_GET["id"])) {
    $session->message("No id was provided for photo deletion"); 
    redirect_to("index.php"); 
  }
  $photo = PHOTOGRAPH::find_by_id($_GET["id"]); 
  if($photo && $photo->destroy()) {
      $session->message("Photo was deleted"); 
      redirect_to("show_photo.php"); 
  } else {
    $session->mesage("No photo was found"); 
    redirect_to("index.php"); 
  }
?>

<?php if(isset($database)) {$database->close_connection; } ?>