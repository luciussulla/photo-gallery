<?php 
  require_once("../includes/initialize.php"); 
?>
<?php include_layout_template("header.php") ?>
<?php $all = PHOTOGRAPH::find_all(); ?>

<?php foreach($all as $photo): ?>
<div style="float: left; margin-left:20px;">
  <img src="<?php echo $photo->file_path(); ?>" width="150">
  <p><?php $photo->caption ?></p>
</div>
<?php endforeach; ?>
<?php include_layout_template("admin_footer.php") ?>