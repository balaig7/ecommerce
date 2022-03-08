<?php 
session_start();
// error_reporting(0);
// ini_set('display_errors', 0);
$_SESSION['active']=false;

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
                <?php if(isset($_SESSION['welcome_message'])){ ?>
                    <div class="alert bg-success text-white">
                        <?=$_SESSION['welcome_message']?>
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
                <a href="register.php" class="a-link">New to E-ACCESSORIES? Register</a>
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
<?php

require_once 'config/connection.php';
if(isset($_POST['submit'])){
    $userName=mysqli_real_escape_string($conn,$_POST['user_name']);
    $password=$_POST['password'];
    $query="SELECT id,profile_id,user_name,role,password FROM `login` where user_name='".$userName."'";
    $result=mysqli_query($conn,$query);
    if(mysqli_num_rows($result)>0){
        $userData=mysqli_fetch_assoc($result);
        if (password_verify($password, $userData['password'])) {
                unset($userData['password']);
				$_SESSION['current_user']=$userData;
				if(isset($_SESSION['redirect_url'])){
                    $url=$_SESSION['redirect_url'];
				}else {
                    $url="index.php";
				}
				unset($_SESSION['error_message'],$_SESSION['redirect_url'],$_SESSION['welcome_message']);
                
				if($_SESSION['current_user']['role']=='user'){
                    $_SESSION['active']=true;
					header("Location:".$url."");
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