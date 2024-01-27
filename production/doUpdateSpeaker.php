<?php

require_once("../db-connect.php");

if (!isset($_POST["name"])) {
    die("請循正常管道進去");
} 

$name=$_POST["name"];
$description=$_POST["description"];
$id = $_POST["id"]; 


$sql="UPDATE speaker SET Speaker_name='$name', Speaker_description='$description' WHERE Speaker_ID=$id";

if($conn->query($sql) === TRUE){
    echo "更新成功";
}else{
    echo "更新資料錯誤" .$conn->error;
}

$conn->close();