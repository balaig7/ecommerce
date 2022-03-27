<?php
require_once 'config.php';
echo "<pre>";
print_r($_POST);
$orderData=array();
$responseData = file_get_contents('php://input');
mysqli_query($conn,"INSERT into `events`(data)values('".$responseData."') ");
$decodedvalue=json_decode($responseData);
$billingAddress=$decodedvalue->purchase_units['0']->shipping->address;
$orderCreatedAt=date("Y-m-d h:i:s");
$invoiceId=time() . mt_rand() .$currentLoggedUserId;
$orderData=array(
    'user_id'=>$currentLoggedUserId,
    'order_id'=>$invoiceId,
    'name' =>$decodedvalue->purchase_units['0']->shipping->name->full_name,
    'email'=>$decodedvalue->payer->email_address,
    'address'=>$billingAddress->address_line_1,
    'city'=>$billingAddress->admin_area_2,
    'country'=>"USA",
    'zipCode'=>$billingAddress->postal_code,
    'total'=>$decodedvalue->purchase_units['0']->amount->value,
    'status'=>"new",
    'created_at' => $orderCreatedAt ,
);
$query="INSERT into `orders`(".implode("," ,array_keys($orderData)).") values ('".implode("','",$orderData)."')";
if(mysqli_query($conn,$query)){
    $orderId=mysqli_insert_id($conn);
    $orderedProducts=$_SESSION['cart']['products'];
    foreach ($orderedProducts as $key => $value) {
        $orderDetails=array(
            'order_id' => $orderId,
            'product_id'=>$value['id'],
            'product_name' =>$value['name'],
            'product_price'=>$value['discounted_price'],
            'quantity'=>$value['quantity'],
            'sub_total'=>$value['quantity'] * $value['discounted_price'],
            'created_at'=>$orderCreatedAt,
        );
        $orderDetailsQuery="INSERT into `order_details`(".implode("," ,array_keys($orderDetails)).") values ('".implode("','",$orderDetails)."')";
        mysqli_query($conn,$orderDetailsQuery);
        mysqli_query($conn,'DELETE FROM `session_cart` where id= "'.$key.'"');
        mysqli_query($conn,'UPDATE `products` set quantity="'.($value['quantity_in_stock'])-($value['quantity']).'" where id= "'.$$value['id'].'"');
        mysqli_query($conn,'UPDATE `users` set address="'.mysqli_real_escape_string($conn,$billingAddress->address_line_1).'",city ="'.mysqli_real_escape_string($conn,$billingAddress->admin_area_2).'",country ="USA" where id= "'.$_SESSION['current_user']['profile_id'].'"');

    }
    sendResponse('success',"Thank you. Your order has been received","order-success.php?order_id=".base64_encode($invoiceId)."-".base64_encode($currentLoggedUserId)."");

}


?>