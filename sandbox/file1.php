<?php 
  echo "<pre>"; 
  print_r($_FILES  ["file_upload"]); 
  echo "</pre>";
  echo "<hr/>"; 
?>

<?php 
 if(isset($_POST["submit"])) {
    $tmp_file = $_FILES['file_upload']['tmp_name']; 
    $file = $_FILES["file_upload"]["name"]; 
    $target_file = basename($file); 
    $upload_dir = "uploads"; 
    // the function looks for it in the temp folder knowing the temp name; 
    if(move_uploaded_file($tmp_file, $upload_dir . "/". $target_file)) {
      $message = "File uploaded successfully."; 
    } else {
      echo $_FILES["file_upload"]['error']; 
      $message = $_FILES["file_upload"]['error']; 
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <?php if(!empty($message)) { 
    echo "<p>{$message}</p>";
  } ?>
  <form action="file1.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="MAX_FILE_SIZE" value="4000000" />
    <input type="file" name="file_upload" />
    <input type="submit" name="submit" value="Upload"/>
  </form>
</body>
</html>