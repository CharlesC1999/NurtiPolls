<?php

require_once("../db_connect.php");

$id=$_GET["Coupon_ID"];

$sql="UPDATE coupons SET valid='0' WHERE Coupon_ID = $id";

if ($conn->query($sql) === TRUE) {
    echo "刪除成功";
} else {
    echo "刪除資料錯誤: " . $conn->error;
}

$conn->close();

header("location: coupons.php");