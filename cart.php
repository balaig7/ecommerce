<?php
include __DIR__."/loader.php";
$sessionCart=$_SESSION['cart']['products'];
// echo "<pre>";
// print_r($_SESSION);
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
</style>
<div class="section">
    <div class="container">
       <h2 class="cart-label">SHOPPING CART</h2>
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
             <?php foreach($sessionCart as $key => $value){  ?>
            <tr>
               <input type="hidden" class="session_product_id" value="<?=$value['id']?>">
               <td data-th="Product">
                  <div class="row">
                     <div class="col-sm-2 hidden-xs"><img src="<?=str_replace("../",'',$value['thumnail_image_path']).$value['thumnail_image']?>"  class="img-responsive"/></div>
                     <div class="col-sm-10">
                        <p><?=$value['name']?></p>
                     </div>
                  </div>
               </td>
               <td data-th="Price" class="product-price" data-price="<?=$value['discounted_price']?>">$<?=$value['discounted_price']?></td>
               <td data-th="Quantity">
                  <!-- <input type="number" class="form-control text-center quantity" min="1" max="<?=$value['quantity_in_stock']?>" value="<?=$value['quantity']?>"> -->
                  <div class="input-number price-min">
                     <input id="price-min" class="quantity" type="number" min="1" max="<?=$value['quantity_in_stock']?>" value="<?=$value['quantity']?>">
							<span class="qty-up">+</span>
							<span class="qty-down">-</span>
						</div>
               </td>
               <!-- <input type="hidden" class="sub_total" value="<?=number_format(($value['discounted_price']*$value['quantity']),2)?>"> -->
               <td data-th="Subtotal" class="text-center sub-total">$<?=number_format(($value['discounted_price']*$value['quantity']),2)?></td>
               <td class="actions">
                  <!-- <button class="btn btn-info btn-sm"><i class="fa fa-refresh"></i></button> -->
                  <button class="btn btn-danger btn-sm" onclick="removeProductFromCart('<?=$value['id']?>','remove-product-from-cart')"><i class="fa fa-trash-o"></i></button>								
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
               <td class="hidden-xs"></td>
               <td  class="hidden-xs">Total</td>
               <td class="hidden-xs text-center"><strong class="grand-total">$<?=number_format($_SESSION['cart']['total'],2)?></strong></td>
             <?php  if(!empty($sessionCart)){ ?>
               <td><a href="checkout.php" class="btn btn-success btn-block">Checkout <i class="fa fa-angle-right"></i></a></td>
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
    function removeProductFromCart(product, mode) {
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
                url: "cart-core.php",
                type: "post",
                data: {
                    sess_prod_id: product,
                    mode: mode
                },
                success: function(data) {
                    var response = $.parseJSON(data);
                    if (response.status == 'success') {
                        Swal.fire({
                            title: response.message,
                            text: '',
                            icon: 'success'
                        }).then(function(result) {
                            if (result.value) {
                                location.reload();
                            }
                        });


                    } else {
                        Swal.fire(
                            response.message,
                            '',
                            'error'
                        )
                    }

                }
            })
        }
    })
}
$(document).on("change",".quantity",function(){
   var quantity_in_stock=parseInt($(this).attr("max"));
   var currentRow=$(this).closest('tr');
   var product=currentRow.find(".session_product_id").val();//get product id
   var quantity=parseInt($(this).val());
   if(quantity > quantity_in_stock){
      Swal.fire(
         "Sorry this product only contains "+quantity_in_stock+" in stock",
         '',
         'warning'
      )
      $(this).val(quantity_in_stock)
   
   }else{
      $.ajax({
         url:"cart-core.php",
         type:"post",
         data:{
            mode:"add-quantity",
            sess_prod_id:product,
            quantity:quantity
         },
         success:function(data){
            var response=$.parseJSON(data)
            if(response.status=='success'){
               var subTotal=parseInt(quantity)*parseFloat(currentRow.find("td.product-price").data('price'));
               currentRow.find("td.sub-total").text("$"+(parseFloat(subTotal).toFixed(2)))//increase row total
               // currentRow.find(".sub_total").val(parseFloat(subTotal).toFixed(2))//increase row total
               
               $(".grand-total").text("$"+response.message)
            }
            
         }
      })
   }

})

</script>