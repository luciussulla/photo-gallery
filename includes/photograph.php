<?php
  require_once(LIB_PATH.DS.'database_object.php');

  class Photograph extends DatabaseObject {
    protected static $table_name="photograph"; 
    protected static $db_fields = array('id', 'filename', 'type', 'size', 'caption'); 
    // attributes
    public $id; 
    public $filename; 
    public $type;
    public $size;
    public $caption; 
    // helper variables
    private   $temp_path; 
    protected $upload_dir = "images"; // im not sure about this path
    public    $errors=array(); 

    // pass in $_FILE(['uploaded_file']) as an argument 
    public function attach_file($file) {
      // error checking on form params 
      if(!$file || empty($file) || !is_array($file)) {
        // nothing uploaded or wrong argument used.
        $this->errors[] = "No file was uploaded."; 
        return false; 
      } elseif($file['error'] !=0 ) {
        // error 
        $this->errors[] = $file['error']; 
        return false; 
      } else {
        // set obj attributes to the form params   
        $this->temp_path = $file['tmp_name']; 
        $this->filename  = basename($file['name']); 
        $this->type      = $file['type']; 
        $this->size      = $file['size']; 
        // not saving anything yet to the db
        return true; 
      }
    }

     


  }
?>