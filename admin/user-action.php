<?php
require_once ('functions/func-db.php');
require_once ('functions/func-core.php');
error_reporting(0);
ini_set('display_errors', 0);
$status=mysqli_real_escape_string($conn,$_POST['status']);
$userId=mysqli_real_escape_string($conn,$_POST['user_id']);
$message=$status=='1' ? 'User Unblocked' : 'User Blocked';
$data=array(
    'status' => $status,
    'success_message' => $message,
);
update($userId,'login',$data,'');

?>

