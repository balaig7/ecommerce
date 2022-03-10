<?php
require_once("settings.php");
session_start();
$_SESSION['cart']=array();
function sendResponse($status,$successMessage,$url=''){
    echo json_encode(array('status' => $status , 'message'=>$successMessage ,'redirectUrl' => $url ));
    exit;
    
}
$date=date("Y-m-d H:i:s");
// session_destroy();
foreach (glob("functions/*.php") as $filename)
{
    require_once $filename;
}
$_SESSION['sess_id']=session_id();
$sessionUserId=$_SESSION['sess_id'];//generate random id for both logged in and anonymous users
$isUserActive=empty($_SESSION['active']) ?  $_SESSION['active']='0' : $_SESSION['active'];//check if the user login or not
$currentLoggedUserId=empty($_SESSION['current_user']) ? ''  : $_SESSION['current_user']['id'];//get current logged user id
$_SESSION['cart']['user']=$_SESSION['current_user'];
if(empty($currentLoggedUserId)){
    $where = "session_id='" . $sessionUserId . "' and user_id='" . $userId . "'";
}else{
    $where = "session_id='" . $sessionUserId . "'";

}
$productsInCart=dbQuery("SELECT * FROM `session_cart` where $where");
$convertToArray=json_decode(json_encode($productsInCart),true);
$productsInCart=array();
foreach ($convertToArray as $key => $value) {
    $productData = getSingleProduct("SELECT id,name,quantity as quantity_in_stock,thumnail_image_path,thumnail_image,discounted_price from `products` where id=" . $value['id'] . "");
    $productsInCart[$value['id']]=array_merge($productData,$value);
}
$_SESSION['cart']['products']=$productsInCart;


?>