<?php

  $http_host = $_SERVER['HTTP_HOST'];
  $user_name = "root";
  $user_pwd = "";
  $db_name = "site1";

  $conn = mysqli_connect($http_host,$user_name,$user_pwd,$db_name);
  
  session_start();

?>