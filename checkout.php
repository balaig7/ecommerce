<?php
   include __DIR__."/loader.php";
   echo "<pre>";
   print_r($_SESSION);
?>
<style>
.order-submit,.login-modal{
	width:100%!important;
}
.btn-danger{
	background-color:#D10024!important;
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
            <input type="hidden" name="no_shipping" value="1">
            <?php foreach ($_SESSION['cart']['products'] as $key => $value) { ?>
            <!-- <div><?=$value['quantity']?> x <?=$value['name']?></div> -->
            <input type="hidden" name="item_name" value="<?=$value['name']?>">
            <input type="hidden" name="item_number" value="<?=$value['quantity']?>">
            <!-- <div>$<?=number_format($value['quantity']*$value['discounted_price'],2)?></div> -->
            <?php } ?>
            <!-- <input type="hidden" name="item_name" value="Samsung"> -->
            <input type="hidden" name="amount" value="<?=number_format($_SESSION['cart']['total'],2)?>">
            <input type="hidden" name="NO_SHIPPING" value="1">
            <input type="hidden" name="currency_code" value="USD">
            <input type="hidden" name="cancel_return" value="<?="http://".$_SERVER['HTTP_HOST']?>/cancel.php">
            <input type="hidden" name="return" value="<?="http://".$_SERVER['HTTP_HOST']?>/success.php">  
            <!-- <div class="col-md-7">
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
               		<input class="input" type="password" name="password" placeholder="Enter Your Password">
               	</div>
               </div>
               </div> -->
            <!-- Order Details -->
            <div class="col-md-12 order-details">
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
               <!-- <div class="payment-method">
                  <div class="input-radio">
                  	<input type="radio" name="payment" class="payment-type" value="cod" id="payment-1">
                  	<label for="payment-1">
                  		<span></span>
                  		Cash On Delievery
                  	</label>
                  	
                  </div>
                  <div class="input-radio">
                  	<input type="radio" name="payment" value="card" class="payment-type" id="payment-2">
                  	<label for="payment-2">
                  		<span></span>
                  		Credit / Debit Cards
                  	</label>
                  </div>
                  </div> -->
               <?php if($_SESSION['active']=='1'){ ?>
               <button class="primary-btn order-submit">Place order</button>
               <?php }else{ ?>
               <a href="#" class="primary-btn login-modal" data-toggle="modal" data-target="#loginModal">Please Login To Continue</a>
               <?php } ?>
            </div>
         </form>
      </div>
   </div>
</div>
<!-- modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModal" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="myFunction()">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Login</h4>
         </div>
		 <form class="login-form" method="post">
         <div class="modal-body">
               <div class="form-group">
                  <label>User Name</label>
                  <input type="text" class="form-control" name="user_name">
               </div>
			    <input type="hidden" class="form-control" name="action" value="login">
               <div class="form-group">
                  <label >Password</label>
                  <input type="password" class="form-control" name="password">
               </div>
			   <div>
					<a href="#"  data-toggle="modal" data-target="#registerModal" data-dismiss="modal">New to E-ACCESSORIES? Register</a>
			   </div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal" onclick="myFunction()">Close</button>
				<button type="button" class="btn btn-danger login" onclick="loginRegister($('.login-form').serialize())">Login</button>
			</div>
		</form>
      </div>
   </div>
</div>

<!-- register module -->
<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModal" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="myFunction()">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Register</h4>
         </div>
		 <form class="register-form" method="post">
         <div class="modal-body">
			 <div class="form-group">
                  <label>Name</label>
                  <input type="text" name="name" class="form-control">
               </div>
               <div class="form-group">
                  <label>Mobile or Email</label>
                  <input type="text" name="user_name" class="form-control">
               </div>
			   	<input type="hidden" class="form-control" name="action" value="register">
               <div class="form-group">
                  <label >Password</label>
                  <input type="password" name="password" class="form-control">
               </div>

			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal" onclick="myFunction()">Close</button>
				<button type="button" class="btn btn-danger register" onclick="loginRegister($('.register-form').serialize())">Register</button>
			</div>
		</div>
	</form>
   </div>
   </div>
</div>
<?php
   include __DIR__."/layouts/footer.php";
?>
<script>
function loginRegister(data){
console.log(data)
$.ajax({
	url:"checkout-login.php",
	type:"post",
	data:data,
	success:function(data){
		var response=$.parseJSON(data);
		if(response.status=='success'){
         if(response.message=='Login success'){
            location.reload();
         }else{

            
            Swal.fire({
               title: response.message,
               text: '',
               icon: 'success'
            }).then(function(result) {
               if (result.value) {
                  location.reload();
               }
            });
         }
		}else{
			Swal.fire({
				title: response.message,
				text: '',
				icon: 'error'
			}).then(function(result) {
				if (result.value) {
					location.reload();
				}
			});
		}
	}

})
}
function myFunction() {
    $('form').trigger('reset');
}

</script>