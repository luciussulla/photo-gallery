<?php 
  require_once("../../includes/initialize.php"); 
  // if(!$session->is_logged_in()) {redirect_to("login.php"); }
  // log_action('action', 'message'); 
?>

<?php include_layout_template("admin_header.php") ?>

  <?php 
    $all_photos = PHOTOGRAPH::find_all(); 
  ?> 
<table cellspacing="0">
 <thead>
   <th>id</th>
   <th>filename</th>
   <th>type</th>
   <th>size</th>
   <th>caption</th>
   <tbody>
   <?php  foreach($all_photos as $photo) {?>
    <?php echo "<tr>" ?>
    <td><?php echo $photo->id ?>      </td>
    <td><?php echo $photo->filename?> </td>
    <td><?php echo $photo->type?>     </td>
    <td><?php echo $photo->size?>     </td>
    <td><?php echo $photo->caption?>  </td>
    <?php echo "</tr>" ?>
  <?php } ?>
  </tbody>
</thead>
</table>

<p class="show">Showed Photos</p>

<?php include_layout_template("admin_footer.php") ?>