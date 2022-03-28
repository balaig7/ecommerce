<?php
   include __DIR__."/loader.php";
   // echo "<pre>";
   // print_r($_SESSION);
   // echo $invoiceId=time() . mt_rand() .$currentLoggedUserId;
?>
<style>
.btn-danger{
   color: #fff;
   background-color: #D10024;
   border-color: #D10024;
}
.login-modal{
	width:100%!important;
}
.order-submit{
   font-weight: 500;
   text-transform: unset!important;
   font-size: 18px;
}
.primary-btn{
	background-color:#2C2E2F!important;
}
</style>
<div class="section">
   <div class="container">
      <div class="row">
            <!-- Order Details -->
            <div class="col-md-12 order-details">
               <div class="section-title text-center">
                  <h3 class="title">Your Order</h3>
               </div>
               <div class="order-summary" style="border-bottom: 1px solid #E4E7ED;">
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
                     <div><strong class="order-total" data-total=""><span>$</span><span class="total-amount"><?=number_format($_SESSION['cart']['total'],2)?></span></strong></div>
                  </div>
               </div>
               <label>Payment Method</label>
               <div class="payment-method">
                  <div class="input-radio">
                  	<input type="radio" name="payment" class="payment-type" checked value="cod" id="payment-1">
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
                  </div>
               <?php if($_SESSION['active']=='1'){ ?>
                  <div id="paypal-payment-button" style="text-align:center">
                  </div>
                  <div style="text-align:-webkit-center" class="cod">
                  	<a href="#" class="primary-btn order-submit" style="width: 68%;padding: 15px;"  data-toggle="modal" data-target="#billing-details" data-dismiss="modal">Buy Now</a>
                  </div>
               <?php }else{ ?>
               <a href="#" class="primary-btn login-modal" data-toggle="modal" data-target="#loginModal">Please Login To Continue</a>
               <?php } ?>
            </div>
         <!-- </form> -->
      </div>
   </div>
</div>
<div class="modal fade" id="billing-details" tabindex="-1" role="dialog" aria-labelledby="billing-details" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="myFunction()">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Billing address</h4>
         </div>
         <form class="billing-details-form" method="post">
            <div class="modal-body">
               <div class="form-group">
               		<input class="input" type="text" name="first-name" placeholder="First Name">
               	</div>
               	<div class="form-group">
               		<input class="input" type="text" name="last-name" placeholder="Last Name">
               	</div>
               	<div class="form-group">
               		<input class="input" type="email" name="email" placeholder="Email">
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
               		<input class="input" type="text" name="zipcode" placeholder="ZIP Code">
               	</div>
			      </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal" onclick="myFunction()">Cancel</button>
               <button type="button" class="btn btn-danger login" onclick="checkout($('.billing-details-form').serialize())">Place Order</button>
            </div>
		</form>
      </div>
   </div>
</div>
<?php
   include __DIR__."/layouts/footer.php";
   ?>
   <script src="https://www.paypal.com/sdk/js?client-id=AbsPhIWImWuMO_GM8eH3pb1xkKid3s5oHK1h-zGdsRKGaISorl7Z2-xiQRUiOcvDjtH7q9_d3fE0wsP0&disable-funding=credit,card&buyer-country=US" data-page-type="product-details"></script>
<script>
   paymentMethod();
   function paymentMethod(){
      var checked= $('input[name="payment"]:checked').val();
      if(checked=='cod'){
         $('#paypal-payment-button').css('display','none')
         $('.cod').css('display','block')
      }else{
         $('.cod').css('display','none')
         $('#paypal-payment-button').css('display','block')
      }
   }
   $(document).on('change','.payment-type',function(){
     paymentMethod()
   })
   paypal.Buttons({
      style : {
        color: 'black',
        shape: 'pill',
        label: 'buynow',
        height:55

    },
    createOrder: function (data, actions) {
        return actions.order.create({
            purchase_units : [{
               amount: {
                    value: $('.total-amount').text()
                }
               }]
            });
         },
    onApprove: function (data, actions) {
        return actions.order.capture().then(function (details) {
           console.log(details)
           $.ajax({
            'url':"endpoint.php",
            'data': JSON.stringify(details), //{action:'x',params:['a','b','c']}
            'type': 'POST',
            'processData': false,
            'contentType': 'application/json', //typically 'application/x-www-form-urlencoded', but the service you are calling may expect 'text/json'... check with the service to see what they expect as content-type in the HTTP header.
            success:function(data){
               var response=JSON.parse(data)
               if(response.status=='success'){
                  window.location = response.redirectUrl
               }
            }   
          });
        })
      },
      onCancel: function (data) {
         // window.location.replace("cancel.php")
      }
   }).render('#paypal-payment-button');

   function checkout(data) {
      $.ajax({
         url:"cod.php",
         data: data, //{action:'x',params:['a','b','c']}
         type: 'POST',
         success:function(data){
            var response=JSON.parse(data)
            if(response.status=='success'){
               window.location = response.redirectUrl
            }
         }   
      });
   }
</script>