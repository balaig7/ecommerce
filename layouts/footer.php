	<footer id="footer">
			<!-- top footer -->
			<div class="section">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<div class="col-md-4 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">About Us</h3>
								<!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut.</p> -->
								<ul class="footer-links">
									<li><a href="#"><i class="fa fa-map-marker"></i>1734 Stonecoal Road</a></li>
									<li><a href="#"><i class="fa fa-phone"></i>+021-95-51-84</a></li>
									<li><a href="#"><i class="fa fa-envelope-o"></i>email@email.com</a></li>
								</ul>
							</div>
						</div>

						<div class="col-md-4 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">QUICK LINK</h3>
								<ul class="footer-links">
									<li><a href="index.php">Home</a></li>
							<?php foreach(dbQuery('SELECT * from `category` where status="1"') as $value ) {?>
									<li><a href="products.php?category=<?=$value->name?>" target="_blank"><?=$value->name?></a></li>
							<?php } ?>
								</ul>
							</div>
						</div>

						<div class="clearfix visible-xs"></div>

						

						<div class="col-md-4 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Service</h3>
								<ul class="footer-links">
									<li><a href="#">My Account</a></li>
									<li><a href="cart.php">View Cart</a></li>
								<?php if(!empty($currentLoggedUserId)) {?>
									<li><a href="wishlist.php">Wishlist</a></li>
								<?php } ?>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>

			
		</footer>
		<!-- /FOOTER -->

		<!-- jQuery Plugins -->
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/slick.min.js"></script>
		<script src="assets/js/nouislider.min.js"></script>
		<script src="assets/js/jquery.zoom.min.js"></script>
		<script src="assets/js/main.js"></script>
		<script src="assets/js/sweetalert.min.js"></script>
		<script src="assets/js/custom.js"></script>
	</body>
</html>
