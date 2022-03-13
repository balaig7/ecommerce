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
									<!-- <li><a href="#">Laptops</a></li>
									<li><a href="#">Smartphones</a></li>
									<li><a href="#">Cameras</a></li>
									<li><a href="#">Accessories</a></li> -->
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
					<!-- /row -->
				</div>
				<!-- /container -->
			</div>
			<!-- /top footer -->

			
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
		<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js" ></script>
			<script src="assets/js/custom.js"></script>

	<?php
	// require_once "config/connection.php";
	// $productsNames=mysqli_query($conn,'SELECT name from `products`');
	// $data=array();
	// if($productsNames){
	// 	if(mysqli_num_rows($productsNames)>0){
	// 		while ($row=mysqli_fetch_assoc($productsNames)) {
	// 			$data[]=$row;			
	// 		}
	// 	}else{
	// 		echo "No Results found";
	// 	}
	// }
	// // $availableTags='';
	// foreach ($data as $key => $value) {
	// 	$availableTags.=("'".implode(" , ",addslashes($value))."'");
	// }
	// // echo "<pre>";
	// // print_r($data);
	// // echo $availableTags;
	// ?>
		<script>
	$("#search-product").bind("change paste keyup", function() {
		// alert('hi')
    var availableTags = [
      "ActionScript",
      "AppleScript",
      "Asp",
      "BASIC",
      "C",
      "C++",
      "Clojure",
      "COBOL",
      "ColdFusion",
      "Erlang",
      "Fortran",
      "Groovy",
      "Haskell",
      "Java",
      "JavaScript",
      "Lisp",
      "Perl",
      "PHP",
      "Python",
      "Ruby",
      "Scala",
      "Scheme"
    ];
	
    $( this ).autocomplete({
      source: availableTags
    });
  } );
</script>



	</body>
</html>
