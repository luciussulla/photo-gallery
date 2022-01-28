<?php

  function redirect_to($location = null) {
    if(!$location==null) {
      header("Location: ". $location);
      exit;  
    }
  }

  function output_message($msg = "") {
    if(!empty($msg)) {  
      $output = "<p class=\"message\">{$msg}</p>"; 
    } else {
      $output = ""; 
    }
    return $output; 
  }
  
  spl_autoload_register(function ($class_name) {
    $class_name = strtolower($class_name); 
    $path = LIB_PATH.DS."{$class_name}.php"; 
    if(file_exists($path)) {
      require_once($path); 
    } else {
      die("This file path: {$path} could not be found."); 
    }
  });

  function include_layout_template($template="") {
    return include(SITE_ROOT.DS.'public'.DS.'layouts'.DS.$template); 
  }

  // LOG FILE 

  function write_to_log($action, $message) {

  }

  function log_action($action, $message="") {
    // do we need to know the route from where the function was called to go to the log folder? 
    $logfile_route = SITE_ROOT.DS.'logs'.DS.'logfile.txt'; 
    
    if (file_exists($logfile_route)) {
      if(is_readable($logfile_route)) {
        // echo "file exists"; 
        $timestamp = strftime("%Y/%m/%d %H:%M:%S"); 
        $log = "{$timestamp} | {$action} |  {$message}";  
        if($file_handle = fopen($logfile_route, 'a')) {
          // move the pointer to the end of file
          // fseek($file_handle, 0, SEEK_END); 
          // $pos = ftell($file_handle);
          fwrite($file_handle, $log); 
          fwrite($file_handle, "\n"); 
          fclose($file_handle);   
        }
      }
    } else {
      // check if I have permission to the folder - but how? 
      // find absolute location for the file
      if($file_handle = fopen($logfile_route, 'w')) {
        echo "File created";
        // write to log file We could just recursively write to file
        fclose($file_handle); 
      }

    }
  }

  function list_dir_files($dir_path) {
    $files = scandir($dir_path); 
    // var_dump($files); 
    return $files;
  }

  function generate_images_array($dir_path, $files) {
    $images_array = array(); 
    foreach($files as $key=>$value) {
      $file_path = $dir_path . DS . $value; 
      // echo $file_path . "<br/>"; 
      if(is_file($file_path)) {
        echo $file_path . "<br/>"; 
        array_push($images_array, $value); 
      }
    }
    return $images_array; 
  }
  
  function generate_img_html($images_array) {
    $html_array = array(); 
    foreach($images_array as $img_path) {
      $html  = "";
      $html .= "<img src=\"..\\images\\" . $img_path . "\">";
      $html_array[] = $html; 
      echo $html . "<br/>"; 
    }
    return $html_array; 
  }
?>