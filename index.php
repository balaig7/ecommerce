<?php
include __DIR__."/loader.php";
$category=dbQuery("SELECT * FROM `category` WHERE status='1'");
?>
       <div class="loader-img"></div>

<!-- HOT DEAL SECTION -->
		<div id="hot-deal" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<div class="hot-deal">
							<ul class="hot-deal-countdown">
								<li>
									<div>
										<h3>02</h3>
										<span>Days</span>
									</div>
								</li>
								<li>
									<div>
										<h3>10</h3>
										<span>Hours</span>
									</div>
								</li>
								<li>
									<div>
										<h3>34</h3>
										<span>Mins</span>
									</div>
								</li>
								<li>
									<div>
										<h3>60</h3>
										<span>Secs</span>
									</div>
								</li>
							</ul>
							<h2 class="text-uppercase">hot deal this week</h2>
							<p>New Collection Up to 50% OFF</p>
							<a class="primary-btn cta-btn" href="#">Shop now</a>
						</div>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /HOT DEAL SECTION -->

		<div class="section">
			<div class="container">
				<div class="row">
				<?php foreach ($category as $key => $value) {
					 $products=dbQuery("SELECT * FROM `products` WHERE status='1' and parent_category_id=".$value->id."");
					if(count($products)>5){
				?>
				
					<!-- section title -->
					<div class="col-md-12">
						<div class="section-title">
							<h3 class="title"><?=$value->name?></h3>
						</div>
					</div>

					<div class="col-md-12">
						<div class="row">
							<div class="products-tabs">
								<div id="tab1" class="tab-pane active">
									<div class="products-slick" data-nav="#slick-nav-1">
						<?php  foreach ($products as $productKey => $productValue) { ?>
							<div class="product">
								<form method="post" class="form-<?=$productKey?>">
									<input type="hidden" name="product_id" value='<?=$productValue->id ?>'>
									<input type="hidden" name="mode" value="add-to-cart">
									<input type="hidden" name="quantity" value="1">
									<div class="product-img">
										<img src="<?=str_replace("../", '', $productValue->thumnail_image_path) . $productValue->thumnail_image ?>" alt="">
									</div>
									<div class="product-body">
										<h3 class="product-name"><a href="content.php?id=<?=$productValue->id ?>"><?=$productValue->name ?></a></h3>
										<h4 class="product-price">$<?=$productValue->discounted_price ?> <del class="product-old-price">$<?=$productValue->original_price ?></del></h4>
										<div class="product-rating">
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
										</div>
										<?php if(!empty($currentLoggedUserId)) {?>
										<div class="product-btns">
											<button class="add-to-wishlist" type="button" onclick="addToWishlist('<?=$productValue->id ?>')"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
										</div>
										<?php } ?>
									</div>
									<div class="add-to-cart">
									<button class="add-to-cart-btn" type="button" data-id="<?=$productValue->id?>" onclick="addToCart($('.form-<?=$productKey?>').serialize())"><i class="fa fa-shopping-cart"></i> add to cart</button>
									</div>
								</form>
							</div>

										<?php }?>				
									</div>
									<div id="slick-nav-<?=$key+1?>" class="products-slick-nav"></div>
								</div>
							</div>
								<!-- /tab -->
							</div>

						</div>
					<!-- </div>
						</div>
					</div> -->
				<?php }}?>				

				</div>
				
			</div>
		</div>
<?php
include __DIR__."/layouts/footer.php";
?>
