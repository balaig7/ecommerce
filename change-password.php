<?php
require_once("config.php");
// require_once __DIR__.'/config/connection.php';

$action=$_POST['action'];
if($action == 'change_password'){
    $newPassword=mysqli_real_escape_string($conn,password_hash($_POST['new_password'],PASSWORD_DEFAULT));//hash password
    $updateArrayData=array(
        'password' => $newPassword,
        'success_message' => 'Password Updated'
    );
    $updatePassword=update($currentLoggedUserId,'login',$updateArrayData,'');

}elseif ($action == 'forgot_password') {

}
?>