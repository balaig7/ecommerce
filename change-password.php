<?php
require_once("config.php");
$action=$_POST['action'];
if($action == 'change_password'){
    $newPassword=mysqli_real_escape_string($conn,password_hash($_POST['new_password'],PASSWORD_DEFAULT));//hash password
    $updateArrayData=array(
        'password' => $newPassword,
        'success_message' => 'Password Updated'
    );
    $updatePassword=update($currentLoggedUserId,'login',$updateArrayData,'');

}
?>