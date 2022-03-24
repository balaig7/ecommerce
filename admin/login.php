<?php 
session_start();
error_reporting(0);
ini_set('display_errors', 0);
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
      <link rel="stylesheet" href="assets/css/bootstrap.min.css">
      <link rel="stylesheet" href="assets/css/nprogress.css">
      <link rel="stylesheet" href="assets/css/font-awesome.min.css">
      <link rel="stylesheet" href="assets/css/style.min.css">
      <!-- Waves Effect -->
      <link rel="stylesheet" href="assets/css/waves.min.css">
      <style>
      #single-wrapper{
        background: url(assets/img/sativa.png) top center repeat;
      }
      </style>
   </head>
   <body>
      <div id="single-wrapper">
         <form action="login.php" class="frm-single" method="post">
            <div class="inside">
               <div class="title"><strong>E - ACCESSORIES</strong></div>
               <!-- /.title -->
               <div class="frm-title">Login</div>
               <!-- /.frm-title -->
               <?php if(isset($_SESSION['error_message'])){ ?>
               <div class="alert bg-danger text-white">
                  <?=$_SESSION['error_message']?>
               </div>
               <?php } ?>
               <div class="frm-input">
                  <input type="text" name="user_name" placeholder="User Name" class="frm-inp"><i class="fa fa-user frm-ico"></i>
               </div>
               <!-- /.frm-input -->
               <div class="frm-input">
                  <input type="password" name="password" placeholder="Password" class="frm-inp"><i class="fa fa-lock frm-ico"></i>
               </div>
               <!-- /.frm-input -->
               <!-- /.clearfix -->
               <button type="submit" name="submit" class="frm-submit">Login<i class="fa fa-arrow-circle-right"></i></button>
               <div><a href="forgot-password.php" class="a-link">Forgot Password?</a></div>

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
<?php

require_once 'config/connection.php';
if(isset($_POST['submit'])){
    $userName=mysqli_real_escape_string($conn,$_POST['user_name']);
    $password=mysqli_real_escape_string($conn,$_POST['password']);
    $query="SELECT * FROM `login` where user_name='".$userName."'";
    $result=mysqli_query($conn,$query);
    if(mysqli_num_rows($result)>0){
        $userData=mysqli_fetch_assoc($result);
        if (password_verify($password, $userData['password'])) {
				$_SESSION['current_user']=$userData;
				if(isset($_SESSION['redirect_url'])){
					$url=$_SESSION['redirect_url'];
				}else {
					$url="index.php";
				}
				unset($_SESSION['error_message'],$_SESSION['redirect_url']);

				if($_SESSION['current_user']['role']=='admin'){
					header("Location:".$url."");
				}else{
					  session_destroy();
				      echo "<script>alert('You have no permission to access this page')</script>";
	
				}
        }else{
			echo "<script>alert('Incorrect Password')</script>";
		}
    }else{
			echo "<script>alert('Incorrect Username')</script>";
    }
}
?>
	

</body>
</html>