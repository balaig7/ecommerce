<?php
require_once "config/connection.php";

//it generates random id after user logged id


function checkProductIncart($sessionId, $userId , $productId)
{
    global $conn;
    //for loggedin users
    if (!empty($userId))
    {
        $where = "session_id='" . $sessionId . "' and user_id='" . $userId . "'";
    }
    else
    {
        //for anonymous users
        $where = "session_id='" . $sessionId . "' and user_id='" . $userId . "'";
    }
    // echo "SELECT * FROM `session_cart` where " . $where . " and product_id='" . $productId . "' LIMIT 1";
    $isExists = mysqli_query($conn, "SELECT * FROM `session_cart` where " . $where . " and product_id='" . $productId . "' LIMIT 1");
    // return $isExists;
    if (mysqli_num_rows($isExists) > 0)
    {
        return true;
    }else{
        return false;

    }

    

}
function addToCart($productId, $quantity, $quantityInStock, $sessionId, $userId)
{
    global $conn;
    if ($quantity <= $quantityInStock)
    {
        $isProductExists = checkProductIncart($sessionId, $userId, $productId);
        if ($isProductExists)
        {
            //update quantity
            if (!empty($userId))
            {
                $where = "session_id='" . $sessionId . "' and user_id='" . $userId . "' and product_id='" . $productId . "'";
            }
            else
            {
                //for anonymous users
                $where = "session_id='" . $sessionId . "' and user_id='0'";
            }
            // echo "UPDATE `session_cart` set quantity='" . $quantity."' where " . $where . " and product_id='" . $productId . "'";
            $updateQuantity = mysqli_query($conn, "UPDATE `session_cart` set quantity='" . $quantity."' where " . $where . " and product_id='" . $productId . "'");
            if($updateQuantity){
                sendResponse('success', 'Product added to cart');
            }
        }
        else
        {
            //insert product
            // echo "INSERT into `session_cart` (user_id,session_id,product_id,quantity,created_at)values('".$userId."','".$sessionId."','".$productId."','".$quantity."','".date("Y-m-d H:i:s")."')";
            $insertProduct = mysqli_query($conn, "INSERT into `session_cart` (user_id,session_id,product_id,quantity,created_at)values('".$userId."','".$sessionId."','".$productId."','".$quantity."','".date("Y-m-d H:i:s")."')");
            if($insertProduct){
                sendResponse('success', 'Product added to cart');
            }
            
        }
    }
    else
    {
        sendResponse('failed', 'This product only contains ' . $quantityInStock . ' in stock ');
    }

}

?>
