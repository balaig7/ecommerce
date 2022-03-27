<?php
$title="USERS";
include __DIR__."/loader.php";
$orders=array();
$orders =dbQuery('SELECT `orders`.id,`orders`.order_id as invoice_id,orders.name,orders.address,orders.city,`orders`.country,orders.total,orders.status,order_details.product_name,order_details.product_price,order_details.quantity,orders.created_at FROM `orders` INNER JOIN order_details on orders.id=order_details.order_id group by orders.order_id');
foreach ($orders as $key => $value) {
    $orders[$key]->order_details=dbQuery('SELECT order_details.product_name,order_details.product_price,order_details.quantity,orders.created_at,order_details.sub_total FROM `orders` INNER JOIN order_details on order_details.order_id=orders.id where order_details.order_id="'.$value->id.'"');
    // array_merge($orders['orders'],$orders['orders']['ords']);
}
// echo "<pre>";
// print_r($orders);
?>
<style>
    .modal-backdrop{
        position:unset!important;
    }
</style>
<div class="main-content">
<div class="row small-spacing">
   <div class="col-xs-12">
      <div class="box-content">
         <h4 class="box-title">Orders</h4>
         <table class="table table-striped table-bordered display datatable" style="width:100%">
            <thead>
               <tr>
                 <?php 
                  tableHead(array('S.no','Name','Address','City','Country','Products','Status'));
                 ?>
               </tr>
            </thead>
            
            <tbody>
                <?php foreach ($orders as $key => $value) { ?>
               <tr>
                  
                  <td><?=$key+1?></td>
                  <td><?=$value->name?></td>
                  <td><?=$value->address?></td>
                  <td><?=$value->city?></td>
                  <td><?=$value->country?></td>
                  <td>
    <a href="#"  data-toggle="modal" data-target="#viewProducts" data-dismiss="modal">View Products</a>

<div class="modal fade" id="viewProducts" tabindex="-1" role="dialog" aria-labelledby="registerModal" aria-hidden="true">
   <div class="modal-dialog" style="margin: 241px auto;">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="myFunction()">&times;</button>
            <h4 class="modal-title" id="myModalLabel"></h4>
         </div>
         <div class="modal-body">
			 <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Item</th>
      <th scope="col">Price</th>
      <th scope="col">Quantity</th>
      <th scope="col">Subtotal</th>
    </tr>
  </thead>
  <tbody>
      <?php foreach ($value->order_details as $key => $value) { ?>
    <tr>
        <th scope="row"><?=$key+1?></th>
        <td><?=$value->product_name?></td>
        <td><?=$value->product_price?></td>
        <td><?=$value->quantity?></td>
        <td><?=$value->sub_total?></td>
    </tr>
    <?php } ?>
  </tbody>
</table>

			<div class="modal-footer">
			</div>
		</div>
   </div>
   </div>
</div>

                  </td>
                  <td><span class="notice text-white <?=$value->status=='1' ? 'bg-success' : 'bg-danger'?>"><?=$value->status=='1' ? 'Active' : 'Inactive'?></span></td>
                  
               </tr>
               <?php } ?>
            </tbody>
         </table>
      </div>
   </div>
</div>
<?php
include __DIR__."/layouts/footer.php";
?>
<script>
function userAction(user,status){
    $.ajax({
        url:'user-action.php',
        type:"post",
        data:{
            user_id:user,
            status:status
        },
        success:function(data){
             var response = $.parseJSON(data);
                if (response.status == 'success') {
                    swal({
                        title: response.message,
                        text: '',
                        type: 'success'
                    }, function() {
                        location.reload();
                    });
                } else {
                    Swal({
                        title: 'Error',
                        text: '',
                        type: 'error'
                    })
                }
        }
    })
}
</script>
