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
?>