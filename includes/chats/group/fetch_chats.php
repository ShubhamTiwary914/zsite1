<?php

    include '../../dbconn.php';

    if(isset( $_POST['group_id'] )){

       $group_id = $_POST['group_id'];
       $user_id = $_SESSION['uid'];

       $sql = "SELECT * FROM group_chats WHERE group_id = '$group_id' ORDER BY sent_time";
       $result = mysqli_query($conn,$sql);
       $rows = mysqli_num_rows($result);
       if($rows > 0){
           while($row = mysqli_fetch_assoc($result)){ //inside group_chats
               $member_id = $row['user_id'];
               if($member_id == $user_id){
                  echo  '<div class="w3-pale-green w3-round-medium" style="float:right;padding: 10px 10px 10px 10px;font-size: 120%;border: 1px solid green;">'.
                            $row['message'].
                        '</div>'.'<br><br><br><br>';
               }else{
                
                  $message = $row['message'];
                  $username = '';
                  $sql1 = "SELECT * FROM login WHERE id = '$member_id'";
                  $result1 = mysqli_query($conn,$sql1);
                  $rows1 = mysqli_num_rows($result1);
                  if($rows1 > 0){
                      while($row = mysqli_fetch_assoc($result1)){
                           $username = $row['username'];
                      }
                  }
                  echo  '<div class="w3-light-gray w3-round-medium" style="float:left;padding: 10px 10px 10px 10px;font-size: 120%;border: 1px solid gray">'.
                            '<div class="w3-card-2 w3-text-black" style="margin-bottom: 20px; padding: 10px 10px 10px 10px;margin: -10px -10px 20px -10px">'. 
                                '<button class="w3-btn w3-round-jumbo w3-dark-gray" style="margin-right: 20px;">'.$username[0].'</button>'.
                                $username.
                            '</div>'.
                            $message.
                        '</div>'.'<br><br><br><br><br><br>';

               }
           }  //row
       } //rows


    } //isset
  