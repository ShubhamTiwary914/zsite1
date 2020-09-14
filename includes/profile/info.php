


<?php
  
   include '../dbconn.php';

   if(isset($_POST['profile_info'])){
       

     $user_id = $_SESSION['uid'];
     $user_name = $_SESSION['uname'];
     $user_email = $_SESSION['email'];
     $made_date = (string)$_SESSION['mdate'];


     echo "<h2>Username:   ".$user_name."</h2>";
     echo "<h2>E-mail:   ".$user_email."</h2>";
     echo "<h2>Join Date:   ".$made_date."</h2>";

     

   }

?>


