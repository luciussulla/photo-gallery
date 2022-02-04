<?php 
  require_once("../../includes/initialize.php"); 
  if(!$session->is_logged_in()) {redirect_to("login.php"); }
  log_action("visiting delete_photo", "Visit delete_photo with id of: ".$_GET["id"]); 
?>

<?php 
  if(!isset($_GET["id"])) {
    $session->message("No id was provided for photo deletion"); 
    redirect_to("index.php"); 
  }

  $comment = Comment::find_by_id($_GET["id"]); 
  if($comment && $comment->delete()) {
      $session->message("comment was deleted"); 
      redirect_to("comments.php?id={$comment->photograph_id}");  // db entry for photo is gone but in memory $comment is still there
  } else {
    $session->mesage("No comment was found"); 
    redirect_to("show_photo.php"); 
  }
?>

<?php if(isset($database)) {$database->close_connection; } ?>