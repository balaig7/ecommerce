<?php
require_once("settings.php");
	$paypalUrl='https://www.sandbox.paypal.com/cgi-bin/webscr';
	$paypalId='sb-erz1t15251550@business.example.com';

session_start();
$_SESSION['cart']=array();
function sendResponse($status,$successMessage,$url=''){
    echo json_encode(array('status' => $status , 'message'=>$successMessage ,'redirectUrl' => $url ));
    exit;
}
//if admin can login destroy the session
if($_SESSION['current_user']['role']=='admin'){
    session_destroy();
}

$date=date("Y-m-d H:i:s");
foreach (glob("functions/*.php") as $filename)
{
    require_once $filename;
}
    // echo "<pre>";
    // print_r($_SESSION);

$currentLoggedUserId=empty($_SESSION['current_user']) ? '0'  : $_SESSION['current_user']['id'];//get current logged user id
if($currentLoggedUserId==0){
    $_SESSION['sess_id']=session_id();
}else{
    // if(!empty($_SESSION['sess_id'])){
    //     $_SESSION['sess_id']=$_SESSION['sess_id'];
    //     $getOldToken="SELECT * FROM `session_cart` where session_id='".$_SESSION['sess_id']."'";
    //     $result=mysqli_query($conn,$getOldToken);
    //     if(mysqli_num_rows($result)>0){
    //         mysqli_query($conn,"UPDATE `session_cart` set user_id='".$currentLoggedUserId."' where user_id='0' or session_id='".$_SESSION['sess_id']."'");
    //     }
 
    // }
    // exit;
    $getOldToken="SELECT * FROM `session_cart` where user_id='".$currentLoggedUserId."' LIMIT 1";
    $result=mysqli_query($conn,$getOldToken);
    if(mysqli_num_rows($result)>0){
        $row=mysqli_fetch_assoc($result);
        $_SESSION['sess_id']=$row['session_id'];
        // echo "UPDATE `session_cart` set session_id='".$_SESSION['sess_id']."',user_id='".$currentLoggedUserId."' where user_id='0' or session_id='".$oldSession."'";
        // mysqli_query($conn,"UPDATE `session_cart` set session_id='".$_SESSION['sess_id']."',user_id='".$currentLoggedUserId."' where user_id='0' or session_id='".$oldSession."'");
    }else{
        $_SESSION['sess_id']=session_id();
    }
}
$sessionUserId=$_SESSION['sess_id'];//generate random id for both logged in and anonymous users
$isUserActive=empty($_SESSION['active']) ?  $_SESSION['active']='0' : $_SESSION['active'];//check if the user login or not
$_SESSION['cart']['user']=$_SESSION['current_user'];
if(empty($currentLoggedUserId)){
    $where = "session_id='" . $sessionUserId . "' and user_id='0'";
    $_SESSION['cart']['wishlist']=array();
}else{
    $where = "session_id='" . $sessionUserId . "' and user_id='" . $currentLoggedUserId . "'";
    $productsInWishlist=dbQuery("select wishlist.id,wishlist.product_id,products.name,products.discounted_price,products.thumnail_image_path,products.thumnail_image,products.quantity as quantity_in_stock from wishlist INNER JOIN products on products.id=wishlist.product_id where wishlist.user_id=".$currentLoggedUserId.""); 
    $_SESSION['cart']['wishlist']=json_decode(json_encode($productsInWishlist),true);
}
// echo "SELECT * FROM `session_cart` where $where";
$productsInCart=dbQuery("SELECT * FROM `session_cart` where $where");
$convertToArray=json_decode(json_encode($productsInCart),true);
$productsInCart=array();
$grandTotal=0;
foreach ($convertToArray as $key => $value) {
    $productData = getSingleProduct("SELECT id as products_unique_id,name,quantity as quantity_in_stock,thumnail_image_path,thumnail_image,discounted_price from `products` where id=" . $value['product_id'] . "");
    $productsInCart[$value['id']]=array_merge($productData,$value);
}
$_SESSION['cart']['products']=$productsInCart;
foreach($_SESSION['cart']['products'] as $key => $value){
    $grandTotal+=$value['discounted_price']*$value['quantity'];            
}
$_SESSION['cart']['total']=$grandTotal;
$_SESSION['cart']['old_orders']=array();
$_SESSION['cart']['old_orders']=dbQuery('SELECT `orders`.id,`orders`.order_id as invoice_id,orders.name,orders.address,orders.city,`orders`.country,orders.total,orders.status,order_details.product_name,order_details.product_price,order_details.quantity,orders.created_at FROM `orders` INNER JOIN order_details on orders.id=order_details.order_id where orders.user_id="'.$currentLoggedUserId.'" group by orders.order_id');
$_SESSION['cart']['old_orders']=json_decode(json_encode($_SESSION['cart']['old_orders']),true);
foreach ($_SESSION['cart']['old_orders'] as $key => $value) {
    $_SESSION['cart']['old_orders'][$key]['order_details']=dbQuery('SELECT order_details.product_name,order_details.product_price,order_details.quantity,orders.created_at,order_details.sub_total FROM `orders` INNER JOIN order_details on order_details.order_id=orders.id where order_details.order_id="'.$value['id'].'"');
    $_SESSION['cart']['old_orders'][$key]['order_details']=json_decode(json_encode($_SESSION['cart']['old_orders'][$key]['order_details']),true);
}
// echo "<pre>";
// print_r($_SESSION);


?>