<?php
require_once("../db_connect.php");

if(!isset($_POST["name"])){
    echo "請循正常管道進入";
    exit;
}

$Coupon_ID=$_POST["Coupon_ID"];
$name=$_POST["name"];
$code=$_POST["code"];
$startdate=$_POST["validStartDate"];
$enddate=$_POST["validEndDate"];
$discount_type=$_POST["discount_type"];
$couponAmount=$_POST["couponAmount"];
$min_Amount=$_POST["min_amount"];


$sql="UPDATE coupons 
SET C_name='$name' ,C_code='$code' ,Discount_amount='$couponAmount',Discount_type='$discount_type', Valid_start_date='$startdate', Valid_end_date='$enddate', minimum_spend='$min_Amount' WHERE Coupon_ID=$Coupon_ID";



if ($conn->query($sql) === TRUE) {
    echo "更新成功";
} else {
    echo "更新資料錯誤: " . $conn->error;
}

$conn->close();

header("location: coupon.php");