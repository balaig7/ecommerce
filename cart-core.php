<?php
require_once 'config.php';
$mode = mysqli_real_escape_string($conn,$_POST['mode']);
$productId = mysqli_real_escape_string($conn,$_POST['product_id']);
$sessionCartProductId=mysqli_real_escape_string($conn,$_POST['sess_prod_id']);
$quantity = mysqli_real_escape_string($conn,$_POST['quantity']);
$wishlistProduct=mysqli_real_escape_string($conn,$_POST['wish_list_id']);
$productData = getSingleProduct("SELECT id,name,quantity as quantity_in_stock,original_price,discounted_price from `products` where id=" . $productId . "");
$quantityInStock = $productData['quantity_in_stock'];
$getProductInCart = getSingleProduct("SELECT * from `session_cart` where $where and product_id='" . $productId . "'");
if (empty($getProductInCart))
{
    $quan = $quantity;
}
else
{
    $quan= $getProductInCart['quantity'] + $quantity;
}
switch ($mode)
{
    case 'add-to-cart':
        addToCart($productId, $quan, $quantityInStock, $sessionUserId, $currentLoggedUserId);
    break;
    case 'remove-product-from-cart':
        $removeProductFromCart = mysqli_query($conn, "DELETE FROM `session_cart` where $where and id='" . $sessionCartProductId . "'");
        if ($removeProductFromCart)
        {
            sendResponse('success', 'Product Removed Successfully');
        }
        else
        {
            sendResponse('failed', 'Error in Removing product');

        }
    break;
    case 'add-quantity':
        $updateQuantity = mysqli_query($conn, "UPDATE `session_cart` set quantity='" . $quan . "' where $where and id=" . $sessionCartProductId . "");
        if ($updateQuantity)
        {
            $productsInCart = mysqli_query($conn, "SELECT * FROM `session_cart` where $where");
            $total = 0;
            $updatedData = $finalArray = array();
            while ($row = mysqli_fetch_assoc($productsInCart))
            {
                $updatedData[] = $row;
            }
            foreach ($updatedData as $key => $value)
            {
                $productRow = getSingleProduct("SELECT id as products_unique_id,name,quantity as quantity_in_stock,thumnail_image_path,thumnail_image,discounted_price from `products` where id=" . $value['product_id'] . "");
                $finalArray[] = array_merge($productRow, $value);
                $total += $value['discounted_price'] * $value['quantity'];
            }
            foreach ($finalArray as $key => $value)
            {
                $total += $value['discounted_price'] * $value['quantity'];
            }

            sendResponse('success', number_format($total, 2));
        }
    break;

    case 'add-to-wishlist':
        $query=mysqli_query($conn,"SELECT * FROM `wishlist` where user_id='".$currentLoggedUserId."' and product_id='".$productId."'");
        if($query){
            if(mysqli_num_rows($query)>0){
                sendResponse('failed', "This product already exists in your wishlist");
            }else{
                $addProductToWishlist=mysqli_query($conn,"INSERT into `wishlist` (user_id,product_id) values('".$currentLoggedUserId."','".$productId."')");
                if($addProductToWishlist){
                    sendResponse('success', "Product added to your wishlist");
                }
            }
        }
    break;

    case 'remove-product-from-wishlist':
    $removeProductFromWishlist = mysqli_query($conn, "DELETE FROM `wishlist` where  id='" . $wishlistProduct . "'");
        if ($removeProductFromWishlist)
        {
            sendResponse('success', 'Product Removed Successfully');
        }
        else
        {
            sendResponse('failed', 'Error in Removing product');

        }
    break;
}
?>
