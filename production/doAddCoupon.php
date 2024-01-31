<?php
require_once("../db_connect.php");

if(!isset($_POST["name"])){
    echo "請循正常管道進入";
    exit;
}

$name=$_POST["name"];
$code=$_POST["code"];
$startdate=$_POST["validStartDate"];
$enddate=$_POST["validEndDate"];
$discount_type=$_POST["discount_type"];
$couponAmount=$_POST["couponAmount"];
$min_Amount=$_POST["min_amount"];
$couponDiscription=$_POST["coupon_description"];

// 驗證1：若表單未填寫完整


$sql="INSERT INTO coupons (C_name,C_code, Discount_amount ,Discount_type,Coupon_description,Valid_start_date, Valid_end_date , minimum_spend, valid )
VALUES ('$name', '$code','$couponAmount', '$discount_type','$couponDiscription','$startdate', '$enddate' ,'$min_Amount' ,1)";

if($conn->query($sql)){
    echo "新增資料完成";
  
}else{
    echo "新增資料錯誤: " . $conn->error; 
}

$conn->close();

header("location: add-coupon.php");