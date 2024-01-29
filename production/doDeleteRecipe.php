<?php
require_once("../db_connectn.php");
$id=$_GET["Recipe_ID"];

$sql="UPDATE recipe SET valid='0' WHERE Recipe_ID=$id";

if ($conn->query($sql) === TRUE) {
    echo "刪除成功";
} else {
    echo "刪除資料錯誤: " . $conn->error;
}
$conn->close();
header("location:recipe-list.php");
?>