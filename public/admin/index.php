<?php 
  require_once("../../includes/functions.php"); 
  require_once("../../includes/session.php");
?>
<?php 
  if(!$session->is_logged_in()) {
    redirect_to("login.php"); 
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photo Gallery</title>
    <link href="../../stylesheets/main.css" ref="stylesheet" />
  </head>

  <body>
    <div id="header">
      <h1>Photo Gallery</h1>
    </div>
    <div id="main">
      <h2>Main</h2>
    </div>
    <div id="footer">Copyright <?php echo date("Y", time()) ?> Jakub S</div>
  </body>
</html>