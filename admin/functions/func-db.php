<?php
require_once 'config/connection.php';
date_default_timezone_set("Asia/Kolkata");   //India time (GMT+5:30)

//insert data
function create($table,$data){
    global $conn;
    $message=$data['success_message'];
    $redirectUrl=$data['redirect_url'];
    $created_at=date("Y-m-d H:i:s");
    $data['created_at']=$created_at;
    unset($data['action'],$data['success_message'],$data['redirect_url']);

    $dbData=array();
    foreach($data as $columns => $values){
        $dbData[$columns]=mysqli_real_escape_string($conn,$values);
    }
    $query="INSERT into $table(".implode("," ,array_keys($dbData)).") values ('".implode("','",$dbData)."')";
    if(mysqli_query($conn,$query)){
        sendResponse('success' ,$message ,$redirectUrl );
    }else{
        sendResponse('failed' , 'Error' ,'' );
        
    }

}

function update($id,$table,$data,$condition=NULL){
    global $conn;
    $message=$data['success_message'];
    $redirectUrl=$data['redirect_url'];
    unset($data['action'],$data['success_message'],$data['redirect_url'],$data['id']);

    foreach ($data as $key => $value) {
        $datas[] = $key . "=" . "'" . $value . "'";
    }
    if(empty($condition)){
        $condition="id=".$id."";
    }
    $query="UPDATE `".$table."` set ".implode(",",$datas) ." where $condition";
    if(mysqli_query($conn,$query)){
        sendResponse('success' , $message ,$redirectUrl);
    }else{
        sendResponse('failed' , 'Error' ,'');
    }
}
//get data from db
function get($table){
    global $conn;
    $query="SELECT * from `".$table."`";
    $result=mysqli_query($conn,$query);
    $data=array();
    if(mysqli_num_rows($result)>0){
        while($row=mysqli_fetch_object($result)){
            $data[]=$row;
        }
    }
    return $data;

}

//get data by id

function find($id,$table){
    global $conn;
    $query="SELECT * from `".$table."` where id=".$id." LIMIT 1";
    $result=mysqli_query($conn,$query);
    if(mysqli_num_rows($result)>0){
        $data=mysqli_fetch_object($result);
    }
    return $data;

}

function delete($id,$table){
    global $conn;
    $query="DELETE from `".$table."` where id=".$id."";
    if(mysqli_query($conn,$query)){
     sendResponse('success','Data Deleted','');
    }

}

function dbQuery($query){
     global $conn;
    $result=mysqli_query($conn,$query);
    $data=array();
    if(mysqli_num_rows($result)>0){
        while($row=mysqli_fetch_object($result)){
            $data[]=$row;
        }
    }
    return $data;
}
function sendResponse($status,$successMessage,$url=''){
    echo json_encode(array('status' => $status , 'message'=>$successMessage ,'redirectUrl' => $url ));
     exit;

}

?>