<?php 
  require_once("../../includes/initialize.php"); 
  if(!$session->is_logged_in()) {redirect_to("login.php"); }
?>
<?php $all_photos = PHOTOGRAPH::find_all(); ?> 
<?php include_layout_template("admin_header.php"); ?>
<?php echo output_message($message);?>

<table cellspacing="0">
 <thead>
   <th>id</th>
   <th>filename</th>
   <th>type</th>
   <th>size</th>
   <th>caption</th> 
   <th>Comments</th>  
   <th>&nbsp;</th>  
  </thead>                                                                                                                             
  <tbody>
    <?php foreach($all_photos as $photo): ?>
      <?php echo "<tr>"; ?>
      <td><img src="../<?php echo $photo->file_path(); ?>" width="100"/></td>
      <td><?php echo $photo->filename;  ?> </td>
      <td><?php echo $photo->type; ?>     </td>
      <td><?php echo $photo->size; ?>     </td>
      <td><?php echo $photo->caption; ?>  </td>
      <td>
        <a href="comments.php?id=<?php echo $photo->id; ?>">
          <?php echo count($photo->comments());?> 
        </a>
      </td>
      <td><a href="delete_photo.php?id=<?php echo $photo->id; ?>">Delete</a></td>
      <?php echo "</tr>"; ?>
    <?php endforeach; ?>
  </tbody>
</table>

<p class="show">Showed Photos</p>
<?php include_layout_template("admin_footer.php") ?>