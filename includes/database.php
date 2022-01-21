<?php 
  require_once(LIB_PATH.DS."config.php"); 

  class MySQLDatabase {
    private $connection; 
    public $last_query; 

    function __construct() {
      $this->open_connection(); 
    }

    public function open_connection() {
      // $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname); 
      $this->connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME); 
      if(!$this->connection) {
        die("Database connection failed: " . mysqli_connect_error());
      } 
    }

    public function close_connection() {
      if(isset($this->connection)) {
        mysqli_close($this->connection); 
        unset($this->connection); 
      }
    }
    
    public function escape_value($string) {
      $escaped_value = mysqli_real_escape_string($this->connection, $string); 
      return $escaped_value; 
    }

    public function query($query) {
      $this->last_query = $query; 
      $result = mysqli_query($this->connection, $query); 
      if(!$result) {
        die("Db query failed: " . mysqli_error($this->connection)); 
      }
      return $result;
    }

    public function fetch_array($result) {
      // unpacking the $result set into an object
      return mysqli_fetch_array($result); 
    }

    public function confirm_query($result) {
      if(!$result) {
        $output = "Db query failed: " .  mysqli_error() 
        . "Query was: " . $this->last_query; 
        die($output); 
      }
    }

    public function affected_rows() {
      return mysqli_affected_rows($this->connection); 
    }

    public function insert_id() {
      return mysqli_insert_id($this->connection); 
    }
  }

  $database = new MySQLDatabase(); 
  // $database->close_connection();
?>