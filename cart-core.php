<?php
require_once 'config.php';
$mode = $_POST['mode'];
$productId = $_POST['product_id'];
$quantity = $_POST['quantity'];
$productData = getSingleProduct("SELECT id,name,quantity as quantity_in_stock,original_price,discounted_price from `products` where id=" . $productId . "");
$quantityInStock=$productData['quantity_in_stock'];
$getProductInCart = getSingleProduct("SELECT * from `session_cart` where product_id=" .$productId . "");
if(empty($getProductInCart)){
    $quantity=$quantity;
}else{
    $quantity=$getProductInCart['quantity']+$quantity;
}
switch ($mode)
{
    case 'add-to-cart':
        addToCart($productId,$quantity,$quantityInStock,$sessionUserId,$currentLoggedUserId);
    break;
    case 'remove-product-from-cart':
        // echo "DELETE FROM `session_cart` where $where and product_id='".$_POST["product"]."'";
    $removeProductFromCart=mysqli_query($conn,"DELETE FROM `session_cart` where $where and product_id='".$_POST["product"]."'");
    if($removeProductFromCart){
        sendResponse('success','Product Removed Successfully');
    }else{
        sendResponse('success','Erro in Removing product');
        
    }
    break;
}
?>
