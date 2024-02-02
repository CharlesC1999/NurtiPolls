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
$couponDescription=$_POST["coupon_description"];
$can_use_product=$_POST["categories"];

$sql="INSERT INTO coupons (C_name,C_code, Discount_amount ,Discount_type,Coupon_description,Valid_start_date, Valid_end_date , minimum_spend, valid )
VALUES ('$name', '$code','$couponAmount', '$discount_type','$couponDescription','$startdate', '$enddate' ,'$min_Amount' ,1)";

if($conn->query($sql)){
    echo "新增優惠券資料完成";

    
    // 獲取剛剛插入的優惠券ID
    $coupon_id = $conn->insert_id;

    // 為每個選擇的商品分類插入資料
    foreach($can_use_product as $category_id){
        $category_sql = "INSERT INTO coupon_categories (coupon_id, category_id) VALUES ('$coupon_id', '$category_id')";
        if(!$conn->query($category_sql)){
            echo "新增商品分類錯誤: " . $conn->error; 
        }
    }

} else {
    echo "新增優惠券資料錯誤: " . $conn->error; 
}

$conn->close();

header("location: add-coupon.php");
?>
