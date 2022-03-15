<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>E - ACCESSORIES</title>
 		<!-- Google font -->
 		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">
 		<!-- Bootstrap -->
 		<link type="text/css" rel="stylesheet" href="assets/css/bootstrap.min.css"/>
 		<link type="text/css" rel="stylesheet" href="assets/css/slick.css"/>
 		<link type="text/css" rel="stylesheet" href="assets/css/slick-theme.css"/>
 		<link type="text/css" rel="stylesheet" href="assets/css/nouislider.min.css"/>
 		<link rel="stylesheet" href="assets/css/font-awesome.min.css">
 		<link type="text/css" rel="stylesheet" href="assets/css/style.css"/>
		<link rel="stylesheet" href="assets/css/sweetalert.css">
	<style>
	.loader-img{
   		display:none;  
		position: fixed;
		left: 0px;
		top: 0px;
		width: 100%;
		height: 100%;
		z-index: 9999;
		background: url('assets/img/loader.gif') 
		50% 50% no-repeat rgb(255,255,255);
     }
	</style>
    </head>
	<body>
		<!-- HEADER -->
		<header>
			<!-- TOP HEADER -->
			<div id="top-header">
				<div class="container">
					<ul class="header-links pull-right">
						<li>
							<?=$isUserActive ? '<a href="my-account.php"><i class="fa fa-user-o"></i> My Account</a>' : '<a href="login.php"><i class="fa fa-user-o"></i>Login</a>' ?>
						</li>
					</ul>
				</div>
			</div>
			<!-- /TOP HEADER -->

			<!-- MAIN HEADER -->
			<div id="header">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<!-- LOGO -->
						<div class="col-md-3">
							<div class="header-logo">
								<a href="#" class="logo">
									<!-- <img src="./img/logo.png" alt=""> -->
									<h2 style="color:#fff">E-ACCESSORIES</h2>
								</a>
							</div>
						</div>
						<!-- /LOGO -->

						<!-- SEARCH BAR -->
						<div class="col-md-6 text-center">
							<div class="header-search">
								<form>
									
									<input class="input" id="search-product" placeholder="Search here">
									<button class="search-btn">Search</button>
								</form>
							</div>
						</div>
						<!-- /SEARCH BAR -->

						<!-- ACCOUNT -->
						<div class="col-md-3 clearfix">
							<div class="header-ctn">
								<!-- Wishlist -->
								<?php if(!empty($currentLoggedUserId)) {?>
								
								<div>
									<a href="wishlist.php">
										<i class="fa fa-heart-o"></i>
										<span>Your Wishlist</span>
										<div class="qty"><?=count($_SESSION['cart']['wishlist']) ?></div>
									</a>
								</div>
								<?php } ?>
								<!-- /Wishlist -->

								<!-- Cart -->
								<div class="dropdown">
									<a  href="cart.php" aria-expanded="true">
										<i class="fa fa-shopping-cart"></i>
										<span>Your Cart</span>
										<div class="qty"><?=empty($_SESSION['cart']['products']) ? '0' : count($_SESSION['cart']['products'])?></div>
									</a>
									<div class="cart-dropdown">
										<div class="cart-list">
											<div class="product-widget">
												<div class="product-img">
													<img src="./img/product01.png" alt="">
												</div>
												<div class="product-body">
													<h3 class="product-name"><a href="#">product name goes here</a></h3>
													<h4 class="product-price"><span class="qty">1x</span>$980.00</h4>
												</div>
												<button class="delete"><i class="fa fa-close"></i></button>
											</div>

											<div class="product-widget">
												<div class="product-img">
													<img src="./img/product02.png" alt="">
												</div>
												<div class="product-body">
													<h3 class="product-name"><a href="#">product name goes here</a></h3>
													<h4 class="product-price"><span class="qty">3x</span>$980.00</h4>
												</div>
												<button class="delete"><i class="fa fa-close"></i></button>
											</div>
										</div>
										<div class="cart-summary">
											<small>3 Item(s) selected</small>
											<h5>SUBTOTAL: $2940.00</h5>
										</div>
										<div class="cart-btns">
											<a href="#">View Cart</a>
											<a href="#">Checkout  <i class="fa fa-arrow-circle-right"></i></a>
										</div>
									</div>
								</div>
								<!-- /Cart -->

								<!-- Menu Toogle -->
								<div class="menu-toggle">
									<a href="#">
										<i class="fa fa-bars"></i>
										<span>Menu</span>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</header>
		<!-- /HEADER -->

		<!-- NAVIGATION -->
		<nav id="navigation">
			<!-- container -->
			<div class="container">
				<!-- responsive-nav -->
				<div id="responsive-nav">
					<!-- NAV -->
					<ul class="main-nav nav navbar-nav">
						<li class="active"><a href="index.php">Home</a></li>
						<?php foreach(dbQuery('SELECT * from `category` where status="1"') as $value ) {?>
						<li><a href="products.php?category=<?=$value->name?>"><?=$value->name?></a></li>
						<?php } ?>
						
					</ul>
				</div>
			</div>
		</nav>
