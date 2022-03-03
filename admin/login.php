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

</head>

<body>

<div id="single-wrapper">
	<form action="login.php" class="frm-single" method="post">
		<div class="inside">
			<div class="title"><strong>E - ACCESSORIES</strong></div>
			<!-- /.title -->
			<div class="frm-title">Login</div>
			<!-- /.frm-title -->
			<div class="frm-input"><input type="text" name="user_name" placeholder="User Name" class="frm-inp"><i class="fa fa-user frm-ico"></i></div>
			<!-- /.frm-input -->
			<div class="frm-input"><input type="password" name="password" placeholder="Password" class="frm-inp"><i class="fa fa-lock frm-ico"></i></div>
			<!-- /.frm-input -->
			
			<!-- /.clearfix -->
			<button type="submit" name="submit" class="frm-submit">Login<i class="fa fa-arrow-circle-right"></i></button>
		</div>
		<!-- .inside -->
	</form>
	<!-- /.frm-single -->
</div><!--/#single-wrapper -->
<?php
require_once 'config/connection.php';
session_start(); 
if(isset($_POST['submit'])){
    $userName=mysqli_real_escape_string($conn,$_POST['user_name']);
    $password=mysqli_real_escape_string($conn,$_POST['password']);
    $query="SELECT * FROM `login` where user_name='".$userName."'";
    $result=mysqli_query($conn,$query);
    if(mysqli_num_rows($result)>0){
        $userData=mysqli_fetch_assoc($result);
        if (password_verify($password, $userData['password'])) {
            //  $_SESSION['userDetails']=$userData;
             print_r($userData);
             exit;
        }

       
    }else{

    }
}
?>
	
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/modernizr.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/nprogress.js"></script>
	<script src="assets/js/waves.min.js"></script>

	<script src="assets/js/main.min.js"></script>
</body>
</html>