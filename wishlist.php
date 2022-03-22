<?php
include __DIR__."/loader.php";
$wishlist=$_SESSION['cart']['wishlist'];
// echo "<pre>";
// print_r($wishlist);
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
       <div class="loader-img"></div>
       <h2 class="cart-label">MY WISHLIST</h2>
       <?php if(!empty($currentLoggedUserId)){ ?>

      <table id="cart" class="table table-hover table-condensed">
         <thead>
            <tr>
               <th>Product</th>
               <th>Price</th>
               <th>Action</th>
            </tr>
         </thead>               

         <tbody>
             <?php  if(!empty($wishlist)){ ?>
             <?php foreach($wishlist as $key => $value){  ?>
                
            <tr>
               <input type="hidden" class="session_product_id" value="<?=$value['id']?>">
               <td data-th="Product">
                  <div class="row">
                     <div class="col-sm-2 hidden-xs"><img src="<?=str_replace("../",'',$value['thumnail_image_path']).$value['thumnail_image']?>"  class="img-responsive"/></div>
                     <div class="col-sm-10">
                        <p><a href="content.php?id=<?=$value['product_id']?>"><?=$value['name']?></a></p>
                     </div>
                  </div>
               </td>
               <td data-th="Price" class="product-price" data-price="<?=$value['discounted_price']?>">$<?=$value['discounted_price']?></td>
               <td class="actions">
                  <button class="btn btn-danger btn-sm" onclick="removeProductFromWishlist('<?=$value['id']?>','remove-product-from-wishlist')"><i class="fa fa-trash-o"></i></button>								
                </td>
            </tr>
            <?php }?>  
            <?php }else{?>  
                <td class="empty-cart text-center" colspan="5" class="text-center">You have no items in your wishlist. Start adding!</td>

            <?php }?>  
         </tbody>
         <tfoot>
            
         </tfoot>
      </table>
      <?php }else{ ?>
        <h4 class="text-center text-danger">PLEASE <a href="login.php">LOGIN</a> TO CONTINUE</h4>
    <?php } ?>
   </div>
</div>
<?php
include __DIR__."/layouts/footer.php";
?>
<script>
    function removeProductFromWishlist(product, mode) {
    Swal.fire({
        title: 'Are you sure to remove this product from your wishlist?',
        text: "",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.isConfirmed) {
           $('.loader-img').show();

            $.ajax({
                url: "cart-core.php",
                type: "post",
                data: {
                    wish_list_id: product,
                    mode: mode
                },
                success: function(data) {
                  $('.loader-img').hide();
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
</script>