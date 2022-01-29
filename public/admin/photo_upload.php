<?php 
  require_once("../../includes/initialize.php"); 
  // if(!$session->is_logged_in()) {redirect_to("login.php"); }
  // log_action('action', 'message'); 
  $max_file_size = 40000000; // 40 MB
  // $message = ""; // in case we are not doing POST operation;
  
  if(isset($_POST['submit'])) {
    $photo = new Photograph(); 
    $photo->caption = $_POST['caption']; 
    $photo->attach_file($_FILES['file_upload']);
    if($photo->save()) {
      $session->message("File saved successfully"); 
      redirect_to('show_photo.php'); 
    } else {
      // failure
      $message = join("<br/>", $photo->errors); 
    }
  }
?>

<?php include_layout_template("admin_header.php") ?>
  <div class="container.php">
  <?php echo output_message($message);?>
  <form action="photo_upload.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_file_size ?>" />
    <p><input type="file" name="file_upload" /></p>
    <p>Caption: <input type="text" name="caption" /></p>
    <input type="submit" name="submit" value="Upload"/>
  </form>

<?php include_layout_template("admin_footer.php") ?>