<?php

   include '../../dbconn.php';

   if(isset($_POST['chatter'])){
       
      $logined_user = (int)$_SESSION['uid'];
      $chatter = (int)$_POST['chatter'];
      $message = $_POST['message'];

      $sql = "INSERT INTO chats(from_user,to_user,message) VALUES('$logined_user','$chatter','$message')";
      mysqli_query($conn,$sql);

   }


    

   





