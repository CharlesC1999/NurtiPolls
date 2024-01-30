<?php
require_once("./connect.php");

$sql="UPDATE member SET User_name='wu' WHERE id=107";

if($conn->query($sql) === true) {
    echo "更新成功";
}else{
    echo "更新失敗:" .$conn->error;
}

$conn->close();