<?php
require_once "config/connection.php";

//it generates random id after user logged id
function generateSessionId(){ 
    $uniqueId=md5(uniqid(rand(), true));
    return $uniqueId;
}

function createOrGetSessionCart($userId,$sessionId,Array $sessionData){
global $conn;
$getSessionCartData=mysqli_query($conn,"SELECT * FROM `session_cart` where user_id=".$userId." LIMIT 1");
if($getSessionCartData){
    if(mysqli_num_rows($getSessionCartData)>0){
        $data=mysqli_fetch_assoc($getSessionCartData);
        $sessionData=$data['session_data'];
    }else{
        $createNewSession=mysqli_query($conn,"INSERT INTO `session_cart` (user_id,session_id,session_data,created_at)values('".$userId."','".$sessionId."','".json_encode($sessionData)."','".date("Y-m-d h:i:s")."')");
        if($createNewSession){
            $data=mysqli_fetch_assoc($getSessionCartData);
            $sessionData=$data['session_data'];
        }
        
    }
}
    $_SESSION['temp_data']=$sessionData;
    return $_SESSION['temp_data'];
}

function addToCart(){
 global $conn;
   
}
?>