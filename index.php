<?php
  include 'includes/dbconn.php';
  if(!isset($_SESSION['uid'])){
     header("Location: start.php");
     exit();
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Index</title> 
   <script src="scripts/jquery.js"></script>
   <link rel="stylesheet" href="styles/w3.css" />
   <link rel="stylesheet" href="styles/header.css" />

</head>
<body>
 
  <!-- Header Section -->
  <div id="header-bar" class="w3-card-2 w3-blue-grey w3-animate-top">
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
                 
                 <li id="home-li">Home</li>
                 <a href="social.php">
                      <li id="social-li"> Social </li>
                 </a>
                 <li>Chats</li>
                 <a href="profile.php">
                     <li>Profile</li>
                 </a>
                 <!--search bar section-->
                 <div id="search-bar" style="margin-left: 80px;display:inline-block;"> 
                      <input class="w3-input" id="query" placeholder="Search or enter keywords" 
                      style="width: 270px;height: 30px;margin-top:5px;display: inline-block;">
                      <button class="w3-btn w3-black" id="search" style="height: 30px;margin-bottom: 3px;margin-left: -40px;width:35px;
                      background-image: url('img/nav/search.png');background-position: center;">
                      </button>
                      <div class="w3-light-gray w3-card-2" id="query-box" style="display: inline-block;position: absolute;width: 270px;color: white;"></div>
                 </div>
              </ul>
          </div>
      </div>
   </div>
  

</body>
   
<!--Footer Section-->
   <link rel="stylesheet" href="styles/footer.css">
   <div id="footer" class="w3-card-4">
      <div id="copyrights">All Rights Reserved @ 2019 Site1.com</div>
   </div>
</html>

  <script>
   
   $(document).ready(function(){
 
     $("#logout").click(function(){
          var logout = true;
          $.post('includes/login/signout.php',{logout:logout},function(){
             window.location.href = "start.php";
          });
     });


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


   });
  

 </script>
<style>
#home-li{
   background-color: azure;
   color: black;
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