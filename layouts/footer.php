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
                     <li><a href="#"><i class="fa fa-map-marker"></i>43 Plane Road,Agastiar Patti</a></li>
                     <li><a href="#"><i class="fa fa-phone"></i>+91 9876543210</a></li>
                     <li><a href="#"><i class="fa fa-envelope-o"></i>e-accessories@gmail.com</a></li>
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
                     <li><a href="my-account.php">My Account</a></li>
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
<!-- register modal -->
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
               <input type="hidden" name="action" value="register">
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
	require_once "config/connection.php";
    require_once "functions/func-db.php";
	$data=array();
	$data=dbQuery("Select name as label,id from products");
	foreach ($data as $key => $value) {
		$value->value='content.php?id='.$value->id.'';
		unset($data[$key]->id);
	}
	$searchableValues=json_encode($data);					

?>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/slick.min.js"></script>
<script src="assets/js/nouislider.min.js"></script>
<script src="assets/js/jquery.zoom.min.js"></script>
<script src="assets/js/main.js"></script>
<script src="assets/js/sweetalert.min.js"></script>
<script src="assets/js/custom.js"></script>
<script src="assets/js/jquery-ui.js"></script>
<script>
$( function() {
	var source=<?=$searchableValues?>;
	$( "#search-product" ).autocomplete({
		
		source: source,
		select: function( event, ui ) { 
			window.location.href = ui.item.value;
		}
	});
});
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
               icon:  response.status,
			   confirmButtonColor: '#D10024',

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
				icon: response.status,
				confirmButtonColor: '#D10024',

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
	$('body').removeAttr('style');
}
</script>
</body>
</html>
