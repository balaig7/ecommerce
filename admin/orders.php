<?php
$title="USERS";
include __DIR__."/loader.php";
$orders=array();
$orders =dbQuery('SELECT `orders`.id,`orders`.order_id as invoice_id,orders.name,orders.address,orders.city,`orders`.country,orders.total,orders.status,order_details.product_name,order_details.product_price,order_details.quantity,orders.created_at FROM `orders` INNER JOIN order_details on orders.id=order_details.order_id group by orders.order_id');
foreach ($orders as $key => $value) {
    $orders[$key]->order_details=dbQuery('SELECT order_details.product_name,order_details.product_price,order_details.quantity,orders.created_at,order_details.sub_total FROM `orders` INNER JOIN order_details on order_details.order_id=orders.id where order_details.order_id="'.$value->id.'"');
    // array_merge($orders['orders'],$orders['orders']['ords']);
}
$orderStatusList=array(
    'New' =>'1',
    'Processing' => '2',
    'Cancelled' =>'3',
    'Completed' =>'4'

);
// echo "<pre>";
// print_r($orders);
?>
<style>
    .modal-backdrop{
        position:unset!important;
    }
    .update-status{
        width:100%;
        margin-top:15px;
    }

</style>
<div class="main-content">
<div class="row small-spacing">
   <div class="col-xs-12">
      <div class="box-content">
         <h4 class="box-title">Orders</h4>
         <table class="table table-striped table-bordered display datatable orders" style="width:100%">
            <thead>
               <tr>
                  <?php 
                     tableHead(array('#','Name','Address','City','Country','Products','Total Price','Status','Action'));
                     ?>
               </tr>
            </thead>
            <tbody>
               <?php foreach ($orders as $key => $value) { ?>
               <tr>
                  <td><input type="checkbox" name='check_box_values' class="orders-list" value="<?=$value->invoice_id?>"></td>
                  <td><?=$value->name?></td>
                  <td><?=$value->address?></td>
                  <td><?=$value->city?></td>
                  <td><?=$value->country?></td>
                  <td>
                     <a href="#"  data-toggle="modal" data-target="#viewProducts-<?=$key?>" data-dismiss="modal">View Products</a>
                     <div class="modal fade" id="viewProducts-<?=$key?>" tabindex="-1" role="dialog" aria-labelledby="registerModal" aria-hidden="true">
                        <div class="modal-dialog" style="margin: 241px auto;">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="myFunction()">&times;</button>
                                 <h4 class="modal-title" id="myModalLabel">#<?=$value->invoice_id?></h4>
                              </div>
                              <div class="modal-body">
                                 <table class="table table-striped ">
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
                                       <?php foreach ($value->order_details as $order_details_key => $order_details_value) { ?>
                                       <tr>
                                          <th scope="row"><?=$order_details_key+1?></th>
                                          <td><?=$order_details_value->product_name?></td>
                                          <td><?=$order_details_value->product_price?></td>
                                          <td><?=$order_details_value->quantity?></td>
                                          <td><?=$order_details_value->sub_total?></td>
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
                  <td><?=$value->total?></td>
                  <td>
                     <?php
                     switch ($value->status) {
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
                     <span class="notice bg-<?=$pillClass; ?>  text-white"><?=strtoupper($status)?></span>
                  </td>
                  <td>
                     <select name="status" class="order-status">
                        <?php foreach ($orderStatusList as $statuskey => $statusvalue) { ?>
                        <option value="<?=$statusvalue?>" <?=$statusvalue==$value->status ? "selected" : '' ?>><?=$statuskey?></option>
                        <?php } ?>
                     </select>
                  </td>
               </tr>
               <?php } ?>
            </tbody>
         </table>
            <button type="button" class="btn btn-primary update-status" onclick="updateStatus()">Update Status</button>
      </div>
   </div>
</div>
<?php
include __DIR__."/layouts/footer.php";
?>
<script>
function updateStatus(){
     var values = new Array();
     var orderStatus=orderId=''
     var data={};
   $('input[name="check_box_values"]:checked').each(function() {
         orderId=$(this).val()
         orderStatus=$(this).closest('tr').find('.order-status').val()
         values.push({"orderId":orderId,'status':orderStatus});
         
   });
    $.ajax({
        url:'order-status-update.php',
        data:JSON.stringify(values),
        type:"post",
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
