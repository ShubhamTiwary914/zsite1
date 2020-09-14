<?php

   include '../../includes/dbconn.php';

   if(isset( $_POST['query'] )){

       $query =  $_POST['query'];
       $tag = $_POST['tag'];
       if(!empty($query)){

           if($tag == 1){
                $sql = "SELECT * FROM login";
                $result = mysqli_query($conn,$sql);
                $rows = mysqli_num_rows($result);
            
                if( $rows > 0 ){
                    while($row = mysqli_fetch_assoc($result)){
                        $user_name = $row['username'];
                        if(strpos($user_name,$query)!==false){
    
                            echo '<div class="w3-light-gray" style="padding: 5px 5px 5px 5px;margin-top: 4px;border-bottom: 1px solid gray;">'.
                                    '<button class="w3-btn w3-round-jumbo w3-blue-gray" style="display: inline-block;box-shadow: none;margin-right: 7px;">'.$user_name[0].'</button>'.
                                    $user_name.
                                '</div>';
                        }
                    }
                }
           }
           
           elseif($tag == 2){

                $sql = "SELECT * FROM groups";
                $result = mysqli_query($conn,$sql);
                $rows = mysqli_num_rows($result);
            
                if( $rows > 0 ){
                    while($row = mysqli_fetch_assoc($result)){
                        $group_name = $row['group_name'];
                        if(strpos($group_name,$query)!==false){

                            echo '<div class="w3-light-gray" style="padding: 5px 5px 5px 5px;margin-top: 4px;border-bottom: 1px solid gray;">'.
                                    '<button class="w3-btn w3-round-jumbo w3-blue-gray" style="display: inline-block;box-shadow: none;margin-right: 7px;">'.$group_name[0].'</button>'.
                                    $group_name.
                                '</div>';
                        }
                    }
                }

           }



       }

}
