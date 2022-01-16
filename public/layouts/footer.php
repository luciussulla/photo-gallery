</div><!-- end of container -->
<div id="footer">
  <?php echo date("Y", time()); ?> Copyright
</div>
</body>
</html>
<?php if(isset($database)) {$database->close_connection; } ?>
