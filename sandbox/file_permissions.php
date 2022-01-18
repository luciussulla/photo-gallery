<?php 
"abc"; 
// echo fileowner('file_permissions.php'); 
// $user_id = fileowner('file_permissions.php'); 
// $owner_array = posix_getpwuid($user_id);
// echo $owner_array['name'];   

// echo fileperms('file_permissions.php'); 

// echo substr(decoct(fileperms('file_permissions.php')), 2);
// echo "<br/>"; 
// chmod('file_permissions.php', 0444); 
// echo substr(decoct(fileperms('file_permissions.php')), 2);

// echo is_readable('file_permissions.php') ? 'yes' : 'no'; 
// echo is_writable('file_permissions.php') ? 'yes' : 'no'; 

// if($file_handle = fopen('file1.php', 'w')) {
//   echo "file created"; 
//   fwrite($file_handle, "abc"); 
//   fwrite($file_handle, "123"); 
//   fclose($file_handle); 
// } else {
//   echo "could not open"; 
// }

// $file = 'file_changer.php'; 
// $content = '124\n1234'; 
// if($size = file_put_contents($file, $content)) {
//   echo "File {$size} was created"; 
// } else {
//   echo "no created"; 
// }

// DELETING FILES 

// unlink('file_delete.php')
// POINTER 
// $file = 'file1.php'; 
// if($handle = fopen($file, 'w')) {
//   fwrite($handle, 'abcs'); 
//   $pos = ftell($handle); 
//   echo $pos; 

// } else {
//   echo "no writng"; 
// }



?>    