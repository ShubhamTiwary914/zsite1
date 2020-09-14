<?php
  include '../../includes/dbconn.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Online</title>
   <script src="../../scripts/jquery.js"></script>
   <link rel="stylesheet" href="../../styles/emojionearea.min.css">
   <script src="../../scripts/emojionearea.min.js"></script>
   <link rel="stylesheet" href="../../styles/w3.css" />
</head>
<body>

      <!-- Header Section -->
   <link rel="stylesheet" href="../../styles/header.css" />
   <div id="header-bar" class="w3-card-2 w3-blue-grey w3-animate-top">
      <div id="topbar"> 
         <div id="logo">Site1.com</div>  
      </div>
      <div id="navbar" class="w3-dark-gray w3-bar-block">
          <div id="navitems">
              <ul class="w3-ul" id="navul">
                 <a href="../../index.php">
                    <li id="home-li"> Home </li>
                 </a>
                 <a href="../../social.php">
                      <li id="social-li"> Social </li>
                 </a>
                 <li>Chats</li>
                 <a href="../../profile.php">
                      <li id="social-li"> Profile </li>
                 </a>
              </ul>
          </div>
      </div>
   </div>
 

   <!-- Body Section -->
   <div id="body-bar">
      <div id="chat-head" class="w3-blue-gray">
          <button class="w3-btn w3-purple w3-round-jumbo" id="chat-logo">
            <?php 
                $chatter = $_GET['name'];
                echo $chatter[0];
            ?>
          </button>
           <div id="chat-name">
              <?php echo $chatter;?>
           </div>
          <button id="trash" class="w3-btn w3-round-jumbo w3-blue-gray">
             <div id="line1"></div>
             <div id="line2"></div>
             <div id="line3"></div>
          </button>
      </div>

      <div id="chat-body"></div>
      <div id="chat-form">
         <div id="message-box-bar">
             <input type="text" name="message" id="message-box" placeholder="Type Your Message here" class="w3-input w3-light-gray"/>
         </div>
         <button id="send" class="w3-btn w3-pale-green">send</button>
      </div>
   </div>
   <div id="test"></div>


</body>
      <!--Footer Section-->
      <link rel="stylesheet" href="../../styles/footer.css">
      <div id="footer" class="w3-card-4">
         <div id="copyrights">All Rights Reserved @ 2019 Site1.com</div>
      </div>


   <?php
       $sql = "SELECT * FROM login WHERE username = '$chatter'";
       $result = mysqli_query($conn,$sql);
       $rows = mysqli_num_rows($result);
       $chatter_id = 0;

       if( $rows  > 0 ){
          while($row = mysqli_fetch_assoc($result)){
             $chatter_id = $row['id'];
          }
       }

   ?>

<script>
   
   $(document).ready(function(){

      var chatter_id = "<?php echo $chatter_id?>";
      var chatter = "<?php echo $chatter?>";

      $("#send").click(function(){
         var message = $("#message-box").val();         
         if(message != null){
            $.post('../../includes/chats/user/send_chats.php',{chatter: chatter_id,message: message},function(){
               $("#message-box").val(''); 
            });
         }
      });


      $("#message-box").emojioneArea({
         pickerPosition: "top",
         toneStyle: "bullet"
      });


      function fetch_user_chat_history(){
         $.ajax({
               url: "../../includes/chats/user/fetch_chats.php",
               method: "POST",
               data: {chatter_id: chatter_id},
               success: function(data){
                  $("#chat-body").html(data);
               }
          });
      }

      fetch_user_chat_history();

      setInterval(function(){
         fetch_user_chat_history();
      }, 1000);
     
      setTimeout(function(){
         window.location.href = "chatbox.php?name="+chatter+"#last";
      },1000);
      
   });
   

</script>


<style>

#body-bar{
   padding-left: 10px;
   background-color: whitesmoke;
   margin-top: 100px;
   margin-left: 100px;
   width: 80%;
}

#chat-head{
   margin-left: -10px;
   height: 80px;
   padding-left: 10px;
   padding-top: 10px;
}

#chat-logo{
   width: 50px;
   height: 50px;
   font-size: 120%;
   margin-left: 16px;
   border: 0.1px solid white;
}

#chat-name{
   display: inline-block;
   margin-left: 400px;
   margin-top: 2px;
   font-size: 200%;
}

#trash{
   float: right;
   font-size: 120%;
   width: 60px;
   height: 60px;
   color: white;
   margin-right: 40px;
   margin-bottom: 10px;
   
}

#line1, #line2, #line3{
   display: block;
   width: 30px;
   height: 2px;
   background-color: white;
   margin-top: 6px;
}


#chat-body{
   height: 530px;
   overflow-y: scroll;
   padding-right: 30px;
   padding-top: 67px;
}


#chat-form{
   height: 150px;
   margin-left: -10px;
   border: 1px solid gray;
   border-top: 1px solid black;
   padding-top: 20px;
   padding-left: 40px;
   background-color: white;
}


#message-box-bar{
    width: 88%;
    margin-left: -10px;
    margin-top: 40px;
    margin-right: 100px;
}

button#send{
   display: inline-block;
   margin-left: 940px;
   margin-top: -60px;
}

button#send:hover{
   box-shadow: none;
}

</style>
</html>
