<?php 
  require_once('../includes/initialize.php'); 
  if(!$session->is_logged_in()) {
    redirect_to("../public/admin/login.php");
  }
  // handle what happens if sb clicked the clear the file link
  $log_route = SITE_ROOT.DS."logs".DS."logfile.txt";
   
  if(isset($_GET["clear"])) {
      if($_GET['clear']==true) {
      file_put_contents($log_route, ""); 
      log_action("File cleared", "User: {$session->user_id}"); 
      redirect_to('logfile.php'); 
    }
  }
?>

<?php 
  include_layout_template("admin_header.php"); 
?>

<h2>Clear Log</h2>
<p><a href="../logs/logfile.php&clear=true">clear the log file</a></p>

<?php 


  if(file_exists($log_route) && is_readable($log_route)) {
    $output = ""; 
    if($file_handle = fopen($log_route, 'r')) {
      while(!feof($file_handle)) {
        $output .= "<p>".fgets($file_handle)."</p>";
      }
      fclose($file_handle); 
    }
  }
  echo "<div>" . $output . "</div>"; 
?>

<?php
  include_layout_template('footer.php'); 
?>