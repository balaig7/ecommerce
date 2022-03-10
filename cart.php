<?php
include __DIR__."/loader.php";
// echo "<pre>";
// print_r($_SESSION['cart']['products']);
$grandTotal=0;
$sessionCart=$_SESSION['cart']['products'];
?>
<style>
   .table>tbody>tr>td, .table>tfoot>tr>td{
   vertical-align: middle;
   }
   @media screen and (max-width: 600px) {
   table#cart tbody td .form-control{
   width:20%;
   display: inline !important;
   }
   .actions .btn{
   width:36%;
   margin:1.5em 0;
   }
   .actions .btn-info{
   float:left;
   }
   .actions .btn-danger{
   float:right;
   }
   table#cart thead { display: none; }
   table#cart tbody td { display: block; padding: .6rem; min-width:320px;}
   table#cart tbody tr td:first-child { background: #333; color: #fff; }
   table#cart tbody td:before {
   content: attr(data-th); font-weight: bold;
   display: inline-block; width: 8rem;
   }
   table#cart tfoot td{display:block; }
   table#cart tfoot td .btn{display:block;}
   }
   .cart-label{
       margin-bottom:50px;
   }
   td.empty-cart{
       padding:26px!important;
   }
   /* .swal2-styled.swal2-confirm{

	background-color:#D10024!important;
} */
</style>
<div class="section">
    <div class="container">
       <h2 class="cart-label">Shopping Cart</h2>
      <table id="cart" class="table table-hover table-condensed">
         <thead>
            <tr>
               <th style="width:50%">Product</th>
               <th style="width:10%">Price</th>
               <th style="width:8%">Quantity</th>
               <th style="width:22%" class="text-center">Subtotal</th>
               <th style="width:10%"></th>
            </tr>
         </thead>
         <tbody>
             <?php  if(!empty($sessionCart)){ ?>
             <?php foreach($sessionCart as $key => $value){ $grandTotal+=$value['discounted_price']*$value['quantity']; ?>
            <tr>
               <td data-th="Product">
                  <div class="row">
                     <div class="col-sm-2 hidden-xs"><img src="<?=str_replace("../",'',$value['thumnail_image_path']).$value['thumnail_image']?>"  class="img-responsive"/></div>
                     <div class="col-sm-10">
                        <p><?=$value['name']?></p>
                     </div>
                  </div>
               </td>
               <td data-th="Price">$<?=$value['discounted_price']?></td>
               <td data-th="Quantity">
                  <input type="number" class="form-control text-center" value="<?=$value['quantity']?>">
               </td>
               <td data-th="Subtotal" class="text-center">$<?=number_format(($value['discounted_price']*$value['quantity']),2)?></td>
               <td class="actions">
                   <!-- <button class="btn btn-info btn-sm"><i class="fa fa-refresh"></i></button> -->
                   <button class="btn btn-danger btn-sm" onclick="removeProductFromCart('<?=$value['product_id']?>','remove-product-from-cart')"><i class="fa fa-trash-o"></i></button>								
                </td>
            </tr>
            <?php }?>  
            <?php }else{?>  
                <td class="empty-cart text-center" colspan="5" class="text-center">No Product in the cart</td>

            <?php }?>  
         </tbody>
         <tfoot>
            <!-- <tr class="visible-xs">
               <td class="text-center"><strong>Total 1.99</strong></td>
            </tr> -->
            <tr>
               <td><a href="#" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
               <td colspan="2" class="hidden-xs"></td>
               <td class="hidden-xs text-center"><strong>Total $<?=number_format($grandTotal,2)?></strong></td>
             <?php  if(!empty($sessionCart)){ ?>
               <td><a href="#" class="btn btn-success btn-block">Checkout <i class="fa fa-angle-right"></i></a></td>
            <?php }else{ ?>
                <td></td>
            <?php }?>  

            </tr>
         </tfoot>
      </table>
   </div>
</div>
<?php
include __DIR__."/layouts/footer.php";
?>
<script>
    function removeProductFromCart(product,mode){
Swal.fire({
  title: 'Are you sure to remove this product from your cart?',
  text: "",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes'
}).then((result) => {
  if (result.isConfirmed) {
        $.ajax({
		url:"cart-core.php",
		type:"post",
		data:{
            product:product,
            mode:mode
        },
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
}else{

}
    })
    }
</script>