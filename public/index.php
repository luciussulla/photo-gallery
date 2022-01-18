<?php 
  require_once("../includes/initialize.php"); 
?>

<?php include_layout_template("header.php") ?>

<p>User</p>
<?php 
$user = User::find_by_id(1); 
echo "<p>".$user->username."</p>"

?>


<?php include_layout_template("footer.php") ?>