<?php
   
   include '../dbconn.php';
   $server_error = false;

   if(isset($_POST['submit'])){
      
     $uname = mysqli_real_escape_string($conn,$_POST['uname']);
     $email = mysqli_real_escape_string($conn,$_POST['email']);
     $pwd = mysqli_real_escape_string($conn,$_POST['pwd']);
     $pwd2 = mysqli_real_escape_string($conn,$_POST['pwd2']);


     $date_of_creation = strtotime(date("Y-m-d H:i:s")."-10 second");
     $date_of_creation = mysqli_real_escape_string($conn,date("Y-m-d H:i:s",$date_of_creation));

     $emptyField = false;
     $unameTaken = false;
     $emailTaken = false;
     $signup = false;
     $pwd_match = true;
     $pwd_short = false;
     $pwd_len = strlen($pwd);
     
   
   //Checks for empty field
     if(empty($uname) || empty($pwd) || empty($email) || empty($pwd2)){
         $emptyField = true;
     }
     else{
            //Checks if password is too short
            if($pwd_len<7){
                $pwd_short = true;
            }else{               
                  //Checks for user if taken 
               $query = "SELECT * FROM login WHERE username='$uname'";
               $result = mysqli_query($conn,$query);
               $len_result = mysqli_num_rows($result);

               if($len_result > 0){
                  $unameTaken = true;

               }else{
                    //Checks if email is taken
                    $query1 = "SELECT * from login WHERE email = '$email'";
                    $result1 = mysqli_query($conn,$query1);
                    $len_result1 = mysqli_num_rows($result1);
                    if($len_result1 > 0){
                        $emailTaken = true;
                    }


                   else{
                    //Checking pwd1 and pwd2
                    if($pwd != $pwd2){
                       $pwd_match = false;
                    }else{

                      //Hashing and entering values in DB( Database not Dragon BALL! )
                      $hashed_pin= password_hash($pwd,PASSWORD_DEFAULT);
                      $signup = true;
                      
                      $query = "INSERT INTO login(username,password,made,email) VALUES('$uname','$hashed_pin','$date_of_creation','$email')";
                      mysqli_query($conn,$query);

                    }

                  
                }
              }
         
         }
      }
   }

   else{
      $server_error = true;
   }

?>

<script>
   var emptyField = "<?php echo $emptyField ?>";
   var unameTaken =  "<?php echo $unameTaken ?>";
   var emailTaken = "<?php echo $emailTaken?>";
   var pwd_too_short = "<?php echo $pwd_short?>";
   var pwd_match = "<?php echo $pwd_match?>";
   var signup = "<?php echo $signup ?>";


  if(emptyField == true){
      var fields = new Array('#form-uname','#form-pwd',"#form-email","#form-pwd2");

      //if field is empty show error
      for(var field=0;field<fields.length;field++){
         if( $(fields[field]).val() ==""){
            $(fields[field]).addClass('input-error').next().addClass('w3-text-red').text("This Field is Required");
         }else{
            $(fields[field]).removeClass('input-error').next().removeClass('w3-text-red').text("");
         }
      }
    
  }else{
     //Fields have been filled!
     $('#form-uname, #form-pwd').removeClass('input-error').next().removeClass('w3-text-red').text("");
  }
     
     if(pwd_too_short==true){
         $("#form-pwd").addClass('input-error').next().addClass('w3-text-red').text("Minimum 7 digits required! ");
     }else{
         $("#form-pwd").removeClass('input-error').next().removeClass('w3-text-red').text("");
     }

     if(pwd_match==false){
         $("#form-pwd").addClass('input-error').next().addClass('w3-text-red').text("The Passwords do not Match!");
         $("#form-pwd2").addClass('input-error').next().addClass('w3-text-red')
     }else{
         $("#form-pwd").removeClass('input-error').next().removeClass('w3-text-red').text("");
         $("#form-pwd2").removeClass('input-error').next().removeClass('w3-text-red')
     }

     if(unameTaken==true){
         $("#uname-error").addClass('w3-text-red').text("This Username is already taken!");
     }else{
         $("#uname-error").removeClass('w3-text-red').text("");

     }

     if(emailTaken==true){
         $("#email-error").addClass('w3-text-red').text("This E-mail is already taken!");
     }else{
         $("#email-error").removeClass('w3-text-red').text("");

     }

     if(signup == true){
        $("#login").html('<div id="signup" class="w3-text-green" style="font-size: 130%;">Signup successful!</div>');
      window.location.href = "login.php";

      var uname = "<?php echo $uname?>";
      var pwd = "<?php echo $pwd?>";
      alert("Account Created! Username: "+uname+" Password: "+pwd);
     }
  



</script>   
