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
    $path = "../includes/{$class_name}.php"; 
    if(file_exists($path)) {
      require_once($path); 
    } else {
      die("This file path: {$path} could not be found."); 
    }
  });

  

?>

