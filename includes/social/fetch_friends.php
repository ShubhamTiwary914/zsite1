<?php

   include '../dbconn.php';
   if(isset($_POST['get_friends'])){

       $user_id = $_SESSION['uid'];
       $query = "SELECT friend_id FROM friends WHERE user_id = '$user_id'" ;
       $result = mysqli_query($conn,$query);
      
       $rows = mysqli_num_rows($result);
       if($rows > 0){
         while($row = mysqli_fetch_assoc($result)){
            $friend_id = $row['friend_id'];
            $sql = "SELECT * FROM login WHERE id = '$friend_id'";
            $result1 = mysqli_query($conn,$sql);
            $rows1 = mysqli_num_rows($result);
            if($rows1 > 0){
               while($row1= mysqli_fetch_assoc($result1)){
                  $friend_name = $row1['username'];
                  echo 
                           '<div class="w3-card-2" style="height: 90px; margin-right: 60px; padding-top: 23px; padding-left: 14px;">'.
                              '<button class="w3-round-jumbo w3-purple" style="margin-right: 30px; width: 50px; height: 50px; border: 2px solid black;">'.$friend_name[0].'</button>'.
                               '<span>'.$friend_name.'</span>'.
                              '<button class="w3-btn w3-green chat-btn" style="float: right; width:100px;height:30px;font-size: 60%;margin-right: 50px;">Chat</button>'.
                              '<button class="w3-btn w3-dark-grey" style="float: right; width:100px;height:30px;font-size: 60%;margin-right: 40px;font-size: 60%;padding-top: 6px;">View Profile</button>'.
                           '</div>';                                               
               }
            } 

         }
      }else{
         echo "You Dont have any Friends! ";
      }

   }
   
   
   else{
      echo "An Server Error Occured!";
   }

?>


<script>

   $(".chat-btn").click(function(){
       var name = $(this).parent().children("span").text();
       window.location.href = "sub/chats/chatbox.php?name="+name;
   });




</script>
