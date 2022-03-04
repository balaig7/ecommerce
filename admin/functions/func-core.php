<?php

function createFolder($folder){
    if (!file_exists($folder))
    {
        mkdir($folder, 0777, true); //create new folder inside assets
    }
}
function printArray(Array $data){
    echo "<pre>";
    print_r($data);
    exit;
}
function generateSku($size,$uid) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
  
    for ($i = 0; $i < $size; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }
  
    return "SKU-".$randomString.$uid;
}
function isLogin(){
 if(!isset($_SESSION['current_user'])){
    $_SESSION['error_message']='Please login to continue!';
    $_SESSION['redirect_url']=$_SERVER['REQUEST_URI'];
    header("location:login.php");
 }   
}
function isAdmin(Array $userdata){
if($userdata['role']!='admin'){
    unset($_SESSION['current_user']);
    $_SESSION['error_message']='You have no permission to access this page';
}

}
?>