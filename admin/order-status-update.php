<?php
require_once ('functions/func-db.php');
require_once ('functions/func-core.php');
$orderStatusData=json_decode(file_get_contents('php://input'));
$status=0;
foreach ($orderStatusData as $key => $value) {
    $query="UPDATE `orders` set status='".$value->status."' where order_id='".$value->orderId."'";
    if(mysqli_query($conn,$query)){
      $status=1;
    }
}
if($status==1){
    sendResponse('success' ,'Order Status Updated' ,'' );
}else{
    sendResponse('error' ,'Error in updating order status ','' );
}

?>