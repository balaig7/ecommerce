<?php
session_start();
foreach (glob("functions/*.php") as $filename)
{
    require_once $filename;
}
isLogin();
isAdmin($_SESSION['current_user']);
include __DIR__."/layouts/menu.php";
include __DIR__."/layouts/header.php";
error_reporting(0);
ini_set('display_errors', 0);

?>