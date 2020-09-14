<?php

  include '../dbconn.php';

  if(isset($_POST['logout'])){
      session_unset();
      session_destroy();
      $logout = true;
  }

  if(isset($_POST['return'])){
     $_SESSION['leave']= true;
  }


?>
