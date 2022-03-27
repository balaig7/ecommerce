<?php
require_once 'config.php';
$orderData=array();
$orderCreatedAt=date("Y-m-d h:i:s");
$invoiceId=time() . mt_rand() .$currentLoggedUserId;
$orderData=array(
    'user_id'=>$currentLoggedUserId,
    'order_id'=>$invoiceId,
    'name' => mysqli_real_escape_string($conn,$_POST['first-name']." ".$_POST['last-name']),
    'email' =>mysqli_real_escape_string($conn,$_POST['email']),
    'address' => mysqli_real_escape_string($conn,$_POST['address']),
    'city' => mysqli_real_escape_string($conn,$_POST['city']),
    'country' => mysqli_real_escape_string($conn,$_POST['country']),
    'zipcode' => mysqli_real_escape_string($conn,$_POST['zip-code']),
    'total'=>$_SESSION['cart']['total'],
    'status'=>"new",
    'created_at' => $orderCreatedAt,
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
        mysqli_query($conn,'UPDATE `users` set address="'.mysqli_real_escape_string($conn,$_POST['address']).'",city ="'.mysqli_real_escape_string($conn,$_POST['city']).'",country ="'.mysqli_real_escape_string($conn,$_POST['country']).'" where id= "'.$_SESSION['current_user']['profile_id'].'"');
    }
    sendResponse('success',"Thank you. Your order has been received","order-success.php?order_id=".base64_encode($invoiceId)."-".base64_encode($currentLoggedUserId)."");

}


?>