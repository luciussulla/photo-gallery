
<?php
  $file = 'file1.php'; 
  // if($handle = fopen($file, 'r')) {
  //   $content = fread($handle, 10); //.. each character is one byte
  //   fclose($handle); 
  // } else {
  //   echo "not read"; 
  // }

  // echo nl2br($content); 
  // echo "<br/>"; 

  // // READING THE ENTIRE FILE 

  // if($handle = fopen($file, 'r')) {
  //   $content = fread($handle, filesize($file)); 
  //   fclose($handle); 
  // }
  // echo "<hr/>"; 
  // echo nl2br($content); 
 
  // // REading shortcut 
  // $content = file_get_contents($file);
  // echo $content; 
  // echo "<hr/>";  

  // // Incremental reading 
  // $content =""; 
  // if($handle = fopen($file, 'r')) {
  //   while(!feof($handle)) {
  //     $content .= fgets($handle); 
  //   }
  //   fclose($handle); 
  // }
  // echo $content; 
  // echo "<hr/>";  
  // // Dates 

  // echo strftime('%d/%m/%Y %H:%M', filemtime($file)) . "<br/>"; 
  // // FILE INFO 

  // $path_parts = pathinfo(__FILE__); 
  // echo $path_parts['dirname'] . '<br/>'; 
  // echo $path_parts['basename'] . '<br/>'; 
  // echo $path_parts['filename']  . '<br/>';
  // echo $path_parts['extension'] . '<br/>'; 

  // $result = strftime('%d/%m/%Y %H:%M', fileatime($file)); 
  // echo $result
  // filemtime($file)
  // fileatime($file)
  // filectime($file)
  
  // echo dirname($file); 
  echo "<br/>";
  // echo is_dir(); 
  // echo getcwd(); 
  // mkdir('shht.txt', 0777);
  // chmod('shht.txt', 0777); 
  // mkdir('new3/new2/somenew', 0777, true); 
  rmdir('new'); 
  
?>

