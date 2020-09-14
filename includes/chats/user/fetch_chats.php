<?php

        include '../../dbconn.php';

        $chatter_id = (int)$_POST['chatter_id'];
        $logined_id = (int)$_SESSION['uid'];   

                
        $sql = "SELECT * from chats WHERE from_user = '$logined_id' and to_user = '$chatter_id'
                OR from_user = '$chatter_id' and to_user = '$logined_id' ORDER BY sent_time";
        $result1 = mysqli_query($conn,$sql);
        $rows1 = mysqli_num_rows($result1);
        $output = '';
        $message_len = '';
        $counter = 1;
        if($rows1 > 0){
            while($row1 = mysqli_fetch_assoc($result1)){
                $counter++;
                $user_id = $row1['from_user']; //if message is by user or to user

                if($user_id == $logined_id){
                    $message_len= strlen($row1['message']);   
                    
                    if($counter > $rows1){
                        echo  '<div class="w3-pale-green w3-round-medium user_text" id="last" style="float:right;padding: 10px 10px 10px 10px;font-size: 120%;margin-bottom: 110px;border: 1px solid green">'.
                                $row1['message'].
                              '</div>'.'<br><br><br><br>';
                    }else{
                        echo  '<div class="w3-pale-green w3-round-medium user_text" style="float:right;padding: 10px 10px 10px 10px;font-size: 120%;border: 1px solid green">'.
                                $row1['message'].
                              '</div>'.'<br><br><br><br>';
                    }          
                                      
                }else{
                    if($counter > $rows1){
                        echo  '<div class="w3-white w3-round-medium friend_text" id="last" style="padding: 10px 10px 10px 10px;float:left;font-size: 120%;margin-bottom: 100px;border: 1px solid gray">'.
                                   $row1['message'].
                              '</div><br><br><br><br>';                     
                    }else{
                        echo  '<div class="w3-white w3-round-medium friend_text" style="padding: 10px 10px 10px 10px;float:left;font-size: 120%;border: 1px solid gray">'.
                                   $row1['message'].
                              '</div><br><br><br><br>';
                    }
                    
                }
            }
        }else{
            echo '<div class="w3-card-2 w3-round-medium w3-green" style="width: 400px; margin-left: 380px;padding: 20px 20px 20px 20px;font-size: 140%;">
            Say hello to your New Friend!</div>';
        }

                
?>


<script>



</script>


