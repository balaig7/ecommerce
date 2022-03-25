<?php
require_once 'config.php';
$action=$_POST['action'];
if($action=='register'){

}elseif ($action="login") {
    $userName=mysqli_real_escape_string($conn,$_POST['user_name']);
    $password=mysqli_real_escape_string($conn,$_POST['password']);
    $query="SELECT id,display_name,profile_id,user_name,role,password FROM `login` where user_name='".$userName."'";
    $result=mysqli_query($conn,$query);
    if(mysqli_num_rows($result)>0){
        $userData=mysqli_fetch_assoc($result);
        if (password_verify($password, $userData['password'])) {
                unset($userData['password']);
                $billingDetails=mysqli_query($conn,'SELECT address,city,country from `users` where id="'.$userData['profile_id'].'" LIMIT 1');
                $billingDetailsData=mysqli_fetch_assoc($billingDetails);
				$_SESSION['current_user']=array_merge($userData,$billingDetailsData);
				if($_SESSION['current_user']['role']=='user'){
                    $_SESSION['active']=true;
                    sendResponse('success','Login success');
                    // $_SESSION['sess_id']=$_SESSION['sess_id'];

				}else{
                    session_destroy();
                }
        }else{
			sendResponse('error','Incorrect Password');
		}
    }else{
			sendResponse('error','Incorrect Username');
    }
}
?>