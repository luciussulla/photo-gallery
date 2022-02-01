<?php 
  class Session {

      private $logged_in = false; 
      public $user_id; 
      public $message;   
      
      function __construct() {
        session_start(); 
        $this->check_message(); 
        $this->check_login();
      }

      function message($msg="") {
        // at the bottom of the file = $message variable is SET!!! 
        if(!empty($msg)) {
          // then this is the set 
          // the $this->message would not work
          $_SESSION["message"] = $msg; 
        } else {
          // then this is the get
          return $this->message; 
        }
      }

      function is_logged_in() {
        return $this->logged_in; 
      }

      private function check_login() {
        if(isset($_SESSION["user_id"])) {
          $this->user_id = $_SESSION["user_id"]; 
          $this->logged_in = true; 
        } else {
          unset($this->user_id); 
          $this->logged_in = false; 
        }
      }

      private function check_message() {
        // is there a msg in the session already? 
        if(isset($_SESSION["message"])) {
          $this->message = $_SESSION["message"]; 
          unset($_SESSION["message"]);
        } else {
          $this->message = "";
        }
      }

      public function log_in($user) {
        if($user) {
          $_SESSION["user_id"] = $user->id; 
          $this->user_id = $user->id; 
          $this->is_logged_in = true; 
        }
      }

      public function log_out() {
        unset($this->user_id); 
        unset($_SESSION["user_id"]); 
        $this->logged_in = false; 
      }
  }

  $session = new Session(); 
  $message = $session->message(); 

?>