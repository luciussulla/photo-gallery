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
      $outpyt = ""; 
    }
    return $output; 
  }



?>