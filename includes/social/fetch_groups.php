<?php

    include '../dbconn.php';

    if(isset( $_POST['get_groups'] )){

        $user_id = $_SESSION['uid'];
        $sql = "SELECT * FROM group_members WHERE user_id = '$user_id'";
        $result = mysqli_query($conn,$sql);
        $rows = mysqli_num_rows($result);

        if($rows > 0){
            while($row = mysqli_fetch_assoc($result) ){
                $group_id = $row['group_id'];
                $sql1 = "SELECT * FROM groups WHERE id = '$group_id'";
                $result1 = mysqli_query($conn,$sql1);
                $rows1 = mysqli_num_rows($result1);

                if($rows1 > 0){
                    while($row1 = mysqli_fetch_assoc($result1) ){
                        $group_name = $row1['group_name'];
                        echo 
                            '<div class="w3-card-2" style="height: 90px; margin-right: 60px; padding-top: 23px; padding-left: 14px;">'.
                            '<button class="w3-round-jumbo w3-blue-gray w3-text-white" style="margin-right: 30px; width: 50px; height: 50px; border: 2px solid black;">'.$group_name[0].'</button>'.
                                '<span>'.$group_name.'</span>'.
                            '<button class="w3-btn w3-green g-chat-btn" style="float: right; width:100px;height:30px;font-size: 60%;margin-right: 50px;">Enter Chat</button>'.
                            '<button class="w3-btn w3-dark-grey" style="float: right; width:100px;height:30px;font-size: 60%;margin-right: 40px;font-size: 60%;padding-top: 6px;">Group info</button>'.
                            '</div>';    


                    } //row1
                } //rows1


            } //row
        } //rows
       


    }

?>

<script>


    $(".g-chat-btn").click(function(){
        var gname = $(this).parent().children("span").text();
        window.location.href = "sub/chats/group_chatbox.php?gname="+gname;
    });


</script>



