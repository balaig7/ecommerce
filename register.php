<?php 
require_once("settings.php")
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
         <form action="register.php" class="frm-single" method="post">
            <div class="inside">
               <div class="title"><strong>E - ACCESSORIES</strong></div>
               <div class="frm-title">REGISTER</div>
               <div class="frm-input">
                  <input type="text" name="name" placeholder="Name" class="frm-inp" required><i class="fa fa-user frm-ico"></i>
               </div> 
               <div class="frm-input">
                  <input type="text" name="user_name" placeholder="Mobile or Email" class="frm-inp" required><i class="fa fa-user frm-ico"></i>
               </div>
               <div class="frm-input">
                  <input type="password" name="password" placeholder="Password" class="frm-inp" required><i class="fa fa-lock frm-ico"></i>
               </div>
               <button type="submit" name="submit" class="frm-submit">Register<i class="fa fa-arrow-circle-right"></i></button>
                <a href="login.php" class="a-link">Already have an account? Login</a>
            </div>
         </form>
      </div>
      <script src="admin/assets/js/jquery.min.js"></script>
      <script src="admin/assets/js/modernizr.min.js"></script>
      <script src="admin/assets/js/bootstrap.min.js"></script>
      <script src="admin/assets/js/nprogress.js"></script>
      <script src="admin/assets/js/waves.min.js"></script>
      <script src="admin/assets/js/main.min.js"></script>
<?php

require_once 'config/connection.php';
require_once 'functions/func-db.php';
if(isset($_POST['submit'])){
    $name=mysqli_real_escape_string($conn,$_POST['name']);
    $userName=mysqli_real_escape_string($conn,$_POST['user_name']);
    $password=mysqli_real_escape_string($conn,$_POST['password']);
    $checkLoginExists=dbQuery("SELECT * FROM `login` where user_name='".$userName."'");//check if already exists
    if(empty($checkLoginExists)){
       $mobileOrPhone= filter_var($userName, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';//find email or phone
       $createUser=mysqli_query($conn,"INSERT INTO `users`(name,".$mobileOrPhone.",created_at)values('".$name."','".$userName."','".date("Y-m-d h:i:s")."')");//create user
       if($createUser){
           $profileId=mysqli_insert_id($conn);//last inserted id
           $hashedPassword = password_hash($password, PASSWORD_DEFAULT);//hash password
           $createLoginUser=mysqli_query($conn,"INSERT INTO `login`(profile_id,user_name,password,display_name,created_at)values('".$profileId."','".$userName."','".$hashedPassword."','".$name."','".date("Y-m-d h:i:s")."')");
            if($createLoginUser){
                session_start();
                $_SESSION['welcome_message']="Welcome! You account has been created! Please login to continue";
                header("location:login.php");
            }
        }
    }else{
        echo "<script>alert('User already Exists')</script>";
    }
}
?>
</body>
</html>