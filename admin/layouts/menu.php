<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title><?=$title?> | E-ACCESSORIES</title>

	<!-- Main Styles -->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/css/nprogress.css">
		<link rel="stylesheet" href="assets/css/font-awesome.min.css">

		<link rel="stylesheet" href="assets/css/style.min.css">

	<!-- mCustomScrollbar -->
	<link rel="stylesheet" href="assets/css/jquery.mCustomScrollbar.min.css">

	<!-- Waves Effect -->
	<link rel="stylesheet" href="assets/css/waves.min.css">

	<!-- Sweet Alert -->
	<link rel="stylesheet" href="assets/css/sweetalert.css">
	<link rel="stylesheet" href="assets/css/dataTables.bootstrap.min.css">

	<!-- Color Picker -->
	<!-- <link rel="stylesheet" href="assets/color-switcher/color-switcher.min.css"> -->
	


</head>

<body>
<div class="main-menu">
	<header class="header">
		<a href="index.html" class="logo">E-ACCESSORIES</a>
		<button type="button" class="button-close fa fa-times js__menu_close"></button>
		<div class="user">
			<a href="#" class="avatar"><img src="assets/img/avatar.png" alt=""><span class="status online"></span></a>
			<h5 class="name"><?=$_SESSION['current_user']['display_name']?></h5>
			<div class="control-wrap js__drop_down">
				<i class="fa fa-caret-down js__drop_down_button"></i>
				<div class="control-list">
					<div class="control-item"><a href="#"><i class="fa fa-user"></i> Profile</a></div>
					<div class="control-item"><a href="logout.php"><i class="fa fa-sign-out"></i> Log out</a></div>
				</div>
				<!-- /.control-list -->
			</div>
			<!-- /.control-wrap -->
		</div>
		<!-- /.user -->
	</header>
	<!-- /.header -->
	<div class="content">

		<div class="navigation">
			<!-- <h5 class="title">Navigation</h5> -->
			<!-- /.title -->
			<ul class="menu js__accordion">
				<li>
					<a class="waves-effect" href="index.php"><i class="menu-icon fa fa-home"></i><span>Dashboard</span></a>
				</li>
				<li>
					<a class="waves-effect" href="products.php"><i class="menu-icon fa fa-shopping-basket"></i><span>Products</span></a>
				</li>
			</ul>
			<!-- /.menu js__accordion -->
			
				
			<!-- /.menu js__accordion -->
		</div>
		<!-- /.navigation -->
	</div>
	<!-- /.content -->
</div>