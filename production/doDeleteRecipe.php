<?php
require_once("../db_connect.php");
$id = $_GET["Recipe_ID"];

$sql = "UPDATE recipe SET recipe_valid='0' WHERE Recipe_ID=$id";

if ($conn->query($sql) === true) {
    echo "刪除成功";
} else {
    echo "刪除資料錯誤: " . $conn->error;
}
$conn->close();
header("location:recipe-list.php");
