
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
      <meta name="description" content="">
      <meta name="author" content="">
      <title>Home</title>
      <link rel="stylesheet" href="assets/css/bootstrap.min.css">
      <link rel="stylesheet" href="assets/css/nprogress.css">
      <link rel="stylesheet" href="assets/css/font-awesome.min.css">
      <link rel="stylesheet" href="assets/css/style.min.css">
      <!-- Waves Effect -->
      <link rel="stylesheet" href="assets/css/waves.min.css">
      		<link rel="stylesheet" href="assets/css/sweetalert.css">

   </head>
   <body>
      <div id="single-wrapper">
         <form action="" class="frm-single" method="post">
            <div class="inside">
               <div class="title"><strong>E - ACCESSORIES</strong></div>
               <!-- /.title -->
               <div class="frm-title">Reset Password</div>
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
      <script src="assets/js/jquery.min.js"></script>
      <script src="assets/js/modernizr.min.js"></script>
      <script src="assets/js/bootstrap.min.js"></script>
      <script src="assets/js/nprogress.js"></script>
      <script src="assets/js/waves.min.js"></script>
      <script src="assets/js/main.min.js"></script>
      <script src="assets/js/sweetalert.min.js"></script>

<?php

require_once 'config/connection.php';
if(isset($_POST['submit'])){
   $password=mysqli_real_escape_string($conn,password_hash($_POST['password'], PASSWORD_DEFAULT));
      $updatePassword=mysqli_query($conn,'UPDATE `login` set password="'.$password.'" where id="1"');
      if($updatePassword){
         echo "<script> alert('Password updated Successfully');
               window.location.href = 'http://localhost/ecommerce/admin/login.php'
         </script>";
      }
   }
      ?>
	

</body>
</html>