<?php 
  require_once("../includes/initialize.php"); 
  // 1. current page number ($current_page)
  $page = !empty($_GET["page"]) ? (int)$_GET["page"] : 1; 
  // 2. records per page ($per_page)
  $per_page = 1; 
  // 3. total records count ($total_count)
  $all = Photograph::count_all(); 
 

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