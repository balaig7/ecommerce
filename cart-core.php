<?php
require_once 'config.php';
$mode = $_POST['mode'];
$productId = $_POST['product_id'];
$quantity = $_POST['quantity'];
$productData = getSingleProduct("SELECT id,name,quantity as quantity_in_stock,original_price,discounted_price from `products` where id=" . $productId . "");
$quantityInStock = $productData['quantity_in_stock'];
$getProductInCart = getSingleProduct("SELECT * from `session_cart` where $where and product_id='" . $productId . "'");
if (empty($getProductInCart))
{
    $quantity = $quantity;
}
else
{
    $quantity = $getProductInCart['quantity'] + $quantity;
}
switch ($mode)
{
    case 'add-to-cart':
        addToCart($productId, $quantity, $quantityInStock, $sessionUserId, $currentLoggedUserId);
    break;
    case 'remove-product-from-cart':
        $removeProductFromCart = mysqli_query($conn, "DELETE FROM `session_cart` where $where and id='" . $productId . "'");
        if ($removeProductFromCart)
        {
            sendResponse('success', 'Product Removed Successfully');
        }
        else
        {
            sendResponse('success', 'Error in Removing product');

        }
    break;
    case 'add-quantity':
        $updateQuantity = mysqli_query($conn, "UPDATE `session_cart` set quantity='" . $quantity . "' where $where and id=" . $productId . "");
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

}
?>
