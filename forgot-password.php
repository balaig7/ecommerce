<?php 
session_start();
require_once("settings.php");
$_SESSION['current_user']=array();


?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
      <meta name="description" content="">
      <meta name="author" content="">
      <title>Home</title>
      <link rel="stylesheet" href="admin/assets/css/bootstrap.min.css">
      <link rel="stylesheet" href="admin/assets/css/nprogress.css">
      <link rel="stylesheet" href="admin/assets/css/font-awesome.min.css">
      <link rel="stylesheet" href="admin/assets/css/style.min.css">
      <!-- Waves Effect -->
      <link rel="stylesheet" href="admin/assets/css/waves.min.css">
      		<link rel="stylesheet" href="assets/css/sweetalert.css">

      <style>
    .frm-single .frm-submit{
        background-color: #D10024!important;
        border-color: #D10024!important;
        color: #FFF!important;
    }
    .frm-single .frm-input .frm-inp:focus{
        border-color: #D10024!important;
    }
      </style>
   </head>
   <body>
      <div id="single-wrapper">
         <form action="" class="frm-single" method="post">
            <div class="inside">
               <div class="title"><strong>E - ACCESSORIES</strong></div>
               <!-- /.title -->
               <div class="frm-title">Reset Password</div>
               <!-- /.frm-title -->
               <div class="frm-input">
                  <input type="text" name="user_name" placeholder="User Name" class="frm-inp"><i class="fa fa-user frm-ico"></i>
               </div>
               <!-- /.frm-input -->
               <div class="frm-input">
                  <input type="password" name="password" placeholder="New Password" class="frm-inp"><i class="fa fa-lock frm-ico"></i>
               </div>
               <!-- /.frm-input -->
               <!-- /.clearfix -->
               <button type="submit" name="submit" class="frm-submit">Reset Password<i class="fa fa-arrow-circle-right"></i></button>

            </div>
            <!-- .inside -->
         </form>
         <!-- /.frm-single -->
      </div>
      <!--/#single-wrapper -->
      <script src="admin/assets/js/jquery.min.js"></script>
      <script src="admin/assets/js/modernizr.min.js"></script>
      <script src="admin/assets/js/bootstrap.min.js"></script>
      <script src="admin/assets/js/nprogress.js"></script>
      <script src="admin/assets/js/waves.min.js"></script>
      <script src="admin/assets/js/main.min.js"></script>
      <script src="assets/js/sweetalert.min.js"></script>

<?php

require_once 'config/connection.php';
if(isset($_POST['submit'])){
   $userName=mysqli_real_escape_string($conn,$_POST['user_name']);
   $password=mysqli_real_escape_string($conn,password_hash($_POST['password'], PASSWORD_DEFAULT));
   $checkEmail=mysqli_query($conn,"SELECT * FROM `login` where user_name='".$userName."'");
   if(mysqli_num_rows($checkEmail)>0){
      $row=mysqli_fetch_assoc($checkEmail);
      $id=$row['id'];
      $updatePassword=mysqli_query($conn,'UPDATE `login` set password="'.$password.'" where id="'.$id.'"');
      if($updatePassword){
         echo "<script> 
      Swal.fire({
				title: 'Password Updated',
				text: '',
				icon: 'success'
			}).then(function (result) {
            
				if (result.value) {
               window.location.href = 'http://localhost/ecommerce/login.php'
				}
			})
         </script>";
      }
   }else{
      echo "<script> 
      Swal.fire(
         'Incorrect Username',
         '',
         'error'
			)
         </script>";
      }
   }
      ?>
	

</body>
</html>