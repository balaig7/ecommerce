<?php
   include __DIR__."/loader.php";
   $userDetails=$_SESSION['current_user'];
   // echo "<pre>";
   // print_r($_SESSION);
?>
<style>
   .nav-pills>li.active>a,.update{
   background-color: #D10024!important;
   }
   .update,.update:hover{
   color:#fff;
   }
   .update:hover{
   opacity: 0.9;
   }
   .panel-heading a::after {
   content: "";
   border: solid black;
   border-width: 0 3px 3px 0;
   display: inline-block;
   padding: 5px;
   position: absolute;
   right: 0;
   top: 0;
   transform: rotate(45deg);
   }
   .panel-heading a {
   display: block;
   position: relative;
   font-weight: bold;
   &::after {
   content: "";
   border: solid black;
   border-width: 0 3px 3px 0;
   display: inline-block;
   padding: 5px;
   position: absolute;
   right: 0;
   top: 0;
   transform: rotate(45deg);
   }
   &[aria-expanded="true"]::after {
   transform: rotate(-135deg);
   top: 5px;
   }
   }
</style>
<div class="section">
   <div class="container">
      <div class="col-md-12">
         <?php if($_SESSION['active'] =='1' ){ ?>
         <!-- tabs left -->
         <div class="tabbable">
            <ul class="nav nav-pills nav-stacked col-md-3">
               <li class="active"><a href="#account" data-toggle="tab">Account</a></li>
               <li><a href="#resetpassword" data-toggle="tab">Reset Password</a></li>
               <li ><a href="#orders" data-toggle="tab">Orders</a></li>
               <li><a href="logout.php" >Logout</a></li>
            </ul>
            <div class="tab-content col-md-9">
               <div class="tab-pane active" id="account">
                  <form>
                     <div class="form-group col-md-12">
                        <label>Username</label>
                        <input type="text" class="form-control" value="<?=$userDetails['user_name']?>" >
                     </div>
                     <div class="form-group col-md-12">
                        <label>Address</label>
                        <input type="text" class="form-control" value="<?=$userDetails['address']?>" >
                     </div>
                     <div class="form-row">
                        <div class="form-group col-md-6">
                           <label>City</label>
                           <input type="text" class="form-control" value="<?=$userDetails['city']?>">
                        </div>
                        <div class="form-group col-md-6">
                           <label>Country</label>
                           <input type="text" class="form-control" value="<?=$userDetails['country']?>">
                        </div>
                     </div>
                     <div class="form-group col-md-12">
                        <button type="submit" class="btn update">Update</button>
                     </div>
                  </form>
               </div>
               <div class="tab-pane" id="resetpassword">
                  <form method="post" id="reset-password">
                     <div class="form-group col-md-12">
                        <label>New Password</label>
                        <input type="password" name='new_password' class="form-control">
                        <input type="hidden" name='action' value="change_password" class="form-control">
                     </div>
                     <div class="form-group col-md-12">
                        <button type="button" class="btn update" onclick="changePassword()">Change Password</button>
                     </div>
                  </form>
               </div>
               <div class="tab-pane" id="orders">
                  <?php foreach ($_SESSION['cart']['old_orders'] as $key => $value) {
                   switch ($value['status']) {
                        case '1':
                           $status="New";
                           $pillClass='primary';
                           break;
                        case '2':
                           $pillClass='warning';
                           $status="Processing";
                           break;
                        case '3':
                           $status="Cancelled";
                           $pillClass='danger';
                           break;
                        case '4':
                           $status="Completed";
                           $pillClass='success';
                           break;
                        default:
                           # code...
                           break;
                     }    
                  ?>
                  <div class="panel-group" id="accordion">
                     <div class="panel panel-default">
                        <div class="panel-heading">
                           <h4 class="panel-title">
                              <a data-toggle="collapse" data-parent="#accordion" href="#collapse-<?=$key?>">#<?=$value['invoice_id']."(".strtoupper($status).")"?> </a>
                              
                           </h4>
                        </div>
                        <div id="collapse-<?=$key?>" class="panel-collapse collapse">
                           <div class="panel-body">
                                 <div class="col-md-12">
                                      <table class="table table-hover">
                                          <thead>
                                             <tr>
                                             <th>S.no</th>
                                             <th>Items</th>
                                             <th>Quantity</th>
                                             <th>Price</th>
                                             <th>Subtotal</th>
                                             </tr>
                                          </thead>
                                          <tbody>
                                             <?php foreach ($value['order_details'] as $orderDetailsKey => $orderDetailsvalue) { ?>
                                                <tr>
                                                   <td><?=$orderDetailsKey+1?></td>
                                                   <td><?=$orderDetailsvalue['product_name']?></td>
                                                   <td><?=$orderDetailsvalue['quantity']?></td>
                                                   <td><?=$orderDetailsvalue['product_price']?></td>
                                                   <td><?=$orderDetailsvalue['sub_total']?></td>
                                                </tr>
                                             <?php } ?>
                                             <tr>
                                                   <td></td>
                                                   <td></td>
                                                   <td></td>
                                                   <td>Total</td>
                                                   <td><?=$value['total']?></td>
                                                </tr>
                                          </tbody>
                                       </table>
                                 </div>
                           </div>
                        </div>
                     </div>
                  </div>
                                       <?php  } ?>

               </div>
            </div>
         </div>
         <!-- /tabs -->
         <?php }else{ ?>
         <h4  style="text-align: center;">
         Please <a class="text-danger" href="login.php">Login</a> to Continue
         <h4>
         <?php } ?>
      </div>
   </div>
</div>
<hr>
<?php
   include __DIR__."/layouts/footer.php";
?>
<script>
function changePassword(){
   	$.ajax({
		url:"change-password.php",
		type:"post",
		data:$('#reset-password').serialize(),
		success:function(data){
			var response = $.parseJSON(data);
			if(response.status=='success'){
				Swal.fire({
                   title: response.message,
                    text:'',
                    icon:'success'
				}).then(function (result) {
     				if (result.value) {
						location.reload();
     				}
   				});

		
			}else{
				Swal.fire(
                    response.message,
                    '',
                    'error'
                )
			}

		}
	})
}

</script>