<?php
  include '../dbconn.php';
  
  //login form submmited
  if(isset($_POST['submit'])){

      $uname = mysqli_real_escape_string($conn,$_POST['uname']);
      $pwd = mysqli_real_escape_string($conn,$_POST['pwd']);

      $emptyField = false;
      $wrongUname = false;
      $wrongPwd = false;
      $signin = false;

      //empty field 
      if(empty($uname) || empty($pwd)){
         $emptyField = true;
      }else{
         
         //verify user in DB
         $query = "SELECT * FROM login where username='$uname' or email = '$uname'";
         $result = mysqli_query($conn,$query);

         if( mysqli_num_rows($result) < 1 ){
             $wrongUname = true;
         //decrypt and verify pwd in DB with pwd entered
         }else{
            $row= mysqli_fetch_assoc($result);
            $hashpwd= password_verify($pwd,$row['password']);
            
            if($hashpwd==false){
                $wrongPwd = true;
            }else{
                //signin successful
                $_SESSION['uid'] = $row['id'];
                $_SESSION['uname'] = $row['username'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['mdate'] = $row['made'];
                $signin = true;
            }
         }

      }
  }

  //server error
  else{
     echo "An Server Error Occured";
  }
?>



<script>
   var emptyField = "<?php echo $emptyField ?>";
   var wrongUname = "<?php echo $wrongUname ?>";
   var wrongPwd = "<?php echo $wrongPwd ?>";

   
   if(emptyField==true){

      var fields = new Array('#form-uname','#form-pwd');
      //if field is empty show error
      for(var field=0;field<fields.length;field++){
         if( $(fields[field]).val() ==""){
            $(fields[field]).addClass('input-error').next().addClass('w3-text-red').text("This Field is Required!");
         }else{
            $(fields[field]).removeClass('input-error').next().removeClass('w3-text-red').text("");
         }
      }


   }else{
      //remove all red fields before verifying uname n pwd
      $('#form-uname, #form-pwd').removeClass('input-error').next().removeClass('w3-text-red').text("");


      //wrong username entered
      if(wrongUname==true){
         $('#form-uname, #form-pwd').removeClass('input-error').next().removeClass('w3-text-red').text("");

          $("#form-uname").addClass("input-error").next().addClass("w3-text-red").text("Wrong Username / Email entered! try again");
      }else{
         //wrong password entered
          if(wrongPwd==true){
            $('#form-uname, #form-pwd').removeClass('input-error').next().removeClass('w3-text-red').text("");

            $("#form-pwd").addClass("input-error").next().addClass("w3-text-red").text("Wrong Password entered! try again");
          }
      }
   }

   var signIn = "<?php echo $signin ?>";
   if(signIn==true){
      window.location.href = "../../index.php";
   }

</script>




