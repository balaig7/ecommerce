<?php
require_once 'config.php';
$query="INSERT into `ratings`(".implode("," ,array_keys($_POST)).") values ('".implode("','",$_POST)."')";
if(mysqli_query($conn,$query)){
        sendResponse('success',"Thank You for your feedback","");
}

?>