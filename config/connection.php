<?php
$host='localhost';
$username='root';
$password='';
$db='e_accessories';
$conn=mysqli_connect($host,$username,$password,$db);
if(!$conn){
	echo "<h1>Database not connected properly <h1>";
}
?>