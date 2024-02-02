<?php

require_once("../db_connect.php");

if (!isset($_GET["Coupon_ID"])) {
    $Coupon_ID = 0;
} else {
    $Coupon_ID = $_GET["Coupon_ID"];
}

$sql="UPDATE coupons SET valid='0' WHERE Coupon_ID = $Coupon_ID";

if ($conn->query($sql) === TRUE) {
    echo "刪除成功";
} else {
    echo "刪除資料錯誤: " . $conn->error;
}

$conn->close();

header("location: coupons.php");