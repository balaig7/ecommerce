<?php
session_start();
foreach (glob("functions/*.php") as $filename)
{
    require_once $filename;
}
$getUserTemp=[];
// session_destroy();
require_once("settings.php");
$isUserActive=empty($_SESSION['active']=='1') ? '0' : $_SESSION['active'];
$currentLoggedUserId=empty($_SESSION['current_user']) ? ''  : $_SESSION['current_user']['id'];
$sessionUserId=generateSessionId();
$sessionData=array();
$sessionData['user']=$_SESSION['current_user'];
if($isUserActive){
    createOrGetSessionCart($currentLoggedUserId,$sessionUserId,$sessionData);
    $getUserTemp=json_decode(createOrGetSessionCart($currentLoggedUserId,$sessionUserId,$sessionData));
}
require_once __DIR__.'/config/connection.php';
require_once __DIR__.'/layouts/header.php';
?>