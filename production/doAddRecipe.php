<?php
require_once("../db_connectp.php");

if(!isset($_POST["name"])){
    echo "請正常管道進入";
    exit;
}

$name=$_POST["name"];
$email=$_POST["email"];
$phone=$_POST["phone"];

if(empty($name) || empty($email) || empty($phone)){
    echo "請輸入必填欄位";
    exit;
}


$sql="INSERT INTO users (name, phone, email) 
VALUES ('$name','$phone' ,'$email')";

// echo $sql;
// exit;
if($conn->query($sql)){
    echo "新增完成";
}else{
    echo "新增錯誤:" .$conn->error;
}
$conn->close();