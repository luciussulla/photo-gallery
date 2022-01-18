<?php
  $dir = '.'; 

  if(is_dir($dir)) {
    // opening the dir make sure you have permission to open it
    if($dir_handle = opendir($dir)) {
      // read the file
      while($filename = readdir($dir_handle)) {
        echo "Filename: {$filename}" . " <br/>"; 
      }
    }
    // closing the dir
    closedir($dir_handle); 
  }

  echo "<hr/>"; 

  if(is_dir($dir)) {
    $dir_array = scandir($dir); 
    foreach($dir_array as $file) {
      if(stripos($file, '.')>0) {
        echo "filename: {$file}<br/>"; 
      }
    }
  }

?>