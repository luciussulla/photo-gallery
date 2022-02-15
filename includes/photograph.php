<?php
  require_once(LIB_PATH.DS.'database_object.php');

  class Photograph extends DatabaseObject {
    protected static $table_name="photographs"; 
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
        $this->errors[] = "No file was uploaded, or file is in wrong format."; 
        return false; 
      } elseif($file['error'] !=0 ) {
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

    public function save() {
      // this is called after attach file was first triggered
      // this overwrites the DatabaseObject's save
      // A new record wont have an id
      if(isset($this->id)) {
        // we just update the caption
        $this->update(); 
      } else {
        // check for errors
        // not saving if there are pre-existing errors
        if(!empty($this->errors)) {return false;}

        // make sure caption is not too long for DB
        if(strlen($this->caption) >= 255) {
          $this->errors[] = "This caption can only be 255 characters long."; 
          return false; 
        }

        // cant save without filename and temp location 
        if(empty($this->filename) || empty($this->temp_path)) {
          $this->errors[]  = "The file location was not available."; 
          return false; 
        }

        // determine the target path 
        $target_path = SITE_ROOT . DS . 'public' . DS . $this->upload_dir . DS . $this->filename; 

        // check the file does not exist already 
        if(file_exists($target_path)) {
          $this->errors[] = "The file {$this->filename} already exists.";
          return false; 
        }
        // try to move the file
        if(move_uploaded_file($this->temp_path, $target_path)) {
          // success
          if($this->create()) {
            // we are done with temp_path, the file isnt there anymore
            unset($this->temp_path); 
            return true; 
          }
           
        } else {
          // fail
          $this->errors[] = "The file upload failed, possibly due to incorrect permission on the upload folder."; 
          return false; 
        }

      }
    }

    function file_path() {
      return $this->upload_dir . DS . $this->filename; 
    }

    public function comments() {
      return Comment::find_comments_on($this->id); 
    }

    function destroy() {
      if($this->delete()) {
        // remove the file
        $target_path = SITE_ROOT.DS.'public'.DS.$this->file_path(); 
        return unlink($target_path) ? true : false; 
      } else {
        // delete failed 
        return false; 
      }
    }
 
  }
?>