<?php

   include '../../dbconn.php';

   if(isset( $_POST['group_id'] )){

       $group_id = (int)$_POST['group_id'];
       $user_id = (int)$_SESSION['uid'];
       $message = $_POST['message'];

       $sql = "INSERT INTO group_chats(group_id,user_id,message) VALUES('$group_id','$user_id','$message')";
       mysqli_query($conn,$sql);

   }





