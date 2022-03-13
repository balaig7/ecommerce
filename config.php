<?php
require_once("settings.php");
	$paypalUrl='https://www.sandbox.paypal.com/cgi-bin/webscr';
	$paypalId='sb-dyajt7448805@personal.example.com';

session_start();
$_SESSION['cart']=array();
function sendResponse($status,$successMessage,$url=''){
    echo json_encode(array('status' => $status , 'message'=>$successMessage ,'redirectUrl' => $url ));
    exit;
    
}
if($_SESSION['current_user']['role']=='admin'){
    session_destroy();

}

$date=date("Y-m-d H:i:s");
foreach (glob("functions/*.php") as $filename)
{
    require_once $filename;
}
$_SESSION['sess_id']=session_id();
$sessionUserId=$_SESSION['sess_id'];//generate random id for both logged in and anonymous users
$isUserActive=empty($_SESSION['active']) ?  $_SESSION['active']='0' : $_SESSION['active'];//check if the user login or not
$currentLoggedUserId=empty($_SESSION['current_user']) ? '0'  : $_SESSION['current_user']['id'];//get current logged user id
$_SESSION['cart']['user']=$_SESSION['current_user'];
if(empty($currentLoggedUserId)){
    $where = "session_id='" . $sessionUserId . "'";
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
// echo "<pre>";
// print_r($_SESSION);


?>