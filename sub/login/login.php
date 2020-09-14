<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Login</title>
   <link rel="stylesheet" href="../../styles/w3.css">
   <link rel="stylesheet" href="../../styles/register.css">
   <script  type="text/javascript" src="../../scripts/jquery.js"></script>
</head>
<body>
     
   <div id="header-bar" class="w3-card-2 w3-blue-grey w3-animate-top">
      <div id="topbar"> 
         <div id="logo">Site1.com</div>  
      </div>
   </div>

   <div id="formbar" class="w3-card-2">
       <div id="formhead" class="w3-blue">
          <div id="headtext">User login Form</div>
       </div>
       <div id="formbody">

           <form action="includes/signup.php" method="POST" class="w3-form" id="form">
               <div id="username"> 
                  <label for="Username">Enter Username / Email </label><br><br>
                  <input type="text" name="uname" id="form-uname" class="w3-input"/>
                  <div id="uname-error"></div>
               </div>
               <div id="password">
                  <label for="Password">Enter Password </label><br><br>              
                  <input type="password" name="pwd" id="form-pwd" class="w3-input"/>
                  <div id="pwd-error"></div>
               </div>
               <button type="submit" class="w3-btn w3-green w3-hover-blue" id="form-btn">login</button>
           </form>

       </div>
   </div>


   <div id="login">
      <span id="login-text">New to Site1.com? </span>
      <div id="login-btn" class="w3-large w3-text-blue w3-hover-text-black">
          <a href="register.php">SignUp for Site1.com</a>
      </div>
   </div>

   <div id="test"></div>

</body>
  <script>
    
    $(document).ready(function(){
       $('#form').submit(function(event){
            event.preventDefault();
            var username = $('#form-uname').val();
            var pwd = $('#form-pwd').val();
            var submit = $('#form-btn').val();

            $.post('../../includes/login/signin.php',{
               uname: username,
               pwd: pwd,
               submit: submit
            },function(data,status){
               $("#test").html(data);
            });
       });

    });
  </script>


<!--Footer Section-->
<link rel="stylesheet" href="../../styles/footer.css">
<div id="footer" class="w3-card-4">
   <div id="copyrights">All Rights Reserved @ 2019 Site1.com</div>
</div>


</html>