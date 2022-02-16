<?php 
  require_once("../includes/initialize.php"); 
  // 1. current page number ($current_page)
  $page = !empty($_GET["page"]) ? (int)$_GET["page"] : 1; 
  // 2. records per page ($per_page)
  $per_page = 3; 
  // 3. total records count ($total_count)
  $total_count = Photograph::count_all(); 

  // find paginated number of photos
  // $photos = PHOTOGRAPH::find_all();
  $pagination = new Pagination($page, $per_page, $total_count); 
  // finding records only for this particular page

  $sql = "SELECT * FROM photographs "; 
  $sql .= "LIMIT {$per_page} ";
  $sql .= "OFFSET {$pagination->offset()}";  
  $photos = Photograph::find_by_sql($sql); 
?>

<?php include_layout_template("header.php") ?>

<?php foreach($photos as $photo): ?>
<div style="float: left; margin-left:20px;">
  <img src="<?php echo $photo->file_path(); ?>" width="150">
  <p><?php $photo->caption ?></p>
</div>
<?php endforeach; ?>

<div id="pagination" style="clear: both;" >
  <?php 
    if($pagination->total_pages() > 1 ) { // fist is if there is any need to paginate

      if($pagination->has_previous_page()) {
        echo "<a href=\"index.php?page="; 
        echo $pagination->previous_page(); 
        echo "\">&laquo; Previous</a>";
      }

      for($i=1; $i <= $pagination->total_pages(); $i++) {
        if($i==$page) {
          echo " <span class=\"selected\">{$i}</span> "; 
        } else {
          echo " <a href=\"index.php?page={$i}\">{$i}</a> "; 
        }
      }

      if($pagination->has_next_page()) {
        echo " <a href=\"index.php?page=";
        echo $pagination->next_page(); 
        echo "\">Next &raquo;</a> ";  
      }

    }
  ?>  
</div>

<?php include_layout_template("admin_footer.php") ?>