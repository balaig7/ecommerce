<?php
include __DIR__."/loader.php";
?>
<style>
    .order-submit{
        width:100%!important;
    }
</style>
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
                    <form class="check-out" action="<?=$paypalUrl?>" method="post">
                    						    <input type="hidden" name="business" value="<?php echo $paypalId; ?>">
						    <input type="hidden" name="cmd" value="_xclick">
						    <input type="hidden" name="item_name" value="Samsung">
						    <input type="hidden" name="item_number" value="2">
						    <input type="hidden" name="amount" value="<?=number_format($_SESSION['cart']['total'],2)?>">
						    <input type="hidden" name="no_shipping" value="1">
						    <input type="hidden" name="currency_code" value="USD">
						    <input type="hidden" name="cancel_return" value="<?="http://".$_SERVER['HTTP_HOST']?>/cancel.php">
						    <input type="hidden" name="return" value="<?="http://".$_SERVER['HTTP_HOST']?>/success.php">  

					<div class="col-md-7">
						<!-- Billing Details -->
						<div class="billing-details">
							<div class="section-title">
								<h3 class="title">Billing address</h3>
							</div>
							<div class="form-group">
								<input class="input" type="text" name="first-name" placeholder="First Name">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="last-name" placeholder="Last Name">
							</div>
							<div class="form-group">
								<input class="input" type="email" name="email" placeholder="Email or Phone">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="address" placeholder="Address">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="city" placeholder="City">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="country" placeholder="Country">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="zip-code" placeholder="ZIP Code">
							</div>
							<div class="form-group">
								<input class="input" type="tel" name="tel" placeholder="Telephone">
							</div>
							<div class="form-group">
								<div class="input-checkbox">
									<input type="checkbox" id="create-account">
									<label for="create-account">
										<span></span>
										Create Account?
									</label>
									<div class="caption">
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p>
										<input class="input" type="password" name="password" placeholder="Enter Your Password">
									</div>
								</div>
							</div>
						</div>
						<!-- /Billing Details -->
					</div>

					<!-- Order Details -->
					<div class="col-md-5 order-details">
						<div class="section-title text-center">
							<h3 class="title">Your Order</h3>
						</div>
						<div class="order-summary">
							<div class="order-col">
								<div><strong>PRODUCT</strong></div>
								<div><strong>TOTAL</strong></div>
							</div>
							<div class="order-products">
                                <?php foreach ($_SESSION['cart']['products'] as $key => $value) { ?>
								<div class="order-col">
									<div><?=$value['quantity']?> x <?=$value['name']?></div>
									<div>$<?=number_format($value['quantity']*$value['discounted_price'],2)?></div>
								</div>
                                <?php } ?>
								
							</div>
							
							<div class="order-col">
								<div><strong>TOTAL</strong></div>
								<div><strong class="order-total">$<?=number_format($_SESSION['cart']['total'],2)?></strong></div>
							</div>
						</div>
						<div class="payment-method">
							<div class="input-radio">
								<input type="radio" name="payment" id="payment-2">
								<label for="payment-2">
									<span></span>
									Cash On Delievery
								</label>
								
							</div>
							<div class="input-radio">
								<input type="radio" name="payment" id="payment-3">
								<label for="payment-3">
									<span></span>
									Credit / Debit Cards
								</label>
							</div>
						</div>
						<button href="#"  class="primary-btn order-submit">Place order</button>
					</div>
				
                                </form>
                </div>
			</div>
		</div>
<?php
include __DIR__."/layouts/footer.php";
?>

