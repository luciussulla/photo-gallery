<?php 
  // This file should help other files import basic includes that can be see below. 
  // ALl of the below files will be properly imported to any file in the app
  //Director separator / or \ depending if windows or linux
  
  defined('DS')         ? null : define('DS'       , DIRECTORY_SEPARATOR); 
  // defined('SITE_ROOT')  ? null : define('SITE_ROOT', DS.'C'.DS.'xampp'.DS.'htdocs'.DS.'beyond'); 
  defined('SITE_ROOT')  ? null : define('SITE_ROOT', DS.'xampp'.DS.'htdocs'.DS.'beyond'); // WE start on disc C
  defined('LIB_PATH')   ? null : define('LIB_PATH' , SITE_ROOT.DS.'includes'); 

  // Config file load first
  require_once(LIB_PATH.DS."config.php"); 
  // Load basic functions
  require_once(LIB_PATH.DS."functions.php"); 
  // Load core objects
  require_once(LIB_PATH.DS."session.php");
  require_once(LIB_PATH.DS."database.php");
  require_once(LIB_PATH.DS."database_object.php");
  require_once(LIB_PATH.DS."pagination.php");
  // load database related classes
  require_once(LIB_PATH.DS."user.php");
  require_once(LIB_PATH.DS."photograph.php");

?>