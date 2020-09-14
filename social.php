<?php
  include 'includes/dbconn.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Online</title>
   <script src="scripts/jquery.js"></script>
   <link rel="stylesheet" href="styles/w3.css" />
</head>
<body>

      <!-- Header Section -->
   <link rel="stylesheet" href="styles/header.css" />
   <div id="header-bar" class="w3-card-2 w3-blue-grey w3-css-top">
      <div id="topbar"> 
         <div id="logo">Site1.com</div>  
 
         <!-- Sidebar Section -->
         <button id="settings" class="w3-btn w3-round-jumbo w3-blue-gray" style="box-shadow: none;">
             <div id="line1"></div>
             <div id="line2"></div>
             <div id="line3"></div>
         </button>
        
         <div id="side-bar" class="w3-blue-gray">
            <div id="stats">
               <?php
                  $user = $_SESSION['uname'];
                  echo '<button class="w3-purple w3-round-jumbo" style="padding: 15px 25px 15px 25px;border: 2px solid black;font-size: 150%;box-shadow: none;">'.$user[0].'<button>';
                  echo '<span style="display: inline-block;margin-left: 100px;margin-top: 10px;font-size: 200%;color: white;">'.$user.'<span>';
               ?>
            </div>
            <div id="logout">
               <button id="logout-btn" class="w3-red w3-text-white" style="margin-top: 350px;margin-left: 220px;">Logout</button>
            </div>
         </div>

      </div>
      <div id="navbar" class="w3-dark-gray w3-bar-block">
          <div id="navitems">
              <ul class="w3-ul" id="navul">
                 <a href="index.php">
                    <li id="home-li"> Home </li>
                 </a>                 
                 <li id="social-li"> Social </li>
                 <li>Chats</li>
                 <a href="profile.php">
                     <li>Profile</li>
                 </a>                

                 <!-- Search Bar Section -->
                 <div id="search-bar" style="margin-left: 80px;display:inline-block;"> 
                      <button class="w3-btn w3-blue" id="query-tag"></button>
                      <div id="search-tag-bar" class="w3-card-2" style="font-size: 100%;">
                        <div id="search-user" class="w3-text-white w3-blue-gray" style="border: 1px solid burlywood;border-bottom: 0px;">Users</div>
                        <div id="search-group" class="w3-text-white w3-blue-gray" style="border: 1px solid burlywood;">Groups</div>
                      </div>
                      <input class="w3-input" id="query" placeholder="Search or enter username">
                      <button class="w3-btn " id="search"></button>
                      <div class="w3-light-gray w3-card-2" id="query-box"></div>
                 </div>
              </ul>
          </div>
      </div>
   </div>
 

   <!-- Body Section -->
   <link rel="stylesheet" type="text/css" href="styles/social.css">
   <div id="body-bar">
      <div id="friends">
         <h3 class="friend-head">Friends</h3>
         <h5 class="friend-body">  </h5><br>
         <button id="more-f" class="w3-btn w3-blue">View More</button>
      </div>
      <div class="divisor"></div>
      <div id="groups">
         <h3 class="group-head">Groups</h3>
         <h5 class="group-body"></h5><br>
         <button id="more-g" class="w3-btn w3-blue">View More</button>
      </div>
   </div>
   <div id="test"></div>


</body>
      <!--Footer Section-->
      <link rel="stylesheet" href="styles/footer.css">
      <div id="footer" class="w3-card-4">
         <div id="copyrights">All Rights Reserved @ 2019 Site1.com</div>
      </div>

<script>
   
   $(document).ready(function(){
 
     //settings sidebar animation
     var open_side = false;
     $("#settings").click(function(){
          if(open_side){ open_side = false; }
          else{ open_side = true; }
          
          if(open_side){   //while closed
             $("#line1").addClass("line1");$("#line2").addClass("line2");$("#line3").addClass("line3");
             $("#side-bar").css({"visibility":"visible"}).animate({"height":"+=400px"},200);
          }else{  //while open
            $("#line1").removeClass("line1");$("#line2").removeClass("line2");$("#line3").removeClass("line3");
            $("#side-bar").animate({"height":"-=400px"},10).css({"visibility":"hidden"});
          }

     });


     $("#logout").click(function(){
          var logout = true;
          $.post('includes/login/signout.php',{logout:logout},function(){
             window.location.href = "start.php";
          });
     });
    
    //dropdown on entering keywords in search-bar ad tag for search
    $("#search-tag-bar").css({"visibility":"hidden"});
    $("#query-tag").click(function(){
         if($("#search-tag-bar").css("visibility") == "hidden"){
               $("#search-tag-bar").css({"visibility":"visible"});
         }else{
              $("#search-tag-bar").css({"visibility":"hidden"});
         }

         if( $("#query-tag").hasClass('img-rotate-up') ){
              $(this).removeClass('img-rotate-up');
         }else{
              $(this).addClass('img-rotate-up');
         }


    });

    // user: 1 , group : 2
    var tag = 1;
    $("#search-tag-bar div").click(function(){
         if( $(this).text() == 'Users' ){
            tag = 1;
            $("#query").attr("placeholder","Search or enter username");
         }else{
            tag = 2;
            $("#query").attr("placeholder","Search or enter groups");   
         }
    });


     $("#query").keydown(function(){
         var query = $(this).val();
         $.ajax({
             url: "includes/search/users.php",
             method: "POST",
             data: {query: query,tag: tag},
             success: function(data){
                $("#query-box").html(data);
             }
         });
     });
     
     function remove_queries(){
        var query = $("#query").val();
        if(query == ''){
           $("#query-box").html('');
        }
     }

     setInterval(function(){
        remove_queries();
     }, 500);



     function fetch_friends(){
         $.post('includes/social/fetch_friends.php',{get_friends:1},function(data){
            $('.friend-body').html(data);
         });
     }

     function fetch_groups(){
         $.post('includes/social/fetch_groups.php',{get_groups:1},function(data){
            $('.group-body').html(data);
         });
     }

     fetch_friends();
     fetch_groups();
     setInterval(function(){
         fetch_friends();
         fetch_groups();
     },3000);
    
   });
  

 </script>

 <style>
 #social-li{
    background-color: azure;
    color: black;
 }

 #body-bar{
   padding-left: 10px;
   background-color: whitesmoke;
   margin-top: 100px;
   margin-left: 100px;
   width: 80%;
 }

 
#friends #more-f, #more-g{
   display: inline-block;
   margin-left: 87%;
   margin-bottom: 10px;
 }

.friend-head,.group-head{
   font-size: 180%;
   font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
   width: 780px;
   border-bottom: 1px solid gray;
}


 .friend-body,.group-body{
    margin-left: 40px;
    font-size: 160%;
 }


.divisor{
   margin-top: 40px;
   margin-bottom: 60px;
   height: 2px;
   width: 100%;
   margin-left: -5px;
   background-color: grey;
}




/* Search Bar Section */

#search-bar button{
   height: 30px;
   width: 35px;
}

#search{
   margin-bottom: 3px;
   margin-left: -40px;
   background-image: url('img/nav/search.png');
   background-position: center;
}

#query{
   width: 270px;
   height: 30px;
   margin-top:5px;
   display: inline-block;
}

#query-box{
   display: inline-block;
   position: absolute;
   width: 270px;
   color: white;
}

#query-tag{
   margin-right: -1px;
   margin-top: -6px;
   display: inline-block;
   background-image: url('img/nav/search-tag.png');
   background-position: center;
   box-shadow: none;
}

.img-rotate-up{
   transform: rotate(180deg);
   -webkit-transform: rotate(180deg);
}

#search-tag-bar{
   display: inline-block;
   position: absolute;
   margin-top: 40px;
   margin-left: -100px;
   font-size: 120%;
   width: 100px;
}


#search-user{
   border-bottom: 1px solid black;
}


#search-tag-bar div:hover{
   cursor: pointer;
   box-shadow: 1px 1px 1px sandybrown;
}



/* Sidebar section */
#settings{
   display: inline-block;
   margin-left: 1250px;
   margin-top: -50px;
}

#line1, #line2, #line3{
   display: block;
   width: 30px;
   height: 2px;
   background-color: white;
   margin-top: 6px;
}

#side-bar{
   margin-left: 1000px;
   margin-top: 57px;
   display: inline-block;
   width: 500px;
   height: 0px;
   padding-top: 40px;
   padding-left: 20px;
   position: absolute;
   z-index: 3;
   visibility: hidden;
}

#side-bar *{
   position: absolute;
   z-index: 4;
}

.line1{
   transition: 0.444s;
   -webkit-transform: rotate(-45deg);
   transform: rotate(-45deg) translate(-5px, 5px);
}

.line2{
   transition: 0.444s;
   opacity: 0;
}

.line3{
   transition: 0.444s;
   -webkit-transform: rotate(45deg);
   transform: rotate(45deg) translate(-5px, -5.2px);
}

#logout-btn{
   box-shadow: none;
   display: block;
   border: 2px solid red;
}

#logout-btn:hover{
   cursor: pointer;
}

 </style>

</html>